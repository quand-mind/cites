<template>
  <div>
    <v-client-table :data="tableData" :columns="columns" :options="options">
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
        :src="props.row.photo || '/images/default-user.png'"
        alt="user photo"
      ></b-img>

      <!-- is active slot -->
      <b-form-checkbox
        slot="activo"
        slot-scope="props"
        name="check-button"
        class="check-active"
        :checked="props.row.is_active"
        switch
        @change="handleCheckBoxChange(props.row)"
      ></b-form-checkbox>

      <!-- name slot -->
      <span slot="nombre" slot-scope="props">{{props.row.name}}</span>

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
        <span class="text-danger">Deleting User</span>
      </template>
      <div v-if="selectedUser" class="d-block text-center">
        <h3>Are you sure that you want delete {{selectedUser.name}} from users?</h3>
      </div>

      <b-button class="mt-3" block @click="hideDeleteModal">Cancel</b-button>
    </b-modal>

    <!-- Edit modal -->

    <b-modal ref="edit-modal" hide-footer>
      <template v-slot:modal-title>
        <span>Editando Usuario: {{selectedUser.username}}</span>
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
              placeholder="Choose a file or drop it here..."
              drop-placeholder="Drop file here..."
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

          <b-form-group id="input-group-1" label="Correo:" label-for="input-1">
            <b-form-input
              id="input-1"
              v-model="editForm.email"
              type="email"
              required
              placeholder="Enter email"
            ></b-form-input>
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
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: ["users"],
  data: () => ({
    columns: [
      "usuario",
      "nombre",
      "correo",
      "rol",
      "activo",
      "foto",
      "acciones"
    ],
    roles: ["writer", "admin"],
    tableData: [],
    options: {},
    selectedUser: null,
    editForm: {},
    formPhoto: null
  }),
  methods: {
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
        name: this.selectedUser.name,
        username: this.selectedUser.username,
        email: this.selectedUser.email,
        role: this.selectedUser.role,
        photo: this.selectedUser.photo,
        is_active: this.selectedUser.is_active
      };
      this.$refs["edit-modal"].show();
    },
    showDeleteModal() {
      this.$refs["delete-modal"].show();
    },
    hideEditModal() {
      this.$refs["edit-modal"].hide();
      this.selectedUser = null;
      this.formPhoto = null;
    },
    hideDeleteModal() {
      this.$refs["delete-modal"].hide();
    },
    handleCheckBoxChange(row) {
      let _this = this;
      let uIdx = _this.tableData.findIndex(user => row.id === user.id);
      _this.tableData[uIdx].is_active = !_this.tableData[uIdx].is_active;

      axios
        .put(`/dashboard/users/edit/${row.id}`, {
          is_active: _this.tableData[uIdx].is_active
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

      axios
        .put(`/dashboard/users/edit/${this.selectedUser.id}`, {
          ...this.editForm
        })
        .then(res => {
          if (res.status === 200) {
            _this.makeToast(res.data);
            _this.hideEditModal();
            setTimeout(() => window.location.reload(), 3000);
          }
        })
        .catch(err => console.log(err));
    },
    onReset() {
      this.editForm = {};
    },

    makeToast(msg, variant = "success", delay = 3000, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: "Evento de actualización de usuario",
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    }
  },

  computed: {
    editPhotoURL() {
      return this.formPhoto ? URL.createObjectURL(this.formPhoto) : null;
    }
  },
  mounted() {
    this.tableData = this.users.map(user => {
      user.is_active === 1 ? (user.is_active = true) : (user.is_active = false);
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
  width: 50px;
  height: 50px;
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
</style>
