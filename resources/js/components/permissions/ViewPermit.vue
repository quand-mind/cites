<template>
  <div>
    <h2>Permiso</h2>
    <h4>N° de Permiso: {{permit.request_permit_no}}</h4>
    <div>
      <hr>
        <b-row class=" mb-2 mt-2">
          <b-col md="6">Cliente: <span class="ml-2">{{permit.client.user.name}}</span></b-col>
          <b-col md="6">Nacionalidad: <span class="ml-2">{{permit.client.user.nationality}}</span></b-col>
        </b-row>
        <b-row class=" mb-2 mt-2">
          <b-col md="6">Email: <span class="ml-2">{{permit.client.email}}</span></b-col>
          <b-col md="6">DNI: <span class="ml-2">{{permit.client.user.dni}}</span></b-col>
        </b-row>
        <hr>
        <b-row class=" mb-2 mt-2">
          <b-col md="6">Lugar de Envio: <span class="ml-2">{{permit.destiny_place}}</span></b-col>
          <b-col md="6">Lugar de Llegada: <span class="ml-2">{{permit.departure_place}}</span></b-col>
        </b-row>
        <b-row class="mb-2 mt-2">
          <b-col md="6">Puerto de Salida: <span class="ml-2">{{permit.shipment_port}}</span></b-col>
          <b-col md="6">Puerto de Llegada: <span class="ml-2">{{permit.landing_port}}</span></b-col>
        </b-row>
        <b-row class="mb-2 mt-2">
          <b-col md="6">Consignado a: <span class="ml-2">{{permit.consigned_to}}</span></b-col>
          <b-col md="6">Medio de Transporte: <span class="ml-2">{{permit.transportation_way}}</span></b-col>
        </b-row>
        <b-row class="mb-2 mt-2">
          <b-col v-if="permit.permit_type_id === 2" md="6">País De Envío: <span class="ml-2">{{permit.country}}</span></b-col>
          <b-col v-if="permit.permit_type_id !== 2" md="6">País Destino: <span class="ml-2">{{permit.country}}</span></b-col>
          <b-col md="3">Propósito: <span class="ml-2">{{permit.purpose}}</span></b-col>
        </b-row>
        <hr>
    </div>

    <div class="mt-5">
      <h4 class="mb-4">Especies</h4>
      <hr class="">
      <b-row class=" mb-2 mt-2">
        <b-col v-for="(column, index) of columns" v-bind:key="index">{{column}}</b-col>
      </b-row>
      <hr>
      <b-row class=" mb-2 mt-2" v-for="(specie, index) of permit.species" v-bind:key="index">
        <b-col>{{specie.name_common}}</b-col>
        <b-col>{{specie.name_scientific}}</b-col>
        <b-col>{{specie.type}}</b-col>
        <b-col>{{specie.pivot.qty}}</b-col>
      </b-row>
    </div>
    <button class="w-100 mt-5 btn btn-primary" v-if="type ==='client'" @click="printPermit()">Imprimir Certificado</button>

  </div>
</template>
<script>
export default {
  props:
  ['permit', 'type'],
  data: () => ({
    columns:['Nombre Común', 'Nombre Científico', 'Tipo', 'Cantidad']
  }),
  methods:{
    printPermit(){
      console.log('Permiso',this.permit)
    }
  }
}
</script>