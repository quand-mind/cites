<template>
  <div style="height:90vh;">
    <h1> Permiso N°: {{permit.request_permit_no}}</h1>
    <hr>
    <b-row class="mb-2">
      <b-col xs="12" md="6">
        <h6>N° Sistra: {{permit.sistra}}</h6>
      </b-col>
      <b-col xs="12" md="6">
        <h6>Válido Hasta: {{permit.valid_until}}</h6>
      </b-col>
    </b-row>
    <b-row>
      <b-col xs="12" md="6">
        <h6>Fecha de Creación: {{moment(permit.created_at).format("DD-MM-YYYY")}}</h6>
      </b-col>
      <b-col xs="12" md="6">
        <h6>Fecha de Validación: {{moment(permit.updated_at).format("DD-MM-YYYY")}}</h6>
      </b-col>
    </b-row>
    <hr>
    <b-row class="mt-4 mb-2">
      <b-col xs="12" md="4">
        <h6>N° de Trámite: {{permit.formalitie.request_formalitie_no}}</h6>
      </b-col>
      <b-col xs="12" md="4">
        <h6>Propósito: {{permit.purpose}}</h6>
      </b-col>
      <b-col xs="12" md="4">
        <h6>Cosignado a: {{permit.consigned_to}}</h6>
      </b-col>
    </b-row>
    <b-row >
      <b-col xs="12" md="4">
        <h6 v-if="permit.permit_type.type === 'export' || permit.permit_type.type === 'reexport'">País de Destino: {{permit.formalitie.country}}</h6>
        <h6 v-if="permit.permit_type.type === 'import'">País de Destino: Venezuela</h6>
      </b-col>
      <b-col xs="12" md="4">
        <h6 v-if="permit.permit_type.type === 'export' || permit.permit_type.type === 'reexport'">País de Origen: Venezuela</h6>
        <h6 v-if="permit.permit_type.type === 'import'">País de Origen: {{permit.formalitie.country}}</h6>
      </b-col>
      <b-col xs="12" md="4">
        <h6 v-if="permit.permit_type.type === 'export'">Tipo de Permiso: Exportación.</h6>
        <h6 v-if="permit.permit_type.type === 'reexport'">Tipo de Permiso: Reexportación.</h6>
        <h6 v-if="permit.permit_type.type === 'import'">Tipo de Permiso: Importación.</h6>
      </b-col>
    </b-row>
    <hr>
    

    <b-card no-body class="mt-30 w-100">
      <b-row no-gutters>
        <b-col md="2" class="d-flex justify-content-center align-items-center">
          <b-card-img style="height: 100px; width:auto;" src="/storage/../images/logos/logo-minec.png" alt="Image" class="rounded-2"></b-card-img>
        </b-col>
        <b-col md="6">
          <b-card-body title="Ministerio del Poder Popular para el Ecosocialismo">
            <b-card-text>
              Este permiso fue expedido y validado.
            </b-card-text>
          </b-card-body>
        </b-col>
      </b-row>
    </b-card>

  </div>
</template>

<style scoped>

  .w-90{
    width:90%;
  }
  .mt-30{
    margin-top:30rem
  }
</style>
<script>
import moment from "moment";
export default {
  props:['permit'],
  data() {
    return {
      moment: moment
    }
  }
}
</script>