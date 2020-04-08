<!--
Ultima Actualización: 16/01/2020

Tipo de componente: Módulo

Donde se usa:
	Home.blade.php (layout)

Descripción:
	aside con algunas noticias y logos asociados
 -->

<template>
  <!-- SideBar -->
  <aside
    class="py-5 d-flex flex-column align-items-center mb-4"
    style="border: 1px solid #dadada; flex-shrink: 2; min-width: 300px"
  >
    <!-- Enlaces de interes -->
    <div
      v-if="images.length > 0"
      class="w-100 d-flex align-items-center flex-wrap justify-content-around px-4"
    >

      <a v-for="image in images" :key="image.id + image.name" target="_blank" :href="image.url" class="image-aside" onclick="return false">
        <img :src="'/storage/' + image.src" />
      </a>
    </div>
    <div
      v-else
      class="w-100 d-flex align-items-center flex-wrap justify-content-around px-4"
    >
      <a target="_blank" href="http://www.minec.gob.ve/" class="image-aside" onclick="return false">
        <img src="/images/logos/logo-minec.png" />
      </a>
      <a target="_blank" href="http://www.thegef.org/" class="image-aside" onclick="return false">
        <img src="/images/logos/logo-gef.png" />
      </a>
      <a target="_blank" href="http://www.insai.gob.ve/" class="image-aside" onclick="return false">
        <img src="/images/logos/logo-insai.jpg" />
      </a>
      <a target="_blank" href="http://www.mindefensa.gob.ve/" class="image-aside" onclick="return false">
        <img src="/images/logos/logo-mindefensa.jpg" />
      </a>
      <a target="_blank" href="#" class="image-aside" onclick="return false">
        <img src="/images/logos/logo-pnud.png" />
      </a>
      <a target="_blank" href="http://mppre.gob.ve" class="image-aside" onclick="return false">
        <img src="/images/logos/logo-minexterior.png" />
      </a>
      <a target="_blank" href="https://www.unenvironment.org/" class="image-aside" onclick="return false">
        <img src="/images/logos/logo-unep.png" />
      </a>
      <a target="_blank" href="https://twitter.com/mitcoex" class="image-aside" onclick="return false">
        <img src="/images/logos/logo-minturismo.png" />
      </a>
      <a target="_blank" href="http://www.minpal.gob.ve" class="image-aside" onclick="return false">
        <img src="/images/logos/logo-minppal15años.png" />
      </a>
      <a target="_blank" href="http://www.mpps.gob.ve" class="image-aside image-h" onclick="return false">
        <img src="/images/logos/logo-minsalud.png" />
      </a>
      <a target="_blank" href="https://bch.cbd.int/" class="image-aside image-h" onclick="return false">
        <img src="/images/logos/logo-biosafety.png" />
      </a>
      <a target="_blank" href="http://bch.cbd.int/?lg=es" class="image-aside image-h" onclick="return false">
        <img src="/images/logos/logo-convencion.png" />
      </a>
    </div>
  </aside>
</template>

<script>
import axios from 'axios';
export default {
  name: "sidebar",
  data: () => ({
    images: []
  }),
  mounted () {
    let _this = this

    axios
      .get('/aside-images')
      .then(res => {
        console.log(res.data)
        _this.images = [...res.data]
      })
      .catch(err => console.log(err))
  }
};
</script>

<style lang="scss">
.image-aside img {
  height: 80px;
  margin: 10px;
}

.image-aside.image-h img {
  height: auto;
  max-width: 100%;
}
</style>
