<template>
  <div>
    <div class="caja bg-light p-2 my-2">
      <h1>Permisos</h1>
      <h4 class="ml-4">Realice la solicitud para la aprobación de permisos MINEC.</h4>


      <ul class="list-group mt-4">
        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
           Permiso de exportación de especies de la fauna silvestre vivas, muertas o de sus productos no incluida en los apéndices de la Convención sobre el Comercio Internacional de Especies Amenazadas de Fauna y Flora Silvestres (CITES) con fines comerciales
          <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseComercialExports" aria-expanded="false" aria-controls="collapseComercialExports">
            Recaudos
          </button>
        </li>
        <div class="collapse" id="collapseComercialExports">
          <div class="card card-body">
            <div class="d-flex">
              <h6>Lista de Recaudos:</h6>
            </div>
            <ul class=" mt-4">
              <li class="">Planilla de solicitud Exportación de Fauna Silvestre y/o sus productos (disponible en <a href="http://www.minec.gob.ve/" target="blank">minec.gob.ve</a> ).</li>
              <li class="">Timbres fiscales por <b>2</b> unidades tributarias.</li>
              <li class="" v-if="!is_valid_dni">Cédula de identidad.</li>
              <li class="" v-if="!is_valid_rif">Registro Único de Información Fiscal RIF.</li>
              <li class="">Documentos demostrativos de la legalidad de la procedencia de los animales silvestres y/o de sus productos, dependiendo del caso, seleccionar uno o varios si aplican.
                <ul>
                  <li>Permiso de Importación emitido por el MINEC.</li>
                  <li>Factura de compra venta de los animales y/o productos a exportar, con fines mercantiles.</li>
                  <li>Documento(s) de traspaso notariado.</li>
                  <li>Guía(s) de Movilización (es) de canje y guía(s) de movilización canjeada(s), para pieles de la especie silvestre Hydrochoerus hydrochaeris (Chigüire) y otras especies silvestres con aprovechamientos comerciales similares.</li>
                  <li>Permiso para curtir pieles de la especie silvestre Hydrochoerus hydrochaeris (Chigüire) y otras especies silvestres con aprovechamientos comerciales similares.</li>
                  <li>Guía(s) de Movilización (es) de canje y guía(s) de movilización canjeada(s), para productos de especies silvestres distintas a las anteriores, con aprovechamientos comerciales diferentes.</li>
                  <li>Actas de inspección de animales silvestres y/o sus productos a exportar.</li>
                  <li>Informe(s) parcial(es) o total(es) de inspección(es) y/o de inventario(s) de los productos almacenados.</li>
                  <li>Informe(s) más reciente de inspección(es) y/o de inventario(s) de los animales por cada especie silvestre cautiva en el zoocriadero.</li>
                </ul>
              </li>
              <li class="" v-if="!is_valid_comerce_species_license">Licencia para ejercer el comercio o industria de animales silvestres vivos, muertos y de sus productos, emitido por el MINEC.</li>
              <li class="" v-if="!is_valid_zoo_hatcheries_authorization">Permiso para la instalación y funcionamiento de Zoocriaderos con fines comerciales, emitido por el MINEC.</li>
            </ul>
            <div class="w-100 d-flex justify-content-end align-items-center">
             <button v-if="!showPurpose" class="btn btn-primary" @click="openPurposeData('comercial_export')">Solicitar Permiso</button>
            </div>
            <div class="mt-3 d-flex flex-row justify-content-between" v-if="showPurpose && permit_type === 'comercial_export'">
              <b-form-input v-model="purpose" placeholder="Propósito del Permiso:"></b-form-input>
              <div>
                <button class="btn btn-danger" @click="showPurpose = false">Cancelar</button>
                <button class="btn btn-primary" @click="requestAuthorization()">Solicitar Permiso</button>
              </div>
            </div>
          </div>

        </div>

        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
           Permiso de importación de especies de la fauna silvestre vivas, muertas o de sus productos con fines comerciales
          <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseComercialImport" aria-expanded="false" aria-controls="collapseComercialImport">
            Recaudos
          </button>
        </li>
        <div class="collapse" id="collapseComercialImport">
          <div class="card card-body">
            <div class="d-flex">
              <h6>Lista de Recaudos:</h6>
            </div>
            <ul class=" mt-4">
              <li class="">Planilla de solicitud de Importación de Fauna Silvestre y/o sus productos (disponible en <a href="http://www.minec.gob.ve/" target="blank">minec.gob.ve</a> ).</li>
              <li class="">Timbres fiscales por <b>2</b> unidades tributarias.</li>
              <li class="" v-if="!is_valid_dni">Cédula de identidad.</li>
              <li class="" v-if="!is_valid_rif">Registro Único de Información Fiscal RIF.</li>
              <li class="">Documentos demostrativos de la legalidad de la procedencia de los animales silvestres y/o de sus productos, dependiendo del caso, seleccionar uno o varios si aplican.
                <ul>
                  <li>Permiso de Importación emitido por el MINEC.</li>
                  <li>Factura de compra venta de los animales y/o productos a exportar, con fines mercantiles.</li>
                  <li>Documento(s) de traspaso notariado.</li>
                  <li>Guía(s) de Movilización (es) de canje y guía(s) de movilización canjeada(s), para pieles de la especie silvestre Hydrochoerus hydrochaeris (Chigüire) y otras especies silvestres con aprovechamientos comerciales similares.</li>
                  <li>Permiso para curtir pieles de la especie silvestre Hydrochoerus hydrochaeris (Chigüire) y otras especies silvestres con aprovechamientos comerciales similares.</li>
                  <li>Guía(s) de Movilización (es) de canje y guía(s) de movilización canjeada(s), para productos de especies silvestres distintas a las anteriores, con aprovechamientos comerciales diferentes.</li>
                  <li>Actas de inspección de animales silvestres y/o sus productos a exportar.</li>
                  <li>Informe(s) parcial(es) o total(es) de inspección(es) y/o de inventario(s) de los productos almacenados.</li>
                  <li>Informe(s) más reciente de inspección(es) y/o de inventario(s) de los animales por cada especie silvestre cautiva en el zoocriadero.</li>
                </ul>
              </li>
              <li class="" v-if="!is_valid_zoo_hatcheries_authorization">Permiso para la instalación y funcionamiento de Zoocriaderos con fines comerciales, emitido por el MINEC.</li>
              <li class="" v-if="!is_valid_comerce_species_license">Licencia para ejercer el comercio o industria de animales silvestres vivos, muertos y de sus productos, emitido por el MINEC.</li>
              <li class="">Permiso para Introducir la Especie Silvestre Exótica  emitida por el MINEC, aplica para el animal vivo de cada especie exótica a importar.</li>
            </ul>
            <div class="w-100 d-flex justify-content-end align-items-center">
              <button v-if="!showPurpose" class="btn btn-primary" @click="openPurposeData('comercial_import')">Solicitar Permiso</button>
            </div>
            <div class="mt-3 d-flex flex-row justify-content-between" v-if="showPurpose && permit_type === 'comercial_import'">
              <b-form-input v-model="purpose" placeholder="Propósito del Permiso:"></b-form-input>
              <div>
                <button  class="btn btn-danger" @click="showPurpose = false">Cancelar</button>
                <button  class="btn btn-primary" @click="requestAuthorization()">Solicitar Permiso</button>
              </div>
            </div>
          </div>
        </div>

        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
           Certificado de reexportación de especies de la fauna silvestre vivas, muertas o de sus productos no incluidas en los apéndices de la Convención sobre el Comercio Internacional de Especies Amenazadas de Fauna y Flora Silvestres (CITES) con fines comerciales
          <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseComercialReexport" aria-expanded="false" aria-controls="collapseComercialReexport">
            Recaudos
          </button>
        </li>
        <div class="collapse" id="collapseComercialReexport">
          <div class="card card-body">
            <div class="d-flex">
              <h6>Lista de Recaudos:</h6>
            </div>
            <ul class=" mt-4">
              <li class="">Planilla de solicitud de Importación de Fauna Silvestre y/o sus productos (disponible en <a href="http://www.minec.gob.ve/" target="blank">minec.gob.ve</a> ).</li>
              <li class="">Timbres fiscales por <b>2</b> unidades tributarias.</li>
              <li class="" v-if="!is_valid_dni">Cédula de identidad.</li>
              <li class="" v-if="!is_valid_rif">Registro Único de Información Fiscal RIF.</li>
              <li class="" v-if="!is_valid_zoo_hatcheries_authorization">Permiso para la instalación y funcionamiento de Zoocriaderos con fines comerciales, emitido por el MINEC.</li>
              <li class="" v-if="!is_valid_comerce_species_license">Licencia para ejercer el comercio o industria de animales silvestres vivos, muertos y de sus productos, emitido por el MINEC.</li>
              <li class="">Documentos demostrativos de la legalidad de la procedencia de los animales silvestres y/o de sus productos, dependiendo del caso, seleccionar uno o varios si aplican.
                <ul>
                  <li>Permiso de Importación emitido por el MINEC.</li>
                  <li>Factura de compra venta de los animales y/o productos a exportar, con fines mercantiles.</li>
                  <li>Documento(s) de traspaso notariado.</li>
                  <li>Guía(s) de Movilización (es) de canje y guía(s) de movilización canjeada(s), para pieles de la especie silvestre Hydrochoerus hydrochaeris (Chigüire) y otras especies silvestres con aprovechamientos comerciales similares.</li>
                  <li>Permiso para curtir pieles de la especie silvestre Hydrochoerus hydrochaeris (Chigüire) y otras especies silvestres con aprovechamientos comerciales similares.</li>
                  <li>Guía(s) de Movilización (es) de canje y guía(s) de movilización canjeada(s), para productos de especies silvestres distintas a las anteriores, con aprovechamientos comerciales diferentes.</li>
                  <li>Actas de inspección de animales silvestres y/o sus productos a exportar.</li>
                  <li>Informe(s) parcial(es) o total(es) de inspección(es) y/o de inventario(s) de los productos almacenados.</li>
                  <li>Informe(s) más reciente de inspección(es) y/o de inventario(s) de los animales por cada especie silvestre cautiva en el zoocriadero.</li>
                </ul>
              </li>
            </ul>
            <div class="w-100 d-flex justify-content-end align-items-center">
              <button v-if="!showPurpose" class="btn btn-primary" @click="openPurposeData('comercial_reexport')">Solicitar Permiso</button>
            </div>
            <div class="mt-3 d-flex flex-row justify-content-between" v-if="showPurpose && permit_type === 'comercial_reexport'">
              <b-form-input v-model="purpose" placeholder="Propósito del Permiso:"></b-form-input>
              <div>
                <button  class="btn btn-danger" @click="showPurpose = false">Cancelar</button>
                <button  class="btn btn-primary" @click="requestAuthorization()">Solicitar Permiso</button>
              </div>
            </div>
          </div>
        </div>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import moment from "moment";

