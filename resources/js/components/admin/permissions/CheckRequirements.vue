<template>
  <div>
    <div v-if="permit.length === 0">
      <h1>Error, el permiso no se ha podido encontrar.</h1>
      <a class="btn btn-primary mt-4 text-white" href="/permissions">Volver al Inicio</a>
    </div>
    <div>
      <b-row class=" mb-2 mt-2">
        <b-col md="6">Permiso N° {{permit[0].request_permit_no}}</b-col>
        <b-col md="6">
          <b-form-input v-model="permit[0].sistra" placeholder="Número Sistra"></b-form-input>
        </b-col>
        <div></div>
      </b-row>
      <div class="ml-5 mb-4">
        <hr>
        <b-row class=" mb-2 mt-2">
          <b-col md="6">Cliente: <span class="ml-2">{{this.permit[0].client.user.name}}</span></b-col>
          <b-col md="6">Nacionalidad: <span class="ml-2">{{this.permit[0].client.user.nationality}}</span></b-col>
        </b-row>
        <b-row class=" mb-2 mt-2">
          <b-col md="6">Email: <span class="ml-2">{{this.permit[0].client.email}}</span></b-col>
          <b-col md="6">DNI: <span class="ml-2">{{this.permit[0].client.user.dni}}</span></b-col>
        </b-row>
        <hr>
        <b-row class=" mb-2 mt-2">
          <b-col md="6">Lugar de Envio: <span class="ml-2">{{this.permit[0].destiny_place}}</span></b-col>
          <b-col md="6">Lugar de Llegada: <span class="ml-2">{{this.permit[0].departure_place}}</span></b-col>
        </b-row>
        <b-row class="mb-2 mt-2">
          <b-col md="6">Puerto de Salida: <span class="ml-2">{{this.permit[0].shipment_port}}</span></b-col>
          <b-col md="6">Puerto de Llegada: <span class="ml-2">{{this.permit[0].landing_port}}</span></b-col>
        </b-row>
        <b-row class="mb-2 mt-2">
          <b-col md="6">Consignado a: <span class="ml-2">{{this.permit[0].consigned_to}}</span></b-col>
          <b-col md="6">Medio de Transporte: <span class="ml-2">{{this.permit[0].transportation_way}}</span></b-col>
        </b-row>
        <b-row class="mb-2 mt-2">
          <b-col v-if="permit[0].permit_type_id === 2" md="6">País De Envío: <span class="ml-2">{{this.permit[0].country}}</span></b-col>
          <b-col v-if="permit[0].permit_type_id !== 2" md="6">País Destino: <span class="ml-2">{{this.permit[0].country}}</span></b-col>
          <b-col md="3">Propósito: <span class="ml-2">{{this.permit[0].purpose}}</span></b-col>
        </b-row>
        <hr>
      </div>
      <h4 class="ml-4 mb-4">Hoja de Checkeo de Requisitos</h4>
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
              
              <b-col lg="3" class="d-flex justify-content-center align-items-center">
                <div
                  class="d-flex justify-content-center align-items-center"
                  v-if="requeriment.short_name === 'documentos_especies'"
                >
                  <button :disabled="!permit[0].species.length > 0" class="btn text-dark" @click="showSelectedSpecies = true" style="cursor:pointer">
                    <font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon>
                  </button>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-row" v-else-if="requeriment.short_name !== 'documentos_especies'">
                  <b-form-checkbox
                    :disabled="!requeriment.pivot.file_url"
                    @change="changeValid(requeriment, permit[0])"
                    :id="'checkbox'+ requeriment.id"
                    v-model="requeriment.pivot.is_valid"
                    :value="1"
                    :unchecked-value="0"
                  >
                    Válido
                  </b-form-checkbox>
                  <div >
                    <b-form-input @change="sendErrors(requeriment, permit[0])" class="ml-4" v-if="!requeriment.pivot.is_valid" v-model="requeriment.pivot.file_errors" placeholder="Indique el problema:" ></b-form-input>
                  </div>
                </div>
              </b-col>
            </b-row>
          </div>
        </div>
        <button class="btn btn-primary" :disabled="!isValidRequirements" @click="validPermit()">Validar Permiso</button>
      </div>

    </div>
    <b-modal v-model="showSelectedSpecies" size="xl" id="species-modal" title="Listado de Especies" hide-footer>
      <SelectedSpecies
      v-on:uploadSpecieFile="uploadSpecieFile"
      v-on:validSpecies="validSpecies"
      v-on:deleteFile="deleteFile"
      v-on:closeSpecieListDialog="closeSpecieListDialog"
      :selectedSpecies="permit[0].species" :showSelectedSpecies="showSelectedSpecies"
      :type="type"/>
    </b-modal>
  </div>
