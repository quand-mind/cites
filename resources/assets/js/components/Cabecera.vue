<!-- 
Ultima Actualización: 16/01/2020

Tipo de componente: Módulo

Donde se usa:
	Home.blade.php (layout)

Descripción:
	Contiene el header con la primera imagen con parallax, el logo y el nombre 
 -->

 <template>
	<div class="cabecera" id="up">
	<header class="verde">
		<div class="navbar flex-wrap flex-xl-nowrap flex-lg-nowrap" > 
				<router-link to="/">
					<div class="d-flex flex-wrap align-items-center justify-content-start">
						<img src="/images/logos/minec-thumb.png" class="figure">
						<p class="ml-2 p-1 font-weight-bold w-75 h6 d-none d-lg-flex d-xl-flex text-black">Implementación del Marco Nacional de Bioseguridad en Venezuela,
						de acuerdo con el Protocolo de Cartagena sobre Seguridad de la
						Biotecnología 
						</p>
					</div>
				</router-link>
			<!-- <div class="d-flex flex-nowrap align-self-end"> 							
				<a href="ingreso.html"  class="btn m-1 border border-secondary rounded py-1 px-3">Ingresar</a>
				<a href="registro.html"  class="btn m-1 text-white verde btn-verde">Registrarse</a>
			</div> -->
		</div>
	</header>
  </div>
</template>

<script>
export default {
  name: 'cabecera'
}
</script>

<style scoped>
	li:hover,
a:hover,
li,
a {
    text-decoration: none;
    color: #000;
}
	header{
	height: 50vh;
	background-image: url("/images/bg-header.jpg");
	background-repeat:no-repeat; /* Indicamos que no se repetira */
	background-size: auto 100%; /* Encajamos la imagen al 100% del ancho */
	background-attachment: fixed;
	background-position: center;
}
</style>
