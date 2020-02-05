<!--
Ultima Actualización: 19/01/2020

Tipo de componente: Vista

Ruta:/

Descripción:
	La Pagina principal de el sitio, contiene una pequeña descripción del proyecto, muestra las noticias en un slider, las preguntas frecuentes y permite hacer una pregunta
 -->

<template>
  <div>
    <!-- Acerca de  -->
    <div class="p-4 card">
      <h2 class="m-0 m-lg-5 m-xl-5 text-center display-4">Acerca del proyecto</h2>
      <p class="mt-5">
        El proyecto tiene como objetivo: establecer una plataforma de medidas legislativas, reglamentarias, sociales y de infraestructura para aplicar el Protocolo de Cartagena en la República Bolivariana de Venezuela, con el fin de contribuir a la conservación global y el uso sostenible de la diversidad biológica.
      </p>
      <p>
        El MINEC reconoce a la bioseguridad como un eje transversal que toca la gestión de diversos organismos y busca crear capacidades institucionales conjuntamente con otros Ministerios y entes públicos con inherencia en la materia, asegurando la debida sinergia entre las Autoridades Nacionales Competentes y la Aplicación del Protocolo de Cartagena sobre Bioseguridad.
      </p>
    </div>
    <slide></slide>
    <!--FAQS -->
    <div class="p-5 p-lg-4 p-xl-4">
      <h3 class="font-weight-bold">Preguntas frecuentes</h3>
      <div v-if="faqs.length > 0" class="p-3 my-5" style="background-color: #e6e6e6">
        <div v-for="(item, index) of faqs" :key="index">
          <!-- Preguntas -->
          <a href="#">
            <h5 class="font-weight-bold" style="color: #2c3e50">{{ item.question }}</h5>
            <p class="my-3 ml-3">{{ item.answer }}</p>
          </a>
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
import pregunta from "../components/Hacer-pregunta.vue";
import slide from "../components/Slide.vue";

export default {
  components: {
    pregunta,
    slide
  },
  data() {
    return {
      faqs: []
    };
  },
  created() {
    // Get questions
    let _this = this;
    axios
      .get("/questions")
      .then(res => {
        _this.faqs = [...res.data];
      })
      .catch(err => console.log(err.response));
  }
};
</script>

<style>
li:hover,
a:hover,
li,
a { 
  text-decoration: none;
  color: #000;
}
</style>