</template>
<script>

import SelectedSpecies from '../permissions/SelectedSpecies.vue';
export default {
  props: ['permit','type', 'official'],
  components: {
    SelectedSpecies
  },
  data: () => ({
    columns: [
      "Requerimiento",
      "Archivo",
      "Validación"
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

    errorId: null,
    showErrors: false,
    showSelectSpecie: false,
    showSelectedSpecies: false,

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
    isValidRequirements(){
      let count = 0 
      for (const requeriment of this.permit[0].requeriments) {
        if (requeriment.short_name === 'documentos_especies') {
          let speciesCount = this.checkUploadedSpecies(count)
          count += speciesCount
        }
        else if (requeriment.pivot.is_valid){
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
        if (specie.pivot.is_valid){
          speciesCount++
        }
      }
      if(speciesCount === this.permit[0].species.length){
        return 1
      }
    },
    uploadSpecieFile (file, specie) {

      var form = new FormData();
      form.append("file", file);
      form.append("specie", JSON.stringify(specie));
      axios
        .post(`/dashboard/permissions/uploadSpecieFile/`, form, {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        })
        .then(res => {
          console.log(res.data)
          specie.pivot.file_url = res.data
          this.makeToast('Archivo Guardado')
          setTimeout(() => window.location.reload(), 1200)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    uploadFile (file, requeriment, index) {

      var form = new FormData()
      form.append("file", file)
      form.append("requeriment", JSON.stringify(requeriment));

      axios
        .post(`/dashboard/permissions/uploadFile/`, form, {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        })
        .then(res => {
          console.log(res.data)
          this.makeToast('Archivo Guardado')
          requeriment.pivot.file_url = res.data
          setTimeout(() => window.location.reload(), 1200)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    changeValid(requeriment, permit){
      requeriment.pivot.is_valid = !requeriment.pivot.is_valid
      if (requeriment.pivot.is_valid){
        this.showErrors = false
        this.errorId = null
        requeriment.pivot.file_errors = null
      } else {
        this.showErrors = true
        this.errorId = requeriment.id
      }
      axios
        .post(`/dashboard/permissions/check/`+permit.id, {requeriment: JSON.stringify(requeriment), permit: permit})
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), 1200)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    validSpecies(specie, index){
      axios
        .post(`/dashboard/permissions/checkSpecies/`+this.permit[0].id, {specie: JSON.stringify(specie), permit: this.permit[0], index: index})
        .then(res => {
          this.makeToast(res.data)
          this.showSelectedSpecies = false
          // setTimeout(() => window.location.reload(), 1200)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    validPermit(index){
      axios
        .post(`/dashboard/permissions/validPermit/`+ this.permit[0].id, {official_id: this.official.id, sistra: this.permit[0].sistra})
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.assign('/dashboard/permissions/'), 1200)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    sendErrors(requeriment, permit){
      axios
        .post(`/dashboard/permissions/check/`+permit.id, {requeriment: JSON.stringify(requeriment), permit: permit})
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), 1200)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    closeSpecieListDialog(){
      this.showSelectedSpecies = false
    },
    deleteFile(file){
      console.log(file)
    },
    makeToast(msg, variant = "success", delay = 3000, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: 'Estatus del Requerimiento Actualizado.',
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    },
    addSpecieToList(newSpecie){
      console.log(newSpecie)
      this.selectedSpecies.push(newSpecie)
    },
  },
}
</script>