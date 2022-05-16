<template>
  <div>
    <div v-if="formalitie.length === 0">
      <h1>Error, el permiso no se ha podido encontrar.</h1>
      <a class="btn btn-primary mt-4 text-white" href="/permissions">Volver al Inicio</a>
    </div>
    <div>
      
      <b-row class=" mb-2 mt-2">
        <b-col md="6"><h1>N° Tramite: {{formalitie.request_formalitie_no}}</h1></b-col>
        <b-col md="6">
          <b-form-input :key="formalitie.sistra" v-model="formalitie.sistra" placeholder="Número Sistra" @change="checkValidRequirements()"></b-form-input>
        </b-col>
        <div></div>
      </b-row>
      <h4 class="ml-4 mb-4">Hoja de Chequeo de Requisitos</h4>
      <div class="card" v-for="(permit, index) of formalitie.permits" :key="index">
        <h3 class="ml-4 mt-3">Permiso N° {{permit.request_permit_no}}</h3>
        <div class="ml-5 mr-5 mb-4">
          <hr>
          <b-row>
            <b-col>
              <b-form-input :key="permit.stamp_number" v-model="permit.stamp_number" placeholder="Número De Timbre Fiscal" @change="checkValidRequirements()"></b-form-input>
            </b-col>
          </b-row>
          <b-row class=" mb-2 mt-2">
            <b-col md="6">Cliente: <span class="ml-2">{{formalitie.client.user.name}}</span></b-col>
            <b-col md="6">Nacionalidad: <span class="ml-2">{{formalitie.client.user.nationality}}</span></b-col>
          </b-row>  
          <b-row class=" mb-2 mt-2">
            <b-col md="6">Email: <span class="ml-2">{{formalitie.client.email}}</span></b-col>
            <b-col md="6">DNI: <span class="ml-2">{{formalitie.client.user.dni}}</span></b-col>
          </b-row>
          <hr>
          <b-row class=" mb-2 mt-2">
            <b-col md="6">Lugar de Envio: <span class="ml-2">{{permit.destiny_place}}</span></b-col>
            <b-col md="6">Lugar de Llegada: <span class="ml-2">{{permit.departure_place}}</span></b-col>
          </b-row>
          <b-row class="mb-2 mt-2">
            <b-col md="6">Puerto de Salida: <span class="ml-2">{{permit.shipment_port}}</span></b-col>
            <b-col md="6">Puerto de Llegada: <span class="ml-2">{{permit.landing_port}}</span></b-col>
          </b-row>
          <b-row class="mb-2 mt-2">
            <b-col md="6">Consignado a: <span class="ml-2">{{permit.consigned_to}}</span></b-col>
            <b-col md="6">Medio de Transporte: <span class="ml-2">{{permit.transportation_way}}</span></b-col>
          </b-row>
          <b-row class="mb-2 mt-2">
            <b-col v-if="permit.permit_type_id === 2" md="6">País De Envío: <span class="ml-2">{{permit.country}}</span></b-col>
            <b-col v-if="permit.permit_type_id !== 2" md="6">País Destino: <span class="ml-2">{{permit.country}}</span></b-col>
            <b-col md="3">Propósito: <span class="ml-2">{{permit.purpose}}</span></b-col>
          </b-row>
          <hr>
        </div>
        <h4 class="ml-4 mb-4">Requisitos para: <br> ({{permit.permit_type.name}})</h4>
        <div class="m-4 card card-body">
          <div class="d-flex justify-content-center align-items-center flex-column">
            <b-row class="w-100 header d-flex justify-content-between align-items-center flex-row">
              <b-col lg="3" class="d-flex justify-content-center align-items-center" v-for="(column,index) of columns" v-bind:key="index">
                <b>{{column}}</b>
              </b-col>
            </b-row>
            <div class="w-100 body justify-content-center align-items-center flex-column">
              <b-row class="w-100 d-flex justify-content-between align-items-center flex-row" v-for="(requeriment,index) of permit.requeriments" v-bind:key="index">
                <b-col lg="3" class="my-4">{{requeriment.name}}</b-col>
                <b-col v-if="requeriment.type !== 'form' && requeriment.type !== 'physical'" lg="3" class="d-flex justify-content-center align-items-center">
                  <div v-if="!requeriment.pivot.file_url">
                    <font-awesome-icon :icon="['fa', 'ban']"></font-awesome-icon> No hay un archivo subido
                  </div>
                  <div v-else>
                    <a :href="`/${requeriment.pivot.file_url}`" target="_blank"><font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon> Ver Archivo</a>
                  </div>
                </b-col>
                <b-col v-else-if="requeriment.type === 'form'" lg="3" class="d-flex justify-content-center align-items-center">
                  <div>
                    <font-awesome-icon :icon="['fa', 'check']"></font-awesome-icon> Completado
                  </div>                
                </b-col>
                <b-col v-else-if="requeriment.type === 'physical'" lg="3" class="d-flex justify-content-center align-items-center">
                  <div>
                    Solo físico
                  </div>                
                </b-col>
                
                <b-col lg="3" class="d-flex justify-content-center align-items-center">
                  <div
                    class="d-flex justify-content-center align-items-center mr-4"
                    v-if="requeriment.short_name === 'documentos_especies'"
                  >
                    <button :disabled="!permit.species.length > 0" class="btn text-dark" @click="showSelectedSpecies = true" style="cursor:pointer">
                      <font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon>
                    </button>
                  </div>
                  <div class="d-flex justify-content-center align-items-center flex-row" >
                    <b-form-checkbox class="mr-2" v-model="requeriment.pivot.is_valid" :key="requeriment.pivot.is_valid" :value="1" @input="changeValid(requeriment, permit, index)"
                      :unchecked-value="0" name="check-button" button button-variant="success" :disabled="Boolean(requeriment.pivot.is_valid)">
                      <font-awesome-icon :icon="['fa', 'check']"></font-awesome-icon>
                    </b-form-checkbox>

                    <b-form-checkbox v-model="requeriment.pivot.is_valid" :key="!requeriment.pivot.is_valid" :value="0" @input="changeValid(requeriment, permit, index)"
                      :unchecked-value="1" name="check-button" button button-variant="danger" :disabled="!requeriment.pivot.is_valid">
                      <font-awesome-icon :icon="['fa', 'times']"></font-awesome-icon>
                    </b-form-checkbox>
                    
                  </div>
                </b-col>
              </b-row>
            </div>  
          </div>
        </div>
        <b-modal v-model="showSelectedSpecies" size="xl" id="species-modal" title="Listado de Especies" hide-footer>
          <SelectedSpecies
          v-on:deleteFile="deleteFile"
          v-on:closeSpecieListDialog="closeSpecieListDialog"
          :selectedSpecies="permit.species" :showSelectedSpecies="showSelectedSpecies"
          :type="type"/>
        </b-modal>
        <b-modal v-model="showObservations" size="xl" id="species-modal" title="Confirmar Errores en el Permiso" hide-footer>
          <span >Coloque la razón/es de los problemas del permiso</span>
          <b-form-textarea
          class="mt-3"
          v-model="formalitie.observations"
          placeholder="Errores:"
          rows="3"
          @change="updateValue()"
          :key="formalitie.observations"
          max-rows="6"
        ></b-form-textarea>
        <button class="mt-4 w-100 btn btn-danger" :key="!isValid" :disabled="!formalitie.observations" @click="sendErrors()">Enviar Errores</button>
        </b-modal>
      </div>
        <button class="mt-4 w-100 btn btn-primary" :key="isValid" :disabled="!isValid" @click="validPermit()">Validar Trámite</button>
        <button class="mt-4 w-100 btn btn-danger" :key="!isValid" :disabled="isValid" @click="showObservations = true">Problemas con los Recaudos</button>
    </div>
  </div>
