<template>
  <div>
    <div class="caja bg-light p-2 my-2">
      <h1>Encuestas</h1>
      <h4 class="ml-4">Crea, edita o elimina encuestas y decide cuales serán visibles en el sitio web</h4>
    </div>
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
      <div class="action-container" slot="acciones" slot-scope="props">
        <a class="text-dark" @click.prevent="{showEditSurveyModal(props.row)}">
          <font-awesome-icon :icon="['fa', 'edit']"></font-awesome-icon>
        </a>

        <a
          class="text-danger"
          @click.prevent="{deleteSurvey(props.row);}"
        >
          <font-awesome-icon :icon="['fa', 'trash']"></font-awesome-icon>
        </a>
      </div>
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
            placeholder="https://OGM.3dmensional.agency/surveys/..."
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
            placeholder="https://OGM.3dmensional.agency/surveys/..."
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


    <!-- Delete modal -->

    <b-modal ref="delete-modal" hide-footer>
      <template v-slot:modal-title>
        <span class="text-danger">Eliminando la encuesta {{selectedSurvey.title}}</span>
      </template>
      <div v-if="selectedSurvey" class="d-block text-center">
        <h3>¿Estas seguro de que deseas eliminar la encuesta {{selectedSurvey.title}}?</h3>

        <b-button class="mt-3" block variant="danger" @click="submitDeleteSurvey">Confirmar</b-button>
        <b-button class="mt-3" block @click="hideDeleteModal">Cancelar</b-button>
      </div>
    </b-modal>
    
  </div>
</template>

<script>
import axios from "axios";
import moment from "moment";
import timeout from '../../setTimeout.js'

export default {
  props: ["surveys"],
  data: () => ({
    timeout: timeout,
    tableSettings: {
      data: [],
      columns: [
        "título",
        "descripción",
        "url",
        "fecha_de_publicación",
        "creada_por",
        "acciones"
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
        id: null,
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
      this.selectedSurvey = row;
      this.form = {
        id: this.selectedSurvey.id,
        title: this.selectedSurvey.title,
        description: this.selectedSurvey.description,
        url: this.selectedSurvey.url,
        published_date: this.selectedSurvey.published_date
      };
      this.$refs["edit-survey-modal"].show();
    },
    hideEditSurveyModal() {
      this.$refs["edit-survey-modal"].hide();
    },
    deleteSurvey(survey) {
      this.selectedSurvey = survey;
      this.showDeleteModal();
    },
    showDeleteModal() {
      this.$refs["delete-modal"].show();
    },
    hideDeleteModal() {
      this.$refs["delete-modal"].hide();
    },
    onSubmitEdit() {
      let _this = this;

      axios
        .post(`/dashboard/surveys/edit/${_this.selectedSurvey.id}`, {
          ..._this.form
        })
        .then(res => {
          if (res.status === 200) {
            _this.makeToast(res.data);
            _this.hideEditSurveyModal();
            setTimeout(() => window.location.reload(), timeout);
          }
        })
        .catch(err => {
          let { data } = err.response

          if (data.errors !== undefined || data.errors !== null) {
            let errors = Object.values(data.errors).toString()
            _this.makeToast(errors, "danger");
          } else {
            _this.makeToast(data, "danger");
          }
        });
    },
    submitDeleteSurvey() {
      let _this = this;

      axios
        .delete(`/dashboard/surveys/${_this.selectedSurvey.id}`)
        .then(res => {
          if (res.status === 200) {
            _this.makeToast(res.data);
            _this.hideDeleteModal();
            setTimeout(() => window.location.reload(), timeout);
          }
        })
        .catch(err => {
          let { data } = err.response

          if (data.errors !== undefined || data.errors !== null) {
            let errors = Object.values(data.errors).toString()
            _this.makeToast(errors, "danger");
          } else {
            _this.makeToast(data, "danger");
          }
        });
    },
    makeToast(msg, variant = "success", delay = timeout, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: "Evento de actualización de usuario",
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
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
    onResetEdit() {}, 
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
