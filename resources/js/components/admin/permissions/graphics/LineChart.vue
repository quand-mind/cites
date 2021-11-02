<script>
import { Line, mixins } from 'vue-chartjs'
const { reactiveProp } = mixins
export default {
  extends: Line,
  mixins: [reactiveProp],
  props:['values','labels', 'backgrounds', 'label', 'borders'],
  data: (vm) => ({
    data : {
        labels: vm.labels,
        datasets: [{
            label: vm.label,
            data: vm.values,
            borderColor: vm.borders,
            backgroundColor: vm.backgrounds,
            borderWidth: 3
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