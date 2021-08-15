<template>
  <div>
    <div v-if="!loading" class="d-flex justify-content-between align-items-center">
      Cargando las Especies... <b-spinner small variant="success" label="Spinning"></b-spinner>
    </div>
    <div v-if="loading">
      Especie:
    <div class="mt-3">
      <span> <small>Filtros de Busqueda</small></span>
    </div>
    <b-row class="d-flex justify-content-center align-items-center">
      <b-col sm="12" md="4" lg="4" class="input-group mb-3 ">
        <b-form-select @input="setSpecieData()" v-model="newSpecie.kingdom" :options="kingdoms"></b-form-select>
      </b-col>
      <b-col sm="12" md="4" lg="6" class="input-group mb-3">
        <b-form-select :disabled="!showSpecies" v-model="newSpecie.name_common" :options="species"></b-form-select>
      </b-col>
      <b-col sm="12" md="4" lg="2" class="input-group mb-3">
        <b-form-input type="number" :disabled="!showSpecies" v-model="newSpecie.qty" placeholder="Cantidad:"></b-form-input>
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
      kingdom: null,
      pivot:{
        file_url:null
      },
      qty: null
    },
    loading: false,
    showSpecies: false,
    file:null,

    kingdoms:[
      { value: null, text: 'Tipo', disabled: true },
      { value: 'Animalia', text: 'Animalia' },
      { value: 'Plantae', text: 'Plantae' },
    ],

    plants:[
      { value: null, text: 'Especie', disabled: true },
      { value: 'Orquidea', text: 'Orquidea' },
      { value: 'Araguaney', text: 'Araguaney' },
      { value: 'Girasol', text: 'Girasol' },
    ],

    animals:[
      { value: null, text: 'Especie', disabled: true },
      { value: 'Berrendo', text: 'Berrendo' },
      { value: 'Perro', text: 'Perro' },
      { value: 'Gato', text: 'Gato' },
    ],
    species:[
      { value: null, text: 'Especie', disabled: true },
    ],

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
    setSpecieData(){
      if (this.newSpecie.kingdom === 'Animalia'){
        this.species = this.animalsSpecies
      }
      else {
        this.species = this.plants
      }
      this.showSpecies = true
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
  },
  beforeCreate: async function () {
      try {
          await this.$store.dispatch('fetchSpecies')
          this.loading = true
      } catch (err) {
      console.log(err)
    }
  }
}
</script>