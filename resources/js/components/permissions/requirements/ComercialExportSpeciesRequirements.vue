<template>
  <div>
    <div class="caja bg-light p-2 my-2">
      <h3 class="ml-4 mb-4">Permiso de exportación de especies de la fauna silvestre vivas, muertas o de sus productos no incluida en los apéndices de la Convención sobre el Comercio Internacional de Especies Amenazadas de Fauna y Flora Silvestres (CITES) con fines comerciales.</h3>
      <h4 class="ml-4 mb-2">Requisitos:</h4>
      <ul class="list-group mt-4">
        <div class="card card-body">
          <v-client-table :data="tableData" :columns="columns" :options="options">
            <div
              class="action-container"
              slot="acciones"
              v-if="(props.row.id === 3 && is_valid_dni === true) ||
              (props.row.id === 4 && is_valid_rif === true) ||
              (props.row.id === 5 && is_valid_comerce_species_license === true) ||
              (props.row.id === 6 && is_valid_zoo_hatcheries_authorization === true)"
              slot-scope="props"
            >
              
            </div>
            <div
              class="action-container"
              slot="acciones"
              v-else-if="props.row.id === 7"
              slot-scope="props"
            >
              <button class="btn text-primary" @click="showSelectSpecie = true" style="cursor:pointer">
                <font-awesome-icon :icon="['fa', 'plus']"></font-awesome-icon>
              </button>
              <button class="btn text-dark" @click="showSpecies = true" style="cursor:pointer">
                <font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon>
              </button>
            </div>
            <div
              class="action-container"
              slot="acciones"
              v-else
              slot-scope="props"
            >
              <label class="text-dark" :for="'file'+ props.row.id" style="cursor:pointer">
                <font-awesome-icon :icon="['fa', 'upload']"></font-awesome-icon>
              </label>
              <b-form-file
                style="display:none"
                :id="'file'+ props.row.id"
                accept=".pdf, .jpg, .png"
                v-model="props.row.file"
                drop-placeholder="Subir archivo aquí..."
                max-size="2048"
              ></b-form-file>
              <a class="text-danger" @click.prevent="{deleteFile(props.row)}" style="cursor:pointer">
                <font-awesome-icon :icon="['fa', 'trash']"></font-awesome-icon>
              </a>
            </div>
            <span slot="requerimiento" slot-scope="props">{{props.row.name}}</span>
            <span slot="archivo" v-if="(props.row.id === 3 && is_valid_dni === true) ||
              (props.row.id === 4 && is_valid_rif === true) ||
              (props.row.id === 5 && is_valid_comerce_species_license === true) ||
              (props.row.id === 6 && is_valid_zoo_hatcheries_authorization === true)"
              slot-scope="props"
            > 
              <font-awesome-icon :icon="['fa', 'check']"></font-awesome-icon>
              Ya está registrado este Documento
            </span>
            <span slot="archivo" v-else-if="props.row.id === 7" slot-scope="props"><font-awesome-icon :icon="['fa', 'clipboard-list']"></font-awesome-icon> Especies Agregadas: {{selectedSpecies.length}}</span>
            <span slot="archivo" v-else-if="props.row.file === null" slot-scope="props"><font-awesome-icon :icon="['fa', 'ban']"></font-awesome-icon> No hay un archivo subido</span>
            <span slot="archivo" v-else slot-scope="props"><font-awesome-icon :icon="['fa', 'file-alt']"></font-awesome-icon> {{props.row.file.name}}</span>

            
          </v-client-table>

          <div v-if="showSelectSpecie">
            Especies:
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
          </div>
          <div class="w-100 d-flex justify-content-end align-items-center">
            <button class="btn btn-primary mt-3">Enviar Recaudos para su revisión</button>
          </div>
        </div>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  data: () => ({
    columns: [
      "requerimiento",
      "archivo",
      "acciones"
    ],
    tableData: [
      {
        id: 1,
        name: 'Planilla de solicitud Exportación de Fauna Silvestre y/o sus productos (disponible en minec.gob.ve).',
        file: null
      },
      {
        id: 2,
        name: 'Timbres fiscales por 2 unidades tributarias.',
        file: null
      },
      {
        id: 3,
        name: 'Cédula de identidad.',
        file: null
      },
      {
        id: 4,
        name: 'Registro Único de Información Fiscal RIF.',
        file: null
      },
      {
        id: 5,
        name: 'Licencia para ejercer el comercio o industria de animales silvestres vivos, muertos y de sus productos, emitido por el MINEC.',
        file: null
      },
      {
        id: 6,
        name: 'Autorización para la instalación y funcionamiento de Zoocriaderos con fines comerciales, emitido por el MINEC.',
        file: null
      },
      {
        id: 7,
        name: 'Especies',
        file: null
      },
    ],
    options: {
      perPage: 10,
      perPageValues: [10, 20, 50]
    },
    is_valid_dni: true,
    is_valid_rif: false,
    is_valid_zoo_hatcheries_authorization: false,
    is_valid_comerce_species_license: false,
    export_form_file: null,
    revenue_stamps_file: null,
    dni_file: null,
    rif_file: null,
    showSelectSpecie: false,
    showSpecies: false,
    species_legal_documents_file: null,
    comerce_species_license_file: null,
    zoo_hatcheries_authorization_file: null,
    newSpecie: {
      name: null,
      phylum: null,
      family: null,
      class: null,
      kingdom: null,
      legal_document:null,
      qty: null
    },
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
    selectedSpecies:[]
  }),
  computed : {
    exportFormInputValue(){
      this.getFileName()
    } 
  }, methods: {
    getFileName(){
      const element = document.getElementById('exportForm')
      console.log(element)
      return element
    },
    deleteFile(row){
      console.log(row)
      row.file= null
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
  }
}
</script>
<style>
  .custom-file-input:lang(en) ~ .custom-file-label::after {
    content: 'Subir Archivo';
  }
</style>