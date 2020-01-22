<!--
Ultima Actualización: 19/01/2020

Tipo de componente: Módulo

Donde se usa:
 Home.blade.php (layout)

Descripción:
  Menu con links a las paginas principales, se oculta en los dispositivos moviles
 -->

<template>
  <b-nav class="main-nav verde">
    <b-nav-item class="nav-item" v-for="(link, index) in links" :key="link + index">{{link}}</b-nav-item>
  </b-nav>
</template>

<script>
export default {
  name: "nav1",
  data: () => ({
    links: [
      "Proyecto",
      "¿Qué es un transgénico?",
      "¿Quiénes somos?",
      "Preguntas frecuentes y encuestas",
      "Protocolo de Cartagena",
      "Proyectos asociados",
      "Lab. Nacional de detección de OVM",
      "Recursos"
    ],
    sublinks: [
        
    ]
  })
};
</script>

<style lang="scss">
.main-nav {
  text-transform: uppercase;
}

.nav-item {
  flex: 1;
  text-align: center;
  display: flex;
  align-items: center;
  justify-content: center;

  & a {
    color: white;
  }

  &:hover {
    background: #55ef6d;
  }
}
</style>
