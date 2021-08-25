<template>
  <div>
    <!-- <div v-if="!loading" class="d-flex justify-content-between align-items-center">
      Cargando las Especies... <b-spinner small variant="success" label="Spinning"></b-spinner>
    </div> -->
    <div>
      Especie:
      <div class="mt-3">
        <span> <small>Filtros de Busqueda</small></span>
      </div>

      <b-row class="d-flex justify-content-center align-items-center">
        <b-col sm="12" md="4" lg="3" class="input-group mb-3 ">
          <vue-bootstrap-typeahead style="width: 87%;" @input="searchSpecie(specieName)"  @hit="onSelectSpecie"
          v-model="specieName" :data="species" placeholder="Busca la especie"/>
          <b-spinner class="ml-3 mt-2" v-if="loadingSpecies" small variant="success" label="Spinning"></b-spinner>
          <!-- <b-form-input @update="searchSpecie(newSpecie.name_common)" v-model="newSpecie.name_common"></b-form-input> -->
        </b-col>
        <b-col sm="12" md="4" lg="1" class="input-group mb-3">
          Apéndice
        </b-col>
        <b-col sm="12" md="4" lg="1" class="input-group mb-3">
          <b-form-select :options="appends" :disabled="!newSpecie.name_common" v-model="newSpecie.appendix" placeholder="Apéndice:"></b-form-select>
        </b-col>
        <b-col sm="12" md="4" lg="1" class="input-group mb-3">
          Origen:
        </b-col>
        <b-col sm="12" md="4" lg="1" class="input-group mb-3">
          <b-form-select :options="origins" :disabled="!newSpecie.name_common" v-model="newSpecie.origin" placeholder="Origen:"></b-form-select>
        </b-col>
        <b-col sm="12" md="4" lg="3" class="input-group mb-3">
          <b-form-input :disabled="!newSpecie.name_common" v-model="newSpecie.origin_country" placeholder="País de Origen:"></b-form-input>
        </b-col>
        <b-col sm="12" md="4" lg="2" class="input-group mb-3">
          <b-form-input type="number" :disabled="!newSpecie.name_common" v-model="newSpecie.qty" placeholder="Cantidad:"></b-form-input>
        </b-col>
      </b-row>

      <b-row>
        <b-col sm="12" md="4" lg="12" class="input-group mb-3">
          <b-form-input :disabled="!newSpecie.name_common" v-model="newSpecie.description" placeholder="Descripción:"></b-form-input>
        </b-col>
      </b-row>
      
      <!-- <b-row class="d-flex justify-content-start   align-items-center">
        <b-col sm="6" md="4" lg="3" class="input-group mb-3">
          <b-form-checkbox v-model="newSpecie.options.cautivery" :checked="true" name="check-button" :disabled="false" switch>
            ¿Criado en Cautividad?
          </b-form-checkbox>
        </b-col>
        <b-col v-if="newSpecie.options.cautivery" sm="12" md="4" lg="9" class="input-group mb-3">
          <b-form-input type="text"  v-model="newSpecie.operation_number" placeholder="N° de la Operación: "></b-form-input>
        </b-col>
      </b-row>
      
      <b-row class="d-flex justify-content-start   align-items-center">
        <b-col sm="6" md="4" lg="3" class="input-group mb-3">
          <b-form-checkbox v-model="newSpecie.options.preeconvention" :checked="true" name="check-button" :disabled="false" switch>
            ¿Espécimen Preconvencción?
          </b-form-checkbox>
        </b-col>
        <b-col v-if="newSpecie.options.preeconvention" sm="12" md="4" lg="2" class="input-group mb-3">
          Fecha de adquisicion:
        </b-col>
        <b-col v-if="newSpecie.options.preeconvention" sm="12" md="4" lg="7" class="input-group mb-3">
          <b-form-input type="date"  v-model="newSpecie.acquisition_date" placeholder="Fecha de adquisicion:"></b-form-input>
        </b-col>
      </b-row>
      <b-row class="d-flex justify-content-start   align-items-center">
        <b-col sm="6" md="4" lg="3" class="input-group mb-3">
          <b-form-checkbox v-model="newSpecie.options.reexport" :checked="true" name="check-button" :disabled="false" switch>
            ¿Posee reexportanción anterior?
          </b-form-checkbox>
        </b-col>
        <b-col v-if="newSpecie.options.reexport" sm="12" md="4" lg="2" class="input-group mb-3">
          <b-form-input type="text"  v-model="newSpecie.old_reexport_country" placeholder="País:"></b-form-input>
        </b-col>
        <b-col v-if="newSpecie.options.reexport" sm="12" md="4" lg="2" class="input-group mb-3">
          <b-form-input type="text"  v-model="newSpecie.warrant_number" placeholder="N° de Certificado:"></b-form-input>
        </b-col>
        <b-col v-if="newSpecie.options.reexport" sm="12" md="2" lg="2" class="input-group mb-3">
          Fecha de la última reexportación:
        </b-col>
        <b-col v-if="newSpecie.options.reexport" sm="12" md="3" lg="3" class="input-group mb-3">
          <b-form-input type="date"  v-model="newSpecie.old_reexport_date" placeholder="Fecha:"></b-form-input>
        </b-col>
      </b-row> -->

      <b-row class="d-flex justify-content-end align-items-center">
        <b-col v-if="isNew === false" sm="12" md="8" lg="9" class="input-group mb-3">
          <b-form-file
            :disabled="!showSpecies"
            @input="uploadFile(newSpecie)"
            accept=".pdf"
            v-model="file"
            placeholder="Documento Legal: (Formatos aceptados: .pdf)"
            drop-placeholder="Subir archivo aquí..."
            max-size="10240"
          ></b-form-file>
        </b-col>
        <b-col v-if="isNew === false" sm="12" md='6' lg='3' class="input-group mb-3 d-flex justify-content-end align-items-center">
          <button class="w-100 btn btn-primary" :disabled="!validSpecie" @click="addSpecieToList()">Agregar Especie a la Lista</button>
        </b-col>
        <b-col v-if="isNew === true" sm="12" class="input-group mb-3 d-flex justify-content-end align-items-center">
          <button class="w-100 btn btn-primary" :disabled="!validSpecie" @click="addSpecieToList()">Agregar Especie a la Lista</button>
        </b-col>
      </b-row>

    </div>
    
  </div>
