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
    <b-nav-item class="nav-item" v-for="(link, index) in menuLinks" :key="link.slug + index" :href="'/' + link.slug">
      {{link.title}}

      <b-nav class="sub-nav verde" v-if="link.get_subpages">
        <b-nav-item v-for="sublink in link.get_subpages" :key="sublink.slug" :href="`/${link.slug}/${sublink.slug}`">
          {{sublink.title}}
        </b-nav-item>
      </b-nav>
    </b-nav-item>
  </b-nav>
</template>

<script>
export default {
  name: "nav1",
  props: ['menu-links'],
  data: () => ({
  }),
  mounted () {
    let _this = this
  }
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
    top: 100%;
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
