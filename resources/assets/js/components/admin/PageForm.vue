<template>
  <div>
    <b-form @submit.prevent="onSubmit" @reset="onReset">
      <b-container class="mt-5">
        <b-row>
          <b-col>
            <h2 class="mb-4">Propiedades del contenido</h2>
          </b-col>
        </b-row>
        <b-row>
          <b-col>
            <b-form-group label="Título" label-for="input-1">
              <b-form-input v-model="pageData.title" required placeholder="Titulo de la página"></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>
      </b-container>
      <b-container>
        <b-row>
          <b-col>
            <b-form-group
              id="input-group-2"
              label="Descripción"
              label-for="input-2"
              :description="
                                `min: 120 caracteres, max: 158 caracteres. Total de caracteres: ${pageData.meta_description.length}.`
                            "
            >
              <b-form-textarea
                id="input-2"
                v-model="pageData.meta_description"
                required
                rows="4"
                placeholder="Meta descripción"
              ></b-form-textarea>
              <!-- Este es mi primer page con vue-2-editor. Amo programar, amo javascript, y también amo a Issa. Estoy enamorado, y mi mayor deseo es vivir junto a ella. -->
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group id="input-group-2" label="Robots" label-for="input-2">
              <b-form-textarea
                id="input-2"
                v-model="pageData.meta_robots"
                required
                rows="4"
                placeholder="Meta robots"
              ></b-form-textarea>
            </b-form-group>
          </b-col>
        </b-row>
      </b-container>

      <b-container>
        <b-row>
          <b-col>
            <b-form-group id="input-group-2" label="Keywords" label-for="input-2">
              <b-form-textarea
                id="input-2"
                v-model="pageData.meta_keywords"
                required
                rows="4"
                placeholder="Palabras claves"
              ></b-form-textarea>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group
              id="input-group-3"
              label="Publicar page"
              label-for="input-3"
              description="Estando activo el page será visible al público"
            >
              <b-form-checkbox v-model="pageData.is_active" name="check-button" size="lg" switch></b-form-checkbox>
            </b-form-group>
          </b-col>
        </b-row>
      </b-container>
      <b-container>
        <b-row>
          <b-col>
            <b-form-group label="Contenido" label-for="input-3">
              <vue-editor
                useCustomImageHandler
                @image-added="handleImageAdded"
                @image-removed="handleImageRemoved"
                v-model="pageData.content"
              ></vue-editor>
            </b-form-group>
          </b-col>
        </b-row>
      </b-container>
      <b-container>
        <b-row>
          <b-col>
            <b-button class="submit-btn" size="lg" type="submit" variant="primary">Guardar</b-button>
            <b-button size="lg" type="reset" variant="danger">Cancelar</b-button>
          </b-col>
        </b-row>
      </b-container>
    </b-form>
    <b-card class="mt-3" header="Form Data Result">
      <pre class="m-0">{{ pageData }}</pre>
    </b-card>
    <b-card class="mt-3" header="Form Image Result">
      <pre class="m-0">{{ image }}</pre>
    </b-card>
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
import Datepicker from "vuejs-datepicker/dist/vuejs-datepicker.esm.js";
import * as lang from "vuejs-datepicker/src/locale";
import moment from "moment";

export default {
  props: ["page"],
  components: {
    VueEditor,
    Datepicker
  },
  data: () => ({
    pageData: {
      title: "",
      meta_description: "",
      meta_robots: "",
      meta_keywords: "",
      is_active: false,
      content: ""
    },
    pageErrors: {
      title: [],
      meta_description: [],
      meta_robots: [],
      meta_keywords: [],
      is_active: [],
      content: []
    },
    settings: {
      languages: lang
    }
  }),
  methods: {
    savePage(formData) {
      let _this = this;

      axios
        .post(`/dashboard/pages/create`, formData)
        .then(res => {
          // save image
          _this.saveImage(res.data.page_id);
        })
        .catch(err => _this.makeToast(err.response.data, "danger"));
    },

    updatePage(formData) {
      let _this = this;

      axios
        .post(`/dashboard/pages/edit/${_this.page.id}`, formData)
        .then(res => {
          // save image
          _this.makeToast(res.data);
          setTimeout(() => window.location.replace("/dashboard/pages"), 2000);
        })
        .catch(err => _this.makeToast(err.response.data, "danger"));
    },
    onSubmit() {
      let _this = this;
      let formData = new FormData();

      Object.keys(_this.pageData).forEach(el => {
        if (el === "is_active") formData.append(el, Number(_this.pageData[el]));
        else formData.append(el, _this.pageData[el]);
      });

      _this.page === null || _this.page === undefined
        ? _this.savePage(formData)
        : _this.updatePage(formData);
    },
    onReset() {},
    handleImageAdded: function(file, Editor, cursorLocation, resetUploader) {
      // An example of using FormData
      // NOTE: Your key could be different such as:
      // formData.append('file', file)

      var formData = new FormData();
      formData.append("image", file);

      axios({
        url: "/dashboard/images/page/content",
        method: "page",
        data: formData
      })
        .then(result => {
          let url = result.data.url; // Get url from response
          Editor.insertEmbed(cursorLocation, "image", url);
          resetUploader();
        })
        .catch(err => {
          _this.makeToast(err.response.data, "danger");
        });
    },
    handleImageRemoved: function(file, Editor, cursorLocation, resetUploader) {
      // An example of using FormData
      // NOTE: Your key could be different such as:
      // formData.append('file', file)

      var formData = new FormData();
      formData.append("path", file);

      axios({
        url: "/dashboard/images/page/content/delete",
        method: "page",
        data: formData
      })
        .then(result => {
          let url = result.data.url; // Get url from response
          // Editor.insertEmbed(cursorLocation, "image", url);
          resetUploader();
        })
        .catch(err => {
          _this.makeToast(err.response.data, "danger");
        });
    },
    makeToast(msg, variant = "success", delay = 3000, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: "Actualización de la página",
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    }
  },
  mounted() {
    let _this = this;
    if (_this.page) {
      Object.keys(_this.pageData).forEach(key => {
        if (key !== "image") {
          _this.pageData[key] = _this.page[key];
        }
      });

      Object.keys(_this.image).forEach(key => {
        if (key === "publish_date") {
          _this.image.publish_date = moment(_this.page.image[key]).format(
            "YYYY-MM-DD"
          );
        } else _this.image[key] = _this.page.image[key];
      });

      if (_this.page.image.url) _this.image.url = _this.page.image.url;
    }
  }
};
</script>

<style lang="scss">
.submit-btn {
  margin-right: 10px;
}
</style>
