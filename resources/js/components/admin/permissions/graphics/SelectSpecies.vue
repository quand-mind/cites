<template>
  <b-row>
    <b-col md="6" v-if="speciesNotListed.length > 0">
      <h5>Agregar Especies:</h5>
      <b-card v-for="specie of speciesNotListed" :key="specie.id">
        <b-row>
          <b-col md="11" sm="12">{{specie.name_common}}</b-col>
          <b-col md="1" sm="12">
            <b-btn @click="addSpecie(specie)"><b> + </b></b-btn>
          </b-col>
        </b-row>
      </b-card>
    </b-col>
    <b-col v-else>
      <h5>Agregar Seleccionadas:</h5>
      <b-card>
        <span>No quedan especies por añadir</span>
      </b-card>
    </b-col>
    <b-col md="6" v-if="speciesList.length > 0">
      <h5>Especies Seleccionadas:</h5>
      <b-card v-for="specie of speciesList" :key="specie.id">
        <b-row>
          <b-col md="11" sm="12">{{specie.name_common}}</b-col>
          <b-col md="1" sm="12">
            <b-btn @click="quitSpecie(specie)"><b> - </b></b-btn>
          </b-col>
        </b-row>
      </b-card>
    </b-col>
    <b-col v-else>
      <h5>Especies Seleccionadas:</h5>
      <b-card>
        <span>No hay ninguna specie añadida</span>
      </b-card>
    </b-col>
  </b-row>
</template>
<script>
import timeout from '../../../../setTimeout';
export default {
  props: ['species', 'all_species'],
  data:(vm)=>({
    speciesList: vm.species,
    allSpeciesList: vm.all_species,
    speciesNotListed: []
  }),
  methods: {
    changeDate() {
      // console.log(this.date1Data)
      axios
        .post(`/dashboard/permissions/graphics/selectSpecies`, {species: JSON.stringify(this.speciesList)})
        .then(res => {
          this.makeToast('Gráfica Actualizada')
          this.$emit('changeSpecies', res.data)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    makeToast(msg, variant = "success", delay = timeout, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: 'Gráfica',
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    },
    addSpecie(specie) {
      let index = this.speciesNotListed.findIndex(specieList => specieList.id === specie.id)
      this.speciesNotListed.splice(index,1)
      this.speciesList.push(specie)
      this.$forceUpdate
      this.changeDate()
    },
    quitSpecie(specie) {
      let index = this.speciesList.findIndex(specieList => specieList.id === specie.id)
      this.speciesList.splice(index,1)
      this.speciesNotListed.push(specie)
      this.$forceUpdate
      this.changeDate()
    },
    setNotListedSpecies() {
      for (const specie of this.allSpeciesList) {
        let index = this.speciesList.findIndex(specieList => specieList.id === specie.id)
        if(index) {
          this.speciesNotListed.push(specie)
        }
      }
    }
  },
  mounted() {
    this.setNotListedSpecies()
  }
}
</script>