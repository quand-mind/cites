<template>
  <div>
    <b-row class="mt-3">
      <b-col lg="2" class="w-100"> Nombre de la Especie:</b-col>
      <b-col lg="2" class="w-100">Tipo de Especie:</b-col>
      <b-col lg="2" class="w-100">Cantidad:</b-col>
      <b-col lg="2" class="w-100">Archivo:</b-col>
      <b-col lg="2" v-if="type==='client'" class="w-100">Acciones:</b-col>
      <b-col lg="2" class="w-100" v-if="type !== 'client'">Válido:</b-col>
    </b-row>
    <b-row class="mt-3 mb-3" v-for="(specie, index) of selectedSpecies" v-bind:key="index">
      <b-col lg="2" class="w-100">{{specie.name_common}}</b-col>
      <b-col lg="2" class="w-100">{{specie.type}}</b-col>
      <b-col lg="2" class="w-100">{{specie.pivot.qty}}</b-col>
      <b-col lg="2">
        <a v-if="specie.pivot.file_url" :href="`/${specie.pivot.file_url}`" target="_blank"><font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon> Ver Archivo </a>
        <span v-else>No se ha subido ningun archivo</span>
      </b-col>
      <b-col lg="2"  v-if="type==='client'" class="w-100">
        <button v-if="specie.pivot.file_url" class="ml-3 btn text-danger relative" @click="deleteFile(specie, index)" style="cursor:pointer">
          <font-awesome-icon :icon="['fa', 'trash']"></font-awesome-icon>
        </button>
        <div v-else>
          <label class="btn text-primary" :for="'file'+ index" style="cursor:pointer">
            <font-awesome-icon :icon="['fa', 'upload']"></font-awesome-icon>
          </label>
          <b-form-file
            @input="uploadFile(specie, index)"
            :data-id="index"
            style="display:none"
            :id="'file'+ index"
            accept=".pdf"
            v-model="file"
            drop-placeholder="Subir archivo aquí..."
            max-size="10240"
          ></b-form-file>
        </div>
      </b-col>
      
      <b-col lg="2" v-if="type !== 'client'" class="d-flex justify-content-center align-items-center flex-row">
        <b-form-checkbox
          :disabled="!specie.pivot.file_url"
          @change="validSpecies(specie, index)"
          v-model="specie.pivot.is_valid"
          :value="1"
          :unchecked-value="0"
        >
          Válido
        </b-form-checkbox>
        <div>
          <b-form-input @change="sendErrors(specie, index)" class="ml-4" v-if="showErrors && errorId === specie.id" v-model="specie.pivot.file_errors" placeholder="Indique el problema:" ></b-form-input>
        </div>
      </b-col>
    </b-row>
  </div>
</template>
<script>
export default {
  props: ['selectedSpecies','showSelectedSpecies', 'type'],
  data: () =>({
    file: null,
    errorId: null,
    showErrors: false,
  }),
  methods:{
    uploadFile (specie, index) {
      this.$emit('uploadSpecieFile', this.file, specie, false, index)
    },
    deleteFile(specie, index){
      this.$emit('deleteSpecieFile', specie, index)
    },
    closeSpecieListDialog(){
      false
      this.$emit('closeSpecieListDialog')
    },
    deleteSpecie(specie){
      this.$emit('deleteSpecie', specie)
    },
    validSpecies(specie, index){
      specie.pivot.is_valid = !specie.pivot.is_valid
      if (specie.pivot.is_valid){
        this.showErrors = false
        this.errorId = null
        specie.pivot.file_errors = null
        this.$emit('validSpecies', specie, index)
      } else {
        this.showErrors = true
        this.errorId = specie.id
      }
    },
    sendErrors(specie, index){
      this.$emit('validSpecies', specie, index)
    },
  }
}
</script>