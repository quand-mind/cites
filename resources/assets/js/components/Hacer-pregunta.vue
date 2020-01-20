<!-- 
Ultima Actualización: 18/01/2020

Tipo de componente: Módulo

Donde se usa:
 Home.vue (vista)
 Faqs (vista)

Descripción:
 Crea un model que permite registrar una pregunta
 -->

 <template>
  <div>
    <b-button class="text-uppercase ml-4 btn font-weight-bold btn-lg" style="background-color: #2c3e50; color: #fff" @click="showCreateQuestionModal" variant="primary">Crear nueva pregunta</b-button>
    <!-- <v-client-table
      :data="tableSettings.data"
      :columns="tableSettings.columns"
      :options="tableSettings.options"
    >
      <span slot="fecha" slot-scope="props">{{props.row.created_at}}</span>
      <span slot="pregunta" slot-scope="props">{{props.row.question}}</span>
      <span slot="respuesta" slot-scope="props">{{props.row.answer || ""}}</span>
      <span slot="respondida_por" slot-scope="props">{{props.row.answered_by}}</span>
      <div slot="pregunta_frecuente" slot-scope="props">
        <b-form-checkbox
          v-model="props.row.is_faq"
          :checked="props.row.is_faq"
          name="check-button"
          switch
          :data-id="props.row.id"
          @change="changeQuestionStatus(props.row.id)"
        ></b-form-checkbox>
      </div>
      <div slot="acciones" slot-scope="props">
        <b-button @click="showEditQuestionModal(props.row)" variant="primary">Responder</b-button>
      </div>
    </v-client-table>
 -->
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

        <b-button class="btn-verde" type="submit" variant="primary">Enviar</b-button>
        <b-button type="reset" variant="danger">Cancelar</b-button>
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
  props: ["questions"],
  data: () => ({
    tableSettings: {
      data: [],
      columns: [
        "fecha",
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
      answered_by: null
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
        answered_by: null
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
        answered_by: this.selectedQuestion.answered_by
      };
    },
    hideEditQuestionModal() {
      this.$refs["edit-question-modal"].hide();
    },
    onSubmit() {
      let formData = new FormData();

      for (let prop in this.form) formData.append(prop, this.form[prop]);

      axios
        .post(`/question`, formData)
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
        .post(`/question/update/${this.form.id}`, formData)
        .then(res => {
          console.log(res);
          window.location.reload();
        })
        .catch(err => console.log(err.response));
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
    makeToast(msg, variant = "success", delay = 3000, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: "Actualización de la pregunta",
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    }
  },
  mounted() {
    this.tableSettings.data = this.questions.map(question => {
      let newQuest = { ...question };
      newQuest.created_at = moment(newQuest.created_at).format("DD/MM/YYYY");
      newQuest.is_faq = Boolean(newQuest.is_faq);
      newQuest.answered_by = newQuest.answered_by.username;
      return newQuest;
    });
    console.log(this.questions);
  }
};
</script>

<style lang="scss">
// Table styles

// hide default filter
.VueTables__search {
  display: none;
}
.verde{
  background-color: #00a96d;
}
.btn-verde{
  background-color: #00a96d;
}
.btn-verde:hover{
  background-color:#009462;
}
</style>
