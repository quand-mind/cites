<template>
  <div>
    <div v-if="permit.length === 0">
      <h1>Error, el permiso no se ha podido encontrar.</h1>
      <a class="btn btn-primary mt-4 text-white" href="/permissions">Volver al Inicio</a>
    </div>
    <div>
      <h1 class="ml-4 mb-4">Permiso N° {{permit[0].request_permit_no}}</h1>
      <h4 class="ml-4 mb-4">Hoja de Checkeo de Requisitos</h4>
      <h4 class="ml-4 mb-4">Requisitos para: <br> (Permiso de exportación de especies de la fauna silvestre vivas, muertas o de sus productos no incluida en los apéndices de la Convención sobre el Comercio Internacional de Especies Amenazadas de Fauna y Flora Silvestres (CITES) con fines comerciales.)</h4>
      <div class="card card-body">
        <div class="d-flex justify-content-center align-items-center flex-column">
          <div class="w-100 header d-flex justify-content-between align-items-center flex-row">
            <div class=" w-100" v-for="(column,index) of columns" v-bind:key="index">
              <div class="ml-3"><b>{{column}}</b></div>
            </div>
          </div>
          <div class="w-100 body justify-content-center align-items-center flex-column">
            <div class="w-100 d-flex justify-content-between align-items-center flex-row" v-for="(row,index) of tableData" v-bind:key="index">
              <div class="w-100 ml-3 my-4">{{row.name}}</div>
              <div class="w-100 ml-3">
                <div v-if="row.id === 7">
                  <font-awesome-icon :icon="['fa', 'clipboard-list']"></font-awesome-icon> Especies Agregadas: {{selectedSpecies.length}}
                </div>
                <div v-else-if="(row.id === 3 && is_valid_dni) ||
                (row.id === 4 && is_valid_rif) ||
                (row.id === 5 && is_valid_comerce_species_license) ||
                (row.id === 6 && is_valid_zoo_hatcheries_authorization)">

                  <font-awesome-icon :icon="['fa', 'check']"></font-awesome-icon>
                  Ya está registrado este Documento
                </div>
                <div v-else-if="!row.file">
                  <font-awesome-icon :icon="['fa', 'ban']"></font-awesome-icon> No hay un archivo subido
                </div>
                <div v-else>
                  <a :href="row.path" target="_blank"><font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon> Archivo ({{ row.file.name }})</a>
                </div>
              </div>
              <div class="w-100 ml-3">
                <div
                  class="d-flex justify-content-start align-items-center"
                  v-if="(row.id === 3 && is_valid_dni) ||
                  (row.id === 4 && is_valid_rif) ||
                  (row.id === 5 && is_valid_comerce_species_license) ||
                  (row.id === 6 && is_valid_zoo_hatcheries_authorization)"
                >
                Checkeado
                </div>
                <div
                  class="d-flex justify-content-start align-items-center"
                  v-else-if="row.id === 7"
                >
                  <button class="btn text-primary" @click="showSelectSpecie = true" style="cursor:pointer">
                    <font-awesome-icon :icon="['fa', 'plus']"></font-awesome-icon>
                  </button>
                  <button class="btn text-dark" @click="showSelectedSpecies = true" style="cursor:pointer">
                    <font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon>
                  </button>
                </div>
                <div
                  class="d-flex justify-content-start align-items-center"
                  v-else
                >
                  <label class="btn text-dark" :for="'file'+ row.id" style="cursor:pointer">
                    <font-awesome-icon :icon="['fa', 'upload']"></font-awesome-icon>
                  </label>
                  <b-form-file
                    @change="handleChangeUpload"
                    :data-id="row.id"
                    style="display:none"
                    :id="'file'+ row.id"
                    accept=".pdf, .jpg, .png"
                    v-model="row.file"
                    drop-placeholder="Subir archivo aquí..."
                    max-size="2048"
                  ></b-form-file>
                  <button class="ml-3 btn text-danger relative" @click.prevent="deleteFile(row)" style="cursor:pointer">
                    <font-awesome-icon :icon="['fa', 'trash']" @click.prevent="deleteFile(row)"></font-awesome-icon>
                  </button>
                </div>
              </div>
              <div class="w-100">
                <div v-if="row.id !== 7" class="ml-3">
                  <label :for="'check'+ row.id">Valido</label>
                  <input type="checkbox" :id="'check'+ row.id" v-model="row.is_valid" aria-label="Válido">
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- <div v-if="showSelectSpecie">
          Especie:
          <div class="mt-3">
            <span> <small>Filtros de Busqueda</small></span>
          </div>
          <b-row v-if="showSelectSpecie" class="d-flex justify-content-center align-items-center">
            <b-col sm="12" md="4" lg="2" class="input-group mb-3 ">
              <b-form-select v-model="newSpecie.kingdom" :options="kingdoms"></b-form-select>
            </b-col>
            <b-col sm="12" md="4" lg="2" class="input-group mb-3">
              <b-form-select v-model="newSpecie.family" :options="families"></b-form-select>
            </b-col>
            <b-col sm="12" md="4" lg="2" class="input-group mb-3">
              <b-form-select v-model="newSpecie.class" :options="classes"></b-form-select>
            </b-col>
            <b-col sm="12" md="4" lg="2" class="input-group mb-3">
              <b-form-select v-model="newSpecie.phylum" :options="phylums"></b-form-select>
            </b-col>
            <b-col sm="12" md="4" lg="2" class="input-group mb-3">
              <b-form-select v-model="newSpecie.name" :options="species"></b-form-select>
            </b-col>
            <b-col sm="12" md="4" lg="2" class="input-group mb-3">
              <b-form-input v-model="newSpecie.qty" placeholder="Cantidad:"></b-form-input>
            </b-col>
          </b-row>
          <b-row v-if="showSelectSpecie" class="d-flex justify-content-center align-items-center">
            <b-col sm="12" md="8" lg="9" class="input-group mb-3">
              <b-form-file
                accept=".pdf, .jpg, .png"
                v-model="newSpecie.legal_document"
                placeholder="Documento Legal: (Formatos aceptados: .pdf, .jpg, .png)"
                drop-placeholder="Subir archivo aquí..."
                max-size="2048"
              ></b-form-file>
            </b-col>
            <b-col sm="12" md="4" lg="2" class="input-group mb-3 d-flex justify-content-end align-items-center">
              <button class="btn btn-primary" @click="addSpecieToList()">Agregar Especie a la Lista</button>
            </b-col>
            <b-col sm="12" md="4" lg="1" class="input-group mb-3 d-flex justify-content-end align-items-center">
              <button class="btn btn-danger" @click="showSelectSpecie = false">Cancelar</button>
            </b-col>
          </b-row>
        </div> -->

        <div class="ml-4" v-if="showSelectedSpecies && selectedSpecies.length >0">
          Listado de Especies: <button class="ml-4 btn btn-info" @click="showSelectedSpecies = false">Ocultar Listado</button>
          <b-row class="mt-3" v-for="(specie, index) of selectedSpecies" v-bind:key="index">
            <b-col lg="3" class="w-100"> Nombre de la Especie: {{specie.name}}</b-col>
            <b-col lg="3" class="w-100">Tipo de Especie: {{specie.kingdom}}</b-col>
            <b-col lg="3" class="w-100">Cantidad: {{specie.qty}}</b-col>
            <b-col lg="3" class="w-100">
              <a :href="specie.path" target="_blank"><font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon> Archivo ({{ specie.legal_document.name }})</a>
            </b-col>
          </b-row>
        </div>

        <button class="btn btn-primary">Enviar</button>
      </div>

    </div>
    <b-modal v-model="showSelectSpecie" size="xl" id="species-modal" title="Agregar Especie" hide-footer>
      <AddSpecie
      v-on:addSpecie="addSpecieToList"
      v-on:closeAddSpecieDialog="closeAddSpecieDialog"
      :selectedSpecies="selectedSpecies" :showSelectSpecie="showSelectSpecie"
      type="client"/>
    </b-modal>
    <b-modal v-model="showSelectedSpecies" size="xl" id="species-modal" title="Listado de Especies" hide-footer>
      <SelectedSpeciesList
      v-on:deleteSpecie="deleteSpecie"
      v-on:closeSpecieListDialog="closeSpecieListDialog"
      :selectedSpecies="selectedSpecies" :showSelectedSpecies="showSelectedSpecies"
      type="client"/>
    </b-modal>
  </div>
