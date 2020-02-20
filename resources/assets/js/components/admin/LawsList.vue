<template>
  <div>
    <b-button @click="showCreateModal" variant="primary">Agregar archivo</b-button>
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
      <span slot="ver_archivo" slot-scope="props"><a :href="props.row.path" target="_blank">Ver archivo</a></span>
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
          <b-form-group class="user-file">
            <picture>
              <b-img thumbnail fluid :src="editFileURL || selectedFile.file" alt="user file"></b-img>
            </picture>
            <b-form-file
              accept=".doc,.pdf"
              v-model="formFile"
              placeholder="Seleccione un archivo"
              drop-placeholder="Drop file here..."
            ></b-form-file>
            <div class="mt-3">Archivo seleccionado: {{ formFile ? formFile.name : '' }}</div>
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
              accept=".doc,.pdf"
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

export default {
  props: ["laws"],
  data: () => ({
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
      name: "",
      description: "",
      type: null
    },
    formFile: null,
    newFile: null
  }),
  methods: {
    showCreateModal() {
      this.$refs["create-modal"].show();
    },
    hideCreateModal() {
      this.$refs["create-modal"].hide();
    },
    editFile(user) {
      this.selectedFile = user;
      this.showEditModal();
    },
    deleteFile(user) {
      this.selectedFile = user;
      this.showDeleteModal();
    },
    showEditModal() {
      this.editForm = {
        name: this.selectedFile.name,
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

      Object.keys(_this.editForm).forEach(key => {
        if (key !== "file") form.append(key, _this.editForm[key]);
      });

      _this.formFile && form.append("file", _this.formFile);

      axios
        .post(`/dashboard/laws/edit/${_this.selectedFile.id}`, form, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(res => {
          if (res.status === 200) {
            _this.makeToast(res.data);
            _this.hideEditModal();
            setTimeout(() => window.location.reload(), 3000);
          }
        })
        .catch(err => {
          _this.makeToast(err.response.data, "danger");
        });
    },
    onReset() {
      this.editForm = {};
    },
    onResetCreate() {
      this.createForm = {
        name: "",
        username: "",
        email: "",
        role: "",
        is_active: true,
        password_confirmation: "",
        password: ""
      };
    },

    makeToast(msg, variant = "success", delay = 3000, append = false) {
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

      console.log(_this.newFile)

      axios
        .post(`/dashboard/laws/create/`, form, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(res => {
          if (res.status === 200) {
            _this.makeToast(res.data);
            _this.hideEditModal();
            setTimeout(() => window.location.reload(), 2000);
          }
        })
        .catch(err => {
          _this.makeToast(err.response.data, "danger");
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
            setTimeout(() => window.location.reload(), 2000);
          }
        })
        .catch(err => {
          _this.makeToast(err.response.data, "danger");
        });
    }
  },

  computed: {
    editFileURL() {
      return this.formFile ? URL.createObjectURL(this.formFile) : null;
    },
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
