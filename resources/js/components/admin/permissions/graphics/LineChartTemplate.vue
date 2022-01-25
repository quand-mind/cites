<template>
  <div>
    <Graphic :title="titleToPass"></Graphic>
    <SelectDate @changeDate="changeDate" :date1="date1ToPass" :date2="date2ToPass" class="mb-5"></SelectDate>
    <b-row>
      <b-col lg="4" md="12">
        <div v-for="dataset of datasetsToPass" :key="dataset.label">
          <div class="d-flex m-3">
            <div class="label-box" :style="`background-color:${dataset.borderColor}`"></div>
            <span><small>{{dataset.label}}</small></span>
          </div>
        </div>
      </b-col>
      <b-col lg="8" md="12">
        <LineChart ref="lineChart" :labels="labelsToPass" :datasets="datasetsToPass"></LineChart>
      </b-col>
      
    </b-row>
  </div>
</template>
<script>
import LineChart from './LineChart.vue';
import Graphic from './Graphic.vue';
import timeout from '../../../../setTimeout';
import SelectDate from './SelectDate.vue';
export default {
  props:['title', 'datasets', 'labels', 'date1', 'date2'],
  data: (vm) => ({
    labelsToPass: vm.labels,
    datasetsToPass: vm.datasets,
    titleToPass: vm.title,
    date1ToPass: vm.date1,
    date2ToPass: vm.date2,
  }),
  components: {
    LineChart,
    Graphic,
    SelectDate,
  },
  methods:{
    changeDate (data) {
      this.datasetsToPass = data.datasets
      this.labelsToPass = data.labels
      this.$forceUpdate()
    },
    saveData () {
      let datasets = []
      let count = 0
      for (const dataset of this.datasetsToPass) {
      
        datasets.push({label: dataset.label, values:[]})
        for (const value of dataset.data) {
          datasets[count].values.push(value)
        }
        count++
      }

      let speciesIdsArray = this.labelsToPass.map(specie => specie.id)
      let speciesIds = speciesIdsArray.join(',')
      // console.log(speciesIds)
      let date = new Date()
      let documentTitleToPass = 'grafica_permisos_por_fecha' + date

      window.location.assign(`/dashboard/permissions/graphics/exportPermitsData?speciesIds=${speciesIds}&title=${this.titleToPass}&documentTitle=${documentTitleToPass}`)
    },
    makeToast(msg, variant = "success", delay = timeout, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: 'Guardar Datos',
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    },
  }
}
</script>
<style scoped>
  .w-70 {
    max-width: 70%;
  }
  .label-box {
    min-width: 40px;
    min-height:10px;
    margin-right: 20px;
  }
</style>