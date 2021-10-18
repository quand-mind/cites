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
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
  }),
  mounted () {
    this.renderChart(this.data, this.options)
  }
}
</script>