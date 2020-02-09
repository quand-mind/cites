<template>
  <div>
    <div class="caja bg-light p-3">
      <h1>Bienvenido al Panel de administración de MINEC <span><img src="/images/logos/minec-thumb.png" class="figure" /></span></h1>
      <h4 class="ml-4">Desde acá podrás modificar el sitio web, agregar o modificar páginas, responder preguntas, hacer encuestas y administrar usuarios</h4>
    </div>
    <b-card-group deck>
      <b-card header-tag="header" class="m-3">
        <template v-slot:header>
          <h6 class="mb-0 text-uppercase">Páginas</h6>
        </template>
        <b-card-text>Revisa una de las páginas o modifica una creada</b-card-text>
        <b-button-group>
            <b-button href="/dashboard/pages/create" variant="primary" class="mx-2"><font-awesome-icon :icon="['fas', 'plus']"></font-awesome-icon><br> Crear una nueva página</b-button>
            <b-button href="/dashboard/pages" variant="info" class="mx-2"><font-awesome-icon :icon="['fas', 'book-open']"></font-awesome-icon><br> Administrar páginas</b-button>
        </b-button-group>
      </b-card>

      <b-card header-tag="header" class="m-3">
        <template v-slot:header>
          <h6 class="mb-0 text-uppercase">Menú</h6>
        </template>
        <b-card-text>Modifica el orden o los botones del menú</b-card-text>
        <b-button href="/dashboard/menu" variant="primary"class="mx-2"><font-awesome-icon :icon="['fas', 'pager']"></font-awesome-icon><br> Modificar menú</b-button>
      </b-card>

      <b-card header-tag="header" class="m-3">
        <template v-slot:header>
          <h6 class="mb-0 text-uppercase">Administrar Usuarios</h6>
        </template>
        <b-card-text>Ten el control de todas los usuarios que administran el sitio y de los roles que tendrán</b-card-text>
          <b-button-group>
            <b-button href="/dashboard/users" variant="primary" class="mx-2"><font-awesome-icon :icon="['fas', 'user-plus']"></font-awesome-icon><br> Crear usuarios</b-button>
            <b-button href="/dashboard/users" variant="info" class="mx-2"><font-awesome-icon :icon="['fas', 'users-cog']"></font-awesome-icon><br> Modificar usuarios</b-button>
            <b-button href="/dashboard/users" variant="danger" class="mx-2"><font-awesome-icon :icon="['fas', 'user-times']"></font-awesome-icon><br> Eliminar usuarios</b-button>
          </b-button-group>
      </b-card>
    </b-card-group>
    <b-card-group deck>
      <b-card header-tag="header">
        <template v-slot:header>
          <h6 class="mb-0 text-uppercase">Preguntas Frecuentes</h6>
        </template>
        <b-button-group>
            <b-button href="/dashboard/questions" variant="primary" class="mx-2"><font-awesome-icon :icon="['fas', 'plus']"></font-awesome-icon><br> Crear nueva pregunta</b-button>
            <b-button href="/dashboard/questions" variant="info" class="mx-2"><font-awesome-icon :icon="['fas', 'question-circle']"></font-awesome-icon><br> Responder preguntas</b-button>
            <b-button href="/dashboard/questions" variant="danger" class="mx-2"><font-awesome-icon :icon="['fas', 'cog']"></font-awesome-icon><br> Administrar preguntas</b-button>
          </b-button-group>
      </b-card>
       <b-card header-tag="header">
        <template v-slot:header>
          <h6 class="mb-0 text-uppercase">Encuestas</h6>
        </template>
        <b-button-group>
            <b-button href="/dashboard/surveys" variant="primary" class="mx-2"><font-awesome-icon :icon="['fas', 'plus']"></font-awesome-icon><br> Crear nueva encuesta</b-button>
            <b-button href="/dashboard/surveys" variant="info" class="mx-2"><font-awesome-icon :icon="['fas', 'cog']"></font-awesome-icon><br> Administrar encuestas</b-button>
          </b-button-group>
      </b-card>
    </b-card-group>
    <div>
      <h3 class="text-center">Sitio web creador por ...</h3>
    </div>
  </div>
</template>

<script>

</script>
<style lang="scss">
</style>
