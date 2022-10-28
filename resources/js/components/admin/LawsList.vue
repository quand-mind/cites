<template>
  <div>
    <div class="caja bg-light p-2 my-2">
      <h1>Legislación</h1>
      <h4 class="ml-4">Sube archivos <b>.pdf</b> donde se definan las leyes, describelas y especifica si son nacionales o internacionales</h4>
    </div>
    <b-button @click="showCreateModal" variant="primary"><font-awesome-icon :icon="['fa', 'plus']"></font-awesome-icon> Agregar archivo</b-button>
    <b-button href="/dashboard/laws/order" variant="info"><font-awesome-icon :icon="['fa', 'sort-numeric-up']"></font-awesome-icon> Ordenar archivos</b-button>
    <v-client-table :data="tableData" :columns="columns" :options="options">
      <!-- actions slot -->
      <div class="action-container" slot="acciones" slot-scope="props">
        <a class="text-dark" @click.prevent="{editFile(props.row)}">
          <font-awesome-icon :icon="['fa', 'edit']"></font-awesome-icon>
        </a>

        <a class="text-danger" @click.prevent="{deleteFile(props.row)}">
          <font-awesome-icon :icon="['fa', 'trash']"></font-awesome-icon>
        </a>
      </div>

      <!-- name slot -->
      <span slot="nombre" slot-scope="props">{{props.row.name}}</span>

      <!-- description slot -->
      <span slot="descripcion" slot-scope="props">{{props.row.description}}</span>

      <!-- type slot -->
      <span slot="tipo" slot-scope="props">{{props.row.type}}</span>

      <!-- preview slot -->
      <span slot="ver_archivo" slot-scope="props"><a :href="'/storage' + props.row.path" target="_blank"><font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon> Ver archivo</a></span>
    </v-client-table>

    <!-- Delete modal -->

    <b-modal ref="delete-modal" hide-footer>
      <template v-slot:modal-title>
        <span class="text-danger">Eliminando archivo {{selectedFile.name}}</span>
      </template>
      <div v-if="selectedFile" class="d-block text-center">
        <h3>¿Estas seguro de que deseas eliminar este archivo?</h3>

        <b-button class="mt-3" block variant="danger" @click="submitDeleteFile">Confirmar</b-button>
        <b-button class="mt-3" block @click="hideDeleteModal">Cancelar</b-button>
      </div>
    </b-modal>

    <!-- Edit modal -->

    <b-modal ref="edit-modal" hide-footer>
      <template v-slot:modal-title>
        <span>Editando Archivo: {{selectedFile && selectedFile.name}}</span>
      </template>
      <div v-if="selectedFile" class="d-block">
        <b-form class="edit-form" @submit.prevent="onEditSubmit" @reset="onReset">
          <b-form-group label="Descripción:" label-for="input-2">
            <b-form-input v-model="editForm.description" required></b-form-input>
          </b-form-group>

          <b-form-group label="Tipo:" label-for="input-2">
            <b-form-select v-model="editForm.type"
              :options="lawsOptions"></b-form-select>
          </b-form-group>

          <b-button type="submit" variant="success">Guardar Cambios</b-button>
          <b-button type="reset" variant="outline-danger">Limpiar</b-button>
        </b-form>
      </div>

      <b-button class="mt-3" block @click="hideEditModal">Cancelar</b-button>
    </b-modal>

    <!-- Create user modal -->
    <b-modal ref="create-modal" hide-footer>
      <template v-slot:modal-title>
        <span>Nuevo Archivo</span>
      </template>
      <div class="d-block">
        <b-form class="edit-form" @submit.prevent="onCreateSubmit" @reset="onResetCreate">
          <b-form-group class="user-file">
            <b-form-file
              accept="application/pdf"
              v-model="newFile"
              placeholder="Seleccione un archivo"
              drop-placeholder="Drop file here..."
            ></b-form-file>
            <div class="mt-3">Archivo seleccionado: {{ newFile ? newFile.name : '' }}</div>
          </b-form-group>

          <b-form-group label="Descripción:" label-for="input-2">
            <b-form-input v-model="createForm.description" required></b-form-input>
          </b-form-group>

          <b-form-group label="Tipo:" label-for="input-2">
            <b-form-select v-model="createForm.type"
              :options="lawsOptions"></b-form-select>
          </b-form-group>

          <b-progress class="mb-5" v-if="showProgressBar" :value="uploadPercentage" :max="100" show-progress animated></b-progress>

          <b-button type="submit" variant="success">Agregar archivo</b-button>
          <b-button type="reset" variant="outline-danger">Limpiar</b-button>
        </b-form>
      </div>

      <b-button class="mt-3" block @click="hideCreateModal">Cancelar</b-button>
    </b-modal>
  </div>
