<template>
  <div>
    <div class="caja bg-light p-2 my-2">
      <h1>Autorizaciones</h1>
      <h4 class="ml-4">Realice la solicitud para la aprobación de autorizaciones.</h4>


      <ul class="list-group mt-4">
        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
          Autorización para la instalación y funcionamiento de Zoocriaderos
          <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseNurseries" aria-expanded="false" aria-controls="collapseNurseries">
            Recaudos
          </button>
        </li>
        <div class="collapse" id="collapseNurseries">
          <div class="card card-body">
            <div class="d-flex">
              <h6>Lista de Recaudos:</h6>
            </div>
            <ul class=" mt-4">
              <li class="">Datos de la <b>persona natural solicitante</b> (Nombre, apellido, número de cedula, número de RIF. dirección, número de teléfono (fijo y celular) y correo electrónico), datos de la <b>persona jurídica solicitante</b> (Nombre del propietario, número de RIF, dirección, número de teléfono (fijo y celular) y correo electrónico.</li>
              <li class="">Timbres fiscales por <b>2</b> unidades tributarias.</li>
              <li class="">Proyecto para la instalación y funcionamiento del zoocriaderos Indispensable, debe incluir:
                <ul>
                  <li>Tipo y modalidad de actividad de zoocría</li>
                  <li>Nombre científico de la(s) especie(s) o taxón mayor a criar</li>
                  <li>Biología de las especies</li>
                  <li>Dirección y coordenadas UTM, Datum REGVEN, para la localización del Zoocriadero solicitante</li>
                  <li>Descripción del patrón tecnológico</li>
                  <li>Protocolos de manejo, alimentación y sanitario de los ejemplares</li>
                  <li>Descripción de las instalaciones</li>
                  <li>Plano descriptivo de las instalaciones definiendo sus dimensiones</li>
                </ul>
              </li>
              <li class="">Porta ac consectetur ac</li>
              <li class="">Vestibulum at eros</li>
            </ul>
            <div class="w-100 d-flex justify-content-end align-items-center">
              <button class="btn btn-primary">Solicitar Autorización</button>
            </div>
          </div>
        </div>
        <li class="list-group-item list-group-item-action">Dapibus ac facilisis in</li>
        <li class="list-group-item list-group-item-action">Morbi leo risus</li>
        <li class="list-group-item list-group-item-action">Porta ac consectetur ac</li>
        <li class="list-group-item list-group-item-action">Vestibulum at eros</li>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import moment from "moment";

export default {
   props: ["words"],
  data: () => ({
  }),
  methods: {
    showCreateModal() {
      this.$refs["create-modal"].show();
      this.form = {
        word: "",
        description: "",
      };
    },
    hideCreateModal() {
      this.$refs["create-modal"].hide();
    },
    showEditModal(row) {
      this.$refs["edit-modal"].show();
      this.selectedWord = row;
      this.form = {
        word: this.selectedWord.word,
        description: this.selectedWord.description,
      };
    },
    hideEditModal() {
      this.$refs["edit-modal"].hide();
    },
    onSubmit() {
      axios
        .post(`/dashboard/glosary`, {...this.form})
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), 300)
        })
        .catch(err => {
          console.log(err)
          this.makeToast(err.toString(), 'danger')
        });
    },
    onReset() {},
    onSubmitEdit() {

      axios
        .post(`/dashboard/glosary/edit/${this.selectedWord.id}`, this.form)
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), 300)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    deleteWord (row) {
      let _this = this

      axios
        .delete(`/dashboard/glosary/${row.id}`)
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), 300)
        })
        .catch(err => {
          _this.makeToast(err.response.data, 'danger')
        })
    },
    onResetEdit() {},
    makeToast(msg, variant = "success", delay = 3000, append = false) {
      // Create a new toast
      this.$bvToast.toast(`${msg}`, {
        title: "Actualización de la palabra",
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    }
  },
  mounted() {
  }
};
</script>

<style lang="scss">
// Table styles

// hide default filter
.VueTables__search {
  display: none;
}
</style>