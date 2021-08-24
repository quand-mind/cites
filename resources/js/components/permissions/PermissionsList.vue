<template>
  <div>
    <div class="caja bg-light p-2 my-2">
      <h1>Permisos</h1>
      <h4 class="ml-4">Realice la solicitud para la aprobación de permisos MINEC.</h4>
  
      <ul class="list-group mt-4" v-for="(permit, index) of permit_types" v-bind:key="index">
        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
           {{permit.name}}
          <button class="btn btn-secondary" type="button" data-toggle="collapse" :data-target="'#collapsePermit' + index" aria-expanded="false" aria-controls="collapsePermit">
            Recaudos
          </button>
        </li>
        <div class="collapse" :id="'collapsePermit' + index">
          <div class="card card-body">
            <div class="d-flex">
              <h6>Lista de Recaudos:</h6>
            </div>
            <ul class=" mt-4" v-for="(requeriment, index) of permit.requeriments" v-bind:key="index">
              <li class="">{{requeriment.name}}</li>
            </ul>
            <div class="w-100 d-flex justify-content-end align-items-center">
             <a class="btn btn-primary" :href="`/solicitante/permissions/permit_form/${permit.id}`">Solicitar Permiso</a>
            </div>
          </div>

        </div>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: ["permit_types", 'type', 'client_data'],
  data: () => ({

  }),
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