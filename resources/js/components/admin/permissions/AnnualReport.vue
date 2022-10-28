<template>
  <div>
    <h1>Informe Anual de Especies</h1>

    <p class="mt-5">Seleccione el año del que desee obtener el informe:</p>

    <!-- <b-form-datepicker minimum-view="year" :max="date2Data" id="date1" v-model="date" class="mb-2"></b-form-datepicker> -->
    <b-row class="mt-3">
      <b-col sm="12" md="4">
        <datepicker class="ml-3" v-model="yearNotFormated" :value="this.yearNotFormated" calendar-button-icon="fa fa-calendar" name="uniquename" calendar-button=true minimum-view="year" :format="DatePickerFormat" placeholder="Seleccione"></datepicker>
      </b-col>
      <b-col sm="12" md="2">
        <b-button @click="downloadAnualReport" class="w-100">
          Descargar Informe
        </b-button>
      </b-col>
    </b-row>


  </div>
</template>
<script>
import Datepicker from 'vuejs-datepicker';
export default {
  data:(vm)=>({
    yearNotFormated: null,
    year: null,
    DatePickerFormat: 'yyyy',
  }),
  components: {
    Datepicker
  },
  watch: {
    yearNotFormated: function(newData, oldData) {
      let yearFormated = newData.toString().split(' ')[3]
      console.log(yearFormated);
      this.year = yearFormated 
    }
  },
  methods: {
    downloadAnualReport() {
      let date = new Date()
      const titleToPass = 'Reporte Anual de Especies'
      const documentTitleToPass = 'reporte_anual_esepecies' + this.year + '_(' + date + ')'
      window.location.assign(`/dashboard/permissions/annual-report/export?year=${this.year}&documentTitle=${documentTitleToPass}&title=${titleToPass}`)
    }
  }
}
</script>
<style lang="sass">
  .vdp-datepicker {
    .vdp-datepicker__calendar-button {
      margin-right: 20px;
    }
    input {
      width: 85%;
      padding: 5px 15px;
    }
  }
</style>