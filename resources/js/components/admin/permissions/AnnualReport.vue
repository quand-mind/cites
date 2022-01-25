<template>
  <div>
    <h1>Informe Anual</h1>

    <p class="mt-5">Seleccione el año del que desee obtener el informe:</p>

    <!-- <b-form-datepicker minimum-view="year" :max="date2Data" id="date1" v-model="date" class="mb-2"></b-form-datepicker> -->
    <b-row>
      <b-col sm="12" md="8">
        <datepicker class="ml-3" v-model="year" :value="this.year" calendar-button-icon="fa fa-calendar" name="uniquename" calendar-button=true minimum-view="year" :format="DatePickerFormat" placeholder="Seleccione"></datepicker>
      </b-col>
      <b-col sm="12" md="4">
        <b-button class="w-100">
          Descargar Informe Anual
        </b-button>
      </b-col>
    </b-row>


  </div>
</template>
<script>
import Datepicker from 'vuejs-datepicker';
export default {
  data:(vm)=>({
    year: null,
    DatePickerFormat: 'yyyy'
  }),
  components: {
    Datepicker
  },
  watch: {
    year: function(newData, oldData) {
      console.log(newData);
    }
  }
}
</script>