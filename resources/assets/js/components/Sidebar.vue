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
    class="py-5 d-flex flex-column align-items-center"
    style="border: 1px solid #dadada; flex-shrink: 2; min-width: 300px"
  >
    <!-- Enlaces de interes -->
    <h3>Enlaces de interés</h3>
    <div
      class="w-100 d-flex align-items-center flex-wrap justify-content-around my-5 px-4"
      style="max-width: 300px"
    >
      <a href="http://www.minec.gob.ve/" class="image-aside" onclick="return false">
        <img src="/images/logos/logo-minec.png" />
      </a>
      <a href="http://www.thegef.org/" class="image-aside" onclick="return false">
        <img src="/images/logos/logo-gef.png" />
      </a>
      <a
        href="https://www.conacyt.gob.mx/cibiogem/index.php/cibiogem/acerca-de-la-cibiogem"
        class="image-aside"
        onclick="return false"
      >
        <img src="/images/logos/logo-cibiogem.png" />
      </a>
      <a href="http://registrosigefor.minec.gob.ve/" class="image-aside" onclick="return false">
        <img src="/images/logos/logo-sigefor.png" />
      </a>
      <a href="#" class="image-aside" onclick="return false">
        <img src="/images/logos/logo-pnud.png" />
      </a>
      <a href="#" class="image-aside" onclick="return false">
        <img src="/images/logos/logo-unep.png" />
      </a>
      <a href="http://www.bioseguridadecuador.gob.ec/" class="image-aside" onclick="return false">
        <img src="/images/logos/logo-ciisb.png" />
      </a>
      <a href="http://bch.cbd.int/?lg=es" class="image-aside" onclick="return false">
        <img src="/images/logos/logo-convencion.png" />
      </a>
    </div>
  </aside>
</template>

<script>
export default {
  name: "sidebar"
};
</script>

<style lang="scss">
.image-aside img {
  height: 80px;
  margin: 10px;
}
</style>