</template>
<script>

const tableData = [
  {
    id: 1,
    name: 'Planilla de solicitud Exportación de Fauna Silvestre y/o sus productos (disponible en minec.gob.ve).',
    file: null,
    is_valid: false
  },
  {
    id: 2,
    name: 'Timbres fiscales por 2 unidades tributarias.',
    file: null,
    is_valid: false
  },
  {
    id: 3,
    name: 'Cédula de identidad.',
    file: null,
    is_valid: false
  },
  {
    id: 4,
    name: 'Registro Único de Información Fiscal RIF.',
    file: null,
    is_valid: false
  },
  {
    id: 5,
    name: 'Licencia para ejercer el comercio o industria de animales silvestres vivos, muertos y de sus productos, emitido por el MINEC.',
    file: null,
    is_valid: false
  },
  {
    id: 6,
    name: 'Autorización para la instalación y funcionamiento de Zoocriaderos con fines comerciales, emitido por el MINEC.',
    file: null,
    is_valid: false
  },
  {
    id: 7,
    name: 'Especies',
  },
]

export default {
  props: ['permit'],
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
    files: [],
    tableData,
    is_valid_dni: true,
    is_valid_rif: false,
    is_valid_zoo_hatcheries_authorization: false,
    is_valid_comerce_species_license: false,

    showSelectSpecie: false,
    showSelectedSpecies: false,
    showSpecies: false,

    newSpecie: {
      name: null,
      phylum: null,
      family: null,
      class: null,
      kingdom: null,
      legal_document:null,
      qty: null
    },
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
    handleChangeUpload (e) {
      this.files[Number(e.target.getAttribute('data-id')) - 1] = e.target.files[0]

      // this.files = [ ...this.files ]
    },
    deleteFile(row){
      row.file = null
    },
    addSpecieToList(){
      this.selectedSpecies.push(this.newSpecie)
      console.log(this.newSpecie.legal_document)
      this.newSpecie = {
        name: null,
        phylum: null,
        family: null,
        class: null,
        kingdom: null,
        legal_document:null,
        qty: null
      }
      this.showSelectSpecie = false
    }
  },
}
</script>