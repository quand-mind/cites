<!--
Ultima Actualización: 16/01/2020

Tipo de componente: Vista

Ruta:/proyecto/legislacion-internacional

Descripción:
	Contiene las leyes internacionales
 -->

<template>
  <div>
    <titulo msg="Legislación" />
    <!-- Escrito Leyes-->
    <div class="d-flex flex-column p-5 text-justify">
      <div class="law-item" v-for="law in laws" :key="law.name">
        <div class="name">{{law.name}}</div>
        <a :href="'/storage/files/' + law.url" target="_blank" class="url">Descargar aquí</a>
      </div>
    </div>
  </div>
</template>

<script>
import titulo from "../components/Titulo.vue";

export default {
  components: {
    titulo
  },
  data: () => ({
    laws: [
      {
        name: "Constitución de la República Bolivariana de Venezuela",
        url: "constitución.pdf"
      },
      {
        name: "Plan de la patria",
        url: "plan-de-la-patria.pdf"
      },
      {
        name: "Ley de Gestión de la Diversidad Biológica",
        url: "ley-de-diversidad-biologica.pdf"
      },
      {
        name: "Protocolo de Cartagena",
        url: "protocolo-cartagena.pdf"
      },
      {
        name: "Estrategia de la Biodiversidad",
        url: "estrategia-de-biodiversidad.pdf"
      },
      {
        name: "Gaceta sobre la Ley de semillas",
        url: "gaceta-ley-de-semillas.pdf"
      }
    ]
  })
};
</script>


<style lang="scss">
.law-item {
  display: flex;
  justify-content: space-between;
  padding: 1rem;
}
</style>
