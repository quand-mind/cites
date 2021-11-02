<template>
  <div>
    <div class="caja bg-light p-2 my-2">
      <h1>Acrónimo</h1>
      <h4 class="ml-4">Define, edita o elimina Acrónimos que sean visibles en el sitio web</h4>
    </div>
    <b-button @click="showCreateModal" variant="primary">Definir nuevo Acrónimo</b-button>
    <v-client-table
      :data="tableSettings.data"
      :columns="tableSettings.columns"
      :options="tableSettings.options"
    >
      <span slot="acrónimo" slot-scope="props">{{props.row.siglas}}</span>
      <span slot="descripción" slot-scope="props">{{props.row.description || ""}}</span>
      <div class="action-container" slot="acciones" slot-scope="props">
        <a class="text-dark" @click.prevent="{showEditModal(props.row)}">
          <font-awesome-icon :icon="['fa', 'edit']"></font-awesome-icon>
        </a>

        <a class="text-danger" @click.prevent="{deleteWord(props.row)}">
          <font-awesome-icon :icon="['fa', 'trash']"></font-awesome-icon>
        </a>
      </div>
    </v-client-table>

    <!-- Create modal -->
    <b-modal ref="create-modal" hide-footer>
      <template v-slot:modal-title>
        <span>Definir nuevo Acrónimo</span>
      </template>
      <b-form id="acrodForm" @submit.prevent="onSubmit" @reset="onReset">
        
        <b-form-group label="Escriba la palabra:" label-for="acrod">
          <b-form-input id="acrod" v-model="form.siglas" required placeholder="Palabra"></b-form-input>
        </b-form-group>

        <b-form-group label="Definición:" label-for="textarea">
          <b-form-textarea
            id="textarea"
            v-model="form.description"
            placeholder="Escribe la definición"
            rows="3"
            max-rows="6"
          ></b-form-textarea>
        </b-form-group>

        <b-button type="submit" variant="primary">Enviar</b-button>
        <b-button type="reset" variant="danger">Cancelar</b-button>
      </b-form>
    </b-modal>

    <!-- Edit modal -->
    <b-modal ref="edit-modal" hide-footer>
      <template v-slot:modal-title>
        <span>Editar Acrónimo</span>
      </template>
      <b-form @submit.prevent="onSubmitEdit" @reset="onResetEdit">
        
        <b-form-group label="Escriba la palabra:" label-for="acrod">
          <b-form-input id="acrod" v-model="form.siglas" required placeholder="Palabra"></b-form-input>
        </b-form-group>

        <b-form-group label="Definición:" label-for="textarea">
          <b-form-textarea
            id="textarea"
            v-model="form.description"
            placeholder="Escribe la definición"
            rows="3"
            max-rows="6"
          ></b-form-textarea>
        </b-form-group>

        <b-button type="submit" variant="primary">Enviar</b-button>
        <b-button type="reset" variant="danger">Cancelar</b-button>
      </b-form>
    </b-modal>



  </div>
</template>

<script>
import axios from "axios";
import moment from "moment";
import timeout from '../../setTimeout.js'

export default {
   props: ["words"],
  data: () => ({
    timeout: timeout,
    tableSettings: {
      data: [],
      columns: [
        "acrónimo",
        "descripción",
        "acciones"
        ],
      options: {
        perPage: 10,
        perPageValues: [10, 20, 50]
      }
    },
    form: {
      siglas: "",
      description: "",
    },
    selectedWord: null
  }),
  methods: {
    showCreateModal() {
      this.$refs["create-modal"].show();
      this.form = {
        siglas: "",
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
        siglas: this.selectedWord.siglas,
        description: this.selectedWord.description,
      };
    },
    hideEditModal() {
      this.$refs["edit-modal"].hide();
    },
    onSubmit() {
      axios
        .post(`/dashboard/acronimos`, {...this.form})
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), timeout)
        })
        .catch(err => {
          this.makeToast(err.response.data, 'danger')
        });
    },
    onReset() {},
    onSubmitEdit() {

      axios
        .post(`/dashboard/acronimos/edit/${this.selectedWord.id}`, this.form)
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), timeout)
        })
        .catch(err => {
          this.makeToast(err.response.data, 'danger')
        });
    },
    deleteWord (row) {
      let _this = this

      axios
        .delete(`/dashboard/acronimos/${row.id}`)
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), timeout)
        })
        .catch(err => {
          _this.makeToast(err.response.data, 'danger')
        })
    },
    onResetEdit() {},
    makeToast(msg, variant = "success", delay = timeout, append = false) {
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
    this.tableSettings.data = [...this.words]
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
