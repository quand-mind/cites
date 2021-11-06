<template>
  <div>
    <Graphic :title="titleToPass"></Graphic>
    <SelectDate @changeDate="changeDate" :date1="date1ToPass" :date2="date2ToPass" class="mb-5"></SelectDate>
    <LineChart ref="lineChart" :labels="labelsToPass" :datasets="datasetsToPass"></LineChart>
  </div>
</template>
<script>
import LineChart from './LineChart.vue';
import Graphic from './Graphic.vue';
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
      console.log(data)
      this.datasetsToPass = data.datasets
      this.labelsToPass = data.labels
      // this.$refs.lineChart.update()
      this.$forceUpdate()
    }
  }
}
</script>