</template>

<script>
import axios from "axios";
import timeout from '../../setTimeout.js'

export default {
  props: ["laws"],
  data: () => ({
    timeout: timeout,
    columns: [
      "nombre",
      "descripcion",
      "ver_archivo",
      "tipo",
      "acciones"
    ],
    lawsOptions: [
      {
        value: null, text: "Seleccione un tipo de legislación"
      },
      {
        value: 'nac', text: "Nacional"
      },
      {
        value: 'int', text: "Internacional"
      }
    ],
    tableData: [],
    options: {
      perPage: 10,
      perPageValues: [10, 20, 50]
    },
    selectedFile: null,
    editForm: {},
    createForm: {
      description: "",
      type: null
    },
    formFile: null,
    newFile: null,
    uploadPercentage: 0,
    showProgressBar: false
  }),
  methods: {
    showCreateModal() {
      this.$refs["create-modal"].show();
    },
    hideCreateModal() {
      this.$refs["create-modal"].hide();
    },
    editFile(file) {
      this.selectedFile = file;
      this.showEditModal();
    },
    deleteFile(file) {
      this.selectedFile = file;
      this.showDeleteModal();
    },
    showEditModal() {
      this.editForm = {
        description: this.selectedFile.description,
        type: this.selectedFile.type
      };
      this.$refs["edit-modal"].show();
    },
    showDeleteModal() {
      this.$refs["delete-modal"].show();
    },
    hideEditModal() {
      this.$refs["edit-modal"].hide();
      this.editForm = {};
      this.selectedFile = null;
      this.formFile = null;
    },
    hideDeleteModal() {
      this.$refs["delete-modal"].hide();
    },
    onEditSubmit() {
      let _this = this;
      let form = new FormData();

      Object.keys(_this.editForm).forEach(key => form.append(key, _this.editForm[key]));

      axios
        .post(`/dashboard/laws/edit/${_this.selectedFile.id}`, form)
        .then(res => {
          if (res.status === 200) {
            _this.makeToast(res.data);
            _this.hideEditModal();
            setTimeout(() => window.location.reload(), timeout);
          }
        })
        .catch(err => {
          let { data } = err.response

          console.log(JSON.stringify(err))

          if (data.errors !== undefined || data.errors !== null) {
            let errors = Object.values(data.errors).toString()
            _this.makeToast(errors, "danger", 5000);
          } else {
            _this.makeToast(data, "danger", 5000);
          }
        });
    },
    onReset() {
      this.editForm = {};
      this.newFile = null;
    },
    onResetCreate() {
      this.createForm = {
        description: "",
        type: null
      };
    },

    makeToast(msg, variant = "success", delay = timeout, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: "Evento de actualización de archivo",
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    },
    onCreateSubmit() {
      let _this = this;

      let form = new FormData();

      Object.keys(_this.createForm).forEach(key => form.append(key, _this.createForm[key]));

      if (_this.newFile) {
        form.append("file", _this.newFile);
        form.append("name", _this.newFile.name);
      }

      _this.showProgressBar = true

      axios
        .post(`/dashboard/laws/create`, form, {
          headers: {
              'Content-Type': 'multipart/form-data'
          },
          onUploadProgress: function( progressEvent ) {
            _this.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100 ))
          }.bind(this)
        })
        .then(res => {
          if (res.status === 200) {
            _this.makeToast(res.data);
            _this.hideEditModal();
            setTimeout(() => window.location.reload(), timeout);
          }
        })
        .catch(err => {
          console.log(err)
          let { data } = err.response

          _this.showProgressBar = false;

          if (data.errors !== undefined && data.errors !== null) {
            let errors = Object.values(data.errors).toString()
            _this.makeToast(errors, "danger");
          } else {
            _this.makeToast(data.message, "danger");
          }
        });
    },
    submitDeleteFile() {
      let _this = this;

      axios
        .delete(`/dashboard/laws/${_this.selectedFile.id}`)
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
            errors = Object.keys(data.errors).toString()
            _this.makeToast(errors, "danger");
          } else {
              _this.makeToast(data, "danger");
          }
        });
    }
  },

  computed: {
    newFileUrl() {
      return this.newFile ? URL.createObjectURL(this.newFile) : null;
    }
  },

  mounted () {
    this.tableData = this.laws
  }
};
</script>
<style lang="scss">
.action-container {
  display: flex;
  justify-content: space-around;

  a {
    &:hover {
      cursor: pointer;
    }
  }
}

// Table styles

// hide default filter
.VueTables__search {
  display: none;
}
</style>
