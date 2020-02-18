<!-- 
Ultima Actualización: 16/01/2020

Tipo de componente: Vista

Ruta:/protocolo/faqs

Descripción:
	Muestra las preguntas más frecuentes acerca de el protocolo de Cartagena leyendolas de la base de datos
 -->

<template>
	<div>
		<titulo msg="Protocolo de cartagena"/>
		<h2 class="text-center my-5 font-weight-light">Preguntas Frecuentes sobre el protocolo</h2>
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