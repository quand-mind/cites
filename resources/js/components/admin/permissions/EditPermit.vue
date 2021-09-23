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
            <b-form-select v-model="permit.departament.id"
            :options="departamentOptions">
            </b-form-select>
          </b-col>
        </b-row>
        <b-row class="mt-4 mb-2">
          <b-col cols="4">Tipo de Permso:</b-col>
        </b-row>
        <b-row>
          <b-col cols="4">
            <b-form-select v-model="permit.type"
              :options="options"></b-form-select>
          </b-col>
        </b-row>
      </b-card-text>
    </b-card>
    <b-card>
      <b-card-text>
        <b-row class="mt-4 mb-2">
          <b-col cols="4">Requerimientos:</b-col>
        </b-row>
        <b-row class="mt-4 mb-2">
          <b-col cols="6">Añadir Requerimiento</b-col>
          <b-col cols="6">Listado de Requerimientos</b-col>
        </b-row>
        <b-row>
          <b-col cols="4">
            <b-form-select v-model="selectedRequeriment"
              :options="requeriments"></b-form-select>
          </b-col>
          <b-col cols="2">
            <b-button :disabled="!selectedRequeriment" @click="addRequeriment()">Agregar</b-button>
          </b-col>
          <b-col cols="6">
            <div v-if="permit.requeriments.length > 0">
              <b-button v-b-toggle.requeriments-list class="m-1 w-100">Ver Requerimientos</b-button>
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
    <b-btn class="w-100 mt-3" variant="primary" @click="editPermit()">Actualizar Permiso</b-btn>
  </div>
</template>
<script>
export default {
  props:['permit'],
  data: () => ({
    selectedRequeriment:null,
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
      {value:null, text: 'Seleccione una opción', disabled: true},
    ]
  }),
  methods: {
    closeEditPermittDialog(){
      this.$emit('closeEditPermittDialog')
    },
    editPermit(){
      this.$emit('editPermit', this.permit)
      this.closeEditRequerimentDialog()
    },

    addRequeriment(){
      this.permit.requeriments.push(this.selectedRequeriment)
      // console.log(this.permit.requeriments)
      this.checkRequeriments()
      this.selectedRequeriment = null
    },

    deleteRequeriment(requeriment){
      const index = this.permit.requeriments.findIndex(requerimentA => requerimentA.value.id == requeriment.id )
      this.permit.requeriments.splice(index, 1)
      this.requeriments.push({value: requeriment, text: requeriment.name})
    },

    checkRequeriments(){
      // console.log(this.permit.requeriments)
      // console.log(this.requeriments)
      for (const requeriment of this.requeriments) {
        if (requeriment.value){
          const index = this.permit.requeriments.findIndex(requerimentPermit => requerimentPermit.id === requeriment.value.id)
          if (index){
            // console.log(this.requeriments[1].value.id)
            // console.log(requeriment.id)
            console.log(index)
            this.requeriments.splice(index,1)
          }
        }
        // console.log(this.requeriments)
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
            this.requeriments.push({value: requeriment, text: requeriment.name}) 
          }
          this.checkRequeriments()
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