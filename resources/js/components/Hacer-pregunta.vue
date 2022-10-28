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
    <h3 class="mb-5">Haga una consulta y le responderemos en la brevedad posible</h3>
    <b-form class="container px-5" id="questionForm" @submit.prevent="onSubmit" @reset="onReset">
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

      <b-button class="btn-verde" type="submit" variant="primary" size="lg">Enviar</b-button>
    </b-form>
  </div>
</template>

<script>
import axios from "axios";
import moment from "moment";
import timeout from '../setTimeout';

export default {
  props: ["questions"],
  data: () => ({
    timeout: timeout,
    form: {
      asked_by: "",
      question: "",
      sendResponseEmail: 0
    }
  }),
  methods: {
    onSubmit() {
      let _this = this;
      let formData = new FormData();

      for (let prop in this.form) formData.append(prop, this.form[prop]);

      axios
        .post(`/question`, formData)
        .then(res => {
          setTimeout(_this.onReset, timeout)
          _this.makeToast(res.data);
        })
        .catch(err => console.log(err.response));
    },
    onReset() {
      this.form.asked_by = ""
      this.form.question = ""
    },
    makeToast(msg, variant = "success", delay = timeout, append = false) {
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
  background-color: #69c816;
}
.btn-verde {
  background-color: #69c816;
}
.btn-verde:hover {
  background-color: #69c816;
}
</style>
