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
              :disabled="!specieToEdit.name_common"
              placeholder="Escoge una foto (Max. 2MB)"
              drop-placeholder="Subir archivo aquí..."
            ></b-form-file>
            <div class="mt-3">Selected file: {{ newPhoto ? newPhoto.name : newPhotoUrl }}</div>
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
              <span>Nombre Científico:</span>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <b-form-input disabled v-model="specieToEdit.name_scientific"></b-form-input>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <span>Nombre Común:</span>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <b-form-input :disabled="!specieToEdit.name_scientific" v-model="specieToEdit.name_common"></b-form-input>
              <b-spinner class="ml-3 mt-2" v-if="loadingSpecieData" small variant="success" label="Spinning"></b-spinner>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <span>Tipo:</span>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <b-form-input :disabled="!specieToEdit.name_scientific" v-model="specieToEdit.type" ></b-form-input>
              <b-spinner class="ml-3 mt-2" v-if="loadingSpecieData" small variant="success" label="Spinning"></b-spinner>
            </b-col>
          </b-row>
          <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <span>Apéndice:</span>
            </b-col>
          <b-row class="d-flex justify-content-center align-items-center">
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <b-form-input :disabled="!specieToEdit.name_scientific" v-model="specieToEdit.appendix"></b-form-input>
              <b-spinner class="ml-3 mt-2" v-if="loadingSpecieData" small variant="success" label="Spinning"></b-spinner>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <span>Clase:</span>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <b-form-input :disabled="!specieToEdit.name_scientific" v-model="specieToEdit.class"></b-form-input>
              <b-spinner class="ml-3 mt-2" v-if="loadingSpecieData" small variant="success" label="Spinning"></b-spinner>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <span>Familia:</span>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <b-form-input :disabled="!specieToEdit.name_scientific" v-model="specieToEdit.family"></b-form-input>
              <b-spinner class="ml-3 mt-2" v-if="loadingSpecieData" small variant="success" label="Spinning"></b-spinner>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <span>Descripción:</span>
            </b-col>
            <b-col sm="12" md="12" lg="12" class="input-group mb-3">
              <b-form-input type="text" placeholder="Ingrese una corta descripción:" :disabled="!specieToEdit.name_scientific" v-model="specieToEdit.description"></b-form-input>
            </b-col>
          </b-row>
        </b-col>
      </b-row>

      
      

      <b-row class="d-flex justify-content-end align-items-center">
        <b-col sm="12" class="input-group mb-3 d-flex justify-content-end align-items-center">
          <button class="w-100 btn btn-primary" :disabled="!validSpecie" @click="editSpecie()">Guardar Especie</button>
        </b-col>
      </b-row>

    </div>
    
  </div>
</template>
<script>
import {mapActions, mapGetters} from 'vuex'
export default {
  props: ['specieEditable'],
  data: (vm) =>({
    newPhoto: null,
    isNewPhoto: false,
    newPhotoUrl: vm.specieEditable.img,
    specieToEdit: {
      name_common: vm.specieEditable.name_common,
      name_scientific: vm.specieEditable.name_scientific,
      type: vm.specieEditable.type,
      description: vm.specieEditable.description,
      appendix: vm.specieEditable.appendix,
      class: vm.specieEditable.class,
      family: vm.specieEditable.family,
      search_id:vm.specieEditable.search_id
    },
    specieName:vm.specieEditable.name_scientific,
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
    // newPhotoUrl() {
    //   return this.newPhoto ? URL.createObjectURL(this.newPhoto) : null;
    // },
    validSpecie(){
      let valid_name_common = Boolean(this.specieToEdit.name_common)
      let valid_type = Boolean(this.specieToEdit.type)
      let valid_family = Boolean(this.specieToEdit.family)
      let valid_description = Boolean(this.specieToEdit.description)
      let valid_name_scientific = Boolean(this.specieToEdit.name_scientific)
      let valid_appendix = Boolean(this.specieToEdit.appendix)
      let valid_class = Boolean(this.specieToEdit.class)
      let valid_img = Boolean(this.newPhotoUrl)

      return valid_name_common && valid_appendix && valid_type && valid_family && valid_name_scientific && valid_description && valid_class && valid_img
    }
  },
  methods: {
    ...mapActions([
      'fetchSpecies',
    ]),
    setNewPhoto () {
      this.isNewPhoto = true
      let url = URL.createObjectURL(this.newPhoto)
      this.newPhotoUrl = url
    },
    onSelectSpecie(specie) {
      this.loadingSpecieData = true
      this.specieToEdit.name_scientific = specie;
      axios
        .post(`/dashboard/species/searchSpecieData`, {name: this.specieToEdit.name_scientific})
        .then(res => {
          console.log(res.data)
          this.specieToEdit.search_id = res.data.id
          this.specieToEdit.family = res.data.higher_taxa.family
          if (!this.specieToEdit.family){
            this.specieToEdit.family = 'No posee familia'
          }
          this.specieToEdit.class = res.data.higher_taxa.class
          if (!this.specieToEdit.class){
            this.specieToEdit.class = 'No posee clase'
          }
          this.specieToEdit.appendix = 'Apéndice ' + res.data.cites_listing
          if (!this.specieToEdit.appendix){
            this.specieToEdit.appendix = 'No posee apéndice'
          }
          this.specieToEdit.type = res.data.higher_taxa.kingdom
          let common_names = ''
          let count = 0
          for (const name of res.data.common_names) {
            if(count > 0){
              common_names = common_names + ', '
            }
            common_names = common_names + name.name
          }
          this.specieToEdit.name_common = common_names
          console.log(common_names)
          // this.loading = false
          this.loadingSpecieData = false
          // setTimeout(() => window.location.reload(), timeout)
        })
        .catch(err => {
          this.loadingSpecieData = false
          this.makeToast(err.response.data, 'danger')
        });
      // console.log(this.specieToEdit.name_common)
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
    closeEditSpecieDialog(){
      false
      this.$emit('closeEditSpecieDialog')
    },
    editSpecie(){
      this.$emit('editSpecie', this.specieToEdit, this.newPhoto, this.newPhotoUrl, this.isNewPhoto)
      // this.specieToEdit = {
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
  watch: {
    newPhoto: function(newData, oldData) {
      this.setNewPhoto()
    },
  }
}
</script>