<template>
  <aside class="dashboard-aside" :class="{ open: isOpen }">
    <div class="timer">
      ¡{{ timeState }}, {{ user.name }}
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
      <a href="/solicitante/permissions/list" class="list-group-item list-group-item-action">
        <font-awesome-icon :icon="['fas', 'clipboard']"></font-awesome-icon>&nbsp;Listado de Permisos
      </a>
      <a href="/solicitante/permissions/" class="list-group-item list-group-item-action">
        <font-awesome-icon :icon="['fas', 'id-badge']"></font-awesome-icon>&nbsp;Mis Permisos
      </a>
    </div>
  </aside>
</template>

<script>
import moment from "moment";

export default {
  props: ["user"],
  data: () => ({
    isOpen: false,
    timeNow: moment()
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
