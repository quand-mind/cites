<template>
  <div>
    <Graphic :title="titleToPass"></Graphic>
    <SelectSpecies @changeSpecies="changeSpecies" :all_species="allSpeciesToPass" :species="speciesToPass" class="mb-5"></SelectSpecies>
    <Bar ref="bar" :labels="labelsToPass" :datasets="datasetsToPass"></Bar>
  </div>
</template>

<script>
import Bar from './Bar.vue';
import Graphic from './Graphic.vue';
import SelectSpecies from './SelectSpecies.vue';
export default {
  props:['title', 'datasets', 'labels', 'species', 'all_species'],

  data: (vm) => ({
    labelsToPass: vm.labels,
    datasetsToPass: vm.datasets,
    titleToPass: vm.title,
    speciesToPass: vm.species,
    allSpeciesToPass: vm.all_species,
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
    }
  }
}
</script>