<script>
import { Line, mixins } from 'vue-chartjs'
const { reactiveProp } = mixins
export default {
  extends: Line,
  mixins: [reactiveProp],
  props:['datasets','labels',],
  data: (vm) => ({
    data : {
        labels: vm.labels,
        datasets: vm.datasets
    },
    options: {
      chartArea: {width: '95%'},
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
      },
      legend: {
        position: 'left',
        display: false,
        maxWidth: 10,
        labels: {
          display: false,
          show: false,
          // fontColor: 'rgb(, 99, 0)',
          position: 'left',
        }
      },
      plugins: {
        title: {
          display: false,
          text: 'Chart.js Line Chart'
        }
      }
    }
  }),
  methods: {
    update(chart) {
      this.renderChart(this.data, this.options)
      console.log('hola')
      chart.update()
    }
  },
  watch: {
    datasets: function(newData, oldData) {
      this.data.datasets = newData
      this.renderChart(this.data, this.options);
    },
    labels: function(newData, oldData) {
      this.data.labels = newData
      this.renderChart(this.data, this.options);
    }
  },
  mounted () {
    this.renderChart(this.data, this.options)
  }
}
</script>