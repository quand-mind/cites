<!-- 
Ultima Actualización: 16/01/2020

Tipo de componente: Vista

Ruta:/proyecto/acuerdos-internacionales

Descripción:
	Contiene los acuerdos internacionales
 -->

 <template>
	<div>
		<titulo msg="Acuerdos Internacionales"/>
<!-- Escrito Leyes-->
		<div class="d-flex flex-column p-5 text-justify">
			
				<div class="d-flex flex-column flex-lg-row flex-xl-row my-3 align-items-center">
					<p>El  Convenio sobre Diversidad Biológica (CDB) es el primer acuerdo mundial enfocado a la conservación y el uso sustentable de la diversidad biológica. Lo han ratificado 191 países. </p>
				</div>
				<p>El CDB tiene tres objetivos principales: </p>
				<ul>
					<li>La conservación de la biodiversidad</li>
					<li>El uso sostenible de los componentes de la diversidad biológica</li>
					<li>La participación justa y equitativa en los beneficios derivados del uso de los recursos genéticos.</li>
				</ul>
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