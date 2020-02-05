<!--
Ultima Actualización: 31/01/2020

Tipo de componente: Módulo

Donde se usa:
	Home.blade.php (layout)

Descripción:
	Contiene el header con la primera imagen con parallax, el logo y el nombre
 -->

 <template>
  <header>
    <slide class="slide"></slide>
    <b-navbar class="d-flex">
      <router-link class="brand d-flex align-items-center" to="/">
        <img src="/images/logos/minec-thumb.png" class="figure" />
        <p class="d-none d-xl-flex d-lg-flex align-items-center">
          Implementación del Marco Nacional de Bioseguridad en Venezuela,
          de acuerdo con el Protocolo de Cartagena sobre Seguridad de la
          Biotecnología 
        </p>
      </router-link>

      <b-navbar-nav class="w-20 d-flex align-items-center ml-auto">
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
      </b-navbar-nav>

    </b-navbar>
  </header>
</template>

<script>
import slide from "../components/Slide.vue";

export default {
  components: {
    slide
  },
  name: "cabecera"
};
</script>

<style scoped lang="scss">
.slide{
  position: absolute;
  height: 100%;
  width: 100%;
  z-index: -1000;
  overflow: hidden;

}
.navbar {
  align-items: flex-start;
  .brand {
    color: #212529;
    width: 80%;
    font-size: 18px;

    img {
      height: 100%;
      margin-right: 10px;
    }

    p {
      margin: 0;
      @media (max-width: 976px) {
        display: none;
      }
    }
  }

  .navbar-nav {
    img {
      height: 100px;
      margin: 0 5px;
    }
  }
}
header {
  height: 40vh;
  overflow: hidden;
  position: relative;

}
li:hover,
a:hover,
li,
a { 
text-decoration: none;
color: #000;
}
</style>
