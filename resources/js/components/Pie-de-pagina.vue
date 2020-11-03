<!-- 
Ultima Actualización: 16/01/2020

Tipo de componente: Módulo

Donde se usa:
	Home.blade.php (layout)

Descripción:
	pie de pagina, contiene links a las redes sociales y boton para subir al principio de la pagina
 -->

 <template>
  <div>
	<footer style="background-color: #009462;" class="modal-footer d-flex flex-column align-items-center" >
		<b-button href="#up" class="p-3 h1 m-5 uppercase" v-scroll-to="'#app'" variant="light"><span class="icon icon-circle-up"></span> Ir arriba</b-button>
		<!-- Cajetin de redes -->
		<div class="redes">
			<a v-for="link in links" :key="'link-' + link.name" :href="link.url"><img :src="link.photo" class="icon m-2 text-decoration-none" /></a>
			<!-- <a href="#"><span class="icon icon-twitter h2 text-white m-2 text-decoration-none"></span></a>
			<a href="#"><span class="icon icon-instagram  h2 text-white m-2 text-decoration-none"></span></a>
			<a href="#"><span class="icon icon-youtube h2 text-white m-2 text-decoration-none"></span></a> -->
		</div>
		<!-- Logos del Aside -->
		<p class="text-white h5 m-3 text-center">2019 MINEC. Todos los derechos reservados</p>
	</footer>
  </div>
</template>

<script>
export default {
  name: 'pie',
  props: ['links'],
}
</script>

<style scoped>
	.icon {
		height: 50px;
	}
</style>
