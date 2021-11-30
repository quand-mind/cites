`<template>
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
            <b-col sm="12" md="12" lg="12" class="input-group mb-3 ">
              <vue-bootstrap-typeahead style="width: 94%;" @input="searchSpecie(specieName)"  @hit="onSelectSpecie"
              v-model="specieName" :data="species" placeholder="Busca la especie (Nombre Científico):"/>
              <b-spinner class="ml-3 mt-2" v-if="loadingSpecies" small variant="success" label="Spinning"></b-spinner>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <span>Nombre Común:</span>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <b-form-input :disabled="!newSpecie.name_scientific" v-model="newSpecie.name_common"></b-form-input>
              <b-spinner class="ml-3 mt-2" v-if="loadingSpecieData" small variant="success" label="Spinning"></b-spinner>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <span>Tipo:</span>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <b-form-input :disabled="!newSpecie.name_scientific" v-model="newSpecie.type" ></b-form-input>
              <b-spinner class="ml-3 mt-2" v-if="loadingSpecieData" small variant="success" label="Spinning"></b-spinner>
            </b-col>
          </b-row>
          <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <span>Apéndice:</span>
            </b-col>
          <b-row class="d-flex justify-content-center align-items-center">
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <b-form-input :disabled="!newSpecie.name_scientific" v-model="newSpecie.appendix"></b-form-input>
              <b-spinner class="ml-3 mt-2" v-if="loadingSpecieData" small variant="success" label="Spinning"></b-spinner>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <span>Clase:</span>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <b-form-input :disabled="!newSpecie.name_scientific" v-model="newSpecie.class"></b-form-input>
              <b-spinner class="ml-3 mt-2" v-if="loadingSpecieData" small variant="success" label="Spinning"></b-spinner>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <span>Familia:</span>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <b-form-input :disabled="!newSpecie.name_scientific" v-model="newSpecie.family"></b-form-input>
              <b-spinner class="ml-3 mt-2" v-if="loadingSpecieData" small variant="success" label="Spinning"></b-spinner>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <span>Descripción:</span>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <b-form-input type="text" placeholder="Ingrese una corta descripción:" :disabled="!newSpecie.name_scientific" v-model="newSpecie.description"></b-form-input>
            </b-col>
          </b-row>
        </b-col>
      </b-row>

      
      

      <b-row class="d-flex justify-content-end align-items-center">
        <b-col sm="12" class="input-group mb-3 d-flex justify-content-end align-items-center">
          <button class="w-100 btn btn-primary" :disabled="!validSpecie" @click="addSpecieToList()">Añadir Nueva Especie</button>
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
      name_scientific: null,
      type: null,
      description: null,
      appendix: null,
      class: null,
      family: null,
      search_id:null
    },
    specieName:null,
    loading: false,
    showSpecies: false,
    selectedSpecie: "",

    loadingSpecies: false,
    loadingSpecieData: false,
    
    species:[],

  }),
  computed: {
    ...mapGetters([
        'allSpecies',
    ]),
    newPhotoUrl() {
      return this.newPhoto ? URL.createObjectURL(this.newPhoto) : null;
    },
    validSpecie(){
      let valid_name_common = Boolean(this.newSpecie.name_common)
      let valid_type = Boolean(this.newSpecie.type)
      let valid_family = Boolean(this.newSpecie.family)
      let valid_description = Boolean(this.newSpecie.description)
      let valid_name_scientific = Boolean(this.newSpecie.name_scientific)
      let valid_appendix = Boolean(this.newSpecie.appendix)
      let valid_class = Boolean(this.newSpecie.class)
      let valid_img = Boolean(this.newPhoto)

      return valid_name_common && valid_appendix && valid_type && valid_family && valid_name_scientific && valid_description && valid_class && valid_img
    }
  },
  methods: {
    ...mapActions([
      'fetchSpecies',
    ]),
    onSelectSpecie(specie) {
      this.loadingSpecieData = true
      this.newSpecie.name_scientific = specie;
      axios
        .post(`/dashboard/species/searchSpecieData`, {name: this.newSpecie.name_scientific})
        .then(res => {
          console.log(res.data)
          this.newSpecie.search_id = res.data.id
          this.newSpecie.family = res.data.higher_taxa.family
          if (!this.newSpecie.family){
            this.newSpecie.family = 'No posee familia'
          }
          this.newSpecie.class = res.data.higher_taxa.class
          if (!this.newSpecie.class){
            this.newSpecie.class = 'No posee clase'
          }
          this.newSpecie.appendix = 'Apéndice ' + res.data.cites_listing
          if (!this.newSpecie.appendix){
            this.newSpecie.appendix = 'No posee apéndice'
          }
          this.newSpecie.type = res.data.higher_taxa.kingdom
          let common_names = ''
          let count = 0
          for (const name of res.data.common_names) {
            if(count > 0){
              common_names = common_names + ', '
            }
            common_names = common_names + name.name
          }
          this.newSpecie.name_common = common_names
          console.log(common_names)
          // this.loading = false
          this.loadingSpecieData = false
          // setTimeout(() => window.location.reload(), timeout)
        })
        .catch(err => {
          this.loadingSpecieData = false
          this.makeToast(err.response.data, 'danger')
        });
      // console.log(this.newSpecie.name_common)
    },
    searchSpecie(wordToSearch){
      if (wordToSearch.length >= 3){
        this.loadingSpecies = true
        axios
          .post(`/dashboard/searchSpecie`, {filter: wordToSearch})
          .then(res => {
            this.loadingSpecies = false
            for (const specieResult of res.data) {
              this.species.push(specieResult.full_name)
            }
          })
          .catch(err => {
            console.log(err.toString())
            this.loadingSpecies = false
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
      //   name_scientific: null,
      //   type: null,
      //   description: null,
      //   appendix: null,
      //   class: null,
      //   family: null,
      // }
      // this.closeAddSpecieDialog()
    },
  },
}
</script>`