<template>
	<div>
		<titulo msg="Preguntas frecuentes"/>
<!--FAQS -->
		<div class="p-5 p-lg-4 p-xl-4">
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
		<titulo msg="Encuestas"/>
    </div>
</template>

<script>
	import titulo from "../components/Titulo.vue"

	export default{
		components:{
			titulo,
		},
		 data(){
			return{
			faqsArreglo: [1,2,3,4,5,6,7,7,8,10]
			}
  }

	}
</script>
<style type="text/css">
	.noticia:hover{
		background-color: #b9b9b9;
	}
</style>