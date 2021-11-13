<template>
  <div>
    <b-card class="">
      <b-card-text>
        <b-row class="mb-2">
          <b-col cols="8">Nombre:</b-col>
          <b-col cols="4">
            Apodo:
            <b-badge id="tooltip-short-name" class="py-1 px-2" variant="">?</b-badge>
            <b-tooltip placement="right" target="tooltip-short-name" triggers="hover">
              Traté de mantener el apodo lo más corto y descriptivo posible, si utiliza más de una palabra, debe unirlas con una barra baja. <br> <b>Ejemplo: planilla_solicitud</b>.
            </b-tooltip>
          </b-col>
        </b-row>
        <b-row>
          <b-col cols="8">
            <b-form-textarea v-model="requeriment.name"></b-form-textarea>
          </b-col>
          <b-col cols="4">
            <b-form-input v-model="requeriment.short_name"></b-form-input>
          </b-col>
        </b-row>
        <b-row class="mt-4 mb-2">
          <b-col cols="4">Tipo de Recaudo:</b-col>
        </b-row>
        <b-row>
          <b-col cols="4">
            <b-form-select v-model="requeriment.type"
              :options="options"></b-form-select>
          </b-col>
          <b-col cols="8">
            <b-btn variant="primary" @click="editRequeriment()">Actualizar Recaudo</b-btn>
          </b-col>
        </b-row>
      </b-card-text>
    </b-card>
  </div>
</template>
<script>
export default {
  props: ['requeriment'],
  data: () => ({
    options:[
      {value:null, text: 'Seleccione una opción', disabled: true},
      {value:'physical', text: 'Solo entrega en físico'},
      {value:'web', text: 'Entrega web y física'},
      {value:'form', text: 'Planilla'},
      {value:'personal', text: 'Personal'},
    ]
  }),
  methods: {
    editRequeriment(){
      this.$emit('editRequeriment', this.requeriment)
      
    },
    closeEditRequerimentDialog(){
      this.$emit('closeEditRequerimentDialog')
    }
  }
}
</script>