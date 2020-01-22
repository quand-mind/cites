<!--
Ultima Actualización: 19/01/2020

Tipo de componente: Módulo

Donde se usa:
  Home.blade.php (layout)

Descripción:
  Versión movil del menu, esta oculto en la versión para escritorio, y en los dispositivos moviles aparece al apretar el boton
 -->

 <template>
  <div>
    <!-- Boton Burger -->
    <a
      href="#menu-mov"
      class="navbar-toggler rounded-circle p-3 m-3 shadow border fixed-bottom d-xl-none d-lg-none"
      style="right: 0; left: auto; background-color: #dadada"
      type="button"
      data-toggle="collapse"
      role="button"
      aria-expanded="false"
      aria-controls="menu-mov"
      arial-label="Toggle navigation"
    >
      <span class="icon icon-menu h3" style="color: #000;"></span>
    </a>

    <!-- barra movil -->
    <nav
      class="nav justify-content-center p-0 text-uppercase w-75 fixed-top h-100 collapse d-xl-none d-lg-none navbar-expand fade"
      id="menu-mov"
      style="background-color: #2c3e50 "
    >
      <!-- menu2 movil-->
      <ul
        class="d-flex flex-column justify-content-center w-90 h-100 m-0 align-items-stretch p-0 flex-nowrap container"
      >
        <li class="p-2 d-flex align-items-center">
          <a class="btn px-1 font-weight-bold text-white" href="#" onclick="return false">Proyecto</a>
          <!-- Submenu -->
          <ul class="verde position-absolute submenu-movil" style="left: 20%; top:10%">
            <router-link to="/proyecto/comision-nacional-de-bioseguridad">
              <li
                class="p-3 text-white font-weight-bold btn-verde"
              >Comisión Nacional de Bioética y Bioseguridad en Salud</li>
            </router-link>
            <router-link to="/proyecto/acuerdos-internacionales">
              <li class="p-3 text-white font-weight-bold btn-verde">Acuerdos Internacionales</li>
            </router-link>
            <router-link to="/proyecto/legislacion-internacional">
              <li class="p-3 text-white font-weight-bold btn-verde">Legislación Internacional</li>
            </router-link>
            <router-link to="/proyecto/antecedentes-y-justificacion">
              <li class="p-3 text-white font-weight-bold btn-verde">Antecedentes y Justificación</li>
            </router-link>
          </ul>
        </li>
        <li class="p-2 d-flex align-items-center">
          <router-link
            to="/transgenico"
            class="btn p-1 font-weight-bold text-white"
          >Qué es un transgénico</router-link>
        </li>
        <!--  <li class="p-2 d-flex align-items-center"><router-link to="/noticias" class="btn p-1 font-weight-bold text-white">Noticias</router-link></li> -->
        <li class="p-2 d-flex align-items-center">
          <a
            href="#"
            onclick="return false"
            class="btn p-1 font-weight-bold text-white"
          >Quienes somos</a>
          <!-- Submenu -->
          <ul class="verde position-absolute submenu-movil" style="left: 20%;">
            <router-link to="/somos/grupos">
              <li class="p-3 text-white font-weight-bold btn-verde">Grupos</li>
            </router-link>
            <router-link to="/somos/objetivos">
              <li class="p-3 text-white font-weight-bold btn-verde">Objetivos</li>
            </router-link>
            <router-link to="/somos/mision">
              <li class="p-3 text-white font-weight-bold btn-verde">Misión</li>
            </router-link>
            <router-link to="/somos/vision">
              <li class="p-3 text-white font-weight-bold btn-verde">Visión</li>
            </router-link>
          </ul>
        </li>
        <li class="p-2 d-flex align-items-center">
          <router-link
            to="/preguntas-frecuentes-y-encuestas"
            class="btn p-1 font-weight-bold text-white"
          >Preguntas Frecuentes y Encuestas</router-link>
        </li>
        <li class="p-2 d-flex align-items-center">
          <a
            href="#"
            onclick="return false"
            class="btn p-1 font-weight-bold text-white"
          >Protocolo de Cartagena</a>
          <!-- Submenu -->
          <ul class="verde position-absolute submenu-movil" style="left: 20%;">
            <router-link to="/protocolo/">
              <li class="p-3 text-white font-weight-bold btn-verde">El Protocolo</li>
            </router-link>
            <router-link to="/protocolo/mitos-realidades">
              <li class="p-3 text-white font-weight-bold btn-verde">Mitos y Realidades</li>
            </router-link>
            <router-link to="/protocolo/ovm-territorio-nacional">
              <li
                class="p-3 text-white font-weight-bold btn-verde"
              >¿Qué hacer si entra otro tipo de OVM al territorio nacional?</li>
            </router-link>
            <router-link to="/protocolo/faqs">
              <li
                class="p-3 text-white font-weight-bold btn-verde"
              >Preguntas Frecuentes sobre el protocolo</li>
            </router-link>
            <router-link to="/protocolo/recursos">
              <li class="p-3 text-white font-weight-bold btn-verde">Recursos</li>
            </router-link>
          </ul>
        </li>
        <li class="p-2 d-flex align-items-center">
          <a
            href="#"
            onclick="return false"
            class="btn p-1 font-weight-bold text-white"
          >Proyectos asociados</a>
          <!-- Submenu -->
          <ul class="verde position-absolute submenu-movil" style="left: 20%;">
            <router-link to="/asociados/nagoya-lumpur">
              <li class="p-3 text-white font-weight-bold btn-verde">Nagoya-Lumpur</li>
            </router-link>
          </ul>
        </li>
        <li class="p-2 d-flex align-items-center">
          <router-link
            to="/laboratorio-nacional-ovm"
            class="btn p-1 font-weight-bold text-white"
          >Lab. Nacional de detección de OVM</router-link>
        </li>
        <li class="p-2 d-flex align-items-center">
          <a href="#" onclick="return false" class="btn p-1 font-weight-bold text-white">Recursos</a>
          <!-- Submenu -->
          <ul class="verde position-absolute submenu-movil" style="left: 20%; bottom: 10%;">
            <router-link to="/recursos/ovm-venezuela">
              <li
                class="p-3 text-white font-weight-bold btn-verde"
              >Información sobre OVM en Venezuela</li>
            </router-link>
            <router-link to="/recursos/portales">
              <li class="p-3 text-white font-weight-bold btn-verde">Portales de la temática</li>
            </router-link>
            <router-link to="/recursos/formularios">
              <li class="p-3 text-white font-weight-bold btn-verde">Formularios de uso Común</li>
            </router-link>
            <router-link to="/recursos/mapa-del-sitio">
              <li class="p-3 text-white font-weight-bold btn-verde">Mapa del sitio</li>
            </router-link>
            <router-link to="/recursos/glosario">
              <li class="p-3 text-white font-weight-bold btn-verde">Glosario</li>
            </router-link>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  name: "nav-mobile"
};
</script>

<style scoped>
li:hover,
a:hover,
li,
a {
  text-decoration: none;
  color: #000;
}
.submenu-movil {
  max-width: 250px;
  display: none;
}

nav ul router-link:hover {
  background-color: #00a96d;
}
nav ul li:hover > .submenu-movil {
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
}
</style>
