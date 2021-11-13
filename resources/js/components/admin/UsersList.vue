<template>
    <div>
     <div class="caja bg-light p-2 my-2">
      <h1>Usuarios</h1>
      <h4 class="ml-4">Crea, edita o elimina usuarios que pueden publicar y modificar el sitio web</h4>
    </div>
    <b-button @click="showCreateModal" variant="primary">Crear nuevo usuario</b-button>
    <v-client-table :data="tableData" :columns="columns" :options="options" style="width: 90%;">
      <!-- actions slot -->
      <div class="action-container" slot="acciones" slot-scope="props">
        <a class="text-dark" @click.prevent="{editUser(props.row)}">
          <font-awesome-icon :icon="['fa', 'edit']"></font-awesome-icon>
        </a>

        <a class="text-danger" @click.prevent="{deleteUser(props.row)}">
          <font-awesome-icon :icon="['fa', 'trash']"></font-awesome-icon>
        </a>
      </div>

      <!-- user photo slot -->
      <b-img
        thumbnail
        fluid
        slot="foto"
        class="profile-img"
        slot-scope="props"
        :src="props.row.user.photo || '/images/default-user.png'"
        alt="user photo"  
      ></b-img>

      <!-- is active slot -->
      <b-form-checkbox
        slot="activo"
        slot-scope="props"
        name="check-button"
        class="check-active"
        :checked="props.row.user.is_active"
        switch
        @change="handleCheckBoxChange(props.row)"
      ></b-form-checkbox>

      <!-- name slot -->
      <span slot="nombre" slot-scope="props">{{props.row.user.name}}</span>

      <!-- username slot -->
      <span slot="usuario" slot-scope="props">{{props.row.username}}</span>

      <!-- email slot -->
      <span slot="correo" slot-scope="props">{{props.row.email}}</span>

      <!-- role slot -->
      <span slot="rol" slot-scope="props">{{props.row.role}}</span>
    </v-client-table>

    <!-- Delete modal -->

    <b-modal ref="delete-modal" hide-footer>
      <template v-slot:modal-title>
        <span class="text-danger">Eliminando usuario {{selectedUser.username}}</span>
      </template>
      <div v-if="selectedUser" class="d-block text-center">
        <h3>¿Estas seguro de que deseas eliminar a {{selectedUser.user.name}}?</h3>
        <i>Todos los post y páginas creadas por este usuario serán eliminadas</i>

        <b-button class="mt-3" block variant="danger" @click="submitDeleteUser">Confirmar</b-button>
        <b-button class="mt-3" block @click="hideDeleteModal">Cancelar</b-button>
      </div>
    </b-modal>

    <!-- Edit modal -->

    <b-modal ref="edit-modal" hide-footer>
      <template v-slot:modal-title>
        <span>Editando Usuario: {{selectedUser && selectedUser.username}}</span>
      </template>
      <div v-if="selectedUser" class="d-block">
        <b-form class="edit-form" @submit.prevent="onEditSubmit" @reset="onReset">
          <b-form-group class="user-photo">
            <picture>
              <b-img thumbnail fluid :src="editPhotoURL || selectedUser.photo" alt="user photo"></b-img>
            </picture>
            <b-form-file
              accept="image/*"
              v-model="formPhoto"
              placeholder="Escoge una foto(Max. 2MB)"
              drop-placeholder="Subir archivo aquí..."
              max-size="2048"
            ></b-form-file>
            <div class="mt-3">Selected file: {{ formPhoto ? formPhoto.name : '' }}</div>
          </b-form-group>

          <b-form-group id="input-group-2" label="Nombre:" label-for="input-2">
            <b-form-input id="input-2" v-model="editForm.name" required placeholder="Jose Quintero"></b-form-input>
          </b-form-group>

          <b-form-group id="input-group-2" label="Usuario:" label-for="input-2">
            <b-form-input
              id="input-2"
              v-model="editForm.username"
              required
              placeholder="jose_usuario"
            ></b-form-input>
          </b-form-group>

          <b-form-group label="Cédula:" label-for="input-2">
            <b-form-input v-model="editForm.dni" required placeholder="V-20785684"></b-form-input>
          </b-form-group>

          <b-form-group id="input-group-1" label="Correo:" label-for="input-1">
            <b-form-input
              id="input-1"
              v-model="editForm.email"
              type="email"
              required
              placeholder="Introduce el correo"
            ></b-form-input>
          </b-form-group>

          <b-form-group label="Ciudad de Residencia:" label-for="input-1">
            <b-form-input
              v-model="editForm.domicile"
              required
              placeholder="Caracas"
            ></b-form-input>
          </b-form-group>

          <b-form-group label="Dirección:" label-for="input-1">
            <b-form-textarea
              v-model="editForm.address"
              required
              rows="3"
              max-rows="6"
              placeholder="Av. Universidad, Caracas, Venezuela."
            ></b-form-textarea>
          </b-form-group>

          <b-form-group id="input-group-3" label="Rol:" label-for="input-3">
            <b-form-select id="input-3" v-model="editForm.role" :options="roles" required></b-form-select>
          </b-form-group>

          <b-form-group id="input-group-4">
            <b-form-checkbox v-model="editForm.is_active">Usuario activo</b-form-checkbox>
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
        <span>Nuevo Usuario</span>
      </template>
      <div class="d-block">
        <b-form class="edit-form" @submit.prevent="onCreateSubmit" @reset="onResetCreate">
          <b-form-group class="user-photo">
            <picture>
              <b-img
                thumbnail
                fluid
                :src="newPhotoUrl || '/images/default-user.png'"
                alt="user photo"
              ></b-img>
            </picture>
            <b-form-file
              accept="image/*"
              v-model="newPhoto"
              placeholder="Escoge una foto (Max. 2MB)"
              drop-placeholder="Subir archivo aquí..."
            ></b-form-file>
            <div class="mt-3">Selected file: {{ newPhoto ? newPhoto.name : '' }}</div>
          </b-form-group>

          <b-form-group label="Nombre:" label-for="input-2">
            <b-form-input v-model="createForm.name" required placeholder="Marcos Navarro"></b-form-input>
          </b-form-group>

          <b-form-group label="Usuario:" label-for="input-2">
            <b-form-input v-model="createForm.username" required placeholder="marcos_20"></b-form-input>
          </b-form-group>

          <b-form-group label="Cédula:" label-for="input-2">
            <b-form-input v-model="createForm.dni" required placeholder="V-20785684"></b-form-input>
          </b-form-group>

          <b-form-group label="Correo:" label-for="input-1">
            <b-form-input
              v-model="createForm.email"
              type="email"
              required
              placeholder="Introduce correo"
            ></b-form-input>
          </b-form-group>

          <b-form-group label="Ciudad de Residencia:" label-for="input-1">
            <b-form-input
              v-model="createForm.domicile"
              required
              placeholder="Caracas"
            ></b-form-input>
          </b-form-group>

          <b-form-group label="Dirección:" label-for="input-1">
            <b-form-textarea
              v-model="createForm.address"
              required
              rows="3"
              max-rows="6"
              placeholder="Av. Universidad, Caracas, Venezuela."
            ></b-form-textarea>
          </b-form-group>

          <b-form-group label="Contraseña:" label-for="input-2">
            <b-form-input
              
              v-model="createForm.password"
              required
              type="password"
              placeholder="********"
            ></b-form-input>
          </b-form-group>

          <b-form-group label="Repita la contraseña:" label-for="input-2">
            <b-form-input
              
              v-model="createForm.password_confirmation"
              required
              type="password"
              placeholder="********"
            ></b-form-input>
          </b-form-group>

          <b-form-group label="Rol:" label-for="input-3">
            <b-form-select v-model="createForm.role" :options="roles" required></b-form-select>
          </b-form-group>

          <b-form-group>
            <b-form-checkbox v-model="createForm.is_active">Usuario activo</b-form-checkbox>
          </b-form-group>

          <b-button type="submit" variant="success">Crear Usuario</b-button>
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
  props: ["users"],
  data: () => ({
    timeout: timeout,
    columns: [
      "usuario",
      "nombre",
      "correo",
      "rol",
      "activo",
      "foto",
      "acciones"
    ],
    roles: ["writer", "admin", "funcionario"],
    tableData: [],
    options: {
      perPage: 10,
      perPageValues: [10, 20, 50]
    },
    selectedUser: null,
    editForm: {},
    createForm: {
      name: "",
      username: "",
      address: "",
      dni: "",
      nationality: "Venezolano",
      domicile: "",
      email: "",
      role: "",
      is_active: true,
      password: "",
      password_confirmation: ""
    },
    formPhoto: null,
    newPhoto: null
  }),
  methods: {
    showCreateModal() {
      this.$refs["create-modal"].show();
    },
    hideCreateModal() {
      this.$refs["create-modal"].hide();
    },
    editUser(user) {
      this.selectedUser = user;
      this.showEditModal();
    },
    deleteUser(user) {
      this.selectedUser = user;
      this.showDeleteModal();
    },
    showEditModal() {
      this.editForm = {
        name: this.selectedUser.user.name,
        username: this.selectedUser.username,
        address:this.selectedUser.user.address,
        dni: this.selectedUser.user.dni,
        nationality: this.selectedUser.user.nationality,
        domicile: this.selectedUser.user.domicile,
        email: this.selectedUser.email,
        role: this.selectedUser.role,
        photo: this.selectedUser.user.photo,
        is_active: Boolean(this.selectedUser.user.is_active)
      };
      this.$refs["edit-modal"].show();
    },
    showDeleteModal() {
      this.$refs["delete-modal"].show();
    },
    hideEditModal() {
      this.$refs["edit-modal"].hide();
      this.editForm = {};
      this.selectedUser = null;
      this.formPhoto = null;
    },
    hideDeleteModal() {
      this.$refs["delete-modal"].hide();
    },
    handleCheckBoxChange(row) {
      let _this = this;
      let uIdx = _this.tableData.findIndex(user => row.id === user.id);
      _this.tableData[uIdx].user.is_active = !_this.tableData[uIdx].user.is_active;

      axios
        .post(`/dashboard/users/changeActiveState/${row.user.id}`, {
          is_active: _this.tableData[uIdx].user.is_active
        })
        .then(res => {
          if (res.status === 200) {
            _this.makeToast(res.data, "info", 2000);
          }
        })
        .catch(err => console.log(err));
    },
    onEditSubmit() {
      let _this = this;
      let form = new FormData();

      Object.keys(_this.editForm).forEach(key => {
        if (key === "is_active") {
          form.append(key, Number(_this.editForm[key]));
          return;
        }

        if (key !== "photo") form.append(key, _this.editForm[key]);
      });

      _this.formPhoto && form.append("photo", _this.formPhoto);

      axios
        .post(`/dashboard/users/edit/${_this.selectedUser.id}`, form, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(res => {
          if (res.status === 200) {
            _this.makeToast(res.data);
            _this.hideEditModal();
            setTimeout(() => window.location.reload(), timeout);
          }
        })
        .catch(err => {
          _this.makeToast(err.response.data.message, "danger");
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
        address: "",
        nationality: "Venezolano",
        dni: "",
        domicile: "",
        role: "",
        is_active: true,
        password_confirmation: "",
        password: ""
      };
    },

    makeToast(msg, variant = "success", delay = timeout, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: "Evento de actualización de usuario",
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    },
    onCreateSubmit() {
      let _this = this;

      let form = new FormData();

      Object.keys(_this.createForm).forEach(key => {
        if (key === "is_active")
          form.append(key, Number(_this.createForm[key]));
        else form.append(key, _this.createForm[key]);
      });

      _this.newPhoto && form.append("photo", _this.newPhoto); 

      axios
        .post(`/dashboard/users/create`, form, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(res => {
          if (res.status === 200) {
            _this.makeToast(res.data);
            _this.hideEditModal();
            axios.post(`/sendEmail`, form, {
              headers: {
                "Content-Type": "multipart/form-data"
              }
            })
            .then(res => {
              setTimeout(() => window.location.reload(), timeout);
            })
          }
        })
        .catch(err => {
          _this.makeToast(err.response.data.message, "danger");
        });
    },
    submitDeleteUser() {
      let _this = this;

      axios
        .delete(`/dashboard/users/${_this.selectedUser.id}`)
        .then(res => {
          if (res.status === 200) {
            _this.makeToast(res.data);
            _this.hideDeleteModal();
            setTimeout(() => window.location.reload(), timeout);
          }
        })
        .catch(err => {
          _this.makeToast(err.response.data.message, "danger");
        });
    }
  },

  computed: {
    editPhotoURL() {
      return this.formPhoto ? URL.createObjectURL(this.formPhoto) : null;
    },
    newPhotoUrl() {
      return this.newPhoto ? URL.createObjectURL(this.newPhoto) : null;
    }
  },
  mounted() {
    this.tableData = this.users.map(user => {
      user.user.is_active = user.user.is_active === 1;
      return user;
    });
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

.check-active {
  display: block;
  margin: 0 auto;
}

.profile-img {  
  margin: 0 auto;
  display: block;
}

.edit-form {
  .user-photo {
    position: relative;

    .edit-photo {
      position: absolute;
      bottom: 0;
      left: 4px;
    }

    img {
      max-width: 110px;
    }
  }
}

// Table styles

// hide default filter
.VueTables__search {
  display: none;
}
</style>
