<!-- 
Ultima Actualización: 16/01/2020

Tipo de componente: Módulo

Donde se usa:
	Protocolo-recursos.vue (vista)

Descripción:
	Cajetin para video
 -->

<template>
  <div>
	<a href="#" class="d-flex flex-column align-items-center font-weight-bold bg-light m-2 pb-2" width="200"><video src="" class="img-thumbnail" ></video> Video {{msg}}</a>
  </div>
</template>

<script>
export default {
  name: 'video',
  props: {
	msg: String
  }
}
</script>

<style scoped>
	
</style>
