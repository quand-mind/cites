<script>
import { LineChart } from 'vue-chartjs'

export default {
  extends: LineChart,
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
      },
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Chart.js Line Chart'
        }
      }
    }
  }),
  mounted () {
    this.renderChart(this.data, this.options)
  }
}
</script>