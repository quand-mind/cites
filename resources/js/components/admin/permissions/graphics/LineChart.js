import {Line} from 'vue-chartjs'

export default  Line.extend({
  mounted () {
    this.renderChart({

      labels:['Jan', 'Feb', 'Mar', 'May', 'Jun', 'Jul'],
      datasets: [
        {label: 'My activities', backdropColor: '#dd4b39', data: [40,30,20,34,65,34]}
      ]
    }, {responsive: true, maintainAspectRatio: false})
  }
})