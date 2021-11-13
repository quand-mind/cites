<template>
  <div>
    <h1>Recaudos:</h1>
    <div class="mt-3 mb-4 d-flex align-items-center justify-content-start">
      <b-button @click="showAddRequeriment = true" variant="primary">Añadir Nuevo Recaudo +</b-button>
    </div>

    <h4 class="mt-5">Listado de Recaudos</h4>
     <b-card
      class="mb-2"
    >
      <b-card-text>
        <b-row v-for="(requeriment, index ) of requeriments.data" :key="index">
          <b-col class="mb-2 mt-2" cols="10">{{requeriment.name}}</b-col>
          <b-col class="mb-2 mt-2 d-flex align-items-center justify-content-center" cols="2">
            <b-button class="mr-2" variant="info" @click="displayEditModal(requeriment)">Editar</b-button>
            <b-button class="" variant="danger" @click="displayDeleteModal(requeriment)">Eliminar</b-button>
          </b-col>
        </b-row>
        <div class="d-flex w-100 mt-4 justify-content-center align-items-center">
          <b-btn @click="prevPage()" class="mr-2" :disabled='requeriments.current_page === 1'> <font-awesome-icon :icon="['fa', 'chevron-left']"></font-awesome-icon> </b-btn>
          Pagina {{requeriments.current_page}} de {{requeriments.last_page}}
          <b-btn @click="nextPage()" class="ml-2" :disabled='requeriments.current_page >= requeriments.last_page'> <font-awesome-icon :icon="['fa', 'chevron-right']"></font-awesome-icon> </b-btn>
        </div>
      </b-card-text>
    </b-card>

    <b-modal v-model="showAddRequeriment" size="xl" id="add-requeriment-modal" title="Agregar un Nuevo Recaudo" hide-footer>
      <AddRequeriment
      v-on:addRequeriment="addRequeriment"
      v-on:closeAddRequerimentDialog="closeAddRequerimentDialog"/>
    </b-modal>
    <b-modal v-model="showEditRequeriment" size="xl" id="edit-requeriment-modal" title="Editar Recaudo" hide-footer>
      <EditRequeriment
      :requeriment="selectedRequeriment"
      v-on:editRequeriment="editRequeriment"
      v-on:closeEditRequerimentDialog="closeEditRequerimentDialog"/>
    </b-modal>
    <b-modal v-model="showDeleteRequeriment" size="xl" id="delete-requeriment-modal" title="Eliminar Recaudo" hide-footer>
      <div>
        <h6>¿Estás seguro que deseas eliminar este recaudo? Los permisos que tengan este recaudo serán modificados.</h6>
        <b-button variant="danger" class="mt-3" @click="deleteRequeriment(selectedRequeriment)">Confirmar</b-button>
      </div>
    </b-modal>
  </div>

</template>
<script>

import timeout from '../../../setTimeout.js'
import AddRequeriment from '../permissions/AddRequeriment.vue';
import EditRequeriment from '../permissions/EditRequeriment.vue';
export default {
  props: ['requeriments','type'],
  components: {
    AddRequeriment,
    EditRequeriment,
  },
  data: () => ({
    timeout: timeout,
    showAddRequeriment: false,
    showEditRequeriment: false,
    showDeleteRequeriment: false,
    selectedRequeriment: null
  }),
  methods: {
    displayEditModal(requeriment){
      this.selectedRequeriment = requeriment
      this.showEditRequeriment = true
    },
    displayDeleteModal(requeriment){
      this.selectedRequeriment = requeriment
      this.showDeleteRequeriment = true
    },
    prevPage(){
      window.location.assign(this.requeriments.prev_page_url)
    },
    nextPage(){
      window.location.assign(this.requeriments.next_page_url)
    },
    closeAddRequerimentDialog(){
      this.selectedRequeriment = null
      this.showAddRequeriment = false
    },
    closeDeleteRequerimentDialog(){
      this.selectedRequeriment = null
      this.showDeleteRequeriment = false
    },
    closeEditRequerimentDialog(){
      this.selectedRequeriment = null
      this.showEditRequeriment = false
    },
    addRequeriment(requeriment){
      this.closeAddRequerimentDialog()
      axios
        .post(`/dashboard/permissions/addRequeriment/`, {requeriment: JSON.stringify(requeriment)})
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), timeout)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    editRequeriment(requeriment){
      this.closeEditRequerimentDialog()
      axios
        .post(`/dashboard/permissions/editRequeriment/`+ requeriment.id, {requeriment: JSON.stringify(requeriment)})
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), timeout)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    deleteRequeriment(requeriment){
      this.closeDeleteRequerimentDialog()
      axios
        .post(`/dashboard/permissions/deleteRequeriment/`+ requeriment.id)
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), timeout)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    makeToast(msg, variant = "success", delay = timeout, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: 'Recaudos',
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    },
  }
}
</script>