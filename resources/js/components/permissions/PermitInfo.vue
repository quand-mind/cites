<template>
  <div>
    <h1> Permiso N°: {{permit.request_permit_no}}</h1>
    <hr>
    <h6>N° Sistra: {{permit.sistra}}</h6>
    <!-- <h6>Fecha de Creación: {{moment(permit.created_at).format("DD-MM-YYYY")}}</h6> -->
    <h6>Fecha de Creación: {{permit.created_at | moment("dddd, MMMM Do YYYY")}}</h6>
    <!-- <h6>Fecha de Validación: {{moment(permit.updated_at).format("DD-MM-YYYY")}}</h6> -->
    <h6>Válido Hasta: {{permit.valid_until}}</h6>
  </div>
</template>
<script>
export default {
  props:['permit'],
  data() {
  }
}
</script>