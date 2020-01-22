<!--
Ultima Actualización: 16/01/2020

Tipo de componente: Vista

Ruta:/somos/objetivos

Descripción:
	Descripción de los objetivos del proyecto
 -->

<template>
  <div>
    <titulo msg="Objetivos" />
    <!-- Escrito solo texto-->
    <p
      class="p-5 p-xl-4 p-lg-4 text-justify"
    >El Convenio sobre Diversidad Biológica (CDB) es el primer acuerdo mundial enfocado a la conservación y el uso sustentable de la diversidad biológica. Lo han ratificado 191 países.</p>

    <p class="p-5 p-xl-4 p-lg-4 text-justify">
      El CDB tiene tres objetivos principales:
      <br />
      <br />
      <ul>
          <li>La conservación de la biodiversidad.</li>
          <li>El uso sostenible de los componentes de la diversidad biológica.</li>
          <li>La participación justa y equitativa en los beneficios derivados del uso de los recursos genéticos.</li>
        </ul>
    </p>

  </div>
</template>

<script>
import titulo from "../components/Titulo.vue";

export default {
  components: {
    titulo
  }
};
</script>
