<template>
  <div>
    <b-card class="">
      <b-card-text>

        <b-row class="mb-2">
          <b-col cols="8">Nombre:</b-col>
          <b-col cols="4">
            Departamento:
            <b-badge id="tooltip-departament" class="py-1 px-2" variant="">?</b-badge>
            <b-tooltip placement="right" target="tooltip-departament" triggers="hover">
              Asigne a que departamento del ministerio pertenece el permiso.
              <br> <b>Ejemplo: Diversidad Biológica</b>.
            </b-tooltip>
          </b-col>
        </b-row>
        <b-row>
          <b-col cols="8">
            <b-form-input v-model="permit.name"></b-form-input>
          </b-col>
          <b-col cols="4">
            <b-form-select v-model="permit.departament_id"
            :options="departamentOptions">
            </b-form-select>
          </b-col>
        </b-row>

        <b-row class="mt-4 mb-2">
          <b-col cols="8">Tipo de Permiso:</b-col>
          <b-col cols="4">Estatus:</b-col>
        </b-row>
        <b-row>
          <b-col cols="8">
            <b-form-select v-model="permit.type"
              :options="options"></b-form-select>
          </b-col>
          <b-col cols="4">
            <b-form-checkbox v-model="permit.status" value="active" unchecked-value="disabled" name="check-button" switch>
               <b v-if="permit.status === 'active'">Activo</b>
               <b v-else >Deshabilitado</b>
            </b-form-checkbox>
          </b-col>
        </b-row>

      </b-card-text>
    </b-card>
    <b-card>
      <b-card-text>
        <b-row class="mt-4 mb-2">
          <b-col cols="4">Recaudos:</b-col>
        </b-row>
        <b-row class="mt-4 mb-2">
          <b-col cols="6">Añadir Recaudo</b-col>
          <b-col cols="6">Listado de Recaudos</b-col>
        </b-row>
        <b-row>
          <b-col cols="4">
            <b-form-select v-model="selectedRequeriment"
              :options="requeriments" value-field="short_name" 
              text-field="name"></b-form-select>
          </b-col>
          <b-col cols="2">
            <b-button :disabled="!selectedRequeriment" @click="addRequeriment()">Agregar</b-button>
          </b-col>
          <b-col cols="6">
            <div v-if="permit.requeriments.length > 0">
              <b-button v-b-toggle.requeriments-list class="m-1 w-100">Ver Recaudos</b-button>
              <b-collapse  id="requeriments-list">
                <div v-for="(requeriment, index) of permit.requeriments" :key="index">
                  <b-card>
                    <b-row>
                      <b-col cols="9">
                        <span>{{requeriment.name}}</span>
                      </b-col>
                      <b-col class="d-flex align-items-center justify-content-center" cols="3">
                        <b-button @click="deleteRequeriment(requeriment)" variant="danger">Quitar</b-button>
                      </b-col>
                    </b-row>
                  </b-card>
                </div>
              </b-collapse>
            </div>
            <div v-else>
              <span>No hay requeriminetos añadidos aún.</span>
            </div>
          </b-col>
        </b-row>
      </b-card-text>
    </b-card>
    <b-btn class="w-100 mt-3" variant="primary" @click="addPermit()">Guardar Nuevo Permiso</b-btn>
  </div>
</template>
<script>
export default {
  data: () => ({
    selectedRequeriment:null,
    permit:{
      name: null,
      departament_id: null,
      type: null,
      status: false,
      requeriments: [],
    },
    departamentOptions:[
      {value:null, text: 'Seleccione una opción', disabled: true},
    ],
    options:[
      {value:null, text: 'Seleccione una opción', disabled: true},
      {value:'export', text: 'Exportación'},
      {value:'import', text: 'Importación'},
      {value:'reexport', text: 'Reexportación'},
    ],
    requeriments:[
      { name: 'Seleccione una opción', short_name: null},
    ]
  }),
  methods: {
    closeAddPermittDialog(){
      this.$emit('closeAddPermittDialog')
    },
    addPermit(){
      this.$emit('addPermit', this.permit)
      // this.closeEditRequerimentDialog()
    },

    addRequeriment(){
      const findedRequeriment = this.requeriments.find(requeriment => requeriment.short_name === this.selectedRequeriment)
      this.permit.requeriments.push(findedRequeriment)
      this.checkRequeriments()
      this.selectedRequeriment = null
    },

    deleteRequeriment(requeriment){
      const index = this.permit.requeriments.findIndex(requerimentA => requerimentA.id == requeriment.id )
      this.permit.requeriments.splice(index, 1)
      this.requeriments.push(requeriment)
    },

    checkRequeriments(){
      let count = 0
      for ( const [index, requerimentToEvaluate] of this.permit.requeriments.entries()) {
        for (const [indice, requeriment] of this.requeriments.entries()) {
          // console.log('Recaudo: '+ requeriment.short_name + ',  Recaudo a Comparar: '+ requerimentToEvaluate.short_name);
          if (requeriment.short_name === requerimentToEvaluate.short_name){
            // console.log("Resultado de array: "+this.requeriments[indice].short_name + ". Array: "+indice)
            this.requeriments.splice(indice,1)
            count ++
            break
          }
        }
      }
    },

    getDepartaments(){
      axios
        .get(`/dashboard/permissions/getDepartaments/`)
        .then(res => {
          for (const departament of res.data) {
            this.departamentOptions.push({value: departament.id, text: departament.name})
          }
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    getRequeriments(){
      axios
        .get(`/dashboard/permissions/getRequeriments/`)
        .then(res => {
          for (const requeriment of res.data) {
            this.requeriments.push(requeriment)
            this.checkRequeriments()
          }
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    }
  },
  mounted() {
    this.getDepartaments()
    this.getRequeriments()
  }
}
</script>