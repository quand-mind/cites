<template>
  <div>
    <div>

      <b-row>
        <b-col md='4'>
          <b-row class="pl-4 d-flex justify-content-start align-items-center">
            <picture>
              <b-img
                thumbnail
                fluid
                :src="newPhotoUrl || '/images/default-user.png'"
                alt="user photo"
              ></b-img>
            </picture>
            <b-form-file
              accept="image/*"
              v-model="newPhoto"
              :disabled="!newSpecie.name_common"
              placeholder="Escoge una foto (Max. 2MB)"
              drop-placeholder="Subir archivo aquí..."
            ></b-form-file>
            <div class="mt-3">Selected file: {{ newPhoto ? newPhoto.name : '' }}</div>
          </b-row>
        </b-col>
        <b-col md='8'>
          <b-row class="d-flex justify-content-center align-items-center">
            <b-col sm="12" md="6" lg="6" class="input-group mb-3 ">
              <vue-bootstrap-typeahead style="width: 87%;" @input="searchSpecie(specieName)"  @hit="onSelectSpecie"
              v-model="specieName" :data="species" placeholder="Busca la especie (Nombre Científico):"/>
              <b-spinner class="ml-3 mt-2" v-if="loadingSpecies" small variant="success" label="Spinning"></b-spinner>
            </b-col>
            <b-col sm="12" md="6" lg="6" class="input-group mb-3">
              <b-form-input :disabled="!newSpecie.name_common" v-model="newSpecie.general_appearance" placeholder="Apariencia General:"></b-form-input>
            </b-col>
            <b-col sm="12" md="6" lg="6" class="input-group mb-3">
              <b-form-input :disabled="!newSpecie.name_common" v-model="newSpecie.measurements" placeholder="Medidas Estándar:"></b-form-input>
            </b-col>
            <b-col sm="12" md="6" lg="6" class="input-group mb-3">
              <b-form-input type="text" :disabled="!newSpecie.name_common" v-model="newSpecie.pelage" placeholder="Pelaje:"></b-form-input>
            </b-col>
          </b-row>
          <b-row class="d-flex justify-content-center align-items-center">
            <b-col sm="12" md="6" lg="6" class="input-group mb-3">
              <b-form-input :disabled="!newSpecie.name_common" type="number" v-model="newSpecie.aprox_weight" placeholder="Peso Estándar (kg):"></b-form-input>
            </b-col>
            <b-col sm="12" md="6" lg="6" class="input-group mb-3">
              <b-form-input :disabled="!newSpecie.name_common" v-model="newSpecie.head_profile" placeholder="Perfíl de Rostro:"></b-form-input>
            </b-col>
            <b-col sm="12" md="6" lg="6" class="input-group mb-3">
              <b-form-input :disabled="!newSpecie.name_common" v-model="newSpecie.neck_mane" placeholder="Cuello y Melena:"></b-form-input>
            </b-col>
            <b-col sm="12" md="6" lg="6" class="input-group mb-3">
              <b-form-input :disabled="!newSpecie.name_common" v-model="newSpecie.sexual_dimorphism" placeholder="Dimorfismo Sexual:"></b-form-input>
            </b-col>
            <b-col sm="12" md="6" lg="6" class="input-group mb-3">
              <b-form-input :disabled="!newSpecie.name_common" v-model="newSpecie.juvenile" placeholder="Juvenil:"></b-form-input>
            </b-col>
            <b-col sm="12" md="6" lg="6" class="input-group mb-3">
              <b-form-input type="text" :disabled="!newSpecie.name_common" v-model="newSpecie.distribution" placeholder="Distribución Geográfica:"></b-form-input>
            </b-col>
          </b-row>

          <b-row>
            <b-col sm="12" md="6" lg="6" class="input-group mb-3">
              <b-form-input :disabled="!newSpecie.name_common" v-model="newSpecie.wild_population" placeholder="Población Salvaje:"></b-form-input>
            </b-col>
            <b-col sm="12" md="6" lg="6" class="input-group mb-3">
              <b-form-input :disabled="!newSpecie.name_common" v-model="newSpecie.captive_population" placeholder="Población Cautiva:"></b-form-input>
            </b-col>
            <b-col sm="12" md="6" lg="6" class="input-group mb-3">
              <b-form-input :disabled="!newSpecie.name_common" v-model="newSpecie.intraspecific_variation" placeholder="Variación Intraespecífica:"></b-form-input>
            </b-col>
            <b-col sm="12" md="6" lg="6" class="input-group mb-3">
              <b-form-input :disabled="!newSpecie.name_common" v-model="newSpecie.blibliography" placeholder="Bibliografía:"></b-form-input>
            </b-col>
          </b-row>
        </b-col>
      </b-row>

      
      

      <b-row class="d-flex justify-content-end align-items-center">
        <b-col sm="12" class="input-group mb-3 d-flex justify-content-end align-items-center">
          <button class="w-100 btn btn-primary" :disabled="!validSpecie" @click="addSpecieToList()">Agregar Especie a la Lista</button>
        </b-col>
      </b-row>

    </div>
    
  </div>
