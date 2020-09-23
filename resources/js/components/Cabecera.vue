<!--
Ultima Actualización: 31/01/2020

Tipo de componente: Módulo

Donde se usa:
	Home.blade.php (layout)

Descripción:
	Contiene el header con la primera imagen con parallax, el logo y el nombre
 -->

 <template>
 <div class="w-100">
   <header class=" one d-none d-lg-block">
    <slide class="slide"></slide>
    <b-navbar class="">
      <a class="brand d-flex align-items-center" href="/">
        <img src="/images/logos/minec-thumb.png" class="figure" />
        <p class="d-none d-xl-flex d-lg-flex align-items-center">
          Implementación del Marco Nacional de Bioseguridad en Venezuela,
          de acuerdo con el Protocolo de Cartagena sobre Seguridad de la
          Biotecnología 
        </p>
      </a>

      <b-navbar-nav class=" w-20 d-flex align-items-center ml-auto">
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
  <header class="two d-sm-block d-lg-none">
    <slide class="slide"></slide>
  </header>
 </div>
  
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
  align-items: center;
  justify-content: center;

  .brand {
    color: white;
    width: 80%;
    font-size: 18px;

    img {
      height: 100%;
      margin-right: 10px;
    }

    p {
      margin: 0;
      text-shadow: 2px 3px 5px rgba(20, 20, 20);

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
.one {
  height: 40vh;
  overflow: hidden;
  position: relative;
}
.two{
    height: 40vh;
    overflow: hidden;
    position: relative;
    margin-top:56px;
}

.two .navbar ul a img{
  height: 70px !important;
}
.two .navbar ul{
  width: 100%;
  flex-wrap: wrap;
}
.figure{
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
