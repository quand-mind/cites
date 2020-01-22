<!-- 
Ultima Actualización: 20/01/2020

Tipo de componente: Módulo

Donde se usa:
 Home.blade.php (layout)

Descripción:
  Menu con links a las paginas principales, se oculta en los dispositivos moviles
 -->

<template>
  <div>
    <b-nav class="verde collapse d-lg-flex d-xl-flex justify-content-center" align="center" small >
      <div class="d-flex w-90">
      <b-dropdown id="dropdown-1" variant="verde" toggle-class="text-white px-3" size="sm">
          <template v-slot:button-content >
            <strong class="text-white text-uppercase">Proyecto</strong>
          </template>
          <b-dropdown-item to="/proyecto/comision-nacional-de-bioseguridad" class="text-uppercase">Comisión Nacional de Bioética y Bioseguridad en Salud</b-dropdown-item>
          <b-dropdown-item to="/proyecto/acuerdos-internacionales" class="text-uppercase">Acuerdos Internacionales</b-dropdown-item>
          <b-dropdown-item to="/proyecto/legislacion-internacional" class="text-uppercase">Legislación Internacional</b-dropdown-item>
          <b-dropdown-item to="/proyecto/antecedentes-y-justificacion" class="text-uppercase">Antecedentes y Justificación</b-dropdown-item>
      </b-dropdown>
      <b-nav-item link-classes="h-100 text-center font-weight-bold text-white btn-verde rounded px-3 text-uppercase p-auto" to="/transgenico">Qué es un transgénico</b-nav-item>
      <b-dropdown id="dropdown-1" variant="verde" toggle-class="text-white px-3" size="sm">
          <template v-slot:button-content>
            <strong class="text-white text-uppercase">Quienes Somos</strong>
          </template>
          <b-dropdown-item to="/somos/grupos" class="text-uppercase">Grupos</b-dropdown-item>
          <b-dropdown-item to="/somos/objetivos" class="text-uppercase">Objetivos</b-dropdown-item>
          <b-dropdown-item to="/somos/mision" class="text-uppercase">Misión</b-dropdown-item>
          <b-dropdown-item to="/somos/vision" class="text-uppercase">Visión</b-dropdown-item>
      </b-dropdown>
      <b-nav-item link-classes="h-100 text-center font-weight-bold text-white btn-verde rounded px-3 text-uppercase" to="/preguntas-frecuentes-encuestas">Preguntas Frecuentes y Encuestas</b-nav-item>
      <b-dropdown id="dropdown-1" variant="verde" toggle-class="text-white px-3" size="sm">
          <template v-slot:button-content>
            <strong class="text-white text-uppercase">Protocolo de Cartagena</strong>
          </template>
          <b-dropdown-item to="/protocolo/" class="text-uppercase">El Protocolo</b-dropdown-item>
          <b-dropdown-item to="/protocolo/mitos-realidades" class="text-uppercase">Mitos y Realidades</b-dropdown-item>
          <b-dropdown-item to="/protocolo/ovm-territorio-nacional" class="text-uppercase">¿Qué hacer si entra otro tipo de OVM al territorio nacional?</b-dropdown-item>
          <b-dropdown-item to="/protocolo/preguntas-frecuentes" class="text-uppercase">Preguntas Frecuentes sobre el protocolo</b-dropdown-item>
          <b-dropdown-item to="/protocolo/recursos" class="text-uppercase">Recursos</b-dropdown-item>
      </b-dropdown>
      <b-dropdown id="dropdown-1" variant="verde" toggle-class="text-white px-3" size="sm">
          <template v-slot:button-content>
            <strong class="text-white text-uppercase">Proyectos Asociados</strong>
          </template>
          <b-dropdown-item to="/asociados/nagoya-lumpur" class="text-uppercase">Nagoya-Lumpur</b-dropdown-item>
      </b-dropdown>
      <b-nav-item link-classes="h-100 text-center font-weight-bold text-white btn-verde rounded px-3 text-uppercase" to="/laboratorio-nacional-ovm">Lab. Nacional de detección de OVM</b-nav-item size="sm">
      <b-dropdown id="dropdown-1" variant="verde" toggle-class="text-white px-3" size="sm">
          <template v-slot:button-content>
            <strong class="text-white text-uppercase">Recursos</strong>
          </template>
          <b-dropdown-item to="/recursos/ovm-venezuela" class="text-uppercase">Información sobre OVM en Venezuela</b-dropdown-item>
          <b-dropdown-item to="/recursos/portales" class="text-uppercase">Portales de la temática</b-dropdown-item>
          <b-dropdown-item to="/recursos/formularios" class="text-uppercase">Formularios de uso Común</b-dropdown-item>
          <b-dropdown-item to="/recursos/mapa-del-sitio" class="text-uppercase">Mapa del sitio</b-dropdown-item>
          <b-dropdown-item to="/recursos/glosario" class="text-uppercase">Glosario</b-dropdown-item>
      </b-dropdown>
      </div>
    </b-nav>
  </div> 
</template>

<script>
export default {
  name: "nav1"
};
</script>

<style scoped>
<<<<<<< HEAD
  .verde{
    background-color: #00a96d!important
  }
  .btn-verde{
    background-color: #00a96d;
  }
  .btn-verde:hover{
    background-color: #009462;
  }
  .dropdown-menu{
    margin: 0;
  }
  .nav-link{
    display: flex;
    align-items: center;
    justify-content: center;
  }

/*li:hover,
=======
li:hover,
a:hover,
li,
a {
  text-decoration: none;
  color: #000;
}
.submenu {
  max-width: 250px;
  display: none;
}
nav ul li:hover > .submenu {
  display: block;
  z-index: 1000;
}

* {
  box-sizing: content-box;
  padding: 0px;
  margin: 0px;
}
li {
  list-style: none;
}*/
</style>
