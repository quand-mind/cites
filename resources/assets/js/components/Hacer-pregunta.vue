<!--
Ultima Actualización: 18/01/2020

Tipo de componente: Módulo

Donde se usa:
 Home.vue (vista)
 Faqs (vista)

Descripción:
 Crea un model que permite registrar una consulta
 -->

 <template>
  <div>
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

      <b-form-group label="Coméntenos su duda:" label-for="question">
        <b-form-input id="question" v-model="form.question" required placeholder="¿?"></b-form-input>
      </b-form-group>

      <b-button class="btn-verde" type="submit" variant="primary" size="lg">Enviar</b-button>
    </b-form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data: () => ({
    form: {
      asked_by: "",
      question: "",
      sendResponseEmail: 0
    }
  }),
  methods: {
    onSubmit() {
      let _this = this;

      axios
        .post(`/question`, _this.form)
        .then(res => {
          _this.makeToast("Responderemos su consulta lo más pronto posible.", "success", "3000");
        })
        .catch(err => console.log(err.response));
    },
    onReset() {},
    makeToast(msg, variant = "success", delay = 3000, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: "¡Gracias por consultar!",
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