</template>
<script>
import {mapActions, mapGetters} from 'vuex'
export default {
  props: ['selectedSpecies', 'showSelectSpecie','type', 'isNew'],
  data: () =>({

    newSpecie: {
      name_common: null,
      appendix: null,
      origin: null,
      description: null,
      operation_number: null,
      old_reexport_date: null,
      warrant_number: null,
      origin_country: null,
      old_reexport_country: null,
      acquisition_date: null,
      pivot:{
        file_url:null
      },
      options: {
        reexport:false,
        cautivery: false,
        preeconvention: false
      },
      qty: null
    },
    appends: ['I', 'II', 'III'],
    origins: ['W', 'R', 'D', 'A', 'C', 'F', 'U', 'I'],
    specieName:null,
    reexport: false,
    cautivery: false,
    preeconvention: false,
    loading: false,
    showSpecies: false,
    selectedSpecie: "",
    file:null,

    loadingSpecies: false,
    
    species:[],

  }),
  computed: {
    ...mapGetters([
        'allSpecies',
    ]),
    animalsSpecies(){
      let speciesRaw = this.allSpecies.filter( specie => specie.higher_taxa.kingdom === 'Animalia')
      let species = speciesRaw.map(specie => specie.common_names[1])
      let names = []
      const selec = { value: null, text: 'Especie', disabled: true }
      names.push(selec)
      for (const specie of species) {
        if (specie){
          let name = specie.name
          names.push(name)
        }
      }
      return names
    },
    plantSpecies(){
      let speciesRaw = this.allSpecies.filter( specie => specie.higher_taxa.kingdom === 'Plantae')
      let species = speciesRaw.map(specie => specie.common_names[1])
      let names = []
      const selec = { value: null, text: 'Especie', disabled: true }
      names.push(selec)
      for (const specie of species) {
        if (specie){
          let name = specie.name
          names.push(name)
        }
      }
      return names
    },
    validSpecie(){
      let valid_name_common = Boolean(this.newSpecie.name_common)
      let valid_description = Boolean(this.newSpecie.description)
      let valid_origin_country = Boolean(this.newSpecie.origin_country)
      let valid_appendix = Boolean(this.newSpecie.appendix)
      let valid_origin = Boolean(this.newSpecie.origin)
      let valid_qty = Boolean(this.newSpecie.qty)

      return valid_name_common && valid_qty && valid_description && valid_origin_country && valid_appendix && valid_origin
    }
  },
  methods: {
    ...mapActions([
      'fetchSpecies',
    ]),
    onSelectSpecie(specie) {
      this.newSpecie.name_common = specie;
    },
    setSpecieData(){
      if (this.newSpecie.kingdom === 'Animalia'){
        this.species = this.animalsSpecies
      }
      else {
        this.species = this.plants
      }
      this.showSpecies = true
    },
    searchSpecie(wordToSearch){
      if (wordToSearch.length >= 3){
        this.loadingSpecies = true
        axios
          .post(`/solicitante/permissions/searchSpecie`, {filter: wordToSearch})
          .then(res => {
            this.loadingSpecies = false
            for (const specieResult of res.data) {
              this.species.push(specieResult.full_name)
            }
          })
          .catch(err => {
            console.log(err.toString())
            this.loadingSpecies = true
            this.makeToast(err.toString(), 'danger')
          });
      }
    },
    uploadFile (specie) {
      this.$emit('uploadSpecieFile', this.file, specie, true)
    },
    closeAddSpecieDialog(){
      false
      this.$emit('closeAddSpecieDialog')
    },
    addSpecieToList(){
      this.$emit('addSpecie', this.newSpecie)
      this.newSpecie = {
        name_common: null,
        appendix: null,
        origin: null,
        description: null,
        operation_number: null,
        old_reexport_date: null,
        warrant_number: null,
        origin_country: null,
        old_reexport_country: null,
        acquisition_date: null,
        pivot:{
          file_url:null
        },
        options: {
          reexport:false,
          cautivery: false,
          preeconvention: false
        },
        qty: null
      }
      this.closeAddSpecieDialog()
    },
    makeToast(msg, variant = "success", delay = 3000, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: 'Requerimientos',
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    },
  },
  // beforeCreate: async function () {
  //     try {
  //         await this.$store.dispatch('fetchSpecies')
  //         this.loading = true
  //     } catch (err) {
  //     console.log(err)
  //   }
  // }
}
</script>