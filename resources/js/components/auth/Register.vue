<template>
  <div class="">
    <form method="POST" enctype="multipart/form-data" action="/solicitante/registerClient" aria-label="Register">

      <div class="form-group row">
          <label for="name" class="col-md-4 col-form-label text-md-right">Nombre*</label>

          <div class="col-md-6">
            <input placeholder="Alejandro Pérez" id="name" type="text" class="form-control" name="name" v-model="name" required autofocus>

              <span v-if="errors" class="invalid-feedback" role="alert">
                  <strong>{{errors.name}}</strong>
              </span>
          </div>
      </div>

      <div class="form-group row">
          <label for="email" class="col-md-4 col-form-label text-md-right">Correo Electrónico*</label>

          <div class="col-md-6">
            <input placeholder="ejemplo@mail.com" id="email" type="email" class="form-control" name="email" v-model="email" required autofocus>

              <span v-if="errors" class="invalid-feedback" role="alert">
                  <strong>{{errors.email}}</strong>
              </span>
          </div>
      </div>

      <div class="form-group row">
          <label for="username" class="col-md-4 col-form-label text-md-right">Nombre de Usuario*</label>

          <div class="col-md-6">
            <input placeholder="alejandro22" id="username" type="text" class="form-control" name="username" v-model="username" required autofocus>

              <span v-if="errors" class="invalid-feedback" role="alert">
                  <strong>{{errors.username}}</strong>
              </span>
          </div>
      </div>

      <div class="form-group row">
          <label for="dni" class="col-md-4 col-form-label text-md-right">Cédula*</label>

          <div class="col-md-6">
            <input placeholder="V-XXXXXXXX" id="dni" type="text" class="form-control" name="dni" v-model="dni" required autofocus>

              <span v-if="errors" class="invalid-feedback" role="alert">
                  <strong>{{errors.dni}}</strong>
              </span>
          </div>
      </div>

      <div class="form-group row">
          <label for="nationality" class="col-md-4 col-form-label text-md-right">Nacionalidad (País)*</label>

          <div class="col-md-6">
            <select id="nationality" class="form-control" v-model="nationality" name="nationality" required>
              <option :value="null" disabled selected>Seleccione el País</option>
              <option v-for="country of countries" :key="country.label" :value="country.label">{{country.label}}</option>
            </select>
          </div>
      </div>

      <div class="form-group row">
          <label for="address" class="col-md-4 col-form-label text-md-right">Dirección*</label>

          <div class="col-md-6">
            <textarea id="address" placeholder="Av. Sucre, Agua Salud" class="form-control" name="address" style="height:80px;" cols="10" rows="10" v-model="address" required autofocus></textarea>

              <span v-if="errors" class="invalid-feedback" role="alert">
                  <strong>{{errors.address}}</strong>
              </span>
          </div>
      </div>
      
      <div class="form-group row">
          <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña*</label>

          <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password" v-model="password" required autofocus>

              <span v-if="errors" class="invalid-feedback" role="alert">
                  <strong>{{errors.password}}</strong>
              </span>
          </div>
      </div>
      
      <div class="form-group row">
          <label for="password_confirm" class="col-md-4 col-form-label text-md-right">Confirmar Contraseña*</label>

          <div class="col-md-6">
            <input id="password_confirm" type="password" class="form-control" name="password_confirm" v-model="password_confirm" required autofocus>
          </div>
      </div>
      
      <div class="form-group row">
          <label for="phone1" class="col-md-4 col-form-label text-md-right">Telefono 1*</label>

          <div class="col-md-6">
            <input placeholder="04XXXXXXXXX" id="phone1" type="tel" class="form-control" name="phone1" v-model="phone1" required autofocus>
          </div>
          <span v-if="errors" class="invalid-feedback" role="alert">
              <strong>{{errors.phone1}}</strong>
          </span>
      </div>
      
      <div class="form-group row">
          <label for="phone2" class="col-md-4 col-form-label text-md-right">Telefono 2</label>

          <div class="col-md-6">
            <input placeholder="04XXXXXXXXX" id="phone2" type="tel" class="form-control" name="phone2" v-model="phone2" autofocus>
          </div>
          <span v-if="errors" class="invalid-feedback" role="alert">
              <strong>{{errors.phone2}}</strong>
          </span>
      </div>

      <div class="form-group row">
        <label for="role" class="col-md-4 col-form-label text-md-right">Tipo de Usuario*</label>

        <div class="col-md-6">
          <select id="role" class="form-control" v-model="role" name="role" required>
            <option :value="null" disabled selected>Seleccione</option> 
            <option value="natural">Personal Natural</option> 
            <option value="juridica">Persona Juridica</option> 
          </select>

          <span v-if="errors" class="invalid-feedback" role="alert">
              <strong>{{errors.password}}</strong>
          </span>
        </div>
      </div>
      
      <div v-if="role === 'juridica'">

        <h4 class="ml-4 my-5">Información de la Empresa</h4>

        <div class="form-group row">
          <label for="institution_name" class="col-md-4 col-form-label text-md-right">Nombre de la Empresa*</label>

          <div class="col-md-6">
            <input placeholder="Empresa Cualquiera" id="institution_name" type="text" class="form-control" name="institution_name" v-model="institution_name" required autofocus>

              <span v-if="errors" class="invalid-feedback" role="alert">
                <strong>{{errors.institution_name}}</strong>
              </span>
          </div>
        </div>

        <div class="form-group row">
          <label for="institutional_email" class="col-md-4 col-form-label text-md-right">Correo de la Empresa*</label>

          <div class="col-md-6">
            <input placeholder="ejemplo@enterprise.mail.com" id="institutional_email" type="text" class="form-control" name="institutional_email" v-model="institutional_email" required autofocus>

              <span v-if="errors" class="invalid-feedback" role="alert">
                <strong>{{errors.institutional_email}}</strong>
              </span>
          </div>
        </div>

        <div class="form-group row">
          <label for="rif" class="col-md-4 col-form-label text-md-right">RIF de la Empresa*</label>

          <div class="col-md-6">
            <input placeholder="J-XXXXXXXX" id="rif" type="text" class="form-control" name="rif" v-model="rif" required autofocus>

              <span v-if="errors" class="invalid-feedback" role="alert">
                <strong>{{errors.rif}}</strong>
              </span>
          </div>
        </div>

        <div class="form-group row">
          <label for="phone_institution" class="col-md-4 col-form-label text-md-right">Número de la Empresa*</label>

          <div class="col-md-6">
            <input placeholder="04XXXXXXXXX" id="phone_institution" type="text" class="form-control" name="phone_institution" v-model="phone_institution" required autofocus>

              <span v-if="errors" class="invalid-feedback" role="alert">
                <strong>{{errors.phone_institution}}</strong>
              </span>
          </div>
        </div>

      </div>
      
      <div class="form-group row mt-5">
          <div class="col-md-6">
              <span>
                Requerimientos Obligatorios (*)
              </span>
          </div>
        </div>

      <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
          <button type="submit" :disabled="!isValidForm" class="btn btn-primary">
            Registrarse
          </button>
        </div>
      </div>

    </form>
  </div>
