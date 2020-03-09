<!-- 
Ultima Actualización: 16/01/2020

Tipo de componente: Módulo

Donde se usa:
	Asociados-nagoya-lumpur.vue (vista), Faqs.vue (vista), Laboatorio-nacional-ovm.vue (vista), Noticias.vue (vista), Protocolo-faqs.vue (vista), Protocolo-mitos-realidades.vue (vista), Protocolo-ovm-territorio-nacional.vue (vista), Protocolo-recursos.vue (vista), Proyecto-acuerdos-internacionales.vue (vista), Proyecto-antecedentes-justificacion.vue (vista), Proyecto-comision-nacional-de-bioseguridad.vue (vista), Proyecto-legislacion-internacional.vue (vista), Recursos-formulario.vue (vista), Recursos-glosario.vue (vista), Recursos-informacion.vue (vista), Recursos-mapa-del-sitio.vue (vista), Recursos-portales.vue (vista), Somos-grupos.vue (vista), Somos-mision.vue (vista), Somos-vision.vue (vista), Somos-objetivos.vue (vista), Transgenico.vue (vista)

	En todas las vistas excepto en Home


Descripción:
	Recibe un string en msg y lo coloca como un titulo centrado con margen
 -->

 <template>
  <div class="d-flex flex-column justify-content-center align-items-center">
<!-- Titulo -->
	<h2 class="h1 text-center font-weight-normal my-5">{{msg}}</h2>  	
  </div>
</template>

<script>
export default {
  name: 'titulo',
  props:{
	msg: String
}
}
</script>

<style scoped lang="scss">
	h2 {
		position: relative;
		color: #00a96d;
		display: flex;
		justify-content: center;

		&::after {
			content: "";
			position: absolute;
			bottom: -20px;
			width: 95%;
			height: 5px;
			background: #00a96d;
		}
	}
</style>
