<!-- 
Ultima Actualización: 31/01/2020

Tipo de componente: Vista

Ruta:/{any}/

Descripción:
	Renderiza la ruta de la página que recibe por los props
 -->

<template>
	<div>
		<titulo msg="Protocolo de Cartagena"/>
<!-- Escrito -->
		<div class="d-flex flex-column p-5 text-justify">

				<p>El Protocolo de Cartagena sobre Seguridad de la Biotecnología es un marco jurídico para avalar el Convenio sobre Diversidad Biológica.</p>

				<p><b>Objetivo:</b> contribuir a garantizar un nivel adecuado de protección en la esfera de la transferencia, manipulación y utilización seguras de los <i>organismos vivos modificados</i> resultantes de la biotecnología moderna que puedan tener efectos adversos para la conservación y la utilización sostenible de la diversidad biológica, teniendo también en cuenta los riesgos para la salud humana, y centrándose concretamente en los <i>movimientos transfronterizos</i></p>

				<p>Es  el primer acuerdo internacional que rige la transferencia, manejo y uso de organismos vivos modificados obtenidos de la biotecnología moderna (básicamente semillas). No se aplica a productos farmacéuticos o alimentos procesados.</p>
				
				<p>El Protocolo de Cartagena sobre Seguridad de la Biotecnología <a href="http://www.bioseguridadecuador.gob.ec/protocolo.pdf/" target="_blank">(PCSB)</a> en su Art. 20 determina la creación de un sistema de intercambio de información entre las Partes, con este objetivo implementó una plataforma en la que se encuentra alojada la información de cada país referente a los organismos genéticamente modificados (OGM) como: leyes, decisiones, material informativo, análisis de riesgos, entre otros. </p>

				<p>Venezuela, a través de su Autoridad Nacional Competente en Bioseguridad (MINEC) publica información oficial validada en este tema, tanto en su página nacional <a href="#">(www.xxxxxxxxxx)</a> como en la página oficial de los países firmantes del protocolo PCSB (Biosafety Clearing House O CIISB).</p>

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