<template>
  <div>
    <b-form @submit.prevent="onSubmit" @reset="onReset">
      <b-container>
        <b-row>
          <b-col>
            <h2 class="mb-4">Propiedades de la imagen</h2>
          </b-col>
        </b-row>
        <b-row>
          <b-col cols="6">
            <b-form-group label="Portada">
              <b-form-file
                browse-text="Explorar"
                v-model="image.file"
                :state="Boolean(image.file || image.url)"
                placeholder="Selecciona un archivo o arrástralo hasta aquí..."
                drop-placeholder="Drop file here..."
                :required="!image.url && !image.file"
              ></b-form-file>
              <b-img-lazy style="margin-top: 10px" :src="mainImageUrl" alt="image preview" fluid></b-img-lazy>
              <div class="mt-3">
                Archivo seleccionado:
                {{
                image.file
                ? image.file.name
                : ""
                }}
              </div>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group
              label="Autor de la imagen"
              label-for="input-1"
              description="Protegemos los derechos de autor"
            >
              <b-form-input
                v-model="image.author"
                type="text"
                required
                placeholder="Luis Rodríguez"
              ></b-form-input>
            </b-form-group>
            <b-form-group label="Etiqueta de la imagen" label-for="input-1">
              <b-form-input
                v-model="image.alt_img"
                type="text"
                required
                placeholder="Ej: Playa el Ángel, Edo. Vargas"
              ></b-form-input>
            </b-form-group>
            <b-form-group label="Fecha de la imagen" label-for="input-1">
              <datepicker
                v-model="image.publish_date"
                required
                :language="settings.languages['es']"
                input-class="form-control"
                placeholder="Selecciona una fecha"
              ></datepicker>
            </b-form-group>
          </b-col>
        </b-row>
      </b-container>
      <b-container class="mt-5">
        <b-row>
          <b-col>
            <h2 class="mb-4">Propiedades del contenido</h2>
          </b-col>
        </b-row>
        <b-row>
          <b-col>
            <b-form-group label="Título" label-for="input-1">
              <b-form-input v-model="postData.title" required placeholder="Titulo del Post"></b-form-input>
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
                                `min: 120 caracteres, max: 158 caracteres. Total de caracteres: ${postData.meta_description.length}.`
                            "
            >
              <b-form-textarea
                id="input-2"
                v-model="postData.meta_description"
                required
                rows="4"
                placeholder="Meta descripción"
              ></b-form-textarea>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group id="input-group-2" label="Robots" label-for="input-2">
              <b-form-textarea
                id="input-2"
                v-model="postData.meta_robots"
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
                v-model="postData.meta_keywords"
                required
                rows="4"
                placeholder="Palabras claves"
              ></b-form-textarea>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group
              id="input-group-3"
              label="Publicar post"
              label-for="input-3"
              description="Estando activo el post será visible al público"
            >
              <b-form-checkbox v-model="postData.is_active" name="check-button" size="lg" switch></b-form-checkbox>
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
                v-model="postData.content"
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
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
import Datepicker from "vuejs-datepicker/dist/vuejs-datepicker.esm.js";
import * as lang from "vuejs-datepicker/src/locale";
import moment from "moment";
import timeout from '../../setTimeout.js'

export default {
  props: ["post"],
  components: {
    VueEditor,
    Datepicker
  },
  data: () => ({
    timeout: timeout,
    postData: {
      title: "",
      meta_description: "",
      meta_robots: "",
      meta_keywords: "",
      is_active: false,
      content: ""
    },
    image: {
      author: "",
      alt_img: "",
      publish_date: "",
      post_id: null,
      file: null
    },
    postErrors: {
      title: [],
      meta_description: [],
      meta_robots: [],
      meta_keywords: [],
      is_active: [],
      content: [],
      main_image: []
    },
    settings: {
      languages: lang
    }
  }),
  computed: {
    mainImageUrl() {
      if (this.image.file) return URL.createObjectURL(this.image.file);
      else if (this.image.url) return this.image.url;
      else return "/images/default-preview.png";
    }
  },
  methods: {
    savePost(formData) {
      let _this = this;

      axios
        .post(`/dashboard/posts/create`, formData)
        .then(res => {
          // save image
          _this.saveImage(res.data.post_id);
        })
        .catch(err => _this.makeToast(err.response.data, "danger"));
    },

    updatePost(formData) {
      let _this = this;

      axios
        .post(`/dashboard/posts/edit/${_this.post.id}`, formData)
        .then(res => {
          // save image
          _this.updateImage(res.data.post_id);
        })
        .catch(err => _this.makeToast(err.response.data, "danger"));
    },

    saveImage(post_id) {
      let _this = this;
      let formData = new FormData();

      Object.keys(_this.image).forEach(el => {
        if (el === "publish_date")
          formData.append(el, moment(_this.image[el]).format("YYYY-MM-DD"));
        else formData.append(el, _this.image[el]);
      });

      formData.append("post_id", post_id);
      axios
        .post(`/dashboard/images/post/main`, formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(res => {
          // save image
          _this.makeToast(res.data);
          setTimeout(() => window.location.replace("/dashboard/posts"), timeout);
        })
        .catch(err => _this.makeToast(err.response.data, "danger"));
    },

    updateImage(post_id) {
      let _this = this;
      let formData = new FormData();

      Object.keys(_this.image).forEach(el => {
        if (el === "publish_date")
          formData.append(el, moment(_this.image[el]).format("YYYY-MM-DD"));
        else formData.append(el, _this.image[el]);
      });

      formData.append("post_id", post_id);
      axios
        .post(
          `/dashboard/images/post/main/update/${_this.post.image.id}`,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data"
            }
          }
        )
        .then(res => {
          // save image
          _this.makeToast(res.data);
          //   setTimeout(() => window.location.replace("/dashboard/posts"), 300);
        })
        .catch(err => _this.makeToast(err.response.data, "danger"));
    },
    onSubmit() {
      let _this = this;
      let formData = new FormData();

      Object.keys(_this.postData).forEach(el => {
        if (el === "is_active") formData.append(el, Number(_this.postData[el]));
        else formData.append(el, _this.postData[el]);
      });

      _this.post === null || _this.post === undefined
        ? _this.savePost(formData)
        : _this.updatePost(formData);
    },
    onReset() {},
    handleImageAdded: function(file, Editor, cursorLocation, resetUploader) {
      // An example of using FormData
      // NOTE: Your key could be different such as:
      // formData.append('file', file)

      var formData = new FormData();
      formData.append("image", file);

      axios({
        url: "/dashboard/images/post/content",
        method: "POST",
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
        url: "/dashboard/images/post/content/delete",
        method: "POST",
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
    makeToast(msg, variant = "success", delay = timeout, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: "Actualización del post",
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    }
  },
  mounted() {
    let _this = this;
    if (_this.post) {
      Object.keys(_this.postData).forEach(key => {
        if (key !== "image") {
          _this.postData[key] = _this.post[key];
        }
      });

      Object.keys(_this.image).forEach(key => {
        if (key === "publish_date") {
          _this.image.publish_date = moment(_this.post.image[key]).format(
            "YYYY-MM-DD"
          );
        } else _this.image[key] = _this.post.image[key];
      });

      if (_this.post.image.url) _this.image.url = _this.post.image.url;
    }
  }
};
</script>

<style lang="scss">
.submit-btn {
  margin-right: 10px;
}
</style>
