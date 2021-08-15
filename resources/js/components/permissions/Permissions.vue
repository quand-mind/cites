<template>
  <div>
    <h1 class="mb-4">Permisos:</h1>
    <div class="ml-4" v-for="(permit, index) of permissions" v-bind:key="index">
      <div class="permit-container">
        <div class="d-flex justify-content-between align-items-center">
          <h4 class=" mb-3">N° de Permiso: {{permit.request_permit_no}}</h4>
          <b-badge v-if="permit.status === 'uploading_requeriments'" class="p-2" variant="warning">Requerimientos Por Subir</b-badge>
          <b-badge v-if="permit.status === 'committed'" class="p-2" variant="success">Entregado</b-badge>
          <b-badge v-if="permit.status === 'not_valid'" class="p-2" variant="danger">No Valido</b-badge>
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <span>{{permit.permit_type.name}}</span>
          <div>
            <a v-if="permit.status !== 'committed' && type === 'client'" class="btn btn-info" :href="`/solicitante/permissions/uploadRequirements/${permit.id}`">Subir Recaudos</a>
            <button v-if="type === 'client'" class="btn btn-primary" @click="showPermitStatus(permit)">Ver estado del Permiso</button>
          </div>
          <div v-if="type === 'admin'">
            <a v-if="!(permit.status === 'uploading_requeriments' || permit.status === 'committed')" class="btn btn-primary" :href="'/dashboard/permissions/check/'+ permit.id">Realizar Checkeo de la orden</a>
          </div>
        </div>
      </div>
      <b-row>
        
      </b-row>
    </div>

    <b-modal v-if="showPermit" v-model="showPermit" size="xl" id="species-modal" title="Estado del Permiso" hide-footer> 
      <div class="ma-5 d-flex justify-content-between align-items-center">
        <h4 class=" mb-3">N° de Permiso: {{selectedPermit.request_permit_no}}</h4>
        <b-badge v-if="selectedPermit.status === 'committed'" class="p-2" variant="success">Entregado</b-badge>
        <b-badge v-if="selectedPermit.status === 'uploading_requeriments'" class="p-2" variant="danger">Falta subir requerimientos o pulsar el boton de finalizar proceso.</b-badge>
      </div>
      <div class=" mb-5 d-flex justify-content-between align-items-center">
        <span>{{selectedPermit.permit_type.name}}</span>
      </div>
      <b-row>
        <b-col class="pl-4" sm="12" lg="6">{{columns[0]}}</b-col>
        <b-col class="pl-4" sm="12" lg="2">{{columns[1]}}</b-col>
        <b-col class="pl-4" sm="12" lg="4">{{columns[2]}}</b-col>
      </b-row>
      <b-row class="my-3" v-for="(requeriment, index) of selectedPermit.requeriments" v-bind:key="index">
        <b-col sm="12" lg="6">{{requeriment.name}}</b-col>
        <b-col sm="12" lg="2">
          <div v-if="requeriment.pivot.file_url">
            <a :href="`/${requeriment.pivot.file_url}`" target="_blank"><font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon> Ver Archivo</a>
          </div>
          <div v-else>
            <div v-if="requeriment.short_name ==='documentos_especies'"></div>
            <div v-else>
              <font-awesome-icon :icon="['fa', 'ban']"></font-awesome-icon>
              No se ha subido el documento
            </div>
          </div>
        </b-col>
        <b-col sm="12" lg="2" class="">
          <div>
            <b-badge v-if="requeriment.pivot.is_valid" class="p-2" variant="success">
              Valido
              <font-awesome-icon :icon="['fa', 'check']"></font-awesome-icon>
            </b-badge>
            <b-badge v-if="!requeriment.pivot.is_valid && !requeriment.pivot.file_errors" class="p-2" variant="danger">
              No checkeado
              <font-awesome-icon :icon="['fa', 'clipboard']"></font-awesome-icon>
            </b-badge>
            <b-badge v-if="!requeriment.pivot.is_valid && requeriment.pivot.file_errors" class="p-2" variant="danger">
              No valido
              <font-awesome-icon :icon="['fa', 'ban']"></font-awesome-icon>
            </b-badge>
          </div>
        </b-col>
        <b-col sm="12" lg="2" class="">
          <div v-if="!requeriment.pivot.is_valid && requeriment.pivot.file_errors">
            <span> Errores: {{requeriment.pivot.file_errors}}</span>
          </div>
        </b-col>
      </b-row>
    </b-modal>
      
  </div>
</template>
<script>
export default {
  props:['permissions', 'type'],
  data: () => ({

    columns: [
      "Requerimiento",
      "Archivo",
      "Validación"
    ],
    showPermit : false,
    selectedPermit: {} 
  }),
  methods: {
    showPermitStatus(permit){
      this.showPermit = true
      this.selectedPermit = permit
    }
  }
}
</script>
<style scoped>
  .permit-container{
    border: 1px solid rgb(39, 39, 39);
    border-radius: 5px;
    margin-bottom: 20px;
    padding: 20px;
  }
</style>