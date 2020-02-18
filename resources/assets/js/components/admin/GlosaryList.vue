<template>
  <div>
    <b-button @click="showCreateWordModal" variant="primary">Definir nueva palabra</b-button>
    <v-client-table
      :data="tableSettings.data"
      :columns="tableSettings.columns"
      :options="tableSettings.options"
    >
      <span slot="palabra" slot-scope="props">{{props.row.word}}</span>
      <span slot="definición" slot-scope="props">{{props.row.definition || ""}}</span>
      <div class="action-container" slot="acciones" slot-scope="props">
        <a class="text-dark" @click.prevent="{editWord(props.row)}">
          <font-awesome-icon :icon="['fa', 'edit']"></font-awesome-icon>
        </a>

        <a class="text-danger" @click.prevent="{deleteWord(props.row)}">
          <font-awesome-icon :icon="['fa', 'trash']"></font-awesome-icon>
        </a>
      </div>
    </v-client-table>

    <!-- Create Word modal -->
    <b-modal ref="create-word-modal" hide-footer>
      <template v-slot:modal-title>
        <span>Definir una nueva palabra</span>
      </template>
      <b-form id="wordForm" @submit.prevent="onSubmit" @reset="onReset">
        
        <b-form-group label="Escriba la palabra:" label-for="word">
          <b-form-input id="word" v-model="form.word" required placeholder="Palabra"></b-form-input>
        </b-form-group>

        <b-form-group label="Definición:" label-for="word">
          <b-form-textarea
            id="textarea"
            v-model="form.definition"
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

export default {
   props: ["words"],
  data: () => ({
    tableSettings: {
      data: [],
      columns: [
        "Palabra",
        "Definición",
        "Acciones"
        ],
      options: {
        perPage: 10,
        perPageValues: [10, 20, 50]
      }
    },
    form: {
      word: "",
      definition: "",
    },
    selectedWord: null
  }),
  methods: {
    showCreateWordModal() {
      this.$refs["create-word-modal"].show();
      this.form = {
        word: "",
        definition: "",
      };
    },
    hideCreateWordModal() {
      this.$refs["create-word-modal"].hide();
    },
    showEditWordModal(row) {
      this.$refs["edit-word-modal"].show();
      this.selectedWord = row;
      this.form = {
        id: this.selectedWord.id,
        word: this.selectedWord.word,
        definition: this.selectedWord.definition,
      };
    },
    hideEditWordModal() {
      this.$refs["edit-word-modal"].hide();
    },
    onSubmit() {
      let formData = new FormData();

      for (let prop in this.form) formData.append(prop, this.form[prop]);

      axios
        .post(`/word`, formData)
        .then(res => {
          console.log(res);
          window.location.reload();
        })
        .catch(err => console.log(err.response));
    },
    onReset() {},
    onSubmitEdit() {
      let formData = new FormData();

      for (let prop in this.form)
        prop !== "id" && formData.append(prop, this.form[prop]);

      axios
        .post(`/word/update/${this.form.id}`, formData)
        .then(res => {
          console.log(res);
          window.location.reload();
        })
        .catch(err => console.log(err.response));
    },
    onResetEdit() {},
    changeWordStatus(id) {
      let _this = this;
      let postIdx = _this.tableSettings.data.findIndex(post => id === post.id);
      _this.tableSettings.data[postIdx].is_faq = !_this.tableSettings.data[
        postIdx
      ].is_faq;

      axios
        .post(`/dashboard/word/changeStatus/${id}`, {
          is_faq: _this.tableSettings.data[postIdx].is_faq
        })
        .then(res => {
          _this.makeToast(res.data);
        })
        .catch(err => {
          console.log(err.response);
          _this.makeToast(err.response.data, "danger");
        });
    },
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
    this.tableSettings.data = this.words.map(word => {
      // Format the data to render in the panel
      let newWord = { ...word };
      newWord.created_at = moment(newWord.created_at).format("DD/MM/YYYY");
      newWord.is_faq = parseInt(newWord.is_faq) === 1;
      console.log(newWord.word, newWord.is_faq);
      newWord.answered_by = newWord.answered_by
        ? newWord.answered_by.username
        : null;
      return newWord;
    });
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
