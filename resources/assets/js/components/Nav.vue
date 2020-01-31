<!--
Ultima Actualización: 20/01/2020

Tipo de componente: Módulo

Donde se usa:
 Home.blade.php (layout)

Descripción:
  Menu con links a las paginas principales, se oculta en los dispositivos moviles
 -->

<template>
  <b-nav class="d-none d-xl-flex d-lg-flex main-nav verde">
    <b-nav-item class="nav-item" v-for="(link, index) in links" :key="link.url + index">
      <router-link :to="link.url">{{link.name}}</router-link>

      <b-nav class="sub-nav verde" v-if="link.sublinks">
        <b-nav-item v-for="sublink in link.sublinks" :key="sublink.url">
          <router-link :to="sublink.url">{{sublink.name}}</router-link>
        </b-nav-item>
      </b-nav>
    </b-nav-item>
  </b-nav>
</template>

<script>
export default {
  name: "nav1",
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
        url: "/preguntas-frecuentes-y-encuestas"
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
  })
};
</script>

<style lang="scss" scoped>
.main-nav {
  text-transform: uppercase;
}

.nav-item {
  flex: 1;
  text-align: center;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  transition: all 0.5s ease;
  overflow: hidden;

  & a {
    color: white;
    display: flex;
    justify-content: center;
    text-decoration: none;
    align-items: center;
    height: 100%;
    width: 100%;
  }

  &:hover {
    background: #55ef6d;
    transition: all 0.5s ease;
    overflow: visible;

    a {
      color: #212529;
    }

    .sub-nav {
      opacity: 1;
      transition: all 0.5s ease;
    }
  }

  .sub-nav {
    transition: all 0.5s ease;
    position: absolute;
    flex-direction: column;
    top: 88px;
    left: 0;
    opacity: 0;
    z-index: 5;
    width: 100%;

    .nav-item {
      width: 100%;
    }
  }
}
</style>
