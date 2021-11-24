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
        <b-btn @click="showSelectSpecie = true" class="w-100" variant="primary">
          <font-awesome-icon class="mr-2" :icon="['fa', 'plus']"></font-awesome-icon>
          Agregar Nueva Especie
        </b-btn>
      </b-col>
    </b-row>
    <div class="m-5"></div>
    <div class="d-flex justify-content-center align-items-center">
      <v-client-table :data="species" :columns="columns" :options="options" style="width: 90%;">
        <!-- actions slot -->
        <div class="action-container" slot="acciones" slot-scope="props">
          <a class="text-dark" @click.prevent="{editSpecie(props.row)}">
            <font-awesome-icon :icon="['fa', 'edit']"></font-awesome-icon>
          </a>

          <a class="text-danger" @click.prevent="{deleteSpecie(props.row)}">
            <font-awesome-icon :icon="['fa', 'trash']"></font-awesome-icon>
          </a>
        </div>

        <!-- user photo slot -->
        <b-img
          thumbnail
          fluid
          slot="imagen"
          class="profile-img"
          slot-scope="props"
          :src="props.row.img || '/images/default-user.png'"
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

    <b-modal v-model="showSelectSpecie" size="xl" id="species-modal" title="Agregar Especie" hide-footer>
      <AddSpecie
      v-on:addSpecie="addSpecieToList"
      v-on:closeAddSpecieDialog="closeAddSpecieDialog"/>
    </b-modal>
    
  </div>
</template>
<script>
import timeout from '../../../../setTimeout';
import AddSpecie from '../species/AddSpecie.vue';
export default {
  props: ['species'],
  data: () => ({
    loading: false,
    loadingCountries: false,
    options: {
      perPage: 10,
      perPageValues: [10, 20, 50]
    },
    selectedSpecies: null,
    showSelectSpecie: false,
    columns:['imagen','nombre común', 'nombre científco', 'tipo', 'acciones'],
  }),
  components: {
    AddSpecie
  },
  methods: {
    addSpecieToList(newSpecie, img){
      // this.selectedSpecies.push(newSpecie)
      let form = new FormData();
      form.append("specie", JSON.stringify(newSpecie));
      form.append("img", img);
      this.loading = true
      axios
        .post(`/dashboard/permissions/species/registerSpecie`, form, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(res => {
          this.makeToast(res.data)
          this.loading = false
          // setTimeout(() => window.location.reload(), timeout)
        })
        .catch(err => {
          this.loading = false
          this.makeToast(err.response.data, 'danger')
        });
      // this.closeAddSpecieDialog()
    },
    deleteSpecie(specie, index){
      console.log(specie)
      this.selectedSpecies.splice(index)
      this.makeToast('Especie Eliminada')
      this.closeSpecieListDialog()
    },
    closeAddSpecieDialog(){
      this.showSelectSpecie = false
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