<template>
  <div>
    <h1>Permisos</h1>

    <h4 class="mt-5">Listado de Permisos</h4>

    <div class="mt-3 mb-4 d-flex align-items-center justify-content-start">
      <b-button @click="showAddPermit = true" variant="primary">Añadir Nuevo Tipo de Permiso +</b-button>
    </div>

    <b-table
      :items="permits.data"
      :fields="fields"
    >
      <template #cell(actions)="data">
        <div class="d-flex flex-row">
          <b-button class="mr-2" @click="displayEditModal(data.item)" variant="info">Editar</b-button>
          <b-button variant="danger" @click="displayDeleteModal(data.item)">Eliminar</b-button>
        </div>
      </template>
      <template #cell(type)="data">
        <span v-if="data.item.type === 'export'">Exportación</span>
        <span v-if="data.item.type === 'import'">Importación</span>
        <span v-if="data.item.type === 'reexport'">Reexportación</span>
      </template>
    </b-table>

    <b-modal v-model="showAddPermit" size="xl" id="add-permit-modal" title="Agregar un Nuevo Permiso" hide-footer>
      <AddPermit
      v-on:addPermit="addPermit"
      v-on:closeAddPermitDialog="closeAddPermitDialog"/>
    </b-modal>
    <b-modal v-model="showEditPermit" size="xl" id="edit-permit-modal" title="Editar Permiso" hide-footer>
      <EditPermit
      :permit="selectedPermit"
      v-on:editPermit="editPermit"
      v-on:closeEditPermitDialog="closeEditPermitDialog"/>
    </b-modal>
    <b-modal v-model="showDeletePermit" size="xl" id="delete-permit-modal" title="Eliminar Permiso" hide-footer>
      <div>
        <h6>¿Estás seguro que deseas eliminar este permiso?</h6>
        <b-button variant="danger" class="mt-3" @click="deletePermit(selectedPermit)">Confirmar</b-button>
      </div>
    </b-modal>
  </div>
</template>

<script>
import timeout from '../../../setTimeout';
import AddPermit from '../permissions/AddPermit.vue';
import EditPermit from '../permissions/EditPermit.vue';
export default {
  props: ['permits'],
  components: {
    AddPermit,
    EditPermit,
  },
  data: () => ({
    timeout: timeout,
    showAddPermit: false,
    showEditPermit: false,
    showDeletePermit: false,
    selectedPermit: null,
    fields: [
      {
        key: 'name',
        label: 'Nombre',
        sortable: true
      },
      {
        key: 'type',
        label: 'Tipo de Permiso',
        sortable: true
      },
      {
        key: 'departament.name',
        label: 'Departamento',
        sortable: true,
      },
      {
        key: 'actions',
        label: 'Acciones',
      }
    ],
  }),
  methods: {
    displayEditModal(permit){
      this.selectedPermit = permit
      this.showEditPermit = true
    },
    displayDeleteModal(permit){
      this.selectedPermit = permit
      this.showDeletePermit = true
    },
    closeAddPermitDialog(){
      this.showAddPermit = false
      this.selectedPermit = null
    },
    closeDeletePermitDialog(){
      this.selectedPermit = null
      this.showDeletePermit = false
    },
    closeEditPermitDialog(){
      this.showEditPermit = false
      this.selectedPermit = null
    },

    addPermit(permit){
      this.closeAddPermitDialog()
      console.log(permit)
      axios
        .post(`/dashboard/permissions/addPermit/`, {permit: JSON.stringify(permit), requeriments: JSON.stringify(permit.requeriments)})
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), timeout)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    editPermit(permit){
      this.closeEditPermitDialog()
      console.log(permit)
      axios
        .post(`/dashboard/permissions/editPermit/`+ permit.id, {permit: JSON.stringify(permit), requeriments: JSON.stringify(permit.requeriments)})
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), timeout)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    deletePermit(permit){
      this.closeDeletePermitDialog()
      axios
        .post(`/dashboard/permissions/deletePermit/`+ permit.id)
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), timeout)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },

    prevPage(){
      window.location.assign(this.Permits.prev_page_url)
    },
    nextPage(){
      window.location.assign(this.Permits.next_page_url)
    },

    makeToast(msg, variant = "success", delay = timeout, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: 'Permmisos',
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    },
  }
}
</script>