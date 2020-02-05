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
    <b-nav
      class="nav justify-content-center p-0 text-uppercase fixed-top h-100  d-xl-none d-lg-none navbar-expand fade azul"
      id="menu-mov"
    >
      <b-nav-item v-on:click="() => link.sublinks ? false : closeNav()" class="nav-item" v-for="(link, index) in links" :key="link.url + index">
      <b-button class="p-0 bg-transparent border-0 " v-b-toggle.collapse-menu :to="link.url">{{link.name}}</b-button>

      <b-collapse id="collapse-menu" class="sub-nav azul" v-if="link.sublinks">
        <b-nav-item v-on:click="closeNav" v-for="sublink in link.sublinks" :key="sublink.url">
          <router-link :to="sublink.url" class="text-white">{{sublink.name}}</router-link>
        </b-nav-item>
      </b-collapse>
    </b-nav-item>
    </b-nav>
  </div>
</template>

<script>
export default {
  name: "nav-mobile",
  data: () => ({
    links: [
      {
        name: "Proyecto",
        url: "#",
        sublinks: [
          {
            name: "Comisión Nacional de Bioética y Bioseguridad en Salud",
            url: "/proyecto/comision-nacional-de-bioseguridad"
          },
          {
            name: "Acuerdos Internacionales",
            url: "/proyecto/acuerdos-internacionales"
          },
          {
            name: "Legislación",
            url: "/proyecto/legislacion"
          },
          {
            name: "Antecedentes y Justificación",
            url: "/proyecto/antecedentes-y-justificacion"
          }
        ]
      },
      {
        name: "¿Qué es un transgénico?",
        url: "/transgenico"
      },
      {
        name: "¿Quiénes somos?",
        url: "#",
        sublinks: [
          {
            name: "Grupos",
            url: "/somos/grupos"
          },
          {
            name: "Objetivos",
            url: "/somos/objetivos"
          },
          {
            name: "Misión",
            url: "/somos/mision"
          },
          {
            name: "Visión",
            url: "/somos/vision"
          }
        ]
      },
      {
        name: "Preguntas frecuentes y encuestas",
        url: "#",
        sublinks: [
          {
            name: "Preguntas Frecuentes",
            url: "/preguntas-frecuentes"
          },
          {
            name: "Encuestas",
            url: "/encuestas"
          }
        ]
      },
      {
        name: "Protocolo de Cartagena",
        url: "#",
        sublinks: [
          {
            name: "Mitos y Realidades",
            url: "/protocolo/mitos-realidades"
          },
          {
            name:
              "¿Qué hacer si entra otro tipo de OVM al territorio nacional?",
            url: "/protocolo/ovm-territorio-nacional"
          },
          {
            name: "FAQS sobre el protocolo",
            url: "/protocolo/preguntas-frecuentes"
          },
          {
            name: "Recursos",
            url: "/protocolo/recursos"
          }
        ]
      },
      {
        name: "Proyectos asociados",
        url: "#",
        sublinks: [
          {
            name: "Nagoya-Lumpur",
            url: "/asociados/nagoya-lumpur"
          }
        ]
      },
      {
        name: "Lab. Nacional de detección de OVM",
        url: "/laboratorio-nacional-ovm"
      },
      {
        name: "Recursos",
        url: "#",
        sublinks: [
          {
            name: "Información sobre OVM en Venezuela",
            url: "/recursos/ovm-venezuela"
          },
          {
            name: "Portales de la temática",
            url: "/recursos/portales"
          },
          {
            name: "Formularios de uso común",
            url: "/recursos/formularios"
          },
          {
            name: "Mapa del sitio",
            url: "/recursos/mapa-del-sitio"
          },
          {
            name: "Glosario",
            url: "/recursos/glosario"
          }
        ]
      }
    ]
  }),
  methods: {
    closeNav () {
      document.getElementById('menu-mov').classList.toggle('show');
    }
  }
};
</script>

<style lang="scss" scoped>
.nav{
  display: flex;
  flex-direction: column;
  width: 50vw;
   @media (max-width: 460px) {
        width: 75vw;
      }
}
b-button:active, b-button:focus, b-button:hover{
    border: 0px;
}
.nav-item {
  flex: 1;
  text-align: center;
  display: flex;
  align-items: center;
  justify-content: center;
  /*position: relative;*/
  transition: all 0.5s ease;
  overflow: hidden;

  & a {
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-decoration: none;
    align-items: center;
    flex-wrap: wrap;
    height: 100%;
    width: 100%;
  }

  &:hover {
    /*background: #55ef6d;*/
    transition: all 0.5s ease;
    overflow: visible;

    a {
      /*color: #212529;*/
      display: flex;
      flex-wrap: nowrap;
    }

    .sub-nav {
      opacity: 1;
      transition: all 0.5s ease;
    }
  }

  /*&:last-child {
    .sub-nav{
      top: auto;
      bottom: 0px;
    }
  }
*/

  .sub-nav {
    transition: all 0.5s ease;
    /*position: absolute;*/
    flex-direction: column;
    /*top: 0;*/
    /*left: 100%;*/
    opacity: 0;
    z-index: 5;
    width: 80%;
    .nav-item {
      width: 100%;
    }
  }
}

li:hover,
a:hover,
li,
a {
  text-decoration: none;
  color: #fff;
}
.azul{
background-color: #2c3e50
}


</style>
