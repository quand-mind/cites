<template>
  <b-card title="Seleccione la fecha de inicio y la fecha final.">
  
      <b-row>
        <b-col lg="5" md="6" sm="12">
          <!-- <h3>Holas</h3> -->
          <label for="date1">Fecha Inicial:</label>
          <b-form-datepicker :max="date2Data" id="date1" v-model="date1Data" class="mb-2"></b-form-datepicker>
        </b-col>
        <b-col lg="5" md="6" sm="12">
          <label for="date2">Fecha Final:</label>
          <b-form-datepicker :min="date1Data" id="date2" v-model="date2Data" class="mb-2"></b-form-datepicker>
        </b-col>
        <b-col class="d-flex align-items-end" lg="2" md="12">
          <b-btn @click="changeDate" class="w-100">
            Buscar
            <font-awesome-icon class="ml-1" :icon="['fa', 'search']"></font-awesome-icon>
          </b-btn>
        </b-col>
      </b-row>
    
  </b-card>
</template>

<style scoped>
  .b-form-btn-label-control{
    margin-bottom:0 !important;
  }
</style>

<script>
import timeout from '../../../../setTimeout';
export default {
  props: ['date1', 'date2'],
  data:(vm)=>({
    date1Data: vm.date1,
    date2Data: vm.date2
  }),
  methods: {
    changeDate() {
      // console.log(this.date1Data)
      axios
        .post(`/dashboard/permissions/graphics/selectDate`, {date1: this.date1Data, date2: this.date2Data})
        .then(res => {
          this.makeToast('Gráfica Actualizada')
          this.$emit('changeDate', res.data)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    makeToast(msg, variant = "success", delay = timeout, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: 'Gráfica',
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    },
  }
}
</script>
