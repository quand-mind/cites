<template>
	<div>
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