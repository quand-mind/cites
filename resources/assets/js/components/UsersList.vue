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
      <img
        slot="foto"
        class="profile-img"
        slot-scope="props"
        :src="props.row.photo"
        alt="user photo"
      />

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

    <b-modal ref="delete-modal" hide-footer>
      <template v-slot:modal-title>
        <span class="text-danger">Deleting User</span>
      </template>
      <div v-if="selectedUser" class="d-block text-center">
        <h3>Are you sure that you want delete {{selectedUser.name}} from users?</h3>
      </div>

      <b-button class="mt-3" block @click="hideDeleteModal">Cancel</b-button>
    </b-modal>

    <b-modal ref="edit-modal" hide-footer>
      <template v-slot:modal-title>
        <span>Editando Usuario: {{selectedUser.username}}</span>
      </template>
      <div v-if="selectedUser" class="d-block">
        <b-form @submit.prevent="onEditSubmit" @reset="onReset">
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
    editForm: {}
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
      this.$refs["edit-modal"].show();
      this.editForm = {
        name: this.selectedUser.name,
        username: this.selectedUser.username,
        email: this.selectedUser.email,
        role: this.selectedUser.role,
        photo: this.selectedUser.photo,
        is_active: this.selectedUser.is_active
      };
    },
    showDeleteModal() {
      this.$refs["delete-modal"].show();
    },
    hideEditModal() {
      this.$refs["edit-modal"].hide();
    },
    hideDeleteModal() {
      this.$refs["delete-modal"].hide();
    },
    handleCheckBoxChange(row) {
      let uIdx = this.tableData.findIndex(user => row.id === user.id);
      this.tableData[uIdx].is_active = !this.tableData[uIdx].is_active;

      // Change user active state on db
    },
    onEditSubmit() {
      console.log(this.editForm);
    },
    onReset() {
      this.editForm = {};
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
d
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
</style>
