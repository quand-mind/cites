<!-- 
Ultima Actualización: 16/01/2020

Tipo de componente: Vista

Ruta:/

Descripción:
	La Pagina principal de el sitio, contiene una pequeña descripción del proyecto, muestra las noticias en un slider, las preguntas frecuentes y permite hacer una pregunta  
 -->

<template>
	<div>
<!-- Acerca de  -->
		<div class="p-4 card">
			<h2 class="mb-5 m-lg-5 m-xs-5 text-center display-4">Acerca del proyecto</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
<!-- Slider -->
	<!-- <div class="w-100 d-flex justify-content-center verde"> -->
			<!-- <slick ref="slick">
				<a href="#" onclick="return false"><img src="/images/slides/1.jpg"></a>
				<a href="#" onclick="return false"><img src="/images/slides/2.jpg"></a>
			</slick> -->
	<!-- </div> -->
<!--FAQS -->
		<div class="p-5 p-lg-4 p-xl-4">
			<h3 class="font-weight-bold">Preguntas frecuentes</h3>
			<div class="p-3 my-5 " style="background-color: #e6e6e6">
				<div  v-for="(item,index) of faqsArreglo" :key="index">
					<!-- Preguntas -->
					<a href="#">
						<h5 class="font-weight-bold" style="color: #2c3e50" >Pregunta #{{item}}</h5>
						<p class="my-3 ml-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
					</a>
					<hr>
				</div>
			</div>
			<!--Boton de hacer preguntas-->
			<a href="#" onclick="return false" class="text-uppercase ml-4 btn font-weight-bold btn-lg" style="background-color: #2c3e50; color: #fff"> Hacer una pregunta</a>
		</div>
    </div>
</template>

<script>
export default {
  data(){
	return{
	faqsArreglo: [1,2,3,4,5,6,7,7,8,10]

	}
  }
}

</script>

<style>
    li:hover,a:hover, li, a{
      text-decoration: none;
      color: #000;
        }
</style>
				