<!-- 
Ultima Actualización: 16/01/2020

Tipo de componente: Vista

Ruta:/proyecto/comision-nacional-de-bioseguridad

Descripción:
	Contiene la información de la Comision Nacional de Bioseguridad
 -->

<template>
	<div>
		<titulo msg="Comisión Nacional de Bioética y Bioseguridad en Salud"/>
<!-- Escrito -->
		<div class="d-flex flex-column p-5 text-justify">
				<div class="d-flex flex-column flex-lg-row flex-xl-row my-3 align-items-center">
					<p>La Comisión Nacional de Bioética y Bioseguridad en Salud es un órgano adscrito al Ministerio del Poder Popular para la Salud, que tiene por objeto normar, regular y supervisar lo relacionado con los aspectos éticos y de bioseguridad de la acción científica y en todas las prácticas relacionadas a salud y la vida humana, constituyendo a su vez un espacio de reflexión y deliberación en la evaluación, asesoramiento y consulta sobre los aspectos referidos. </p>
				</div>
				<p>Tiene como principales funciones:</p>
				<ul>
					<li>a) Vigilar y supervisar todo lo relacionado con los aspectos éticos de la investigación y atención en salud</li>
					<li>b) Asesorar al Ministerio del Poder Popular para la Salud y a otras Instituciones que lo soliciten sobre temas específicos de bioética y bioseguridad </li>
					<li>c) Definir normas éticas para la investigación, promoción en salud, prevención, diagnóstico y tratamiento de las enfermedades.</li>
					<li>d) Promover la creación de Comisiones de Bioética y Bioseguridad en todas las instituciones de salud y supervisar su funcionamiento. </li>
					<li>e) Elaborar los lineamientos para la formación en Bioética y Bioseguridad de los miembros de las Comisiones de Bioética y del personal de las instituciones de Salud. </li>
					<li>f) Recomendar al Ministro o Ministra del Poder popular para la Salud la aprobación o desaprobación de los protocolos de investigaciones nacionales o internacionales que requieren la utilización de procedimientos que afectan de manera directa o indirecta la salud o integridad del ser humano. </li>

				</ul>
				<!-- <div class="d-flex flex-column flex-lg-row flex-xl-row justify-content-center align-items-center">
					<div class="m-3">
							<img src="/images/coordinador-comision.jpg" class="m-1 p-1 border border-succes rounded-sm" width="100">
						</div>
					<b>Dr. Ramón Portillo, Coordinador</b>
				</div> -->
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