<!--
Ultima Actualización: 6/02/2020

Tipo de componente: Módulo

Donde se usa:
  Home.blade.php (layout)

Descripción:
  Versión movil del menu, esta oculto en la versión para escritorio, y en los dispositivos moviles aparece al apretar el boton
 -->

 <template>
  <div>
    <div id="menu-div" class="w-100">
      <a
      @click="changeBackground"
      v-b-toggle="'menu-mov'"
      id="menu-icon"
      class="navbar-toggler rounded-circle p-3 m-3 shadow border d-xl-none d-lg-none"
      style="background-color: #dadada; cursor: pointer;"
      type="button"
      data-toggle="collapse"
      role="button"
      aria-expanded="false"
      arial-label="Toggle navigation"
    >
      <span class="icon icon-menu h3" style="color: #000;"></span>
    </a></div>
    <!-- Boton Burger -->
    
    <b-collapse id="menu-mov" class="nav">
      <b-nav class="text-uppercase d-xl-none d-lg-none">
        <b-nav-item :to="link.url" button v-b-toggle="'collapse-' + index" class=" nav-item w-100 text-center py-2 text-uppercase font-weight-bold" v-for="(link, index) in links" :key="link.url + index">
          {{link.name}}
          <b-collapse v-if="link.sublinks" :id="'collapse-' + index">
            <b-nav class="w-100 mt-2">
              <b-nav-item class="w-100 nav-item" v-for="sublink in link.sublinks" :key="sublink.url">
                <b-button :to="sublink.url" variant="transparent" class=" w-100">{{sublink.name}}</b-button>
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

      if(this.menu_show) menu.style ="background-color:#2c3e50;"
      else menu.style ="background-color:#fff;"

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

li:hover,
a:hover,
li,
a {
  text-decoration: none;
  color: #fff !important;
}
.nav-item{
  background-color: #2c3e50;
  &:hover{
      background-color: #00a96d !important;
    }
}
.nav{
  background-color: #2c3e50;
}
.nav-link{
  padding: 0 !important;
}
#menu-div{
  background-color: white;
  transition: 0.2s;
}
</style>

