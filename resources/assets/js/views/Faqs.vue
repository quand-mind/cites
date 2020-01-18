<template>
  <div>
    <titulo msg="Preguntas frecuentes" />
    <!--FAQS -->
    <div class="p-5 p-lg-4 p-xl-4">
      <div v-if="faqs.length > 0" class="p-3 my-5" style="background-color: #e6e6e6">
        <div v-for="(item,index) of faqs" :key="index">
          <!-- Preguntas -->
          <a href="#">
            <h5 class="font-weight-bold" style="color: #2c3e50">{{item.question}}</h5>
            <p class="my-3 ml-3">{{item.answer}}</p>
          </a>
          <hr />
        </div>
      </div>
      <div v-else class="p-3 my-5" style="background-color: #e6e6e6">
        <h4 class="font-weight-bold" style="color: #2c3e50">No hay preguntas.</h4>
      </div>
      <!--Boton de hacer preguntas-->
      <a
        href="#"
        onclick="return false"
        class="text-uppercase ml-4 btn font-weight-bold btn-lg"
        style="background-color: #2c3e50; color: #fff"
      >Hacer una pregunta</a>
    </div>
    <titulo msg="Encuestas" />
  </div>
</template>

<script>
import titulo from "../components/Titulo.vue";
import axios from "axios";

export default {
  components: {
    titulo
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
<style type="text/css">
.noticia:hover {
  background-color: #b9b9b9;
}
</style>
