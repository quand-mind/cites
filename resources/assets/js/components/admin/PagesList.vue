<template>
  <div>
    <b-button href="/dashboard/pages/create" variant="primary">Crear una nueva página</b-button>
    <v-client-table :data="tableData" :columns="columns" :options="options">
      <!-- actions slot -->
      <div class="action-container" slot="acciones" slot-scope="props">
        <a class="text-dark" :href="`pages/edit/${props.row.id}`">
          <font-awesome-icon :icon="['fa', 'edit']"></font-awesome-icon>
        </a>

        <a
          class="text-danger"
          @click.prevent="
                        {
                            deletePost(props.row);
                        }
                    "
        >
          <font-awesome-icon :icon="['fa', 'trash']"></font-awesome-icon>
        </a>
      </div>

      <!-- name slot -->
      <span slot="descripcion" slot-scope="props">
        {{
        props.row.meta_description
        }}
      </span>

      <!-- slug slot -->
      <span class="url" slot="url" slot-scope="props">
        <a :href="generateSlug(props.row)">
          {{
            generateSlug(props.row)
          }}
        </a>
      </span>

      <!-- username slot -->
      <span class="title" slot="titulo" slot-scope="props">
        <a :href="`/dashboard/pages/edit/${props.row.id}`">
          {{
          props.row.title
          }}
        </a>
      </span>

      <!-- email slot -->
      <span slot="creada_por" slot-scope="props">
        {{
        props.row.created_by.username
        }}
      </span>

      <!-- email slot -->
      <span slot="ultima_modificacion_por" slot-scope="props">
        {{
        props.row.last_modified_by.username
        }}
      </span>

      <!-- is active slot -->
      <b-form-checkbox
        slot="activo"
        slot-scope="props"
        name="check-button"
        class="check-active"
        v-model="props.row.is_active"
        :checked="Boolean(props.row.is_active)"
        switch
        @change="handleCheckBoxChange(props.row)"
      ></b-form-checkbox>
    </v-client-table>

    <!-- Delete modal -->

    <b-modal ref="delete-modal" hide-footer>
      <template v-slot:modal-title>
        <span class="text-danger">
          <b>Eliminando:</b>
          {{ selectedPost.title }}
        </span>
      </template>
      <div v-if="selectedPost" class="d-block text-center">
        <h3>¿Estas seguro de que deseas eliminar esta página?</h3>
      </div>

      <b-button class="mt-3" block @click="submitDeletePost" variant="danger">Eliminar</b-button>
      <b-button class="mt-3" block @click="hideDeleteModal">Cancelar</b-button>
    </b-modal>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: ["pages"],
  data: () => ({
    columns: [
      "titulo",
      "url",
      "descripcion",
      "creada_por",
      "activo",
      "ultima_modificacion_por",
      "acciones"
    ],
    tableData: [],
    options: {
      perPage: 10,
      perPageValues: [10, 20, 50]
    },
    selectedPost: null
  }),
  methods: {
    deletePost(post) {
      this.selectedPost = post;
      this.showDeleteModal();
    },
    showDeleteModal() {
      this.$refs["delete-modal"].show();
    },
    hideDeleteModal() {
      this.$refs["delete-modal"].hide();
    },
    makeToast(msg, variant = "success", delay = 3000, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: "Evento de actualización de post",
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    },
    submitDeletePost() {
      let _this = this;

      axios
        .delete(`/dashboard/pages/${_this.selectedPost.id}`)
        .then(res => {
          if (res.status === 200) {
            _this.makeToast(res.data);
            _this.hideDeleteModal();
            setTimeout(() => window.location.reload(), 3000);
          } else if (res.status === 500) {
            _this.hideDeleteModal();
            _this.makeToast(res.data.messge, "danger");
          }
        })
        .catch(err => {
          let { data } = err.response

          if (data.errors !== undefined && data.errors !== null) {
            let errors = Object.values(data.errors).toString()
            _this.makeToast(errors, "danger");
          } else {
            _this.makeToast(data.message || data, "danger");
          }
        });
    },
    handleCheckBoxChange(row) {
      let _this = this;
      let pageIdx = _this.tableData.findIndex(page => row.id === page.id);
      _this.tableData[pageIdx].is_active = !_this.tableData[pageIdx].is_active;

      axios
        .post(`/dashboard/pages/changeActiveState/${row.id}`, {
          is_active: _this.tableData[pageIdx].is_active
        })
        .then(res => {
          if (res.status === 200) {
            _this.makeToast(res.data, "info", 2000);
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
    generateSlug(row) {
      if (row.main_page !== null) {
        return '/' + row.get_main_page.slug + '/' + row.slug
      }

      return '/' + row.slug
    }
  },
  mounted() {
    this.tableData = this.pages.map(page => {
      page.is_active = Boolean(parseInt(page.is_active));
      return page;
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
  width: 100px;
  margin: 0 auto;
  display: block;
}

.title {
  width: 200px;
  display: block;
}

.url {
  display: block;
  width: 200px;
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
