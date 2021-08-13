<template>
  <div>
    <b-row class="mt-3">
      <b-col lg="2" class="w-100"> Nombre de la Especie:</b-col>
      <b-col lg="2" class="w-100">Tipo de Especie:</b-col>
      <b-col lg="2" class="w-100">Cantidad:</b-col>
      <b-col lg="2" class="w-100">Acciones:</b-col>
      <b-col lg="2" class="w-100">Archivo:</b-col>
      <b-col lg="2" class="w-100">Eliminar Especie:</b-col>
      <b-col lg="2" class="w-100" v-if="type !== 'client'">Válido:</b-col>
    </b-row>
    <b-row class="mt-3 mb-3" v-for="(specie, index) of selectedSpecies" v-bind:key="index">
      <b-col lg="2" class="w-100">{{specie.name_common}}</b-col>
      <b-col lg="2" class="w-100">{{specie.type}}</b-col>
      <b-col lg="2" class="w-100">{{specie.pivot.qty}}</b-col>
      <b-col lg="2" class="w-100">
        <button v-if="specie.pivot.file_url" class="ml-3 btn text-danger relative" @click="deleteFile(specie)" style="cursor:pointer">
          <font-awesome-icon :icon="['fa', 'trash']"></font-awesome-icon>
        </button>
        <div v-else>
          <label class="btn text-dark" :for="'file'+ index" style="cursor:pointer">
            <font-awesome-icon :icon="['fa', 'upload']"></font-awesome-icon>
          </label>
          <b-form-file
            @input="uploadFile(specie)"
            :data-id="index"
            style="display:none"
            :id="'file'+ index"
            accept=".pdf, .jpg, .png"
            v-model="file"
            drop-placeholder="Subir archivo aquí..."
            max-size="2048"
          ></b-form-file>
        </div>
      </b-col>
      <b-col lg="2">
        <a v-if="specie.pivot.file_url" :href="`/${specie.pivot.file_url}`" target="_blank"><font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon> Ver Archivo </a>
        <span v-else>No se ha subido ningun archivo</span>
      </b-col>
      <b-col lg="2">
        <button class="ml-3 btn text-danger relative" @click="deleteSpecie(specie)" style="cursor:pointer">
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
      this.$emit('uploadSpecieFile', this.file, specie)
    },
    deleteFile(specie){
      this.$emit('deleteSpecieFile', specie)
    },
    closeSpecieListDialog(){
      false
      this.$emit('closeSpecieListDialog')
    },
    deleteSpecie(specie){
      this.$emit('deleteSpecie', specie)
    },
  }
}
</script>