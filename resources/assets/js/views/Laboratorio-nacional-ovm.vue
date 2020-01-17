<!-- 
Ultima Actualización: 16/01/2020

Tipo de componente: Vista

Ruta:/laboratorio-nacional-ovm

Descripción:
	Contiene la información del laboratorio nacional de detección de Organismos Vivientes Modificados
 -->

<template>
	<div>
		<titulo msg="Laboratorio Nacional de Detección de OVM"/>
<!-- Escrito -->
		<div class="d-flex flex-column p-5 text-justify">

				<div class="d-flex flex-column flex-lg-row flex-xl-row my-3 align-items-center">
					<p>El <b>Ministerio del Poder Popular para Ecosocialismo y Aguas</b> (Minea) contará con un nuevo y moderno laboratorio con tecnología de punta, el cual permitirá realizar estudios precisos sobre la información genética de los Organismos Vivos Genéticamente Modificados (OVGM) o transgénicos.</p>
					<div class="m-3">
						<img src="/images/laboratorio-ovm.jpg" class="m-1 p-1 border border-succes rounded-sm" width="250">
					</div>
				</div>				
				<p>Así lo expresó <b>Carliz Díaz, directora de Bioseguridad del Minea,</b> como parte de su ponencia, la cual estuvo dentro de la Estrategia Nacional para la Conservación de la Biodiversidad y su Plan de Acción Nacional (2011-2020).</p>
				<p>La presentación la hizo en el taller consultivo para la elaboración del Tercer Informe de Aplicación del Protocolo de Cartagena sobre Seguridad de la Biotecnología, celebrado en las instalaciones del <b>Hotel Venetur en Mérida,</b> reseñó una nota de prensa del Minea.</p>
				<p>La presentación la hizo en el taller consultivo para la elaboración del Tercer Informe de Aplicación del Protocolo de Cartagena sobre Seguridad de la Biotecnología, celebrado en las instalaciones del <b>Hotel Venetur en Mérida,</b> reseñó una nota de prensa del Minea.</p>
				
				<p>Durante su intervención, destacó que el Centro de Información de Ingeniería Genética tendrá como sede la ciudad de Maracay (Aragua), y actualmente se encuentra en la fase de dotación de materiales e insumos, en alianza con el Fondo Nacional de Ciencia, Tecnología e Innovación (Fonacit), ente adscrito al <b>Ministerio del Poder Popular para Educación Universitaria, Ciencia y Tecnología</b>(MPPEUCT).</p>

				<p>Esta novedosa infraestructura permitirá hacer estudios científicos para detectar el uso de los organismos modificados, que apoyará las acciones de la <b>Estrategia Nacional para la Conservación de la Biodiversidad</b> y su Plan de Acción Nacional, así como impulsar el trabajo de la Comisión Nacional sobre Bioseguridad en el país.</p>

				<p>Díaz añadió que los debates permitirán reforzar la postura del país como miembro de la Conferencia de las Partes, con relación a la aplicación de la tecnología del ADN, la cual apunta a que los ciudadanos tienen el derecho de conocer si están adquiriendo productos derivados de esta manipulación genética.</p>

				<p>Otro de los aspectos significativos, indicó la funcionaria, es que Venezuela logró presentar la Estrategia Nacional para la Conservación de la Biodiversidad en 2010 ante la ONU, es decir, con 5 años de antelación dentro del estamento internacional, siendo referencia en el mundo.</p>

				<p>Asimismo, explicó lo relacionado a la creación del centro de intercambio de información sobre biodiversidad a través de un portal informativo, el cual se puede acceder mediante la dirección: web <a href="www.diversidadbiologica.info.ve" onclick="return false" class="btn-link">diversidadbiologica.info.ve</a>, donde existe información nacional e internacional, correspondiente a temas científicos, administrativos, legales, entre otros de interés.</p>

		</div>
    </div>
</template>

<script>
	import titulo from "../components/Titulo.vue"

	export default{
		components:{
			titulo,
		}
	}
</script>