<template>
  <div>
    <div class="caja bg-light p-2 my-2">
      <h1 class="ml-4 mb-4">Hoja de Checkeo de Requisitos</h1>
      <h4 class="ml-4 mb-2">Requisitos para: <br> (Permiso de exportación de especies de la fauna silvestre vivas, muertas o de sus productos no incluida en los apéndices de la Convención sobre el Comercio Internacional de Especies Amenazadas de Fauna y Flora Silvestres (CITES) con fines comerciales.)</h4>
      <div class="card card-body">
        <v-client-table :data="requirements" :columns="columns" :options="options">

            <span slot="ver_archivo" slot-scope="props"><a :href="props.row.path" target="_blank"><font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon> Ver archivo</a></span>
        </v-client-table>
        <!-- <ul class="list-group list-group-flush mt-4">
          <li class="list-group-item">
            Planilla de solicitud Exportación de Fauna Silvestre y/o sus productos (disponible en <a href="http://www.minec.gob.ve/" target="blank">minec.gob.ve</a> ).
            <div class="input-group mb-3 mt-3">
              <img v-bind:src="permit.requirements.export_form_file_url" height="400px" alt="">
            </div>
            <div>
              <input type="checkbox" id="CheckExportForm" v-model="permit.requirements.is_valid_export_form">
              <label for="CheckExportForm" class="ml-2">¿Es válido el requerimiento?</label>
            </div>
            <div class="mt-3 mb-3" v-if="!permit.requirements.is_valid_export_form">
              <b-form-textarea
                id="ExportFormErrors"
                v-model="permit.requirements.export_form_errors"
                placeholder="Escriba los errores encontrados en el documento:"
                rows="3"
                max-rows="6"
              ></b-form-textarea>

            </div>
          </li>
          <li class="list-group-item">
            Timbres fiscales por <b>2</b> unidades tributarias.
            <div class="input-group mb-3 mt-3">
              <img v-bind:src="permit.requirements.revenue_stamps_file_url" height="400px" alt="">
            </div>
            <div>
              <input type="checkbox" id="CheckRevenueStamps" v-model="permit.requirements.is_valid_revenue_stamps">
              <label for="CheckRevenueStamps" class="ml-2">¿Es válido el requerimiento?</label>
            </div>
            <div class="mt-3 mb-3" v-if="!permit.requirements.is_valid_revenue_stamps">
              <b-form-textarea
                id="ExportFormErrors"
                v-model="permit.requirements.revenue_stamps_errors"
                placeholder="Escriba los errores encontrados en el documento:"
                rows="3"
                max-rows="6"
              ></b-form-textarea>

            </div>
          </li>
          <li class="list-group-item" v-if="permit.client.checked_dni === false">
            Cédula de identidad.
            <div class="input-group mb-3 mt-3">
              <img v-bind:src="permit.client.dni_file_url" height="400px" alt="">
            </div>
            <div>
              <input type="checkbox" id="CheckDni" v-model="permit.client.is_valid_dni">
              <label for="CheckDni" class="ml-2">¿Es válido el requerimiento?</label>
            </div>
            <div class="mt-3 mb-3" v-if="!permit.client.is_valid_dni">
              <b-form-textarea
                id="ExportFormErrors"
                v-model="permit.client.dni_errors"
                placeholder="Escriba los errores encontrados en el documento:"
                rows="3"
                max-rows="6"
              ></b-form-textarea>

            </div>
          </li>
          <li class="list-group-item" v-if="permit.client.checked_rif === false">
            Registro Único de Información Fiscal RIF.
            <div class="input-group mb-3 mt-3">
              <img v-bind:src="permit.client.rif_file_url" height="400px" alt="">
            </div>
            <div>
              <input type="checkbox" id="CheckRif" v-model="permit.client.is_valid_rif">
              <label for="CheckRif" class="ml-2">¿Es válido el requerimiento?</label>
            </div>
            <div class="mt-3 mb-3" v-if="!permit.client.is_valid_rif">
              <b-form-textarea
                id="ExportFormErrors"
                v-model="permit.client.rif_errors"
                placeholder="Escriba los errores encontrados en el documento:"
                rows="3"
                max-rows="6"
              ></b-form-textarea>

            </div>
          </li>
          <li class="list-group-item" v-if="permit.client.checked_comerce_species_license === false">
            Licencia para ejercer el comercio o industria de animales silvestres vivos, muertos y de sus productos, emitido por el MINEC.
            <div class="input-group mb-3 mt-3">
              <img v-bind:src="permit.client.rif_file_url" height="400px" alt="">
            </div>
            <div>
              <input type="checkbox" id="CheckRif" v-model="permit.client.is_valid_comerce_species_license">
              <label for="CheckRif" class="ml-2">¿Es válido el requerimiento?</label>
            </div>
            <div class="mt-3 mb-3" v-if="!permit.client.is_valid_comerce_species_license">
              <b-form-textarea
                id="ExportFormErrors"
                v-model="permit.client.comerce_species_license_errors"
                placeholder="Escriba los errores encontrados en el documento:"
                rows="3"
                max-rows="6"
              ></b-form-textarea>

            </div>
          </li>
          <li class="list-group-item" v-if="permit.client.checked_zoo_hatcheries_authorization === false">
            Autorización para la instalación y funcionamiento de Zoocriaderos con fines comerciales, emitido por el MINEC.
            <div class="input-group mb-3 mt-3">
              <img v-bind:src="permit.client.rif_file_url" height="400px" alt="">
            </div>
            <div>
              <input type="checkbox" id="CheckRif" v-model="permit.client.is_valid_comerce_species_license">
              <label for="CheckRif" class="ml-2">¿Es válido el requerimiento?</label>
            </div>
            <div class="mt-3 mb-3" v-if="!permit.client.is_valid_comerce_species_license">
              <b-form-textarea
                id="ExportFormErrors"
                v-model="permit.client.comerce_species_license_errors"
                placeholder="Escriba los errores encontrados en el documento:"
                rows="3"
                max-rows="6"
              ></b-form-textarea>

            </div>
          </li>
          <li class="list-group-item">
            Especies
            <div v-for="(item, index) in permit.pivot" class="ml-4" v-bind:key="index">
              <div class="input-group mb-3 mt-3">
                <span>{{item.specie.name}}</span> <span class="ml-5">Cantidad: {{item.specie.qty}}</span>
                <img v-bind:src="item.specie_legal_documents_file_url" height="400px" alt="">
              </div>
              <div>
                <input type="checkbox" :id="'CheckSpecieLegalDocument' + index" v-model="item.is_valid_specie_legal_document">
                <label :for="'CheckSpecieLegalDocument' + index" class="ml-2">¿Es válido el requerimiento?</label>
              </div>
            </div>  
          </li>
        </ul> -->
      </div>
    </div>
  </div>
