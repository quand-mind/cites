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

          <button class="btn btn-primary mt-4" @click="editUser()">Actualizar Datos</button>
        </b-card-text>
    </b-card>
  </div>
</template>
<script>
export default {
  props: ['client'],
  data: () => ({
    changePassword: false,
    newPassword: null,
  }),
  methods: {
    editUser () {
      console.log(this.client)
      axios
        .post(`/solicitante/editUser`, { client: JSON.stringify(this.client)})
        .then(res => {
          this.makeToast(res.data)
          // setTimeout(() => window.location.reload(), 1200)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    makeToast(msg, variant = "success", delay = 3000, append = false) {
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