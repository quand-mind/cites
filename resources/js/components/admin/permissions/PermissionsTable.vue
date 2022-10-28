<template>
  <div>
    <h1 class="mb-4">Listado de Trámites Solicitados:</h1>
    <div v-if="formalities.length === 0">
      <span>No hay tramites solicitados. Solicite sus permisos <a href="/solicitante/permissions/list">Aquí.</a></span>
    </div>
    <b-table v-else
      :items="formalities"
      :fields="fields"
    >
      <template #cell(actions)="data">
        <div class="d-flex flex-row">
          <b-button class="mr-2" @click="showFormaliteStatus(data.item)" variant="info">
            <font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon>
          </b-button>
        </div>
      </template>

      <template #cell(created_at)="data">
        <div class="d-flex flex-row">
          <span>{{moment(data.item.created_at).format("DD-MM-YYYY")}}</span>
        </div>
      </template>

      <template #cell(type)="data">
        <span v-if="data.item.permits[0].permit_type.type === 'export'">Exportación</span>
        <span v-if="data.item.permits[0].permit_type.type === 'import'">Importación</span>
        <span v-if="data.item.permits[0].permit_type.type === 'reexport'">Reexportación</span>
      </template>

      <template #cell(status)="data">
        <span v-if="data.item.status === 'uploading_requeriments'">Recaudos Por Subir</span>
        <span v-if="data.item.status === 'requested'">Por Validar</span>
        <span v-if="data.item.status === 'valid'">Validado</span>
        <span v-if="data.item.status === 'committed'">Entregado</span>
        <span v-if="data.item.status === 'printed'">Impreso</span>
        <span v-if="data.item.status === 'not_valid'">No Válido</span>
      </template>
    </b-table>
      <!-- <div class="ml-4" v-for="(formalitie, index) of formalities.data" v-bind:key="index">
        <div class="formalitie-container">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class=" mb-3">N° de Trámite: {{formalitie.request_formalitie_no}}</h5>
            <div>
              <b-badge class="p-2" v-if="formalitie.permits[0].permit_type.type === 'export'" variant="success">Exportación</b-badge>
              <b-badge class="p-2" v-if="formalitie.permits[0].permit_type.type === 'import'" variant="success">Importación</b-badge>
              <b-badge class="p-2" v-if="formalitie.permits[0].permit_type.type === 'reexport'" variant="success">Reexportación</b-badge>
              <b-badge class="p-2" variant="info">{{moment(formalitie.created_at).format("DD-MM-YYYY")}}</b-badge>
              <b-badge v-if="formalitie.status === 'uploading_requeriments'" class="p-2" variant="warning">Recaudos Por Subir</b-badge>
              <b-badge v-if="formalitie.status === 'requested'" class="p-2" variant="info">Por Validar</b-badge>
              <b-badge v-if="formalitie.status === 'valid'" class="p-2" variant="success">Validado Correctamente</b-badge>
              <b-badge v-if="formalitie.status === 'committed'" class="p-2" variant="success">Entregado</b-badge>
              <b-badge v-if="formalitie.status === 'not_valid'" class="p-2" variant="danger">No Valido</b-badge>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <span>N° de Permisos en este trámite: {{formalitie.permits.length}}</span>
            <div v-if="type === 'client'">
              <a v-if="formalitie.status === 'uploading_requeriments'" class="btn btn-info" :href="`/solicitante/permissions/uploadRequirements/${formalitie.id}`">Subir Recaudos</a>
              <a v-if="formalitie.status !== 'uploading_requeriments'" class="btn btn-info" :href="`/solicitante/permissions/uploadRequirements/${formalitie.id}`">Ver Información de los Recaudos</a>
              <button class="btn btn-primary" @click="showFormaliteStatus(formalitie)">Ver estado del Trámite</button>
            </div>
            <div v-if="type === 'admin'">
              <button class="btn btn-primary" @click="showFormaliteStatus(formalitie)">Ver estado del Trámite</button>
              <a v-if="!(formalitie.status === 'uploading_requeriments' || formalitie.status === 'committed' || formalitie.status === 'valid' || formalitie.status === 'printed')" class="btn btn-primary" :href="'/dashboard/permissions/check/'+ formalitie.id">Realizar Validación del Trámite</a>
            </div>
          </div>
        </div>
      </div> -->
    <!-- </div> -->

    <b-modal v-if="showFormalite" v-model="showFormalite" size="xl" id="formalite-modal" title="Estado del Permiso" hide-footer> 
      <div class="ma-5 d-flex justify-content-between align-items-center">
        <h4 class=" mb-3">N° de Trámite: {{selectedFormalite.request_permit_no}}</h4>
        <div>
          <b-badge class="p-2" variant="info">{{moment(selectedFormalite.created_at).format("DD-MM-YYYY")}}</b-badge>
          <b-badge v-if="selectedFormalite.status === 'requested'" class="p-2" variant="warning">Por Validar</b-badge>
          <b-badge v-if="selectedFormalite.status === 'valid'" class="p-2" variant="success">Validado Correctamente</b-badge>
          <b-badge v-if="selectedFormalite.status === 'committed'" class="p-2" variant="success">Entregado</b-badge>
          <b-badge v-if="selectedFormalite.status === 'not_valid'" class="p-2" variant="danger">No Valido</b-badge>
          <b-badge v-if="selectedFormalite.status === 'uploading_requeriments'" class="p-2" variant="danger">Falta subir Recaudos o pulsar el boton de finalizar proceso.</b-badge>
        </div>
      </div>
      <div class="ml-4 mb-4">
        <hr>
        <b-row v-if="type === 'admin'" class=" mb-2 mt-2">
          <b-col md="6">Cliente: <span class="ml-2">{{selectedFormalite.client.user.name}}</span></b-col>
          <b-col md="6">Nacionalidad: <span class="ml-2">{{selectedFormalite.client.user.nationality}}</span></b-col>
        </b-row>
        <b-row v-if="type === 'admin'" class=" mb-2 mt-2">
          <b-col md="6">Email: <span class="ml-2">{{selectedFormalite.client.email}}</span></b-col>
          <b-col md="6">DNI: <span class="ml-2">{{selectedFormalite.client.user.dni}}</span></b-col>
        </b-row>
      </div>
      <div class="ml-4" v-for="(permit, index) of selectedFormalite.permits" v-bind:key="index">
        <div class="formalitie-container">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class=" mb-3">N° de Permiso: {{permit.request_permit_no}}</h5>
            <div>
              <b-badge class="p-2" v-if="permit.permit_type.type === 'export'" variant="success">Exportación</b-badge>
              <b-badge class="p-2" v-if="permit.permit_type.type === 'import'" variant="success">Importación</b-badge>
              <b-badge class="p-2" v-if="permit.permit_type.type === 'reexport'" variant="success">Reexportación</b-badge>
              <b-badge v-if="permit.status === 'uploading_requeriments'" class="p-2" variant="warning">Recaudos Por Subir</b-badge>
              <b-badge v-if="permit.status === 'requested'" class="p-2" variant="warning">Por Validar</b-badge>
              <b-badge v-if="permit.status === 'valid'" class="p-2" variant="success">Validado Correctamente</b-badge>
              <b-badge v-if="permit.status === 'committed'" class="p-2" variant="success">Entregado</b-badge>
              <b-badge v-if="permit.status === 'not_valid'" class="p-2" variant="danger">No Valido</b-badge>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <span>{{permit.permit_type.name}}</span>
            <div v-if="type === 'client'">
              <button class="btn btn-primary" @click="showPermitStatus(permit)">Ver estado del Permiso</button>
            </div>
            <div class="d-flex flex-column justify-content-between align-items-end" v-if="type === 'admin'">
              <button class="btn btn-primary" @click="showPermitStatus(permit)">Ver estado del Permiso</button>
              <a v-if="permit.status === 'committed' || permit.status === 'valid'" class="btn btn-info mt-2" :href="`/dashboard/permissions/viewPermit/${permit.id}`">Imprimir Certificado</a>
              <b-badge v-if="permit.status === 'printed'" class="p-2 mt-2" variant="success">
                Certificado Impreso <font-awesome-icon :icon="['fa', 'clipboard']"></font-awesome-icon>
              </b-badge>
              <a v-if="!(permit.status === 'uploading_requeriments' || permit.status === 'committed' || permit.status === 'valid' || permit.status === 'printed')" class="btn btn-primary mt-2" :href="'/dashboard/permissions/check/'+ selectedFormalite.id">Realizar Validación del Permiso</a>
            </div>
          </div>
        </div>
      </div>
    </b-modal>
    <b-modal v-if="showPermit" v-model="showPermit" size="xl" id="species-modal" title="Estado del Permiso" hide-footer> 
      <div class="ma-5 d-flex justify-content-between align-items-center">
        <h4 class=" mb-3">N° de Permiso: {{selectedPermit.request_permit_no}}</h4>
        <b-badge v-if="selectedPermit.status === 'requested'" class="p-2" variant="warning">Por Validar</b-badge>
          <b-badge v-if="selectedPermit.status === 'valid'" class="p-2" variant="success">Validado Correctamente</b-badge>
          <b-badge v-if="selectedPermit.status === 'committed'" class="p-2" variant="success">Entregado</b-badge>
          <b-badge v-if="selectedPermit.status === 'not_valid'" class="p-2" variant="danger">No Valido</b-badge>
          <b-badge v-if="selectedPermit.status === 'printed'" class="p-2" variant="success">Certificado Impreso</b-badge>
        <b-badge v-if="selectedPermit.status === 'uploading_requeriments'" class="p-2" variant="danger">Falta subir Recaudos o pulsar el boton de finalizar proceso.</b-badge>
      </div>
      <div class="ml-4 mb-4">
        <hr>
        <b-row class=" mb-2 mt-2">
          <b-col md="6">Lugar de Envio: <span class="ml-2">{{selectedPermit.destiny_place}}</span></b-col>
          <b-col md="6">Lugar de Llegada: <span class="ml-2">{{selectedPermit.departure_place}}</span></b-col>
        </b-row>
        <b-row class="mb-2 mt-2">
          <b-col md="6">Puerto de Salida: <span class="ml-2">{{selectedPermit.shipment_port}}</span></b-col>
          <b-col md="6">Puerto de Llegada: <span class="ml-2">{{selectedPermit.landing_port}}</span></b-col>
        </b-row>
        <b-row class="mb-2 mt-2">
          <b-col md="6">Consignado a: <span class="ml-2">{{selectedPermit.consigned_to}}</span></b-col>
          <b-col md="6">Medio de Transporte: <span class="ml-2">{{selectedPermit.transportation_way}}</span></b-col>
        </b-row>
        <b-row class="mb-2 mt-2">
          <b-col v-if="selectedPermit.permit_type_id === 2" md="6">País De Envío: <span class="ml-2">{{selectedPermit.country}}</span></b-col>
          <b-col v-if="selectedPermit.permit_type_id !== 2" md="6">País Destino: <span class="ml-2">{{selectedPermit.country}}</span></b-col>
          <b-col md="3">Propósito: <span class="ml-2">{{selectedPermit.purpose}}</span></b-col>
        </b-row>
        <hr>
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
          <div v-if="requeriment.type === 'form'">
            <font-awesome-icon :icon="['fa', 'check']"></font-awesome-icon>
            Planilla Completada
          </div>
          <div v-else-if="requeriment.type === 'physical'">
            <font-awesome-icon :icon="['fa', 'check']"></font-awesome-icon>
            Solo entrega en Físico
          </div>
          <div v-else-if="requeriment.pivot.file_url">
            <a :href="`/${requeriment.pivot.file_url}`" target="_blank"><font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon> Ver Archivo</a>
          </div>
          <div v-else>
            <font-awesome-icon :icon="['fa', 'ban']"></font-awesome-icon>
            No se ha subido el documento
          </div>
        </b-col>
        <b-col sm="12" lg="2" class="">
          <div>
            <b-badge v-if="requeriment.pivot.is_valid" class="p-2" variant="success">
              Valido
              <font-awesome-icon :icon="['fa', 'check']"></font-awesome-icon>
            </b-badge>
            <b-badge v-else-if="!requeriment.pivot.is_valid && selectedPermit.observations" class="p-2" variant="danger">
              No valido
              <font-awesome-icon :icon="['fa', 'ban']"></font-awesome-icon>
            </b-badge>
            <b-badge v-else class="p-2" variant="warning">
              Por Validar
              <font-awesome-icon :icon="['fa', 'clipboard']"></font-awesome-icon>
            </b-badge>
          </div>
        </b-col>
      </b-row>
    </b-modal>
  </div>
