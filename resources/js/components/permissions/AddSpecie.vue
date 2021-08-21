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
        <b-col sm="12" md="4" lg="4" class="input-group mb-3 ">
          <vue-bootstrap-typeahead style="width: 90%;" @input="searchSpecie(specieName)"  @hit="onSelectSpecie"
          v-model="specieName" :data="species" placeholder="Busca la especie"/>
          <b-spinner class="ml-3 mt-2" v-if="loadingSpecies" small variant="success" label="Spinning"></b-spinner>
          <!-- <b-form-input @update="searchSpecie(newSpecie.name_common)" v-model="newSpecie.name_common"></b-form-input> -->
        </b-col>
        <b-col sm="12" md="4" lg="6" class="input-group mb-3">
          <b-form-input :disabled="!newSpecie.name_common" v-model="newSpecie.description" placeholder="Descripción:"></b-form-input>
        </b-col>
        <b-col sm="12" md="4" lg="2" class="input-group mb-3">
          <b-form-input type="number" :disabled="!newSpecie.name_common" v-model="newSpecie.qty" placeholder="Cantidad:"></b-form-input>
        </b-col>
      </b-row>
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
      description: null,
      pivot:{
        file_url:null
      },
      qty: null
    },
    specieName:null,
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
      let valid_kingdom = Boolean(this.newSpecie.kingdom)
      let valid_qty = Boolean(this.newSpecie.qty)

      return valid_name_common && valid_qty && valid_kingdom
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
            for (const specieResult of res.data.auto_complete_taxon_concepts) {
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
        kingdom: null,
        pivot:{
          file_url:null,
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