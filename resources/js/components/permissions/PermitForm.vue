<template>
  <div>
    <b-alert v-model="loading" variant="info" class="alertFile d-flex justify-content-between align-items-center">
      <span>Solicitando Permiso...</span> <b-spinner small label="Spinning"></b-spinner>
    </b-alert>
    <b-alert v-model="loadingCountries" variant="info" class="alertFile d-flex justify-content-between align-items-center">
      <span>Obteniendo Países...</span> <b-spinner small label="Spinning"></b-spinner>
    </b-alert>
    <h2 v-if="permit_type.type === 'export'">Planilla de Exportación de Fauna Silvestre y/o sus Productos</h2>
    <h2 v-if="permit_type.type === 'import'">Planilla de Importación de Fauna Silvestre y/o sus Productos</h2>
    <h2 v-if="permit_type.type === 'reexport'">Planilla de Re-Exportación de Fauna Silvestre y/o sus Productos</h2>
    <div>
      <b-card
        title="Especies"
        tag="article"
        class="mb-2"
      >
        <b-card-text>
          <b-row class="mb-2">
            <b-col>Listado de Especies</b-col>
            <b-col>Agregar Especie</b-col>
          </b-row>
          <b-row>
            <b-col>
              <span class="ml-2">Especies Agregadas: {{selectedSpecies.length}}</span>
              <button :disabled="!selectedSpecies.length > 0" class="ml-2 btn text-dark" @click="showSelectedSpecies = true" style="cursor:pointer">
                <font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon>
              </button>
            </b-col>
            <b-col>
              <button :disabled="loadingCountries" class="ml-4 btn text-primary" @click="showSelectSpecie = true" style="cursor:pointer">
                <font-awesome-icon :icon="['fa', 'plus']"></font-awesome-icon>
              </button>
            </b-col>
          </b-row>
        </b-card-text>
      </b-card>
      <b-card
        title="Datos del Permiso"
        tag="article"
        class="mb-2"
      >
        <b-card-text>
          <b-row class="mb-2">
            <b-col v-if="permit_type.type == 'import'">País de Procedencia</b-col>
            <b-col v-if="permit_type.type !== 'import'">País de Destino</b-col>
            <b-col>Medio de Transporte</b-col>
            <b-col>Puerto o Aeropuerto de Embarque</b-col>
            <b-col>Puerto o Aeropuerto de Desembarque</b-col>
          </b-row>
          <b-row>
            <b-col>
              <b-form-select v-model="permit.country" :disabled="loadingCountries" :options='countries' text></b-form-select>
            </b-col>
            <b-col>
              <b-form-input placeholder="Barco" v-model="permit.transportation_way" ></b-form-input>
            </b-col>
            <b-col>
              <b-form-input v-if="permit_type.type == 'import'" placeholder="Aeropuerto de Madrid-Barajas Adolfo Suárez" v-model="permit.shipment_port" ></b-form-input>
              <b-form-input v-if="permit_type.type !== 'import'" placeholder="Aeropuerto Internacional de Maiquetía" v-model="permit.shipment_port" ></b-form-input>
            </b-col>
            <b-col>
              <b-form-input v-if="permit_type.type == 'import'" placeholder="Aeropuerto Internacional de Maiquetía" v-model="permit.landing_port" ></b-form-input>
              <b-form-input v-if="permit_type.type !== 'import'" placeholder="Aeropuerto de Madrid-Barajas Adolfo Suárez" v-model="permit.landing_port" ></b-form-input>
            </b-col>
          </b-row>
          <b-row class="my-2">
            <b-col>Fin del Permiso</b-col>
            <b-col>Consignado a</b-col>
            <b-col>Lugar de Salida</b-col>
            <b-col>Lugar de Destino</b-col>
          </b-row>
          <b-row>
            <b-col>
              <b-form-input v-if="permit_type.type == 'import'"  placeholder="Importación de especies para Zoocriadero" v-model="permit.purpose" ></b-form-input>
              <b-form-input v-if="permit_type.type !== 'import'"  placeholder="Exportación de especies para Zoocriadero" v-model="permit.purpose" ></b-form-input>
            </b-col>
            <b-col>
              <b-form-input placeholder="Pedro Pérez" v-model="permit.consigned_to" ></b-form-input>
            </b-col>
            <b-col>
              <b-form-input placeholder="Zoológico el Pinar" v-model="permit.departure_place" ></b-form-input>
            </b-col>
            <b-col>
              <b-form-input placeholder="Zoo Aquarium de Madrid" v-model="permit.destiny_place" ></b-form-input>
            </b-col>
          </b-row>
        </b-card-text>
      </b-card>
      <button :disabled="!validForm" class="mt-4 w-100 btn btn-primary" @click="requestPermit()">Enviar Planilla</button>
    </div>
    <b-modal v-model="showSelectSpecie" size="xl" id="species-modal" title="Agregar Especie" hide-footer>
      <AddSpecie
      v-on:addSpecie="addSpecieToList"
      :isNew="true"
      v-on:closeAddSpecieDialog="closeAddSpecieDialog"
      :countries="countries"
      :selectedSpecies="selectedSpecies" :showSelectSpecie="showSelectSpecie"
      :type="type"/>
    </b-modal>
    <b-modal v-model="showSelectedSpecies" size="xl" id="species-modal" title="Listado de Especies" hide-footer>
      <SelectedSpeciesList
      v-on:deleteSpecie="deleteSpecie"
      v-on:closeSpecieListDialog="closeSpecieListDialog"
      :selectedSpecies="selectedSpecies" :showSelectedSpecies="showSelectedSpecies"
      :type="type"/>
    </b-modal>
  </div>