</template>
<script>
import {mapActions, mapGetters} from 'vuex'
import moment from "moment";
export default {
  props:['formalities', 'type'],
  data: () => ({
    moment: moment,
    fields: [
      {
        key: 'request_formalitie_no',
        label: 'N° de Trámite',
        sortable: true
      },
      {
        key: 'type',
        label: 'Tipo de Permiso',
        sortable: true
      },
      {
        key: 'created_at',
        label: 'Fecha de Creación',
        sortable: true,
      },
      {
        key: 'status',
        label: 'Estatus',
        sortable: true,
      },
      {
        key: 'actions',
        label: 'Acciones',
      }
    ],
    columns: [
      "Recaudo",
      "Archivo",
      "Validación"
    ],
    showPermit : false,
    showFormalite : false,
    selectedPermit: {}, 
    selectedFormalite: {} 
  }),
  computed: {
    validSpecies(){
      let count = 0
      for (const specie of this.selectedPermit.species) {
        if (specie.pivot.is_valid){
          count++
        }
      }
      if (count === this.selectedPermit.species.length){
        return true
      }
      else {
        return false
      }
    }
  },
  methods: {
    ...mapActions([
      'fetchSpecies',
    ]),
    showPermitStatus(permit){
      this.showPermit = true
      this.selectedPermit = permit
    },
    showFormaliteStatus(formalite){
      this.showFormalite = true
      this.selectedFormalite = formalite
    },
  },
}
</script>
<style scoped>
  .formalitie-container{
    border: 1px solid rgb(39, 39, 39);
    border-radius: 5px;
    margin-bottom: 20px;
    padding: 20px;
  }
  .permit-container{
    border: 1px solid rgb(158, 158, 158);
    border-radius: 5px;
    margin-bottom: 20px;
    padding: 20px;
  }
  

  .clase1 {
    padding: 10px;
  }

  .clase1 {
    padding: 20px !important;
  }

  
</style>