<template>
  <div>
    <div>
      <b-alert v-model="loading" variant="info" class="alertFile d-flex justify-content-between align-items-center">
        <span>Subiendo Archivo...</span> <b-spinner small label="Spinning"></b-spinner>
      </b-alert>
      <b-alert v-model="loadingDelete" variant="info" class="alertFile d-flex justify-content-between align-items-center">
        <span>Elimnando Archivo...</span> <b-spinner small label="Spinning"></b-spinner>
      </b-alert>
      <h1 class="ml-4 mb-4">Tramite N° {{formalitie.request_formalitie_no}}</h1>
      <div class="card mb-4" v-for="(permit, index) of formalitie.permits" :key="index">
        <h2 class="mt-3 ml-4 mb-4">Permiso N° {{permit.request_permit_no}}</h2>
        <h5 class="ml-4 mb-4">Subida de Requisitos</h5>
        <h5 class="ml-4 mb-4">Requisitos para: <br> ({{permit.permit_type.name}})</h5>
        <div class="card m-4 card-body">
          <div class="d-flex justify-content-center align-items-center flex-column">
            <b-row class="w-100 header d-flex justify-content-between align-items-center flex-row">
              <b-col lg="3" class="d-flex justify-content-center align-items-center" v-for="(column,index) of columns" v-bind:key="index">
                <b>{{column}}</b>
              </b-col>
            </b-row>
            <div class="w-100 body justify-content-center align-items-center flex-column">
              <b-row class="w-100 d-flex justify-content-between align-items-center flex-row" v-for="(requeriment,index) of permit.requeriments" v-bind:key="index">
                <b-col lg="3" class="my-4">{{requeriment.name}}</b-col>
                <b-col lg="3" class="d-flex justify-content-center align-items-center">
                  <div v-if="requeriment.short_name === 'documentos_especies'">
                    <font-awesome-icon :icon="['fa', 'clipboard-list']"></font-awesome-icon> Especies Agregadas: {{permit.species.length}}
                  </div>
                  <div v-if="!requeriment.pivot.file_url">
                    <font-awesome-icon :icon="['fa', 'ban']"></font-awesome-icon> No hay un archivo subido
                  </div>
                  <div v-else>
                    <a :href="`/${requeriment.pivot.file_url}`" target="_blank"><font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon> Ver Archivo</a>
                  </div>
                </b-col>
                <b-col lg="3">
                  <div
                    class="d-flex justify-content-center align-items-center"
                  >
                    <button v-if="requeriment.short_name === 'documentos_especies'" class="btn text-dark" @click="showSelectedSpecies = true" style="cursor:pointer">
                      <font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon>
                    </button>
                    <label v-if="!requeriment.pivot.file_url" class="btn text-primary" :for="'permit'+ permit.id +'file'+ requeriment.id" style="cursor:pointer">
                      <font-awesome-icon :icon="['fa', 'upload']"></font-awesome-icon>
                    </label>
                    <b-form-file
                      @input="uploadFile(file, requeriment, index)"
                      style="display:none"
                      :id="'permit'+ permit.id +'file'+ requeriment.id"
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
        </div>
        <b-modal v-model="showSelectedSpecies" size="xl" id="species-modal" title="Listado de Especies" hide-footer>
          <SelectedSpecies
          v-on:closeSpecieListDialog="closeSpecieListDialog"
          :selectedSpecies="permit.species"
          :type="type"/>
        </b-modal>
      </div>
      <button v-if="formalitie.status === 'uploading_requeriments'" :disabled="!isUploadedRequirements" @click="requestPermit()" class="btn btn-primary w-100">Finalizar Subida de Recaudos</button>

    </div>
  </div>
</template>
<script>

import SelectedSpecies from '../../admin/permissions/SelectedSpecies.vue';
import AddSpecie from '../AddSpecie.vue';
export default {
  props: ['formalitie','type'],
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
    count: 0,
    length: 0,
    loading: false,
    loadingDelete: false,
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
      this.count = 0 
      this.length = 0
      for (const permit of this.formalitie.permits) {
        for (const requeriment of permit.requeriments) {
          this.length++
          if (requeriment.pivot.file_url){
            this.count++
          }
        }
      }
      if(this.length === this.count) {
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
    uploadFile (file, requeriment, index) {

      var form = new FormData()
      form.append("file", file)
      form.append("requeriment", JSON.stringify(requeriment));
      this.loading = true

      axios
        .post(`/solicitante/permissions/uploadFile/`, form, {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        })
        .then(res => {
  
          this.makeToast('Archivo Guardado')
          requeriment.pivot.file_url = res.data
          this.loading = false
          this.$forceUpdate();
        })
        .catch(err => {
          this.loading = false
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
    checkUploadedRequirements(){
      this.count = 0 
      this.length = 0
      for (const permit of this.formalitie.permits) {
        for (const requeriment of permit.requeriments) {
          this.length++
          if (requeriment.pivot.file_url){
            this.count++
          }
        }
      }
      if(this.length === this.count) {
        return true
        // return count
      }
      else{
        // return count
        return false
      }
    }
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
      this.loadingDelete = true
      axios
        .post(`/solicitante/permissions/deleteFile/${requeriment.pivot.permit_id}`, {requeriment: JSON.stringify(requeriment)})
        .then(res => {
          requeriment.pivot.file_url = null
          this.makeToast(res.data)
          this.loadingDelete = false
          // setTimeout(() => window.location.reload(), 1200)
        })
        .catch(err => {
          this.loadingDelete = false
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
          // setTimeout(() => window.location.reload(), 1200)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    deleteSpecieFile(specie, index){
      this.closeSpecieListDialog()
      this.loadingDelete = true
      axios
        .post(`/solicitante/permissions/deleteSpecieFile/${specie.pivot.permit_id}`, {specie: JSON.stringify(specie),index: index})
        .then(res => {
          specie.pivot.file_url = null
          this.loadingDelete = false
          this.makeToast(res.data)
          // setTimeout(() => window.location.reload(), 1200)
        })
        .catch(err => {
          this.loadingDelete = false
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
<style>
 .alertFile{
   position: fixed;
   top: 0;
   right: 0;
   z-index:100;
 }
</style>