</template>
<script>
import SelectedSpeciesList from '../permissions/SelectedSpeciesList.vue';
import AddSpecie from '../permissions/AddSpecie.vue';

import {mapActions, mapGetters} from 'vuex'
import timeout from '../../setTimeout';

export default {
  props:['permit_type', 'client_data', 'type'],
  components: {
    SelectedSpeciesList,
    AddSpecie
  },
  data: () => ({
    timeout: timeout,
    personals: {
      phone: null,
      mobile: null,
      fax: null
    },
    rawCountries: [],
    countries: [{text:'País de origen de la especie', value : null, disabled: true}],
    loading: false,
    loadingCountries: false,
    permit:{
      country:null,
      transportation_way:null,
      shipment_port:null,
      landing_port:null,
      destiny:null,
      purpose:null,
      consigned_to:null,
      destiny_place:null,
      departure_place:null,
    },
    selectedSpecies:[],
    showSelectSpecie:  false,
    showSelectedSpecies: false
  }),
  computed:{
    validForm () {
      const validCountry = Boolean(this.permit.country)
      const validTransport = Boolean(this.permit.transportation_way)
      const validShipment = Boolean(this.permit.shipment_port)
      const validLanding = Boolean(this.permit.landing_port)
      const validPurpose = Boolean(this.permit.purpose)
      const validConsignedTo = Boolean(this.permit.consigned_to)
      const validDestinyPlace = Boolean(this.permit.destiny_place)
      const validDeparturePlace = Boolean(this.permit.departure_place)
      const lengthSpecie = this.selectedSpecies.length
      return validCountry && validTransport && validShipment && validLanding && validPurpose && validConsignedTo && validDestinyPlace && validDeparturePlace && lengthSpecie > 0
    }
  },
  methods:{
    ...mapActions([
      'fetchSpecies',
    ]),
    addSpecieToList(newSpecie){
      this.selectedSpecies.push(newSpecie)
      this.makeToast('Especie Añadida')
      this.closeAddSpecieDialog()
    },

    deleteSpecie(specie, index){
      console.log(specie)
        this.selectedSpecies.splice(index)
        this.makeToast('Especie Eliminada')
        this.closeSpecieListDialog()
    },

    closeAddSpecieDialog(){
      this.showSelectSpecie = false
    },
    
    closeSpecieListDialog(){
      this.showSelectedSpecies = false
    },

    requestPermit(){
      this.loading = true
      axios
        .post(`/solicitante/permissions/list/createPermit`, { permit_type_id: this.permit_type.id, personals: JSON.stringify(this.personals), permit: JSON.stringify(this.permit), client_id: this.client_data.id, species: JSON.stringify(this.selectedSpecies)})
        .then(res => {
          this.makeToast(res.data)
          this.loading = false
          setTimeout(() => window.location.assign('/solicitante/permissions'), timeout)
        })
        .catch(err => {
          this.loading = false
          this.makeToast(err.toString(), 'danger')
        });
    },
    getCountries(){
      this.loadingCountries = true
      axios
        .get(`/solicitante/countries`)
        .then(res => {
          this.rawCountries = res.data.map( country =>  {return { text: country.label, value: {name: country.label, code: country.value}}})
          this.countries = this.countries.concat(this.rawCountries)
          this.loadingCountries = false
        })
        .catch(err => {
          this.loadingCountries = false
          this.makeToast(err.toString(), 'danger')
        });
    },

    makeToast(msg, variant = "success", delay = timeout, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: 'Planilla',
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    },
  },
  mounted() {
    this.getCountries()
  }
}
</script>