<!--
Ultima Actualización: 19/01/2020

Tipo de componente: Vista

Ruta:/preguntas-frecuentes

Descripción:
	Lee las Preguntas Frecuentes de la base de datos y las muestra de 10 en 10, y las encuestas

 -->

<template>
  <div>
    <titulo msg="Preguntas frecuentes" />
    <!--FAQS -->
    <div class="p-5 p-lg-4 p-xl-4">
      <div v-if="questions.length > 0" class="p-3 my-5" style="background-color: #e6e6e6">
        <div v-for="(item,index) of questions" :key="index">
          <!-- Preguntas -->
          <h5 class="font-weight-bold" style="color: #2c3e50">{{item.question}}</h5>
          <p class="my-3 ml-3">{{item.answer}}</p>
          <hr />
        </div>
      </div>
      <div v-else class="p-3 my-5" style="background-color: #e6e6e6">
        <h4 class="font-weight-bold" style="color: #2c3e50">No hay preguntas.</h4>
      </div>
      <!--Boton de hacer preguntas-->
      <pregunta></pregunta>
    </div>
  </div>
</template>

<script>
import titulo from "../components/Titulo.vue";
import axios from "axios";
import pregunta from "../components/Hacer-pregunta.vue";

export default {
  components: {
    titulo,
    pregunta
  },
  props: ['questions']
};
</script>
<style type="text/css">
.noticia:hover {
  background-color: #b9b9b9;
}
</style>
