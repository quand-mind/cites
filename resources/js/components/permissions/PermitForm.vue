<template>
  <div>
    <h2>Planilla de Importación o (Re) Exportación de Fauna Silvestre y/o sus Productos</h2>
    <div>
      <b-card
        title="Datos Personales"
        tag="article"
        class="mb-2"
      >
        <b-card-text>
          <b-row class="mb-2">
            <b-col>Número de Telefono</b-col>
            <b-col>Celular o móvil</b-col>
            <b-col>Fax</b-col>
          </b-row>
          <b-row>
            <b-col>
              <b-form-input type="tel" v-model="personals.phone" ></b-form-input>
            </b-col>
            <b-col>
              <b-form-input type="tel" v-model="personals.mobile" ></b-form-input>
            </b-col>
            <b-col>
              <b-form-input type="tel" v-model="personals.fax" ></b-form-input>
            </b-col>
          </b-row>
        </b-card-text>
      </b-card>
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
              <button class="ml-4 btn text-primary" @click="showSelectSpecie = true" style="cursor:pointer">
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
            <b-col v-if="permit_type.id !== 1">País de Destino</b-col>
            <b-col v-if="permit_type.id === 1">País de Procedencia</b-col>
            <b-col>Medio de Transporte</b-col>
            <b-col>Puerto o Aeropuerto de Embarque</b-col>
            <b-col>Puerto o Aeropuerto de Desembarque</b-col>
          </b-row>
          <b-row>
            <b-col>
              <b-form-input v-model="permit.country" ></b-form-input>
            </b-col>
            <b-col>
              <b-form-input v-model="permit.transportation_way" ></b-form-input>
            </b-col>
            <b-col>
              <b-form-input v-model="permit.shipment_port" ></b-form-input>
            </b-col>
            <b-col>
              <b-form-input v-model="permit.landing_port" ></b-form-input>
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
              <b-form-input v-model="permit.purpose" ></b-form-input>
            </b-col>
            <b-col>
              <b-form-input v-model="permit.consigned_to" ></b-form-input>
            </b-col>
            <b-col>
              <b-form-input v-model="permit.departure_place" ></b-form-input>
            </b-col>
            <b-col>
              <b-form-input v-model="permit.destiny_place" ></b-form-input>
            </b-col>
          </b-row>
        </b-card-text>
      </b-card>
      <button class="mt-4 w-100 btn btn-primary" @click="requestPermit()">Enviar Planilla</button>
    </div>
    <b-modal v-model="showSelectSpecie" size="xl" id="species-modal" title="Agregar Especie" hide-footer>
      <AddSpecie
      v-on:addSpecie="addSpecieToList"
      :isNew="true"
      v-on:closeAddSpecieDialog="closeAddSpecieDialog"
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

export default {
  props:['permit_type', 'client_data', 'type'],
  components: {
    SelectedSpeciesList,
    AddSpecie
  },
  data: () => ({
    personals: {
      phone: null,
      mobile: null,
      fax: null
    },
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
  methods:{
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

      axios
        .post(`/solicitante/permissions/list/createPermit`, { permit_type_id: this.permit_type[0].id, personals: JSON.stringify(this.personals), permit: JSON.stringify(this.permit), client_id: this.client_data[0].clients[0].id, species: JSON.stringify(this.selectedSpecies)})
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.assign('/solicitante/permissions'), 1200)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },

    makeToast(msg, variant = "success", delay = 3000, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: 'Planilla',
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    },
  }
}
</script>