</template>
<script>
import {mapActions, mapGetters} from 'vuex'
export default {
  data: () =>({
    newPhoto: null,
    newSpecie: {
      name_common: null,
      general_appearance: null,
      measurements: null,
      pelage: null,
      aprox_weight: null,
      head_profile: null,
      neck_mane: null,
      juvenile: null,
      distribution: null,
      captive_population: null,
      wild_population: null,
      intraspecific_variation: null,
      blibliography: null,
    },
    specieName:null,
    loading: false,
    showSpecies: false,
    selectedSpecie: "",

    loadingSpecies: false,
    
    species:[],

  }),
  computed: {
    ...mapGetters([
        'allSpecies',
    ]),
    newPhotoUrl() {
      return this.newPhoto ? URL.createObjectURL(this.newPhoto) : null;
    },
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
      let valid_measurements = Boolean(this.newSpecie.measurements)
      let valid_neck_mane = Boolean(this.newSpecie.neck_mane)
      let valid_pelage = Boolean(this.newSpecie.pelage)
      let valid_general_appearance = Boolean(this.newSpecie.general_appearance)
      let valid_aprox_weight = Boolean(this.newSpecie.aprox_weight)
      let valid_juvenile = Boolean(this.newSpecie.juvenile)
      let valid_head_profile = Boolean(this.newSpecie.head_profile)
      let valid_distribution = Boolean(this.newSpecie.distribution)
      let valid_wild_population = Boolean(this.newSpecie.wild_population)
      let valid_captive_population = Boolean(this.newSpecie.captive_population)
      let valid_intraspecific_variation = Boolean(this.newSpecie.intraspecific_variation)
      let valid_img = Boolean(this.newPhoto)

      return valid_name_common && valid_aprox_weight && valid_measurements && valid_neck_mane && valid_general_appearance && valid_pelage && valid_head_profile && valid_juvenile && valid_distribution && valid_wild_population && valid_captive_population && valid_intraspecific_variation && valid_img
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
          .post(`/dashboard/permissions/searchSpecie`, {filter: wordToSearch})
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
    closeAddSpecieDialog(){
      false
      this.$emit('closeAddSpecieDialog')
    },
    addSpecieToList(){
      this.$emit('addSpecie', this.newSpecie, this.newPhoto)
      // this.newSpecie = {
      //   name_common: null,
      //   general_appearance: null,
      //   measurements: null,
      //   pelage: null,
      //   aprox_weight: null,
      //   head_profile: null,
      //   neck_mane: null,
      //   juvenile: null,
      //   distribution: null,
      //   captive_population: null,
      //   wild_population: null,
      //   intraspecific_variation: null,
      //   blibliography: null,
      // }
      // this.closeAddSpecieDialog()
    },
  },
}
</script>