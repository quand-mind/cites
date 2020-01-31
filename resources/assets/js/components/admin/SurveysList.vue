<template>
  <div>
    <b-button @click="showCreateSurveyModal" variant="primary">Agregar una encuesta</b-button>
    <v-client-table
      :data="tableSettings.data"
      :columns="tableSettings.columns"
      :options="tableSettings.options"
    >
      <span slot="título" slot-scope="props">{{props.row.title}}</span>
      <span slot="descripción" slot-scope="props">{{props.row.description}}</span>
      <span slot="url" slot-scope="props">{{props.row.url}}</span>
      <span slot="fecha_de_publicación" slot-scope="props">{{props.row.published_date}}</span>
      <span slot="creada_por" slot-scope="props">{{props.row.created_by.username}}</span>
    </v-client-table>

    <b-modal ref="create-survey-modal" hide-footer>
      <template v-slot:modal-title>
        <span>Agregar encuesta</span>
      </template>
      <b-form id="surveyForm" @submit.prevent="onSubmit" @reset="onReset">
        <b-form-group label="Título de la encuesta " label-for="title">
          <b-form-input
            id="title"
            v-model="form.title"
            type="text"
            required
            placeholder="Título..."
          ></b-form-input>
        </b-form-group>

        <b-form-group label="Fecha de publicación" label-for="survey">
          <b-form-input id="survey" type="date" v-model="form.published_date" required></b-form-input>
        </b-form-group>

        <b-form-group label="Url de la encuesta" label-for="url">
          <b-form-input
            id="url"
            v-model="form.url"
            required
            placeholder="https://ovm.3dmensional.agency/surveys/..."
          ></b-form-input>
        </b-form-group>

        <b-form-group label="Descripción" label-for="survey">
          <b-form-textarea
            id="textarea"
            v-model="form.description"
            placeholder="Descripción de la encuesta"
            rows="3"
            max-rows="6"
          ></b-form-textarea>
        </b-form-group>

        <b-button type="submit" variant="primary">Enviar</b-button>
        <b-button type="reset" variant="danger">Cancelar</b-button>
      </b-form>
    </b-modal>

    <!-- Response survey modal -->
    <b-modal ref="edit-survey-modal" hide-footer>
      <template v-slot:modal-title>
        <span>Editar pregunta</span>
      </template>
      <b-form id="surveyForm" @submit.prevent="onSubmitEdit" @reset="onResetEdit">
        <b-form-group label="Título de la encuesta " label-for="title">
          <b-form-input
            id="title"
            v-model="form.title"
            type="text"
            required
            placeholder="Título..."
          ></b-form-input>
        </b-form-group>

        <b-form-group label="Fecha de publicación" label-for="survey">
          <b-form-input id="survey" type="date" v-model="form.published_date" required></b-form-input>
        </b-form-group>

        <b-form-group label="Url de la encuesta" label-for="url">
          <b-form-input
            id="url"
            v-model="form.url"
            required
            placeholder="https://ovm.3dmensional.agency/surveys/..."
          ></b-form-input>
        </b-form-group>

        <b-form-group label="Descripción" label-for="survey">
          <b-form-textarea
            id="textarea"
            v-model="form.description"
            placeholder="Descripción de la encuesta"
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
  props: ["surveys"],
  data: () => ({
    tableSettings: {
      data: [],
      columns: [
        "título",
        "descripción",
        "url",
        "fecha_de_publicación",
        "creada_por"
      ],
      options: {
        perPage: 10,
        perPageValues: [10, 20, 50]
      }
    },
    form: {
      title: "",
      description: "",
      url: "",
      published_date: null
    },
    selectedSurvey: null
  }),
  methods: {
    showCreateSurveyModal() {
      this.$refs["create-survey-modal"].show();
      this.form = {
        title: "",
        description: "",
        url: "",
        published_date: null
      };
    },
    hideCreateSurveyModal() {
      this.$refs["create-survey-modal"].hide();
    },
    showEditSurveyModal(row) {
      this.$refs["edit-survey-modal"].show();
      this.selectedSurvey = row;
      this.form = {
        id: this.selectedSurvey.id,
        title: this.selectedSurvey.title,
        description: this.selectedSurvey.description,
        url: this.selectedSurvey.url,
        published_date: this.selectedSurvey.published_date
      };
    },
    hideEditSurveyModal() {
      this.$refs["edit-survey-modal"].hide();
    },
    onSubmit() {
      let formData = new FormData();

      for (let prop in this.form) formData.append(prop, this.form[prop]);

      axios
        .post(`/dashboard/survey`, formData)
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
        .post(`/dashboard/survey/update/${this.form.id}`, formData)
        .then(res => {
          console.log(res);
          window.location.reload();
        })
        .catch(err => console.log(err.response));
    },
    onResetEdit() {},
    makeToast(msg, variant = "success", delay = 3000, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: "Actualización de la encuesta",
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    }
  },
  mounted() {
    this.tableSettings.data = this.surveys.map(survey => {
      let newSurvey = { ...survey };
      newSurvey.published_date = moment(newSurvey.published_date).format(
        "DD/MM/YYYY"
      );
      return newSurvey;
    });
    console.log(this.surveys);
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
