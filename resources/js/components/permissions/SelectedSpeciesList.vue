<template>
  <div>
    <b-row class="mt-3">
      <b-col lg="3" class="w-100"> Nombre de la Especie:</b-col>
      <b-col lg="3" class="w-100">Tipo de Especie:</b-col>
      <b-col lg="2" class="w-100">Cantidad:</b-col>
      <b-col lg="4" v-if="type === 'client'" class="w-100">Acciones:</b-col>
      <b-col lg="1" v-if="type !== 'client'" class="w-100">Acciones:</b-col>
      <b-col lg="3" v-if="type !== 'client'" class="w-100">Archivo:</b-col>
    </b-row>
    <b-row class="mt-3 mb-3" v-for="(specie, index) of selectedSpecies" v-bind:key="index">
      <b-col lg="3" class="w-100">{{specie.name}}</b-col>
      <b-col lg="3" class="w-100">{{specie.kingdom}}</b-col>
      <b-col lg="2" class="w-100">{{specie.qty}}</b-col>
      <b-col lg="3" class="w-100" v-if="type === 'client'">
        <button class="ml-3 btn text-danger relative" @click="deleteSpecie(index)" style="cursor:pointer">
          <font-awesome-icon :icon="['fa', 'trash']"></font-awesome-icon>
        </button>
      </b-col>
      <b-col lg="1" class="w-100" v-if="type !== 'client'">
        <button class="ml-3 btn text-danger relative" @click="deleteSpecie(index)" style="cursor:pointer">
          <font-awesome-icon :icon="['fa', 'trash']"></font-awesome-icon>
        </button>
      </b-col>
      <b-col lg="3" class="w-100" v-if="type !== 'client'">
        <a v-if="specie.legal_document" :href="specie.file_url" target="_blank"><font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon> Archivo ({{ specie.legal_document.name }})</a>
        <button v-if="specie.legal_document" class="ml-3 btn text-danger relative" @click="deleteFile(specie.file_url)" style="cursor:pointer">
          <font-awesome-icon :icon="['fa', 'trash']"></font-awesome-icon>
        </button>
        <div v-if="!specie.legal_document">
          <label class="btn text-dark" :for="'file'+ index" style="cursor:pointer">
            <font-awesome-icon :icon="['fa', 'upload']"></font-awesome-icon>
          </label>
          <b-form-file
            @input="uploadFile"
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
    uploadFile () {
      this.$emit('uploadFile', this.file)
    },
    deleteFile(file){
      this.$emit('deleteFile', file)
    },
    closeSpecieListDialog(){
      false
      this.$emit('closeSpecieListDialog')
    },
    deleteSpecie(index){
      this.$emit('deleteSpecie', index)
    },
  }
}
</script>