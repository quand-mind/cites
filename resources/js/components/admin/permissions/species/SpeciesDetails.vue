<template>
  <div>
    <b-alert v-model="loading" variant="info" class="alertFile d-flex justify-content-between align-items-center">
      <span>Añadiendo Especie...</span> <b-spinner small label="Spinning"></b-spinner>
    </b-alert>
    <b-alert v-model="loadingCountries" variant="info" class="alertFile d-flex justify-content-between align-items-center">
      <span>Obteniendo Países...</span> <b-spinner small label="Spinning"></b-spinner>
    </b-alert>
    <b-row class="">
      <b-col md="9" sm="12">
        <h1>Detalles de las Especies</h1>
      </b-col>
      <b-col md="3" sm="12" class="d-flex">
        <b-btn @click="showAddSpecie = true" class="w-100" variant="primary">
          <font-awesome-icon class="mr-2" :icon="['fa', 'plus']"></font-awesome-icon>
          Agregar Nueva Especie
        </b-btn>
      </b-col>
    </b-row>
    <div class="m-5"></div>
    <div class="d-flex justify-content-center align-items-center">
      <v-client-table :data="species" :columns="columns" :options="options" style="width: 90%;">
        <!-- actions slot -->
        <div class="action-container" slot="editar" slot-scope="props">
          <a class="text-dark" @click.prevent="{showEditSpecieData(props.row)}">
            <font-awesome-icon :icon="['fa', 'edit']"></font-awesome-icon>
          </a>
        </div>

        <!-- user photo slot -->
        <b-img
          thumbnail
          fluid
          slot="especimen masculino"
          slot-scope="props"
          class="profile-img"
          :src="props.row.male_img || '/images/default-user.png'"
          alt="specie photo"  
        ></b-img>
        <b-img
          thumbnail
          fluid
          slot="especimen femenino"
          slot-scope="props"
          class="profile-img"
          :src="props.row.female_img || '/images/default-user.png'"
          alt="specie photo"  
        ></b-img>

        <!-- name_common slot -->
        <span slot="nombre común" slot-scope="props">{{props.row.name_common}}</span>

        <!-- name_scientific slot -->
        <span slot="nombre científco" slot-scope="props">{{props.row.name_scientific}}</span>

        <!-- type slot -->
        <span slot="tipo" slot-scope="props">{{props.row.type}}</span>

        <!-- appendix slot -->
        <span slot="appendix" slot-scope="props">{{props.row.appendix}}</span>
      </v-client-table>
    </div>

    <b-modal v-model="showAddSpecie" size="xl" id="add-species-modal" title="Agregar Especie" hide-footer class="p-5">
      <AddSpecie
      class="p-4"
      v-on:addSpecie="addSpecieToList"
      v-on:closeAddSpecieDialog="closeAddSpecieDialog"/>
    </b-modal>
    <b-modal v-model="showEditSpecie" size="xl" id="edit-species-modal" title="Editar Especie" hide-footer class="p-5">
      <EditSpecie
      class="p-4"
      :specieEditable="selectedSpecie"
      v-on:editSpecie="editSpecie"
      v-on:closeEditSpecieDialog="closeEditSpecieDialog"/>
    </b-modal>
    
  </div>
</template>
<script>
import timeout from '../../../../setTimeout';
import AddSpecie from '../species/AddSpecie.vue';
import EditSpecie from '../species/EditSpecie.vue';
export default {
  props: ['species'],
  data: () => ({
    loading: false,
    loadingCountries: false,
    options: {
      perPage: 10,
      perPageValues: [10, 20, 50]
    },
    selectedSpecie: {},
    showAddSpecie: false,
    showEditSpecie: false,
    columns:['especimen masculino', 'especimen femenino','nombre común', 'nombre científco', 'tipo', 'editar'],
  }),
  components: {
    AddSpecie,
    EditSpecie
  },
  methods: {
    showEditSpecieData(specie) {
      console.log(specie)
      this.selectedSpecie = specie
      this.showEditSpecie = true
    },
    addSpecieToList(newSpecie, male_img, female_img, female_title, male_title){
      let form = new FormData();
      form.append("specie", JSON.stringify(newSpecie));
      form.append("male_img", male_img);
      form.append("female_img", female_img);
      form.append("male_title", male_title);
      form.append("female_title", female_title);
      this.loading = true
      axios
        .post(`/dashboard/species/registerSpecie`, form, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(res => {
          this.makeToast(res.data)
          this.loading = false
          this.closeAddSpecieDialog()
          setTimeout(() => window.location.reload(), timeout)
        })
        .catch(err => {
          this.loading = false
          this.makeToast(err.response.data, 'danger')
        });
    },
    editSpecie(specie, male_img, female_img, male_url, female_url, isNewMalePhoto, isNewFemalePhoto){
      let form = new FormData();
      form.append("specie", JSON.stringify(specie));
      form.append("isNewMalePhoto", isNewMalePhoto);
        form.append("isNewFemalePhoto", isNewFemalePhoto);
      if (isNewMalePhoto) {
        form.append("male_img", male_img);
      }
      else {
        form.append("male_img", male_url);
      }
      if (isNewFemalePhoto) {
        form.append("female_img", female_img);
      }
      else {        
        form.append("female_img", female_url);
      }
      this.loading = true
      axios
        .post(`/dashboard/species/editSpecie`, form, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(res => {
          this.makeToast(res.data)
          this.loading = false
          this.closeEditSpecieDialog()
          setTimeout(() => window.location.reload(), timeout)
        })
        .catch(err => {
          this.loading = false
          this.makeToast(err.response.data, 'danger')
        });
      
    },
    
    closeAddSpecieDialog(){
      this.showAddSpecie = false
    },
    closeEditSpecieDialog(){
      this.showEditSpecie = false
    },
    makeToast(msg, variant = "success", delay = timeout, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: 'Especies',
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    },
  }
}
</script>