<!--
Ultima Actualización: 16/01/2020

Tipo de componente: Módulo

Donde se usa:
	Home.blade.php (layout)

Descripción:
	Contiene el header con la primera imagen con parallax, el logo y el nombre
 -->

 <template>
  <header class="verde">
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
          <img src="/images/logos/logo-gef.png" />
        </a>
        <a href="#" onclick="return false">
          <img src="/images/logos/logo-pnud.png" />
        </a>
        <a href="#" onclick="return false">
          <img src="/images/logos/logo-unep.png" />
        </a>
      </b-navbar-nav>

      <!-- <div class="d-flex flex-nowrap align-self-end">
				<a href="ingreso.html"  class="btn m-1 border border-secondary rounded py-1 px-3">Ingresar</a>
				<a href="registro.html"  class="btn m-1 text-white verde btn-verde">Registrarse</a>
      </div>-->
    </b-navbar>
  </header>
</template>

<script>
export default {
  name: "cabecera"
};
</script>

<style scoped lang="scss">
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
  height: 50vh;
  background-image: url("/images/bg-header.jpg");
  background-repeat: no-repeat; /* Indicamos que no se repetira */
  background-size: auto 100%; /* Encajamos la imagen al 100% del ancho */
  background-attachment: fixed;
  background-position: center;
}
</style>
