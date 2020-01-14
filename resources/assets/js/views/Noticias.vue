<template>
	<div>
		<titulo msg="Noticias"/>
<!-- Noticias -->
		<div class="p-5 p-lg-4 p-xl-4">
			<div class=" my-5 " style="background-color: #e6e6e6" >
	<!-- Noticia -->
				<div v-for="(item,index) of noticiasArreglo" :key= "index">
					<a href="#" class="noticia d-flex flex-column flex-xl-row flex-lg-row align-items-center p-3" onclick="return false">
						<img src="/images/caja1.jpg" class="img-thumbnail p-2 bg-light w-75" style="max-width: 250px">
						<div class="d-flex flex-column p-3">
							<h5 class="font-weight-bold" style="color: #2c3e50" >Noticia #{{item}}</h5>
							<p class="my-3 ml-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquaLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
						</div>
					</a>
				<hr>
				</div>
			</div>
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
		noticiasArreglo: [1,2,3,4,5]
		}
	}
}
</script>
<style type="text/css">
	.noticia:hover{
		background-color: #b9b9b9;
	}
</style>