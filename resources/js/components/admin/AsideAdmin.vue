<template>
  <aside class="dashboard-aside" :class="{ open: isOpen }">
    <div class="timer">
      ¡{{ timeState }}, {{ user.name }}!
      <br />
      {{
      timeNow.format("DD/MM/YYYY - hh:mm:ssa")
      }}
    </div>
    <button class="menu-trigger bg-dark" @click="isOpen = !isOpen">
      <font-awesome-icon
        :icon="!isOpen ? ['fas', 'angle-right'] : ['fas', 'angle-left']"
        color="white"
        size="lg"
      ></font-awesome-icon>
    </button>
    <div class="list-group">
      <a v-if="this.user.role !== 'writer' && this.user.role !== 'funcionario'" href="/dashboard/users" class="list-group-item list-group-item-action">
        <font-awesome-icon :icon="['fas', 'users']"></font-awesome-icon>&nbsp;Usuarios
      </a>
      <a v-if="this.user.role !== 'funcionario'" href="/dashboard/pages" class="list-group-item list-group-item-action">
        <font-awesome-icon :icon="['fas', 'book-open']"></font-awesome-icon>&nbsp;Páginas
      </a>
      <a v-if="this.user.role !== 'writer' && this.user.role !== 'funcionario'" href="/dashboard/menu" class="list-group-item list-group-item-action">
        <font-awesome-icon :icon="['fas', 'pager']"></font-awesome-icon>&nbsp;Menú
      </a>
      <!-- <a href="/dashboard/posts" class="list-group-item list-group-item-action">
        <font-awesome-icon :icon="['fas', 'newspaper']"></font-awesome-icon>&nbsp;Noticias
      </a> -->
      <a v-if="this.user.role !== 'writer' && this.user.role !== 'funcionario'" href="/dashboard/questions" class="list-group-item list-group-item-action">
        <font-awesome-icon :icon="['fas', 'question-circle']"></font-awesome-icon>&nbsp;Preguntas frecuentes
      </a>
      <!-- <a href="/dashboard/questions-categories" class="list-group-item list-group-item-action">
        <font-awesome-icon :icon="['fas', 'th-list']"></font-awesome-icon>&nbsp;Categorías de preguntas
      </a>-->
      <a v-if="this.user.role !== 'funcionario'" href="/dashboard/surveys" class="list-group-item list-group-item-action">
        <font-awesome-icon :icon="['fas', 'poll']"></font-awesome-icon>&nbsp;Encuestas
      </a>
      <a v-if="this.user.role !== 'funcionario'" href="/dashboard/acronimos" class="list-group-item list-group-item-action">
        <font-awesome-icon :icon="['fas', 'list']"></font-awesome-icon>&nbsp;Acrónimos
      </a>
      <a v-if="this.user.role !== 'funcionario'" href="/dashboard/glosary" class="list-group-item list-group-item-action">
        <font-awesome-icon :icon="['fas', 'book']"></font-awesome-icon>&nbsp;Glosario
      </a>
      <a v-if="this.user.role !== 'funcionario'" href="/dashboard/laws" class="list-group-item list-group-item-action">
        <font-awesome-icon :icon="['fas', 'gavel']"></font-awesome-icon>&nbsp;Legislación
      </a>
      <a v-if="this.user.role !== 'writer' && this.user.role !== 'funcionario'" href="/dashboard/header-manager" class="list-group-item list-group-item-action">
        <font-awesome-icon :icon="['fas', 'images']"></font-awesome-icon>&nbsp;Imágenes de Cabecera
      </a>
      <a v-if="this.user.role !== 'writer' && this.user.role !== 'funcionario'" href="/dashboard/aside-manager" class="list-group-item list-group-item-action">
        <font-awesome-icon :icon="['fab', 'elementor']"></font-awesome-icon>&nbsp;Panel lateral
      </a>
      <a v-if="this.user.role !== 'writer' && this.user.role !== 'funcionario'" href="/dashboard/social-links" class="list-group-item list-group-item-action">
        <font-awesome-icon :icon="['fas', 'link']"></font-awesome-icon>&nbsp;Social links
      </a>
      <a v-if="this.user.role !== 'writer'" href="/dashboard/permissions/" class="list-group-item list-group-item-action">
        <font-awesome-icon :icon="['fas', 'clipboard-check']"></font-awesome-icon>&nbsp;Solicitud de Permisos
      </a>
      <a v-if="this.user.role !== 'writer'" href="/dashboard/permissions/requerimentsView" class="list-group-item list-group-item-action">
        <font-awesome-icon :icon="['fas', 'list-ol']"></font-awesome-icon>&nbsp;Recaudos
      </a>
      <a v-if="this.user.role !== 'writer'" href="/dashboard/permissions/permitsView" class="list-group-item list-group-item-action">
        <font-awesome-icon :icon="['fas', 'sticky-note']"></font-awesome-icon>&nbsp;Permisos
      </a>
      <a v-if="this.user.role !== 'writer'" href="/dashboard/permissions/graphics" class="list-group-item list-group-item-action">
        <font-awesome-icon :icon="['fas', 'chart-pie']"></font-awesome-icon>&nbsp;Gráficas
      </a>
      <a v-if="this.user.role !== 'writer'" href="/dashboard/species/speciesDetails" class="list-group-item list-group-item-action">
        <font-awesome-icon :icon="['fas', 'otter']"></font-awesome-icon>&nbsp;Tabla de Especies
      </a>
    </div>
  </aside>
</template>

<script>
import moment from "moment";

export default {
  props: ["user", "iswriter"],
  data: () => ({
    isOpen: false,
    timeNow: moment(),
  }),
  computed: {
    timeState: function() {
      if (this.timeNow.format("H") >= 5 && this.timeNow.format("H") < 12)
        return "Buenos días";
      else if (this.timeNow.format("H") >= 12 && this.timeNow.format("H") < 6)
        return "Buenas tardes";
      else return "Buenas noches";
    }
  },
  mounted() {
    setInterval(() => {
      this.timeNow = moment();
    }, 1000);
  }
};
</script>

<style lang="scss">
.dashboard-aside {
  position: absolute;
  left: 0;
  top: 57px;
  width: 250px;
  height: auto;
  min-height: calc(100vh - 55px);
  padding: 2rem;
  z-index: 700;
  transform: translateX(-215px);

  display: flex;
  align-items: center;
  flex-direction: column;

  background: white;
  box-shadow: 0 5px 5px rgba(100, 100, 100, 0.3);

  transition: all 0.5s ease;

  &.open {
    transform: translateX(0px);
    transition: all 0.5s ease;
  }
}

.menu-trigger {
  position: absolute;
  right: 10px;
  z-index: 2;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50px;
  border: none;
  outline: none;
  width: 1.5rem;
  height: 1.5rem;
}

.timer {
  margin-bottom: 2rem;
}
</style>
