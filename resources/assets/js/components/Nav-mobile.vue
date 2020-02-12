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
      <a class="brand d-flex align-items-center" href="/">
        <img src="/images/logos/minec-thumb.png" class="figure" />
        <p class="d-none d-xl-flex d-lg-flex align-items-center">
          Implementación del Marco Nacional de Bioseguridad en Venezuela,
          de acuerdo con el Protocolo de Cartagena sobre Seguridad de la
          Biotecnología 
        </p>
      </a>
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
        <b-nav-item v-for="(link, index) in links" :href="link.slug"  class="nav-item w-100 text-start py-2 text-uppercase font-weight-bold d-flexw-100"  :key="link.slug + index">
          <div class="nav-title w-100 d-flex justify-content-between">
            <span class="ml-5">{{link.title}}</span>
            <b-button class="ml-1 mr-5" v-if="link.get_subpages.length > 0" href="#" v-b-toggle="'collapse-' + index">
              <font-awesome-icon
              :icon="!isOpen ? ['fas', 'caret-down'] : ['fas', 'caret-down']"
              color="black"
              size="lg"
              ></font-awesome-icon>
            </b-button>
          </div>          
          <b-collapse v-if="link.get_subpages.length > 0" :id="'collapse-' + index">
            <b-nav class="subnav w-100 mt-2">
              <b-nav-item class="w-100 nav-item text-center" :href="sublink.slug" v-for="sublink in link.get_subpages" :key="sublink.slug">{{sublink.title}}</b-nav-item>
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
  props: ["menu-links"],
  data: () => ({
    links: [],
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
  },
  mounted () {
    let _this = this
    _this.links = _this.menuLinks.map(mainLink => {
      if (mainLink.get_subpages !== null && mainLink.get_subpages.length > 0) {
        mainLink.get_subpages = mainLink.get_subpages.filter(sublink => Boolean(parseInt(sublink.is_active)))
      }

      return mainLink
    })
  }
};
</script>

<style lang="scss" scoped>

.nav-link{
  width: 100%;
}
.subnav .nav-item{
  background: #00a96d;
  padding: 5px 0px;
}
img {
    height: 70px;
    margin: 0 10px;
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

