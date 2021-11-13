<template>
  <div>
    <div class="caja bg-light p-2 my-2">
      <h1>Preguntas Frecuentes</h1>
      <h4 class="ml-4">Revisa las preguntas hechas por los usuarios y contestalas. Escoge que preguntas quieres que sean visibles. Crea o elimina preguntas</h4>
    </div>
    <b-button @click="showCreateQuestionModal" variant="primary">Crear nueva pregunta</b-button>
    <v-client-table
      :data="tableSettings.data"
      :columns="tableSettings.columns"
      :options="tableSettings.options"
    >
      <span slot="pregunta" slot-scope="props">{{props.row.question}}</span>
      <span slot="respuesta" slot-scope="props">{{props.row.answer || ""}}</span>
      <span slot="respondida_por" slot-scope="props">{{props.row.answered_by || ""}}</span>
      <div slot="pregunta_frecuente" slot-scope="props">
        <b-form-checkbox
          v-model="props.row.is_faq"
          name="check-button"
          switch
          :data-id="props.row.id"
          @change="changeQuestionStatus(props.row.id)"
        ></b-form-checkbox>
      </div>
      <div slot="acciones" slot-scope="props">
        <b-button @click="showEditQuestionModal(props.row)" variant="primary">Responder</b-button>

        <a class="text-danger" @click.prevent="{deleteQuestion(props.row)}">
          <font-awesome-icon :icon="['fa', 'trash']"></font-awesome-icon>
        </a>

      </div>
    </v-client-table>

    <b-modal ref="create-question-modal" hide-footer>
      <template v-slot:modal-title>
        <span>Crear nueva pregunta</span>
      </template>
      <b-form id="questionForm" @submit.prevent="onSubmit" @reset="onReset">
        <b-form-group label="Correo electrónico: " label-for="asked_by">
          <b-form-input
            id="asked_by"
            v-model="form.asked_by"
            type="email"
            required
            placeholder="user@mail.com"
          ></b-form-input>
        </b-form-group>

        <b-form-group label="Coméntanos tu duda:" label-for="question">
          <b-form-input id="question" v-model="form.question" required placeholder="¿?"></b-form-input>
        </b-form-group>

        <b-form-group label="Respuesta:" label-for="question">
          <b-form-textarea
            id="textarea"
            v-model="form.answer"
            placeholder="Responder pregunta"
            rows="3"
            max-rows="6"
          ></b-form-textarea>
        </b-form-group>

        <b-form-group label="Responder con un email" label-for="question">
          <b-form-checkbox
            name="check-button"
            class="check-active"
            v-model="form.sendEmailResponse"
            :checked="Boolean(form.sendEmailResponse)"
            switch
          ></b-form-checkbox>
        </b-form-group>

        <b-button type="submit" variant="primary">Enviar</b-button>
        <b-button type="reset" variant="danger">Limpiar</b-button>
      </b-form>
    </b-modal>

    <!-- Response question modal -->
    <b-modal ref="edit-question-modal" hide-footer>
      <template v-slot:modal-title>
        <span>Editar pregunta</span>
      </template>
      <b-form id="questionForm" @submit.prevent="onSubmitEdit" @reset="onResetEdit">
        <b-form-group label="Correo electrónico: " label-for="asked_by">
          <b-form-input
            id="asked_by"
            v-model="form.asked_by"
            type="email"
            required
            placeholder="user@mail.com"
          ></b-form-input>
        </b-form-group>

        <b-form-group label="Pregunta:" label-for="question">
          <b-form-input id="question" v-model="form.question" required placeholder="¿?"></b-form-input>
        </b-form-group>
        <b-form-group label="Respuesta:" label-for="question">
          <b-form-textarea
            id="textarea"
            v-model="form.answer"
            placeholder="Responder pregunta"
            rows="3"
            max-rows="6"
          ></b-form-textarea>
        </b-form-group>

        <b-form-group label="Responder con un email" label-for="question">
          <b-form-checkbox
            name="check-button"
            class="check-active"
            v-model="form.sendEmailResponse"
            :checked="Boolean(form.sendEmailResponse)"
            switch
          ></b-form-checkbox>
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
  props: ["questions"],
  data: () => ({
    tableSettings: {
      data: [],
      columns: [
        "pregunta",
        "respuesta",
        "respondida_por",
        "pregunta_frecuente",
        "acciones"
      ],
      options: {
        perPage: 10,
        perPageValues: [10, 20, 50]
      }
    },
    form: {
      asked_by: "",
      question: "",
      answer: "",
      answered_by: null,
      sendResponseEmail: true
    },
    selectedQuestion: null
  }),
  methods: {
    showCreateQuestionModal() {
      this.$refs["create-question-modal"].show();
      this.form = {
        asked_by: "",
        question: "",
        answer: "",
        answered_by: null,
        sendResponseEmail: true
      };
    },
    hideCreateQuestionModal() {
      this.$refs["create-question-modal"].hide();
    },
    showEditQuestionModal(row) {
      this.$refs["edit-question-modal"].show();
      this.selectedQuestion = row;
      this.form = {
        id: this.selectedQuestion.id,
        asked_by: this.selectedQuestion.asked_by,
        question: this.selectedQuestion.question,
        answer: this.selectedQuestion.answer,
        answered_by: this.selectedQuestion.answered_by,
        sendResponseEmail: false
      };
    },
    hideEditQuestionModal() {
      this.$refs["edit-question-modal"].hide();
    },
    onSubmit() {
      let _this = this
      let formData = new FormData();

      for (let prop in this.form) {
        if (prop !== "id") {
          if (prop === "sendResponseEmail") formData.append(prop, this.form[prop] ? 1 : 0);
          else formData.append(prop, this.form[prop]);
        }
      }

      axios
        .post(`/question`, formData)
        .then(res => {
          _this.makeToast(res.data);
          setTimeout(() => window.location.reload(), timeout);
        })
        .catch(err => _this.makeToast(err.response.data, "danger"));
    },
    onReset() {},
    onSubmitEdit() {
      let _this = this
      let formData = new FormData();

      for (let prop in this.form)
        if (prop !== "id") {
          if (prop === "sendResponseEmail") formData.append(prop, this.form[prop] ? 1 : 0);
          else formData.append(prop, this.form[prop]);
        }

      axios
        .post(`/question/update/${this.form.id}`, formData)
        .then(res => {
          _this.makeToast(res.data);
          setTimeout(() => window.location.reload(), timeout);
        })
        .catch(err => _this.makeToast(err.response.data, "danger"));
    },
    onResetEdit() {},
    changeQuestionStatus(id) {
      let _this = this;
      let postIdx = _this.tableSettings.data.findIndex(post => id === post.id);
      _this.tableSettings.data[postIdx].is_faq = !_this.tableSettings.data[
        postIdx
      ].is_faq;

      axios
        .post(`/dashboard/question/changeStatus/${id}`, {
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
    makeToast(msg, variant = "success", delay = timeout, append = false) {
      // Create a new toast
      this.$bvToast.toast(`${msg}`, {
        title: "Actualización de la pregunta",
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    },
    deleteQuestion (question) {
      let _this = this;

      axios
        .delete(`/dashboard/questions/${question.id}`)
        .then(res => {
          if (res.status === 200) {
            _this.makeToast(res.data);
            setTimeout(() => window.location.reload(), 300);
          }
        })
        .catch(err => {
          _this.makeToast(err.response.data, "danger");
        });
    }
  },
  mounted() {
    this.tableSettings.data = this.questions.map(question => {
      // Format the data to render in the panel
      let newQuest = { ...question };
      newQuest.created_at = moment(newQuest.created_at).format("DD/MM/YYYY");
      newQuest.is_faq = parseInt(newQuest.is_faq) === 1;
      newQuest.answered_by = newQuest.answered_by
        ? newQuest.answered_by.username
        : null;
      return newQuest;
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
