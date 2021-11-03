<script>
import { Bar } from 'vue-chartjs'

export default {
  extends: Bar,
  props:['values','labels', 'backgrounds', 'label'],
  data: (vm) => ({
    data : {
        labels: vm.labels,
        datasets: [{
            label: vm.label,
            data: vm.values,
            backgroundColor: vm.backgrounds,
            borderColor: vm.backgrounds,
            borderWidth: 1
        }]
    },
    options: {
      // responsive: true,
      maintainAspectRatio: true,
      scales: {
        y: {
          min: 1,
          max: 100,
          ticks: {
            // forces step size to be 50 units
            stepSize: 10
          }
        }
      }
    }
  }),
  mounted () {
    this.renderChart(this.data, this.options)
  }
}
</script>
<style>
  #bar > div {
    display:flex;
    justify-content:center;
    align-items:center;
  }
  #bar-chart {
    width: 70vw !important;
    height: auto !important;
  }
</style>