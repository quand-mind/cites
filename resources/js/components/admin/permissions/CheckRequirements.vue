<template>
  <div>
    <div v-if="permit.length === 0">
      <h1>Error, el permiso no se ha podido encontrar.</h1>
      <a class="btn btn-primary mt-4 text-white" href="/permissions">Volver al Inicio</a>
    </div>
    <div>
      <h1 class="ml-4 mb-4">Permiso N° {{permit[0].request_permit_no}}</h1>
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
                  <font-awesome-icon :icon="['fa', 'clipboard-list']"></font-awesome-icon> Especies Agregadas: {{selectedSpecies.length}}
                </div>
                <div v-else-if="(requeriment.short_name === 'cedula' && is_valid_dni) ||
                (requeriment.short_name === 'dni' && is_valid_rif) ||
                (requeriment.short_name === 'licencia_comercio_animales' && is_valid_comerce_species_license) ||
                (requeriment.short_name === 'autorizacion_zoocriaderos' && is_valid_zoo_hatcheries_authorization)">

                  <font-awesome-icon :icon="['fa', 'check']"></font-awesome-icon>
                  Ya está registrado este Documento
                </div>
                <div v-else-if="!requeriment.pivot.file_url">
                  <font-awesome-icon :icon="['fa', 'ban']"></font-awesome-icon> No hay un archivo subido
                </div>
                <div v-else>
                  <a :href="requeriment.pivot.file_url" target="_blank"><font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon> Ver Archivo</a>
                </div>
              </b-col>
              <b-col lg="3">
                <div
                  class="d-flex justify-content-center align-items-center"
                  v-if="(requeriment.short_name === 'cedula' && is_valid_dni) ||
                  (requeriment.short_name === 'rif' && is_valid_rif) ||
                  (requeriment.short_name === 'licencia_comercio_animales' && is_valid_comerce_species_license) ||
                  (requeriment.short_name === 'autorizacion_zoocriaderos' && is_valid_zoo_hatcheries_authorization)"
                >
                Checkeado
                </div>
                <div
                  class="d-flex justify-content-center align-items-center"
                  v-else-if="requeriment.short_name === 'documentos_especies'"
                >
                  <button class="btn text-primary" @click="showSelectSpecie = true" style="cursor:pointer">
                    <font-awesome-icon :icon="['fa', 'plus']"></font-awesome-icon>
                  </button>
                  <button :disabled="!selectedSpecies.length > 0" class="btn text-dark" @click="showSelectedSpecies = true" style="cursor:pointer">
                    <font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon>
                  </button>
                </div>
                <div
                  class="d-flex justify-content-center align-items-center"
                  v-else
                >
                  <label v-if="!requeriment.pivot.file_url" class="btn text-dark" :for="'file'+ requeriment.id" style="cursor:pointer">
                    <font-awesome-icon :icon="['fa', 'upload']"></font-awesome-icon>
                  </label>
                  <b-form-file
                    @input="uploadFile(file)"
                    :data-id="requeriment.id"
                    style="display:none"
                    :id="'file'+ requeriment.id"
                    accept=".pdf, .jpg, .png"
                    v-model="file"
                    drop-placeholder="Subir archivo aquí..."
                    max-size="2048"
                  ></b-form-file>
                  <button v-if="requeriment.pivot.file_url" class="ml-3 btn text-danger relative" @click.prevent="deleteFile(requeriment)" style="cursor:pointer">
                    <font-awesome-icon :icon="['fa', 'trash']" @click.prevent="deleteFile(requeriment)"></font-awesome-icon>
                  </button>
                </div>
              </b-col>
              <b-col lg="3" class="d-flex justify-content-center align-items-center">
                <div v-if="(requeriment.short_name === 'cedula' && is_valid_dni) ||
                  (requeriment.short_name === 'rif' && is_valid_rif) ||
                  (requeriment.short_name === 'licencia_comercio_animales' && is_valid_comerce_species_license) ||
                  (requeriment.short_name === 'autorizacion_zoocriaderos' && is_valid_zoo_hatcheries_authorization)">
                    Checkeado
                </div>
                <div v-else-if="requeriment.short_name !== 'documentos_especies'">
                  <b-form-checkbox
                    :disabled="!requeriment.pivot.file_url"
                    @input="changeValid(requeriment, permit[0])"
                    :id="'checkbox'+ requeriment.id"
                    v-model="requeriment.pivot.is_valid"
                    :value="1"
                    :unchecked-value="0"
                  >
                    Válido
                  </b-form-checkbox>
                  <div v-if="!requeriment.pivot.is_valid">
                    <b-form-input v-model="requeriment.pivot.file_errors" placeholder="Indique el problema:" ></b-form-input>
                  </div>
                </div>
              </b-col>
            </b-row>
          </div>
        </div>
      </div>

    </div>
    <b-modal v-model="showSelectSpecie" size="xl" id="species-modal" title="Agregar Especie" hide-footer>
      <AddSpecie
      v-on:addSpecie="addSpecieToList"
      v-on:uploadFile="uploadFile"
      v-on:closeAddSpecieDialog="closeAddSpecieDialog"
      :selectedSpecies="selectedSpecies" :showSelectSpecie="showSelectSpecie"
      :type="type"/>
    </b-modal>
    <b-modal v-model="showSelectedSpecies" size="xl" id="species-modal" title="Listado de Especies" hide-footer>
      <SelectedSpeciesList
      v-on:uploadFile="uploadFile"
      v-on:deleteSpecie="deleteSpecie"
      v-on:deleteFile="deleteFile"
      v-on:closeSpecieListDialog="closeSpecieListDialog"
      :selectedSpecies="selectedSpecies" :showSelectedSpecies="showSelectedSpecies"
      :type="type"/>
    </b-modal>
  </div>
</template>
<script>


import AddSpecie from '../../permissions/AddSpecie.vue';
import SelectedSpeciesList from '../../permissions/SelectedSpeciesList.vue';
export default {
  props: ['permit','type'],
  components: {
    AddSpecie,
    SelectedSpeciesList
  },
  data: () => ({
    columns: [
      "Requerimiento",
      "Archivo",
      "Acciones",
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

    showSelectSpecie: false,
    showSelectedSpecies: false,
    showSpecies: false,

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
  methods: {
    uploadFile (file) {
      console.log(file)
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
    deleteFile(file){
      console.log(file)
    },
    deleteSpecie(index){
      console.log(index)
      this.selectedSpecies.splice(index, 1)
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
      this.showSelectSpecie = false
    },
  },
}
</script>