</template>
<script>

import timeout from '../../../setTimeout.js'
import SelectedSpecies from '../permissions/SelectedSpecies.vue';
export default {
  props: ['formalitie','type', 'official'],
  components: {
    SelectedSpecies
  },
  data: () => ({
    timeout: timeout,
    columns: [
      "Recaudo",
      "Archivo",
      "Validación"
    ],
    isValid: false,
    count: 0,
    length: 0,
    fileUpload: null,
    options: {
      perPage: 10,
      perPageValues: [10, 20, 50]
    },
    file: null,
    is_valid_dni: true,
    is_valid_rif: false,
    is_valid_zoo_hatcheries_authorization: false,
    is_valid_comerce_species_license: false,

    errorId: null,
    showErrors: false,
    showObservations: false,
    showSelectSpecie: false,
    showSelectedSpecies: false,

    families:[],

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
  methods: {
    updateValue(){
        this.$forceUpdate();
    },
    checkValidRequirements(){
      this.count = 0 
      this.length = 0
      for (const permit of this.formalitie.permits) {
        for (const requeriment of permit.requeriments) {
          this.length++
          if (requeriment.pivot.is_valid){
            this.count++
            this.$forceUpdate();
          }
        }
        this.length++
        if (permit.stamp_number){
          this.count++
          this.$forceUpdate();
        }
      }
      if (this.length === this.count) {
        if (this.formalitie.sistra) {
          this.isValid = true
          this.$forceUpdate();
        } else {
          this.isValid = false
          this.$forceUpdate();
        }
        // return count
      }
      else{
        // return count
        this.isValid = false
        this.$forceUpdate();
      }
    },
    uploadFile (file, requeriment, index) {

      var form = new FormData()
      form.append("file", file)
      form.append("requeriment", JSON.stringify(requeriment));
      form.append("type", JSON.stringify('personal'));

      axios
        .post(`/dashboard/permissions/uploadFile/`, form, {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        })
        .then(res => {
          console.log(res.data)
          this.makeToast('Archivo Guardado')
          requeriment.pivot.file_url = res.data
          setTimeout(() => window.location.reload(), timeout)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    changeValid(requeriment, permit, index){
      this.$forceUpdate();
      this.checkValidRequirements()
      axios
        .post(`/dashboard/permissions/check/`+permit.id, {requeriment: JSON.stringify(requeriment), permit: permit, index: index})
        .then(res => {
          this.makeToast(res.data)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    validPermit(){
      console.log(this.formalitie.sistra)
      axios
        .post(`/dashboard/permissions/validPermit/`+ this.formalitie.id, {official_id: this.official.id, sistra: this.formalitie.sistra, permits: JSON.stringify(this.formalitie.permits)})
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.assign('/dashboard/permissions/'), timeout)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    sendErrors(){
      axios
        .post(`/dashboard/permissions/sendErrors/`+ this.formalitie.id, {official_id: this.official.id, observations: this.formalitie.observations, sistra: this.formalitie.sistra, permits: JSON.stringify(this.formalitie.permits)})
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.assign('/dashboard/permissions/'), timeout)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    closeSpecieListDialog(){
      this.showSelectedSpecies = false
    },
    deleteFile(file){
      console.log(file)
    },
    makeToast(msg, variant = "success", delay = timeout, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: 'Validación de Recaudos',
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    },
    addSpecieToList(newSpecie){
      console.log(newSpecie)
      this.selectedSpecies.push(newSpecie)
    },
  },
  mounted() {
    this.checkValidRequirements()
  }
}
</script>