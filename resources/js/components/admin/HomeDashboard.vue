<template>
  <div>
    <div class="caja bg-light p-2">
      <h1>Bienvenido al Panel de administración</h1>
      <h4 class="ml-4">Desde acá podrás Administrar el sitio web, agregar o Administrar páginas, responder preguntas, hacer encuestas y administrar usuarios</h4>
    </div>
    <b-card-group deck>
      <b-card v-if="user.role !== 'funcionario'" header-tag="header" class="m-3">
        <template v-slot:header>
          <h6 class="mb-0 text-uppercase">Páginas</h6>
        </template>
        <b-card-text>Crea una nueva página o modifica una ya creada</b-card-text>
        <b-button-group>
            <b-button href="/dashboard/pages/create" variant="primary" class="mx-2" size="sm"><font-awesome-icon :icon="['fas', 'plus']"></font-awesome-icon><br> Crear una nueva página</b-button>
            <b-button href="/dashboard/pages" variant="info" class="mx-2" size="sm"><font-awesome-icon :icon="['fas', 'book-open']"></font-awesome-icon><br> Administrar páginas</b-button>
        </b-button-group>
      </b-card>

      <b-card v-if="user.role !== 'writer' && user.role !== 'funcionario'" header-tag="header" class="m-3">
        <template v-slot:header>
          <h6 class="mb-0 text-uppercase">Menú</h6>
        </template>
        <b-card-text>Modifica el orden o los botones del menú</b-card-text>
        <b-button href="/dashboard/menu" variant="primary" class="mx-2" size="sm"><font-awesome-icon :icon="['fas', 'pager']"></font-awesome-icon><br> Administrar menú</b-button>
      </b-card>

      <b-card v-if="user.role !== 'writer' && user.role !== 'funcionario'" header-tag="header" class="m-3">
        <template v-slot:header>
          <h6 class="mb-0 text-uppercase">Administrar Usuarios</h6>
        </template>
        <b-card-text>Ten el control de todos los usuarios que administran el sitio y de los roles que tendrán</b-card-text>
          <b-button-group>
            <b-button href="/dashboard/users" variant="primary" class="mx-2" size="sm"><font-awesome-icon :icon="['fas', 'user-plus']"></font-awesome-icon><br> Crear usuarios</b-button>
            <b-button href="/dashboard/users" variant="info" class="mx-2" size="sm"><font-awesome-icon :icon="['fas', 'users-cog']"></font-awesome-icon><br> Administrar usuarios</b-button>
          </b-button-group>
      </b-card>
    </b-card-group>
    <b-card-group deck>
      <b-card class="m-3" v-if="user.role !== 'writer' && user.role !== 'funcionario'" header-tag="header">
        <template v-slot:header>
          <h6 class="mb-0 text-uppercase">Preguntas Frecuentes</h6>
        </template>
        <b-button-group>
            <b-button href="/dashboard/questions" variant="primary" class="mx-2" size="sm"><font-awesome-icon :icon="['fas', 'plus']"></font-awesome-icon><br> Crear nueva pregunta</b-button>
            <b-button href="/dashboard/questions" variant="info" class="mx-2" size="sm"><font-awesome-icon :icon="['fas', 'cog']"></font-awesome-icon><br> Administrar preguntas</b-button>
          </b-button-group>
      </b-card>
       <b-card class="m-3" v-if="user.role !== 'funcionario'" header-tag="header">
        <template v-slot:header>
          <h6 class="mb-0 text-uppercase">Encuestas</h6>
        </template>
        <b-button-group>
            <b-button href="/dashboard/surveys" variant="primary" class="mx-2" size="sm"><font-awesome-icon :icon="['fas', 'plus']"></font-awesome-icon><br> Crear nueva encuesta</b-button>
            <b-button href="/dashboard/surveys" variant="info" class="mx-2" size="sm"><font-awesome-icon :icon="['fas', 'cog']"></font-awesome-icon><br> Administrar encuestas</b-button>
          </b-button-group>
      </b-card>
       <b-card class="m-3" v-if="user.role !== 'wriitter'" header-tag="header">
        <template v-slot:header>
          <h6 class="mb-0 text-uppercase">CITES</h6>
        </template>
        <b-button-group>
            <b-button href="/dashboard/permissions/" variant="primary" class="mx-2" size="sm"><font-awesome-icon :icon="['fas', 'clipboard-check']"></font-awesome-icon><br> Solicitud de Permisos</b-button>
            <b-button href="/dashboard/permissions/graphics" variant="info" class="mx-2" size="sm"><font-awesome-icon :icon="['fas', 'chart-pie']"></font-awesome-icon><br> Gráficas de CITES</b-button>
          </b-button-group>
      </b-card>
    </b-card-group>
    <b-card-group deck>
      <b-card class="m-3" v-if="user.role !== 'writer'" header-tag="header">
        <template v-slot:header>
          <h6 class="mb-0 text-uppercase">Configuracion de Permisos CITES</h6>
        </template>
        <b-button-group>
            <b-button href="/dashboard/permissions/permitsView" variant="primary" class="mx-2" size="sm"><font-awesome-icon :icon="['fas', 'plus']"></font-awesome-icon><br> Crear nuevo Permiso</b-button>
            <b-button href="/dashboard/permissions/permitsView" variant="info" class="mx-2" size="sm"><font-awesome-icon :icon="['fas', 'cog']"></font-awesome-icon><br> Administrar Permisos</b-button>
          </b-button-group>
      </b-card>
      <b-card class="m-3" v-if="user.role !== 'writer'" header-tag="header">
        <template v-slot:header>
          <h6 class="mb-0 text-uppercase">Configuracion de Recaudos CITES</h6>
        </template>
        <b-button-group>
            <b-button href="/dashboard/permissions/requerimentsView" variant="primary" class="mx-2" size="sm"><font-awesome-icon :icon="['fas', 'plus']"></font-awesome-icon><br> Crear nuevo Requerimiento</b-button>
            <b-button href="/dashboard/permissions/requerimentsView" variant="info" class="mx-2" size="sm"><font-awesome-icon :icon="['fas', 'cog']"></font-awesome-icon><br> Administrar Requerimentos</b-button>
          </b-button-group>
      </b-card>
    </b-card-group>
  </div>
</template>

<script>
  export default {
    props: ['iswriter', 'user'],
    data: () => ({})
  }
</script>

<style lang="scss">
</style>
