<!--
Ultima Actualización: 19/01/2020
Tipo de componente: Vista
Ruta:/preguntas-frecuentes
Descripción:
	Lee las Preguntas Frecuentes de la base de datos y las muestra de 10 en 10, y las encuestas
 -->

<template>
  <div>
    <titulo :msg="page.title" />
    <div class="mt-5" v-html="page.content"></div>
    <div class="p-5 p-lg-4 p-xl-4">
      <div v-if="glosary.length > 0" class="p-3 my-5" style="background-color: #e6e6e6">
        <div v-for="(item,index) of glosary" :key="index">
          <!-- Preguntas -->
          <h5 class="font-weight-bold" style="color: #2c3e50">{{item.word}}</h5>
          <p class="my-3 ml-3">{{item.description}}</p>
          <hr />
        </div>
      </div>
      <div v-else class="p-3 my-5" style="background-color: #e6e6e6">
        <h4 class="font-weight-bold" style="color: #2c3e50">No hay palabras en el glosario.</h4>
      </div>
    </div>
  </div>
</template>

<script>
import titulo from "../components/Titulo.vue";
import axios from "axios";
export default {
  components: {
    titulo
  },
  props: ['glosary', 'page']
};
</script>
<style type="text/css">
.noticia:hover {
  background-color: #b9b9b9;
}
</style>