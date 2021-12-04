<template>
  <div>
    <Graphic :title="titleToPass"></Graphic>
    <SelectSpecies @changeSpecies="changeSpecies" :all_species="allSpeciesToPass" :species="speciesToPass" class="mb-5"></SelectSpecies>
    <Bar ref="bar" :labels="labelsToPass" :datasets="datasetsToPass"></Bar>
    <b-btn @click="saveData">Guardar datos de la gráfica</b-btn>
  </div>
</template>

<script>
import Bar from './Bar.vue';
import Graphic from './Graphic.vue';
import timeout from '../../../../setTimeout';
import SelectSpecies from './SelectSpecies.vue';
export default {
  props:['title', 'datasets', 'labels', 'species', 'all_species'],

  data: (vm) => ({
    labelsToPass: [],
    datasetsToPass: null,
    titleToPass: null,
    speciesToPass: [],
    allSpeciesToPass: [],
  }),



  components: {
    Bar,
    Graphic,
    SelectSpecies,
  },
  methods:{
    changeSpecies (data) {
      
      this.datasetsToPass = data.datasets
      this.speciesToPass = data.species
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

      let speciesIdsArray = this.speciesToPass.map(specie => specie.id)
      let speciesIds = speciesIdsArray.join(',')
      // console.log(speciesIds)
      let date = new Date()
      let documentTitleToPass = 'grafica_especies' + date

      window.location.assign(`/dashboard/permissions/graphics/exportSpeciesData?speciesIds=${speciesIds}&title=${this.titleToPass}&documentTitle=${documentTitleToPass}`)
    },
    makeToast(msg, variant = "success", delay = timeout, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: 'Guardar Datos',
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    },
  },
  created () {
    this.labelsToPass = this.labels
    this.datasetsToPass = this.datasets
    this.titleToPass = this.title
    this.speciesToPass = this.species
    this.allSpeciesToPass = this.all_species
  }
}
</script>