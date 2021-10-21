<script>
import { Doughnut } from 'vue-chartjs'

export default {
  extends: Doughnut,
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
      responsive: true, 
      maintainAspectRatio: false, 
      animation: {
        animateRotate: false
      }
    }
  }),
  mounted () {
    this.renderChart(this.data, this.options)
  }
}
</script>