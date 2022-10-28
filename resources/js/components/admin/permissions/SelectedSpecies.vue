<template>
  <div>
    <b-row class="mt-3">
      <b-col lg="2" class="w-100"> Nombre Común:</b-col>
      <b-col lg="2" class="w-100"> Nombre Científico:</b-col>
      <b-col lg="2" class="w-100">Tipo de Especie:</b-col>
      <b-col lg="2" class="w-100">Cantidad:</b-col>
      <b-col lg="4" class="w-100">Descripción:</b-col>
    </b-row>
    <b-row class="mt-3 mb-3" v-for="(specie, index) of selectedSpecies" v-bind:key="index">
      <b-col lg="2" class="w-100">{{specie.name_common}}</b-col>
      <b-col lg="2" class="w-100">{{specie.name_common}}</b-col>
      <b-col lg="2" class="w-100">{{specie.type}}</b-col>
      <b-col lg="2" class="w-100">{{specie.pivot.qty}}</b-col>
      <b-col lg="4" class="w-100">{{specie.pivot.description}}</b-col>
      
    </b-row>
  </div>
</template>
<script>
export default {
  props: ['selectedSpecies', 'type'],
  data: () =>({
    file: null,
    errorId: null,
    showErrors: false,
  }),
}
</script>