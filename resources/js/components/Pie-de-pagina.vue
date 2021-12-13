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
	<footer class="azul modal-footer d-flex flex-row align-items-center justify-content-center" >
		<b-row>
			<b-col class="mt-3" lg="3" md="12">
				<!-- Cajetin de redes -->
				<div class="d-flex align-items-center justify-content-center flex-column h-100 text-white">
					<div class="m-2">
						<img src="/images/logos/instagram.png" width="20px" alt="" class="mr-1">
						<a class="text-white" href="https://www.instagram.com/cites_minec/" target="blank">
							cites_minec
						</a>
					</div>
					<div class="m-2">
						<img src="/images/logos/twitter.png" width="20px" alt="" class="mr-1">
						<a class="text-white" href="https://twitter.com/Cites_Minec" target="blank">
							Cites_Minec
						</a>
					</div>
					<div class="m-2">
						<img src="/images/logos/facebook.png" width="20px" alt="" class="mr-1">
						<a class="text-white" href="https://www.facebook.com/profile.php?id=100074153067703" target="blank">
							Cites Minec
						</a>
					</div>
				</div>
			</b-col>
			<b-col lg="6" md="12">
				<!-- Logos del Aside -->
				<div class="d-flex align-items-center justify-content-center flex-column">
					<b-button href="#up" class="p-3 h1 m-5 uppercase" v-scroll-to="'#app'" variant="light"><span class="icon icon-circle-up"></span> Ir arriba</b-button>
					<p class="text-white h5 m-3 text-center">2019 MINEC. Todos los derechos reservados</p>
				</div>
			</b-col>
			<b-col class="mt-3" lg="3" md="12">
				<!-- Cajetin de contacto -->
				<div class="redes d-flex align-items-start justify-content-center flex-column h-100 text-white">
					<div class="m-2">
						<font-awesome-icon :icon="['fa', 'map-marker-alt']"></font-awesome-icon>
						<span class="ml-2">
							<b>Dirección:</b> Dirección General de Diversidad Biológica, Piso 9, MINEC. Plaza Caracas, Centro Simón Bolívar, Torres del Silencio, Caracas 1010, Distrito Capital. Venezuela.
						</span>
					</div>
					<div class="m-2">
						<font-awesome-icon :icon="['fa', 'phone']"></font-awesome-icon>
						<span class="ml-2">
						+58 4125671554
						</span>
					</div>
					<div class="m-2">
						<font-awesome-icon :icon="['fa', 'envelope']"></font-awesome-icon>
						<span class="ml-2">
							permisoscitesve@gmail.com
						</span>
					</div>
				</div>
			</b-col>
		</b-row>
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
