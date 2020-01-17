<!-- 
Ultima Actualización: 16/01/2020

Tipo de componente: Módulo

Donde se usa:
	Protocolo-recursos.vue (vista)

Descripción:
	Cajetin para imagen
 -->

 <template>
  <div>
	<a href="#"><img src="/images/caja1.jpg" class="img-thumbnail m-2" width="200"></a>
  </div>
</template>

<script>
export default {
  name: 'imagen',
  props: {
	msg: String
  }
}
</script>

<style scoped>
	
</style>
