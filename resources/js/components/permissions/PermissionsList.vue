<template>
  <div>
    <div class="caja bg-light p-2 my-2">
      <h1>Permisos</h1>
      <h4 class="ml-4">Realice la solicitud para la aprobación de permisos MINEC.</h4>
  
      <ul class="list-group mt-4" v-for="(permit, index) of permit_types" v-bind:key="index">
        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
           {{permit.name}}
          <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseComercialExports" aria-expanded="false" aria-controls="collapseComercialExports">
            Recaudos
          </button>
        </li>
        <div class="collapse" id="collapseComercialExports">
          <div class="card card-body">
            <div class="d-flex">
              <h6>Lista de Recaudos:</h6>
            </div>
            <ul class=" mt-4" v-for="(requeriment, index) of permit.requeriments" v-bind:key="index">
              <li class="">{{requeriment.name}}</li>
            </ul>
            <div class="w-100 d-flex justify-content-end align-items-center">
             <button v-if="!showPurpose" class="btn btn-primary" @click="openPurposeData(permit.id)">Solicitar Permiso</button>
            </div>
            <div class="mt-3 d-flex flex-row justify-content-between" v-if="showPurpose && permit_type_id === permit.id">
              <b-form-input v-model="purpose" placeholder="Propósito del Permiso:"></b-form-input>
              <div>
                <b-button @click="showSelectSpecie = !showSelectSpecie" variant="info" v-b-modal>Añadir Especies</b-button>
                <b-button @click="showSelectedSpecies = !showSelectedSpecies" variant="success" :disabled="!selectedSpecies.length > 0" v-b-modal>Listado de Especies</b-button>
                <button class="btn btn-danger" @click="showPurpose = false">Cancelar</button>
                <button class="btn btn-primary" :disabled="!(selectedSpecies.length > 0 && purpose) " @click="requestAuthorization()">Solicitar Permiso</button>
              </div>
            </div>
          </div>

        </div>
      </ul>
      <b-modal v-model="showSelectSpecie" size="xl" id="species-modal" title="Agregar Especie" hide-footer>
        <AddSpecie
        v-on:addSpecie="addSpecieToList"
        v-on:closeAddSpecieDialog="closeAddSpecieDialog"
        :selectedSpecies="selectedSpecies" :showSelectSpecie="showSelectSpecie"
        :type="type"/>
      </b-modal>
      <b-modal v-model="showSelectedSpecies" size="xl" id="species-modal" title="Listado de Especies" hide-footer>
        <SelectedSpeciesList
        v-on:deleteSpecie="deleteSpecie"
        v-on:closeSpecieListDialog="closeSpecieListDialog"
        :selectedSpecies="selectedSpecies" :showSelectedSpecies="showSelectedSpecies"
        :type="type"/>
      </b-modal>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import AddSpecie from '../permissions/AddSpecie.vue';
import SelectedSpeciesList from '../permissions/SelectedSpeciesList.vue';

export default {
  components: {
    AddSpecie,
    SelectedSpeciesList
  },
  props: ["permit_types", 'type'],
  data: () => ({
    is_valid_dni: false,
    is_valid_rif: false,
    is_valid_zoo_hatcheries_authorization: false,
    is_valid_comerce_species_license: false,
    permit_type_id: null,
    showPurpose: false,
    purpose: null,
    client_id:1,

    showSelectSpecie: false,
    showSelectedSpecies: false,
    showSpecies: false,

    selectedSpecies:[],
  }),
  methods: {
    openPurposeData(id){
      this.permit_type_id = id
      this.showPurpose = true
    },
    closeAddSpecieDialog(){
      this.showSelectSpecie = false
    },
    closeSpecieListDialog(){
      this.showSelectedSpecies = false
    },
    deleteSpecie(index){
      console.log(index)
      this.selectedSpecies.splice(index, 1)
    },
    requestAuthorization(){

      axios
        .post(`/solicitante/permissions/list/createPermit`, {species: this.selectedSpecies, permit_type_id: this.permit_type_id, purpose: this.purpose, client_id: this.client_id})
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), 1200)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    makeToast(msg, variant = "success", delay = 3000, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: 'Solicitud de Permiso Realizada, dirijase a las oficinas de MINEC para entregar los recaudos.',
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    },
    addSpecieToList(newSpecie){
      this.selectedSpecies.push(newSpecie)
      this.showSelectSpecie = false
    },
  },
  mounted() {
  }
};
</script>

<style scoped lang="scss">
// Table styles

// hide default filter
input {
  width: 400px;
}
</style>