<!--
Ultima Actualización: 6/02/2020

Tipo de componente: Módulo

Donde se usa:
  Home.blade.php (layout)

Descripción:
  Versión movil del menu, esta oculto en la versión para escritorio, y en los dispositivos moviles aparece al apretar el boton
 -->

 <template>
  <div class="h-100 fixed-top d-block d-xl-none d-lg-none" id="all" style=" z-index: 800 !important; ">
    <div id="menu-div" class="d-flex w-100 justify-content-around align-items-center">
      <router-link class="brand d-flex align-items-center" to="/">
        <img src="/images/logos/minec-thumb.png" class="figure" />
        <p class="d-none d-xl-flex d-lg-flex align-items-center">
          Implementación del Marco Nacional de Bioseguridad en Venezuela,
          de acuerdo con el Protocolo de Cartagena sobre Seguridad de la
          Biotecnología 
        </p>
      </router-link>
        <a href="#" onclick="return false">
          <img src="/images/logos/logo-minec.png" />
        </a>
        <a href="#" onclick="return false">
          <img src="/images/logos/logo-gef.png" />
        </a>
        <a href="#" onclick="return false">
          <img src="/images/logos/logo-pnud.png" />
        </a>
        <a href="#" onclick="return false">
          <img src="/images/logos/logo-unep.png" />
        </a>
      
      <a
      @click="changeBackground"
      v-b-toggle="'menu-mov'"
      id="menu-icon"
      class="navbar-toggler rounded-circle p-3 m-3 shadow border d-xl-none d-lg-none"
      style="background-color: #dadada; cursor: pointer; position: relative;"
      type="button"
      data-toggle="collapse"
      role="button"
      aria-expanded="false"
      arial-label="Toggle navigation"
    >
      <span class="icon icon-menu h3" style="color: #000;"></span>
    </a></div>
    <!-- Boton Burger -->
    
    <b-collapse id="menu-mov" class="nav h-100">
      <b-nav class="text-uppercase d-xl-none d-lg-none d-flex align-items-center justify-content-start">
        <b-nav-item :to="link.slug" button v-b-toggle="'collapse-' + index" class=" nav-item w-100 text-center py-2 text-uppercase font-weight-bold" v-for="(link, index) in links" :key="link.slug + index">
          {{link.title}}
          <b-collapse v-if="link.sublinks" :id="'collapse-' + index">
            <b-nav class="w-100 mt-2">
              <b-nav-item class="w-100 nav-item" v-for="sublink in link.sublinks" :key="sublink.slug">
                <b-button :to="sublink.url" variant="transparent" class=" w-100">{{sublink.title}}</b-button>
              </b-nav-item>
            </b-nav>
          </b-collapse>
        </b-nav-item>
      </b-nav>
    </b-collapse>
    
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
        ]      },
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
    ],
    menu_show: true
  }),
  methods: {
    
    changeBackground(){
      var menu = document.getElementById('menu-div')
      var all = document.getElementById('all')

      if(this.menu_show){ 
        menu.style ="background-color:#2c3e50;"
        all.style="z-index:1000;"
      }
      else{
        all.style="z-index:800;"
        menu.style ="background: white;"
      } 

      this.menu_show = !this.menu_show
    }
  }
};
</script>

<style lang="scss" scoped>

.sub-nav {
    transition: all 2s ease;
    flex-direction: column;
    align-items: center;
    background-color: #2c3e50;
  width: 70%;
    .nav-link{
      width: 250px;
      text-align: center;
    }
    a:hover{
      background-color: #00a96d;
    }
}
img {
    height: 70px;
    margin: 0 5px;
  }

li:hover,
a:hover,
li,
a {
  text-decoration: none;
  color: #fff !important;
}
.nav-item{
  background-color: #2c3e50;
  height: fit-content;
  &:hover{
      background-color: #00a96d !important;
    }
}
.nav{
  background-color: #2c3e50;
  flex-wrap: nowrap !important;
  flex-direction: column;
}
.nav-link{
  padding: 0 !important;
}
#menu-div{
  background-color: white;
  transition: 0.2s;
}
</style>

