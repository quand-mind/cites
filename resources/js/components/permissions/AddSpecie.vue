<template>
  <div>
    Especie:
    <div class="mt-3">
      <span> <small>Filtros de Busqueda</small></span>
    </div>
    <b-row class="d-flex justify-content-center align-items-center">
      <b-col sm="12" md="4" lg="2" class="input-group mb-3 ">
        <b-form-select v-model="newSpecie.kingdom" :options="kingdoms"></b-form-select>
      </b-col>
      <b-col sm="12" md="4" lg="2" class="input-group mb-3">
        <b-form-select v-model="newSpecie.family" :options="families"></b-form-select>
      </b-col>
      <b-col sm="12" md="4" lg="2" class="input-group mb-3">
        <b-form-select v-model="newSpecie.class" :options="classes"></b-form-select>
      </b-col>
      <b-col sm="12" md="4" lg="2" class="input-group mb-3">
        <b-form-select v-model="newSpecie.phylum" :options="phylums"></b-form-select>
      </b-col>
      <b-col sm="12" md="4" lg="2" class="input-group mb-3">
        <b-form-select v-model="newSpecie.name_common" :options="species"></b-form-select>
      </b-col>
      <b-col sm="12" md="4" lg="2" class="input-group mb-3">
        <b-form-input v-model="newSpecie.qty" placeholder="Cantidad:"></b-form-input>
      </b-col>
    </b-row>
    <b-row class="d-flex justify-content-end align-items-center">
      <b-col sm="12" md="8" lg="9" class="input-group mb-3">
        <b-form-file
          @input="uploadFile(newSpecie)"
          accept=".pdf, .jpg, .png"
          v-model="file"
          placeholder="Documento Legal: (Formatos aceptados: .pdf, .jpg, .png)"
          drop-placeholder="Subir archivo aquí..."
          max-size="2048"
        ></b-form-file>
      </b-col>
      <b-col sm="12" md="4" lg="3" class="input-group mb-3 d-flex justify-content-end align-items-center">
        <button class="btn btn-primary" :disabled="!validSpecie" @click="addSpecieToList()">Agregar Especie a la Lista</button>
      </b-col>
      </b-col>
    </b-row>
  </div>
</template>
<script>
export default {
  props: ['selectedSpecies', 'showSelectSpecie','type'],
  data: () =>({

    newSpecie: {
      name_common: null,
      phylum: null,
      family: null,
      class: null,
      kingdom: null,
      pivot:{
        file_url:null
      },
      qty: null
    },
    file:null,

    kingdoms:[
      { value: null, text: 'Tipo' },
      { value: 'Animalia', text: 'Animalia' },
      { value: 'Plantae', text: 'Plantae' },
    ],
    families:[
      { value: null, text: 'Familia' },
      { value: 'Antilocapridae', text: 'Antilocapridae' },
    ],
    classes:[
      { value: null, text: 'Clase' },
      { value: 'Mammalia', text: 'Mammalia' },
    ],
    phylums:[
      { value: null, text: 'Filo' },
      { value: 'Chordata', text: 'Chordata' },
    ],
    species:[
      { value: null, text: 'Especie' },
      { value: 'Berrendo', text: 'Berrendo' },
      { value: 'Perro', text: 'Perro' },
      { value: 'Gato', text: 'Gato' },
    ],

  }),
  computed: {
    validSpecie(){
      let valid_name_common = Boolean(this.newSpecie.name_common)
      let valid_kingdom = Boolean(this.newSpecie.kingdom)
      let valid_legal_document = Boolean(this.newSpecie.pivot.file_url)
      let valid_qty = Boolean(this.newSpecie.qty)

      return valid_name_common && valid_legal_document && valid_qty && valid_kingdom
    }
  },
  methods: {
    uploadFile (specie) {
      this.$emit('uploadSpecieFile', this.file, specie)
    },
    closeAddSpecieDialog(){
      false
      this.$emit('closeAddSpecieDialog')
    },
    addSpecieToList(){
      this.$emit('addSpecie', this.newSpecie)
      this.newSpecie = {
        name_common: null,
        phylum: null,
        family: null,
        class: null,
        kingdom: null,
        pivot:{
          file_url:null,
        },
        qty: null
      }
      this.closeAddSpecieDialog()
    },
  }
}
</script>