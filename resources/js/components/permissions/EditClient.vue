<template>
  <div>
    <b-card
      title="Editar Usuario"
      class="mb-2"
    >
        <b-card-text>
          <div>
            <b-row class="mb-2">
              <b-col>Nombre</b-col>
              <b-col>Nombre de Usuario</b-col>
              <b-col>Cédula</b-col>
              <b-col>Nacionalidad</b-col>
            </b-row>
            <b-row class="mb-2">
              <b-col>
                <b-form-input v-model="client.user.name" placeholder="Nombre"></b-form-input>
              </b-col>
              <b-col>
                <b-form-input v-model="client.username" placeholder="Nombre de Usuario"></b-form-input>
              </b-col>
              <b-col>
                <b-form-input v-model="client.user.dni" placeholder="Cédula"></b-form-input>
              </b-col>
              <b-col>
                <b-form-input v-model="client.user.nationality" placeholder="Nacionalidad"></b-form-input>
              </b-col>
            </b-row>
          </div>

          <div>
            <b-row class="mt-2 mb-2">
              <b-col>Dirección</b-col>
              <b-col>Fax</b-col>
              <b-col>Correo Electrónico</b-col>
              <b-col>Contraseña</b-col>
            </b-row>
            <b-row class="mb-2">
              <b-col>
                <b-form-input v-model="client.user.address" placeholder="Dirección"></b-form-input>
              </b-col>
              <b-col>
                <b-form-input v-model="client.user.fax" placeholder="Fax"></b-form-input>
              </b-col>
              <b-col>
                <b-form-input v-model="client.email" placeholder="Correo Electrónico"></b-form-input>
              </b-col>
              <b-col>
                <!-- <b-button type="button" v-if="!changePassword" @click="changePassword = !changePassword" variant="primary">Cambiar Contraseña</b-button> -->
                <button v-if="!changePassword" @click="changePassword = !changePassword" class="btn btn-primary">Cambiar Contraseña</button>
                <div v-if="changePassword" class="d-flex flex-row ">
                  <b-form-input  v-model="newPassword" placeholder="Contraseña"></b-form-input>
                  <button @click="cancelChange()" class="btn btn-danger">Cancelar</button>
                </div>
              </b-col>
            </b-row>
          </div>
          <div>
            <hr>
            <h5>Archivos</h5>
            <b-row class="mt-2 mb-2">
              <b-col>Copia de Cédula</b-col>
            </b-row>
            <b-row class="mb-2">
              <b-col v-if="client.dni_file_url" cols="2">
                <a :href="`/${client.dni_file_url}`" target="_blank"><font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon> Ver Archivo</a>
              </b-col>
              <b-col cols="4">
                <b-form-file
                v-model="dni"
                placeholder="Archivo pdf de la copia de su cédula"
                max-size="10240"
                accept=".pdf"
                drop-placeholder="Suba el archivo aquí."
              ></b-form-file>
                <!-- <b-form-input v-model="client.user.dni_file_url" placeholder="Dirección"></b-form-input> -->
              </b-col>
            </b-row>
          </div>

          <div>
            <hr>
            <h5>Teléfonos</h5>
            <b-row class="mt-2 mb-2" >
              <b-col v-for="phone of client.user.phones" v-bind:key="phone.id">Télefono {{phone.id}}</b-col>
            </b-row>
            <b-row class="mb-2">
              <b-col v-for="phone of client.user.phones" v-bind:key="phone.id">
                <b-form-input v-model="phone.number" placeholder="Número"></b-form-input>
              </b-col>
            </b-row>
          </div>
          
          <div v-if="client.role !== 'natural'">
            <hr>
            <h5>Institución</h5>
            <b-row class="mt-2 mb-2">
              <b-col>Nombre</b-col>
              <b-col>Correo de la Institución</b-col>
              <b-col>RIF de la Institución</b-col>
              <b-col>Teléfono de la Institución</b-col>
            </b-row>
            <b-row class="mt-2">
              <b-col>
                <b-form-input v-model="client.institution.name" placeholder="Nombre"></b-form-input>
              </b-col>
              <b-col>
                <b-form-input v-model="client.institution.institutional_email" placeholder="Nombre de Usuario"></b-form-input>
              </b-col>
              <b-col>
                <b-form-input v-model="client.institution.rif" placeholder="RIF"></b-form-input>
              </b-col>
              <b-col>
                <b-form-input v-model="client.institution.phones[0].number" placeholder="Cédula"></b-form-input>
              </b-col>
            </b-row>
          </div>

        </b-card-text>
    </b-card>
    <button class="btn btn-primary mt-4" @click="editUser()">Actualizar Datos</button>
    <button class="btn btn-primary mt-4" @click="returnBack()">Regresar a Permisos</button>
  </div>
</template>
<script>
import timeout from '../../setTimeout.js'

export default {
  props: ['client'],
  data: () => ({
    timeout: timeout,
    changePassword: false,
    newPassword: null,
    dni:null
  }),
  methods: {
    editUser () {
      console.log(this.client)
      var form = new FormData()
      form.append("file", this.dni)
      form.append("client", JSON.stringify(this.client));
      axios
        .post(`/solicitante/editUser`, form)
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), timeout)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    returnBack(){
      history.back();
    },
    makeToast(msg, variant = "success", delay = timeout, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: 'Editar Usuario',
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    },
    cancelChange () {
      this.newPassword = null
      this.changePassword = !this.changePassword
    }
  }
}
</script>