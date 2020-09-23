<!-- 
Ultima Actualización: 31/01/2020

Tipo de componente: Vista

Ruta:/{any}/

Descripción:
	Renderiza la ruta de la página que recibe por los props
 -->

<template>
	<div>

		<titulo :msg="page.title"/>
<!-- Escrito -->
		<div class="mt-5 ql-editor" v-html="page.content"></div>
	
    </div>
</template>

<script>
	import titulo from "../components/Titulo.vue"

	export default{
		components:{
			titulo,
		},
		props: [
			'page'
		]
	}
</script>


<style scoped>
	.ql-editor {
		font-size: 1.15rem;
		line-height: 1.7;	
	}

	p{
		margin: 30px 0px;
	}

</style>