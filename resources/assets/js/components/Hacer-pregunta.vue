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
    <b-button
      class="text-uppercase ml-4 btn font-weight-bold btn-lg"
      style="background-color: #2c3e50; color: #fff"
      @click="showCreateQuestionModal"
    >Crear nueva pregunta</b-button>

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

        <b-button class="btn-verde" type="submit" variant="primary">Enviar</b-button>
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
    form: {
      asked_by: "",
      question: ""
    },
    selectedQuestion: null
  }),
  methods: {
    showCreateQuestionModal() {
      this.$refs["create-question-modal"].show();
      this.form = {
        asked_by: "",
        question: ""
      };
    },
    hideCreateQuestionModal() {
      this.$refs["create-question-modal"].hide();
    },
    onSubmit() {
      let _this = this;
      let formData = new FormData();

      for (let prop in this.form) formData.append(prop, this.form[prop]);

      axios
        .post(`/question`, formData)
        .then(res => {
          _this.hideCreateQuestionModal();
          _this.makeToast("Responderemos su pregunta lo más pronto posible.");
        })
        .catch(err => console.log(err.response));
    },
    onReset() {},
    makeToast(msg, variant = "success", delay = 3000, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: "¡Gracias por preguntar!",
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    }
  }
};
</script>

<style lang="scss">
// Table styles

// hide default filter
.VueTables__search {
  display: none;
}
.verde {
  background-color: #00a96d;
}
.btn-verde {
  background-color: #00a96d;
}
.btn-verde:hover {
  background-color: #009462;
}
</style>