</template>
<script>
export default {
  tableData: [
      {
        id: 1,
        name: 'Planilla de solicitud Exportación de Fauna Silvestre y/o sus productos (disponible en minec.gob.ve).',
        file_url: null
      },
      {
        id: 2,
        name: 'Timbres fiscales por 2 unidades tributarias.',
        file_url: null
      },
      {
        id: 3,
        name: 'Cédula de identidad.',
        file_url: null
      },
      {
        id: 4,
        name: 'Registro Único de Información Fiscal RIF.',
        file_url: null
      },
      {
        id: 5,
        name: 'Licencia para ejercer el comercio o industria de animales silvestres vivos, muertos y de sus productos, emitido por el MINEC.',
        file_url: null
      },
      {
        id: 6,
        name: 'Autorización para la instalación y funcionamiento de Zoocriaderos con fines comerciales, emitido por el MINEC.',
        file_url: null
      },
      {
        id: 7,
        name: 'Especies',
        file: null
      },
    ],
  data: () => ({
    permit:{
      code: '0918289213',
      requirements:{
        id:1,
        export_form_file_url: '/images/default-user.png',
        is_valid_export_form: false,
        export_form_errors: null,
        revenue_stamps_file_url:'/images/default-user.png',
        is_valid_revenue_stamps: false,
        revenue_stamps_errors: null,
        is_valid_species_legal_documents: false,
        species_legal_documents_errors: null,
      },
      pivot:[
        {
          specie_id: 1,
          permit_id: 1,
          specie_legal_documents_file_url: '/images/default-user.png',
          is_valid_specie_legal_document: false,
          specie:{
            id:1,
            type: 'Animalia',
            name: 'Perro',
            qty: 100,
            search_id: 12,
          }
        },
        {
          specie_id: 2,
          permit_id: 1,
          specie_legal_documents_file_url: '/images/default-user.png',
          is_valid_specie_legal_document: false,
          specie:{
            id:2,
            type: 'Animalia',
            name: 'Gato',
            qty: 200,
            search_id: 123,
          }
        },
      ],
      client_id:1,
      client:{
        email:'client@mail.com',
        dni_file_url: '/images/default-user.png',
        is_valid_dni: false,
        dni_errors: null,
        checked_dni: false,
        rif_file_url: '/images/default-user.png',
        is_valid_rif: false,
        rif_errors: null,
        checked_rif: false,
        comerce_species_license_file_url: '/images/default-user.png',
        is_valid_comerce_species_license: false,
        comerce_species_license_errors: null,
        checked_comerce_species_license: false,
        zoo_hatcheries_authorization_file_url: '/images/default-user.png',
        is_valid_zoo_hatcheries_authorization: false,
        zoo_hatcheries_authorization_errors: null,
        checked_zoo_hatcheries_authorization: false,
        national_register_of_biologic_colections_file_url: '/images/default-user.png',
        is_valid_national_register_of_biologic_colections: false,
        national_register_of_biologic_colections_errors: null,
        checked_national_register_of_biologic_colections: false,
      }
    }
  })
}
</script>