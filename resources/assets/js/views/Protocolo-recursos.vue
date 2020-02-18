<!-- 
Ultima Actualización: 16/01/2020

Tipo de componente: Vista

Ruta:/protocolo/recursos

Descripción:
	Muestra una galeria de imagenes y videos acerca de los OVM y los proyectos
 -->

<template>
	<div>
    <div class="menu">
    	
    </div>

		<titulo msg="Protocolo de cartagena"/>
		<h2 class="text-center my-5 font-weight-light">Imágenes</h2>
		<div class="d-flex flex-wrap px-5 justify-content-center align-items-center">
			<imagen/>
			<imagen/>
			<imagen/>
			<imagen/>
			<imagen/>
			<imagen/>
		</div>

		<h2 class="text-center my-5 font-weight-light">Videos</h2>
		<div class="d-flex flex-wrap px-5 justify-content-center align-items-center">
			<videos/>
			<videos/>
			<videos/>
			<videos/>
		</div>		
    </div>
</template>

<script>
	import titulo from "../components/Titulo.vue"
	import imagen from "../components/Imagen.vue"
	import videos from "../components/Video.vue"

	export default{
		components:{
			titulo,
			imagen,
			videos
		}
	}
</script>
