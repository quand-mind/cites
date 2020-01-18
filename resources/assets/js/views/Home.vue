<template>
  <div>
    <!-- Acerca de  -->
    <div class="p-4 card">
      <h2 class="m-5 text-center display-4">Acerca del proyecto</h2>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </p>
    </div>
    <!-- Slider -->
    <!-- <slick class="slide" style="max-width: 130vh">
		<a href="#" onclick="return false"><img src="/images/slides/4.jpg" style="width: 100%">
			<div class="position-absolute bg-dark w-100 text-white h-25 rounded d-flex" style="z-index: 300; bottom:0%; opacity: 0.8">
			<p class="h4 m-auto text-center">Noticia #1 Aqui va la noticia</p>
			</div>
		</a>
		<a href="#" onclick="return false"><img src="/images/slides/2.jpg" style="width: 100%">
			<div class="position-absolute bg-dark w-100 text-white h-25 rounded d-flex" style="z-index: 300; bottom:0%; opacity: 0.8">
			<p class="h4 m-auto text-center">Noticia #2 Aqui va la noticia</p>
			</div>
		</a>
		<a href="#" onclick="return false"><img src="/images/slides/3.jpg" style="width: 100%">
			<div class="position-absolute bg-dark w-100 text-white h-25 rounded d-flex" style="z-index: 300; bottom:0%; opacity: 0.8">
			<p class="h4 m-auto text-center">Noticia #3 Aqui va la noticia</p>
			</div>
		</a>
		<a href="#" onclick="return false"><img src="/images/slides/1.jpg" style="width: 100%">
			<div class="position-absolute bg-dark w-100 text-white h-25 rounded d-flex" style="z-index: 300; bottom:0%; opacity: 0.8">
			<p class="h4 m-auto text-center">Noticia #4 Aqui va la noticia</p>
			</div>
		</a>
    </slick>-->
    <!--FAQS -->
    <div class="p-5 p-lg-4 p-xl-4">
      <h3 class="font-weight-bold">Preguntas frecuentes</h3>
      <div class="p-3 my-5" style="background-color: #e6e6e6">
        <div v-for="(item,index) of faqs" :key="index">
          <!-- Preguntas -->
          <a href="#">
            <h5 class="font-weight-bold" style="color: #2c3e50">{{item.question}}</h5>
            <p class="my-3 ml-3">{{item.answer}}</p>
          </a>
          <hr />
        </div>
      </div>
      <!--Boton de hacer preguntas-->
      <router-link
        to="/hacer-pregunta"
        class="text-uppercase ml-4 btn font-weight-bold btn-lg"
        style="background-color: #2c3e50; color: #fff"
      >Hacer una pregunta</router-link>
    </div>
  </div>
</template>

<script>
export default {
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

.slide a div:hover p {
  font-size: 30px;
  transition: all 500ms ease;
}
</style>
