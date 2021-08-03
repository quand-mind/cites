<template>
  <div>
    <div class="caja bg-light p-2 my-2">
      <h3 class="ml-4 mb-4">Permiso de exportación de especies de la fauna silvestre vivas, muertas o de sus productos no incluida en los apéndices de la Convención sobre el Comercio Internacional de Especies Amenazadas de Fauna y Flora Silvestres (CITES) con fines comerciales.</h3>
      <h4 class="ml-4 mb-2">Requisitos:</h4>
      <ul class="list-group mt-4">
        <div class="card card-body">
          <ul class="list-group list-group-flush mt-4">
            <li class="list-group-item">
              Planilla de solicitud Exportación de Fauna Silvestre y/o sus productos (disponible en <a href="http://www.minec.gob.ve/" target="blank">minec.gob.ve</a> ).
              <div class="input-group mb-3 mt-3">
                <b-form-file
                  accept=".pdf, .jpg, .png"
                  v-model="export_form_file"
                  placeholder="Sube el archivo (Formatos aceptados: .pdf, .jpg, .png)"
                  drop-placeholder="Subir archivo aquí..."
                  max-size="2048"
                ></b-form-file>
              </div>
            </li>
            <li class="list-group-item">
              Timbres fiscales por <b>2</b> unidades tributarias.
              <div class="input-group mb-3 mt-3">
                <b-form-file
                  accept=".pdf, .jpg, .png"
                  v-model="revenue_stamps_file"
                  placeholder="Sube el archivo (Formatos aceptados: .pdf, .jpg, .png)"
                  drop-placeholder="Subir archivo aquí..."
                  max-size="2048"
                ></b-form-file>
              </div>
            </li>
            <li class="list-group-item" v-if="!is_valid_dni">
              Cédula de identidad.
              <div class="input-group mb-3 mt-3">
                <b-form-file
                  accept=".pdf, .jpg, .png"
                  v-model="dni_file"
                  placeholder="Sube el archivo (Formatos aceptados: .pdf, .jpg, .png)"
                  drop-placeholder="Subir archivo aquí..."
                  max-size="2048"
                ></b-form-file>
              </div>
            </li>
            <li class="list-group-item" v-if="!is_valid_rif">
              Registro Único de Información Fiscal RIF.
              <div class="input-group mb-3 mt-3">
                <b-form-file
                  accept=".pdf, .jpg, .png"
                  v-model="rif_file"
                  placeholder="Sube el archivo (Formatos aceptados: .pdf, .jpg, .png)"
                  drop-placeholder="Subir archivo aquí..."
                  max-size="2048"
                ></b-form-file>
              </div>
            </li>
            <li class="list-group-item" v-if="!is_valid_comerce_species_license">
              Licencia para ejercer el comercio o industria de animales silvestres vivos, muertos y de sus productos, emitido por el MINEC.
              <div class="input-group mb-3 mt-3">
                <b-form-file
                  accept=".pdf, .jpg, .png"
                  v-model="comerce_species_license_file"
                  placeholder="Sube el archivo (Formatos aceptados: .pdf, .jpg, .png)"
                  drop-placeholder="Subir archivo aquí..."
                  max-size="2048"
                ></b-form-file>
              </div>
            </li>
            <li class="list-group-item" v-if="!is_valid_zoo_hatcheries_authorization">
              Autorización para la instalación y funcionamiento de Zoocriaderos con fines comerciales, emitido por el MINEC.
              <div class="input-group mb-3 mt-3">
                <b-form-file
                  accept=".pdf, .jpg, .png"
                  v-model="zoo_hatcheries_authorization_file"
                  placeholder="Sube el archivo (Formatos aceptados: .pdf, .jpg, .png)"
                  drop-placeholder="Subir archivo aquí..."
                  max-size="2048"
                ></b-form-file>
              </div>
            </li>
          </ul>
          <li class="list-group-item">
              Documentos demostrativos de la legalidad de la procedencia de los animales silvestres y/o de sus productos.
              <div class="input-group mb-3 mt-3">
                <b-form-file
                  accept=".pdf, .jpg, .png"
                  v-model="species_legal_documents_file"
                  placeholder="Sube el archivo (Formatos aceptados: .pdf, .jpg, .png)"
                  drop-placeholder="Subir archivo aquí..."
                  max-size="2048"
                ></b-form-file>
              </div>
            </li>
          <div class="w-100 d-flex justify-content-end align-items-center">
            <button class="btn btn-primary">Enviar Recaudos para su revisión</button>
          </div>
        </div>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  props: ["species"],
  data: () => ({
    is_valid_dni: false,
    is_valid_rif: false,
    is_valid_zoo_hatcheries_authorization: false,
    is_valid_comerce_species_license: false,
    export_form_file: null,
    revenue_stamps_file: null,
    dni_file: null,
    rif_file: null,
    species_legal_documents_file: null,
    comerce_species_license_file: null,
    zoo_hatcheries_authorization_file: null,
    selectedSpecies:[
      {}
    ]
  }),
  computed : {
    exportFormInputValue(){
      this.getFileName()
    } 
  }, methods: {
    getFileName(){
      const element = document.getElementById('exportForm')
      console.log(element)
      return element
    }
  }
}
</script>