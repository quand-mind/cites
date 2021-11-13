<template>
  <div>
    <a href="/dashboard/pages"><font-awesome-icon :icon="['fas', 'arrow-left']"></font-awesome-icon> Volver a las páginas</a>
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
              <b-form-input v-model="pageData.title" :disabled="Boolean(pageData.is_static)" required placeholder="Titulo de la página" :description="`Introduce un título claro y no demasiado largo, preferiblemente usa palabras clave`"></b-form-input>
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
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group id="input-group-2" label="Robots" label-for="input-2" 
                :description="
                                `Esta etiqueta sirve para indicarle a google si debe indexar esta pagina en sus busquedas y si debe seguir los links internos que contenga e indexarlos también.`
                            ">
              <b-form-select
                id="input-2"
                v-model="pageData.meta_robots"
                required
                rows="4"
                :options="robots"
              ></b-form-select>
            </b-form-group>
          </b-col>
        </b-row>
      </b-container>

      <b-container>
        <b-row>
          <b-col>
            <b-form-group id="input-group-2" label="Palabras claves" label-for="input-2" 
                :description="
                                `Indique las palabras claves separadas por una coma por ejemplo 'organismos vivos modificados, OGM, mutaciones'. Las palabras claves son el término o conjunto de términos que utilizan los usuarios cuando buscan en google.`
                            ">
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
            <b-form-group label="" label-for="input-3">
              <b-form-checkbox v-model="pageData.is_subpage" :checked="pageData.is_subpage" name="check-button" :disabled="Boolean(pageData.is_static)" switch @change="showSubpagePrompt">
                Marcar como una subpágina
              </b-form-checkbox>
            </b-form-group>
            <b-form-group label="" label-for="input-3">
              <b-form-checkbox v-model="pageData.is_onMenu" :checked="pageData.is_onMenu" name="check-button" switch>
                Agregar al menú principal
              </b-form-checkbox>
            </b-form-group>
            <b-form-group label="" label-for="input-3">
              <b-form-checkbox v-model="pageData.is_active" :checked="pageData.is_active" name="check-button" switch>
                Marcar como página activa
              </b-form-checkbox>
            </b-form-group>
            <b-form-group label="Seleccione una página raíz:" label-for="input-3">
              <b-form-select v-model="pageData.main_page" :disabled="!pageData.is_subpage" :options="mainPagesOptions"></b-form-select>
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
            <h4>Lista de archivos multimedia disponibles</h4>
            <b-dropdown class="mb-3" id='media-dropdown' text="Haga click en un archivo para copiar la url" variant="outline-secondary">
              <b-dropdown-item
                v-for="media in mediaFiles"
                :key="media.id + media.name"
                class="dropdown-item"
              >
                <div 
                  class="copy-btn"
                  v-clipboard:copy="media.path"
                  v-clipboard:success="() => makeToast('URL copiada al portapapeles')"
                >
                  <font-awesome-icon
                    class="mr-3 text-primary"
                    :icon="['fas', 'clipboard']"
                  ></font-awesome-icon> 
                </div>
                {{ media.name }}
                <div class="actions">
                  <font-awesome-icon @click="() => deleteMediaFile(media.id)" class="ml-1 text-danger" :icon="['fas', 'times-circle']"></font-awesome-icon>
                </div>
              </b-dropdown-item>
            </b-dropdown>
          </b-col>
        </b-row>
      </b-container>
      <b-container>
        <b-row>
          <b-col>
            <b-form-group
              :description="media.file ? `Tamaño del archivo: ${parseFloat(media.file.size / 1e6).toFixed(2)}MB` : 'Hasta 6MB permitidos'"
            >
              <b-form-file 
                v-model="media.file"
                :state="Boolean(media.file)"
                placeholder="Agregar archivo multimedia"
                drop-placeholder="Agregar archivo multimedia"
                accept="video/mpeg,video/ogg,video/webm,video/mp4"
              ></b-form-file>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-input class="mb-2" v-model="media.name" placeholder="Nombre del archivo"></b-form-input>
            <b-button @click="saveMediaFile" class="submit-btn" size="sm" variant="primary">Agregar nuevo archivo</b-button>
            <b-button size="sm" type="reset" variant="danger" @click="media.file = null; media.name = ''">Limpiar</b-button>
          </b-col>
        </b-row>
      </b-container>
      <b-container>
        <b-row>
          <b-col>
            <b-button class="submit-btn" size="lg" type="submit" variant="primary">Guardar contenido</b-button>
            <b-button size="lg" type="reset" variant="danger" @click="pageData.content = ''">Limpiar</b-button>
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
  props: ["page", "mainpages"],
  name: 'pageForm',
  components: {
    VueEditor,
    Datepicker
  },
  data: () => ({
    timeout: timeout,
    pageData: {
      title: "",
      meta_description: "",
      meta_robots: "",
      meta_keywords: "",
      content: "",
      is_onMenu: false,
      is_subpage: false,
      is_active: false,
      main_page: 0
    },
    pageErrors: {
      title: [],
      meta_description: [],
      meta_robots: [],
      meta_keywords: [],
      content: []
    },
    settings: {
      languages: lang
    },robots: [{ text: 'Indexar y Seguir', value: 'index, follow' },{ text: 'No Indexar', value: 'noindex' }, { text: 'Indexar y No seguir', value: 'index,nofollow' },{ text: 'No indexar, No seguir', value: ''}],
    mainPagesOptions: [],
    media: {
      file: null,
      name: '',
    },
    mediaFiles: []
  }),
  methods: {
    showSubpagePrompt () {
        this.$dialog.alert("Esto podría dejar huérfanas a las subpáginas que dependan de esta página si esto es una página principal")
          .then(function(dialog) {
            console.log('Closed');
          });
    },
    savePage(formData) {
      let _this = this;

      axios
        .post(`/dashboard/pages/create`, formData)
        .then(res => {
          _this.makeToast(res.data);
          setTimeout(() => window.location.replace("/dashboard/pages"), timeout);
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

    updatePage(formData) {
      let _this = this;

      axios
        .post(`/dashboard/pages/edit/${_this.page.id}`, formData)
        .then(res => {
          _this.makeToast(res.data);
          setTimeout(() => window.location.replace("/dashboard/pages"), timeout);
        })
        .catch(async err => {
          let { data } =  err.response

          console.log(data)
          
          if (data.errors !== undefined || data.errors !== null) {
            let errors = Object.values(data.errors).toString()
            _this.makeToast(errors, "danger");
          } else {
            _this.makeToast(data, "danger");
          }
        });
    },
    onSubmit() {
      let _this = this;
      let formData = new FormData();

      Object.keys(_this.pageData).forEach(el => {
        if (el === "is_subpage" || el === "is_active" || el === "is_onMenu")
          formData.append(el, Number(_this.pageData[el]));

        else if (el === 'main_page' && _this.pageData[el] === undefined)
          formData.append(el, null);
          
        else
          formData.append(el, _this.pageData[el]);
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

      let _this = this

      var formData = new FormData();
      formData.append("image", file);

      axios({
        url: "/dashboard/images/page/content",
        method: "post",
        data: formData
      })
        .then(result => {
          let url = result.data.url; // Get url from response
          Editor.insertEmbed(cursorLocation, "image", url);
          resetUploader();
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
    handleImageRemoved: function(file, Editor, cursorLocation, resetUploader) {
      // An example of using FormData
      // NOTE: Your key could be different such as:
      // formData.append('file', file)

      let _this = this

      var formData = new FormData();
      formData.append("path", file);

      axios({
        url: "/dashboard/images/page/content/delete",
        method: "post",
        data: formData
      })
        .then(result => {
          let url = result.data.url; // Get url from response
          // Editor.insertEmbed(cursorLocation, "image", url);
          resetUploader();
        })
        .catch(err => {
          let { data } = err.response
          
          if (data.errors !== undefined || data.errors !== null) {
            errors = Object.keys(data.errors).toString()
            _this.makeToast(errors, "danger");
          } else {
              _this.makeToast(data, "danger");
          }
        });
    },
    makeToast(msg, variant = "success", delay = timeout, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: "Actualización de la página",
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    },
    saveMediaFile() {
      // Add a new multimedia file
      if (this.media.file && this.media.name) {
        let _this = this
  
        var formData = new FormData();
        formData.append("file", _this.media.file);
        formData.append("name", _this.media.name);
  
        axios({
          url: "/dashboard/media",
          method: "post",
          data: formData
        })
          .then(res => {
            _this.makeToast(res.data);

            // Get new media lists
            _this.getMediaFiles();
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
      } else {
        this.makeToast('Falta información para guardar el archivo', 'danger')
      }
    },
    deleteMediaFile(id) {
      // get all media files
      let _this = this

      axios.delete(`/dashboard/media/${id}`)
        .then(res => {
          _this.getMediaFiles()
          _this.makeToast('Archivo multimedia eliminado.')
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
    getMediaFiles () {
      // get all media files
      let _this = this

      axios.get('/dashboard/media')
        .then(res => {
          _this.mediaFiles = [...res.data]
        })
        .catch(err => console.log(err))
    }
  },
  mounted() {
    let _this = this;
    if (_this.page) {
      Object.keys(_this.page).forEach(key => {
          if (key === 'is_subpage' || key === 'is_active') _this.pageData[key] = Boolean(parseInt(_this.page[key]));
          else if (key === 'main_page')  _this.pageData[key] = parseInt(_this.page[key]);
          else _this.pageData[key] = _this.page[key];
      });
    }

    _this.mainpages.forEach(page => {
      if (!_this.page || page.id !== _this.page.id) {
        _this.mainPagesOptions.push({ text: page.title, value: page.id })
      }
    });

    _this.getMediaFiles()
  }
};
</script>

<style lang="scss">
.submit-btn {
  margin-right: 10px;
}

.dropdown-item {
  width: 100%;
  
  a {
    width: 100%;
    display: flex;
    position: relative;
    padding-right: 60px;

    .actions {
      position: absolute;
      right: 0;
    }
  }
}
</style>
