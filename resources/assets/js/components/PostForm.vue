<template>
  <div>
    <b-form @submit="onSubmit" @reset="onReset">
      <b-container>
        <b-row>
          <b-col cols="6">
            <b-form-group label="Portada">
              <b-form-file
                v-model="form.main_image"
                :state="Boolean(form.main_image)"
                placeholder="Selecciona un archivo o arrástralo hasta aquí..."
                drop-placeholder="Drop file here..."
                required
              ></b-form-file>
              <b-img-lazy style="margin-top: 10px" :src="mainImageUrl" alt="image preview" fluid></b-img-lazy>
              <div
                class="mt-3"
              >Archivo seleccionado: {{ form.main_image ? form.main_image.name : '' }}</div>
            </b-form-group>
          </b-col>
        </b-row>
      </b-container>
      <b-container>
        <b-row>
          <b-col>
            <b-form-group label="Título" label-for="input-1">
              <b-form-input
                v-model="form.title"
                data-browse="Explorar"
                required
                placeholder="Titulo del Post"
              ></b-form-input>
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
              :description="`min: 120 caracteres, max: 158 caracteres. Total de caracteres: ${form.meta_description.length}.`"
            >
              <b-form-textarea
                id="input-2"
                v-model="form.meta_description"
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
                v-model="form.meta_robots"
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
                v-model="form.meta_keywords"
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
              <b-form-checkbox v-model="form.is_active" name="check-button" size="lg" switch></b-form-checkbox>
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
                v-model="form.content"
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
      <pre class="m-0">{{ form }}</pre>
    </b-card>
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
export default {
  props: ["post"],
  components: {
    VueEditor
  },
  data: () => ({
    form: {
      title: "",
      meta_description: "",
      meta_robots: "",
      meta_keywords: "",
      is_active: false,
      content: "",
      main_image: null
    },
    errors: {
      title: [],
      meta_description: [],
      meta_robots: [],
      meta_keywords: [],
      is_active: [],
      content: [],
      main_image: []
    }
  }),
  computed: {
    mainImageUrl() {
      return this.form.main_image
        ? URL.createObjectURL(this.form.main_image)
        : "/images/default-preview.png";
    }
  },
  methods: {
    onSubmit() {
      let _this = this;
      let formData = new FormData();

      Object.keys(_this.form).forEach(el => {
        formData.append(el, _this.form[el]);
      });

      axios
        .post(`/dashboard/posts/create`, formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(res => {
          console.log(res.data);
        })
        .catch(err => console.log(err));
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
          console.log(err);
        });
    }
  }
};
</script>

<style lang="scss">
.submit-btn {
  margin-right: 10px;
}
</style>
