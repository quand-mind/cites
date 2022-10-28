<template>
  <b-card>
    <vc-donut
      background="white"
      :size="400" unit="px" :thickness="30"
      has-legend legend-placement="left"
      :sections="data" :total="total"
      :start-angle="0" :auto-adjust-text-size="true"
      @section-click="handleSectionClick">
      <h1>{{subtitle}}</h1>

    </vc-donut>
  </b-card>
</template>
<script>

export default {
  props:['subtitle', 'label', 'data', 'total'],
  data: (vm) => ({
  }),
  methods: {
    handleSectionClick(section, event) {
      console.log(`${section.label} clicked.`);
    }
  }
}
</script>

<style>
  .cdc-legend {
    margin-right: 50px !important; 
  }
</style>