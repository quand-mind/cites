<script>
import { Bar } from 'vue-chartjs'

export default {
  extends: Bar,
  props:['datasets','labels',],
  data: (vm) => ({
    data : {
        labels: vm.labels,
        datasets: vm.datasets
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            // forces step size to be 50 units
            stepSize: 5
          }
        }]
      }
    }
  }),
  mounted () {
    this.renderChart(this.data, this.options)
  },
  watch: {
    datasets: function(newData, oldData) {
      this.data.datasets = newData
      console.log(newData)
      this.renderChart(this.data, this.options);
    },
    labels: function(newData, oldData) {
      this.data.labels = newData
      console.log(newData)
      this.renderChart(this.data, this.options);
    }
  },
}
</script>
<style>
  
</style>