</template>
<script>
export default {
  props: ['errors', 'countries'],
  data: () => ({
    name: null,
    email: null,
    username: null,
    dni: null,
    nationality: null,
    address: null,
    password: null,
    password_confirm: null,
    phone1: null,
    phone2: null,
    role: null,
    institution_name: null,
    rif: null,
    institutional_email: null,
    phone_institution: null,
  }),
  computed:{
    isValidForm(){
      const name = Boolean(this.name)
      const email = Boolean(this.email)
      const username = Boolean(this.username)
      const dni = Boolean(this.dni)
      const nationality = Boolean(this.nationality)
      const address = Boolean(this.address)
      const password = Boolean(this.password)
      const password_confirm = Boolean(this.password_confirm)
      const phone1 = Boolean(this.phone1)
      const phone2 = Boolean(this.phone2)
      const role = Boolean(this.role)
      const institution_name = Boolean(this.institution_name)
      const rif = Boolean(this.rif)
      const institutional_email = Boolean(this.institutional_email)
      const phone_institution = Boolean(this.phone_institution)

      if (this.role === 'juridica') {
        return name && email && username && dni && nationality && address && password && password_confirm && phone1 && phone2 && role && institution_name && rif && institutional_email && phone_institution
      }
      else {
        return name && email && username && dni && nationality && address && password && password_confirm && phone1 && phone2 && role
      }
      
    }
  }
}
</script>