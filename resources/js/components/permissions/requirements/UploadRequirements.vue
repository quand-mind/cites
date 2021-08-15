<template>
  <div>
    <div>
      <h1 class="ml-4 mb-4">Permiso N° {{permit[0].request_permit_no}}</h1>
      <h4 class="ml-4 mb-4">Subida de Requisitos</h4>
      <h4 class="ml-4 mb-4">Requisitos para: <br> ({{permit[0].permit_type.name}})</h4>
      <div class="card card-body">
        <div class="d-flex justify-content-center align-items-center flex-column">
          <b-row class="w-100 header d-flex justify-content-between align-items-center flex-row">
            <b-col lg="3" class="d-flex justify-content-center align-items-center" v-for="(column,index) of columns" v-bind:key="index">
              <b>{{column}}</b>
            </b-col>
          </b-row>
          <div class="w-100 body justify-content-center align-items-center flex-column">
            <b-row class="w-100 d-flex justify-content-between align-items-center flex-row" v-for="(requeriment,index) of permit[0].requeriments" v-bind:key="index">
              <b-col lg="3" class="my-4">{{requeriment.name}}</b-col>
              <b-col lg="3" class="d-flex justify-content-center align-items-center">
                <div v-if="requeriment.short_name === 'documentos_especies'">
                  <font-awesome-icon :icon="['fa', 'clipboard-list']"></font-awesome-icon> Especies Agregadas: {{permit[0].species.length}}
                </div>
                <div v-else-if="!requeriment.pivot.file_url">
                  <font-awesome-icon :icon="['fa', 'ban']"></font-awesome-icon> No hay un archivo subido
                </div>
                <div v-else>
                  <a :href="`/${requeriment.pivot.file_url}`" target="_blank"><font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon> Ver Archivo</a>
                </div>
              </b-col>
              <b-col lg="3">
                <div
                  class="d-flex justify-content-center align-items-center"
                  v-if="requeriment.short_name === 'documentos_especies'"
                >
                  <button :disabled="!permit[0].species.length > 0" class="btn text-dark" @click="showSelectedSpecies = true" style="cursor:pointer">
                    <font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon>
                  </button>
                </div>
                <div
                  class="d-flex justify-content-center align-items-center"
                  v-else
                >
                  <label v-if="!requeriment.pivot.file_url" class="btn text-primary" :for="'file'+ requeriment.id" style="cursor:pointer">
                    <font-awesome-icon :icon="['fa', 'upload']"></font-awesome-icon>
                  </label>
                  <b-form-file
                    @input="uploadFile(file, requeriment, index)"
                    :data-id="requeriment.id"
                    style="display:none"
                    :id="'file'+ requeriment.id"
                    accept=".pdf"
                    v-model="file"
                    drop-placeholder="Subir archivo aquí..."
                    max-size="10240"
                  ></b-form-file>
                  <button v-if="requeriment.pivot.file_url" class="ml-3 btn text-danger relative" @click="deleteFile(requeriment)" style="cursor:pointer">
                    <font-awesome-icon :icon="['fa', 'trash']"></font-awesome-icon>
                  </button>
                </div>
              </b-col>
            </b-row>
          </div>
        </div>
        <button v-if="permit[0].status === 'uploading_requeriments'" :disabled="!isUploadedRequirements" @click="requestPermit()" class="btn btn-primary">Finalizar Subida de Recaudos</button>
      </div>

    </div>

    <b-modal v-model="showSelectedSpecies" size="xl" id="species-modal" title="Listado de Especies" hide-footer>
      <SelectedSpecies
      v-on:uploadSpecieFile="uploadSpecieFile"
      v-on:deleteSpecieFile="deleteSpecieFile"
      v-on:deleteSpecie="deleteSpecie"
      v-on:closeSpecieListDialog="closeSpecieListDialog"
      :selectedSpecies="permit[0].species" :showSelectedSpecies="showSelectedSpecies"
      :type="type"/>
    </b-modal>
  </div>
</template>
<script>

