<template>
  <div>
    <b-row class="mt-3">
      <b-col lg="3" class="w-100"> Nombre de la Especie:</b-col>
      <b-col lg="3" class="w-100">Descripción:</b-col>
      <b-col lg="2" class="w-100">Cantidad:</b-col>
      <b-col lg="4" v-if="type === 'client'" class="w-100">Eliminar:</b-col>
    </b-row>
    <b-row class="mt-3 mb-3" v-for="(specie, index) of selectedSpecies" v-bind:key="index">
      <b-col lg="3" class="w-100">{{specie.name_common}}</b-col>
      <b-col lg="3" class="w-100">{{specie.description}}</b-col>
      <b-col lg="2" class="w-100">{{specie.qty}}</b-col>
      <b-col lg="4" class="w-100" v-if="type === 'client'">
        <button class="ml-3 btn text-danger relative" @click="deleteSpecie(specie, index)" style="cursor:pointer">
          <font-awesome-icon :icon="['fa', 'trash']"></font-awesome-icon>
        </button>
      </b-col>
    </b-row>
  </div>
</template>
<script>
export default {
  props: ['selectedSpecies','showSelectedSpecies', 'type'],
  data: () =>({
    file: null
  }),
  methods:{
    uploadFile (specie) {
      this.$emit('uploadSpecieFile', this.file, specie, true)
    },
    deleteFile(specie){
      this.$emit('deleteFile', this.file, specie)
    },
    closeSpecieListDialog(){
      false
      this.$emit('closeSpecieListDialog')
    },
    deleteSpecie(specie, index){
      this.$emit('deleteSpecie', specie, index)
    },
  }
}
</script>