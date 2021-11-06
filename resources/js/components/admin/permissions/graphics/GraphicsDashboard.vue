<template>

  <div>
    <h1>Listado de Gráficas:</h1>

    <b-list-group>

      <b-list-group-item class="d-flex justify-content-between align-items-center">
        Gráfica de especies
        <b-button variant="primary" href="/dashboard/permissions/graphics/speciesStatistics">
          <font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon>
          Ver
        </b-button>
      </b-list-group-item>
      <b-list-group-item class="d-flex justify-content-between align-items-center">
        Gráfica de los tipos de permiso
        <b-button variant="primary" href="/dashboard/permissions/graphics/permitTypeStatistics">
          <font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon>
          Ver
        </b-button>
      </b-list-group-item>
      <b-list-group-item class="d-flex justify-content-between align-items-center">
        Gráfica de los tipos de permiso por fecha
        <b-button variant="primary" href="/dashboard/permissions/graphics/permitsDateStatistics">
          <font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon>
          Ver
        </b-button>
      </b-list-group-item>

    </b-list-group>
  </div>
  
</template>
<script>
export default {
  
}
</script>