import SelectedSpecies from '../../admin/permissions/SelectedSpecies.vue';
import AddSpecie from '../AddSpecie.vue';
export default {
  props: ['permit','type'],
  components: {
    SelectedSpecies,
    AddSpecie
  },
  data: () => ({
    columns: [
      "Requerimiento",
      "Archivo",
      "Acciones"
    ],
    fileUpload: null,
    options: {
      perPage: 10,
      perPageValues: [10, 20, 50]
    },
    file: null,
    is_valid_dni: true,
    is_valid_rif: false,
    is_valid_zoo_hatcheries_authorization: false,
    is_valid_comerce_species_license: false,

    showSelectSpecie: false,
    showSelectedSpecies: false,

    selectedSpecies:[],
    families:[],

    kingdoms:[
      { value: null, text: 'Tipo' },
      { value: 'Animalia', text: 'Animalia' },
      { value: 'Plantae', text: 'Plantae' },
    ],
    families:[
      { value: null, text: 'Familia' },
      { value: 'Antilocapridae', text: 'Antilocapridae' },
    ],
    classes:[
      { value: null, text: 'Clase' },
      { value: 'Mammalia', text: 'Mammalia' },
    ],
    phylums:[
      { value: null, text: 'Filo' },
      { value: 'Chordata', text: 'Chordata' },
    ],
    species:[
      { value: null, text: 'Especie' },
      { value: 'Berrendo', text: 'Berrendo' },
      { value: 'Perro', text: 'Perro' },
      { value: 'Gato', text: 'Gato' },
    ],


  }),
  computed: {
    isUploadedRequirements(){
      let count = 0 
      for (const requeriment of this.permit[0].requeriments) {
        if (requeriment.short_name === 'documentos_especies') {
          let speciesCount = this.checkUploadedSpecies(count)
          count += speciesCount
        }
        else if (requeriment.pivot.file_url){
          count++
        }
      }
      if(this.permit[0].requeriments.length === count) {
        return true
        // return count
      }
      else{
        // return count
        return false
      }
    }
  },
  methods: {
    checkUploadedSpecies(count){
      let speciesCount = 0
      for (const specie of this.permit[0].species) {
        if (specie.pivot.file_url){
          speciesCount++
        }
      }
      if(speciesCount === this.permit[0].species.length){
        return 1
      }
    },
    uploadSpecieFile (file, specie, isNew, index) {

      var form = new FormData();
      form.append("file", file);
      form.append("specie", JSON.stringify(specie));
      form.append("permit", JSON.stringify(this.permit[0]));
      form.append("isNew", JSON.stringify(isNew));
      form.append("index", JSON.stringify(index));
      axios
        .post(`/solicitante/permissions/uploadSpecieFile/`, form, {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        })
        .then(res => {
  
          specie.pivot.file_url = res.data
          this.makeToast('Archivo Guardado')
          // setTimeout(() => window.location.reload(), 1200)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
        this.closeSpecieListDialog()
    },
    uploadFile (file, requeriment, index) {

      var form = new FormData()
      form.append("file", file)
      form.append("requeriment", JSON.stringify(requeriment));

      axios
        .post(`/solicitante/permissions/uploadFile/`, form, {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        })
        .then(res => {
  
          this.makeToast('Archivo Guardado')
          requeriment.pivot.file_url = res.data
          setTimeout(() => window.location.reload(), 1200)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    changeValid(requeriment, permit){

      axios
        .post(`/dashboard/permissions/check/`+permit.id, {requeriment: requeriment, permit: permit})
        .then(res => {
          this.makeToast(res.data)
          // setTimeout(() => window.location.reload(), 1200)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    closeAddSpecieDialog(){
      this.showSelectSpecie = false
    },
    closeSpecieListDialog(){
      this.showSelectedSpecies = false
    },
    requestPermit(){
      axios
        .post(`/solicitante/permissions/requestPermit/${this.permit[0].id}`)
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), 1200)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    deleteFile(requeriment){
      axios
        .post(`/solicitante/permissions/deleteFile/${requeriment.pivot.permit_id}`, {requeriment: JSON.stringify(requeriment)})
        .then(res => {
          requeriment.pivot.file_url = null
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), 1200)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    deleteSpecie(specie){
      console.log(specie)
      axios
        .post(`/solicitante/permissions/deleteSpecie`, {specie: JSON.stringify(specie), permit: JSON.stringify(this.permit[0])})
        .then(res => {
          this.permit[0].species.splice(specie.id - 1)
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), 1200)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    deleteSpecieFile(specie, index){
      axios
        .post(`/solicitante/permissions/deleteSpecieFile/${specie.pivot.permit_id}`, {specie: JSON.stringify(specie),index: index})
        .then(res => {
          specie.pivot.file_url = null
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), 1200)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    makeToast(msg, variant = "success", delay = 3000, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: 'Requerimientos',
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    },
    submit(){},
    addSpecieToList(newSpecie){
      axios
        .post(`/solicitante/permissions/addSpecie`, {specie: JSON.stringify(newSpecie), permit: JSON.stringify(this.permit[0])})
        .then(res => {
          newSpecie.pivot.file_url = null
          this.makeToast(res.data)
          // setTimeout(() => window.location.reload(), 1200)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
      this.permit[0].species.push(newSpecie)
    },
  },
}
</script>