export default {
  data: () => ({
    is_valid_dni: false,
    is_valid_rif: false,
    is_valid_zoo_hatcheries_authorization: false,
    is_valid_comerce_species_license: false,
    permit_type: null,
    showPurpose: false,
    purpose: null,
    client_id:1,
  }),
  methods: {
    openPurposeData(type){
      this.permit_type = type
      this.showPurpose = true
    },
    requestAuthorization(){

      axios
        .post(`/permissions/list/createComercialExportSpecies`, {type: this.permit_type, purpose: this.purpose, client_id: this.client_id})
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), 1200)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    showCreateModal() {
      this.$refs["create-modal"].show();
      this.form = {
        word: "",
        description: "",
      };
    },
    hideCreateModal() {
      this.$refs["create-modal"].hide();
    },
    showEditModal(row) {
      this.$refs["edit-modal"].show();
      this.selectedWord = row;
      this.form = {
        word: this.selectedWord.word,
        description: this.selectedWord.description,
      };
    },
    hideEditModal() {
      this.$refs["edit-modal"].hide();
    },
    onSubmit() {
      axios
        .post(`/dashboard/glosary`, {...this.form})
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), 300)
        })
        .catch(err => {
          console.log(err)
          this.makeToast(err.toString(), 'danger')
        });
    },
    onReset() {},
    onSubmitEdit() {

      axios
        .post(`/dashboard/glosary/edit/${this.selectedWord.id}`, this.form)
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), 300)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    deleteWord (row) {
      let _this = this

      axios
        .delete(`/dashboard/glosary/${row.id}`)
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), 300)
        })
        .catch(err => {
          _this.makeToast(err.response.data, 'danger')
        })
    },
    onResetEdit() {},
    makeToast(msg, variant = "success", delay = 3000, append = false) {
      // Create a new toast
      this.$bvToast.toast(`${msg}`, {
        title: "Actualización de la palabra",
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    }
  },
  mounted() {
  }
};
</script>

<style scoped lang="scss">
// Table styles

// hide default filter
input {
  width: 400px;
}
</style>