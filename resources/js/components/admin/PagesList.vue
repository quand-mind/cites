<template>
  <div>
    <div class="caja bg-light p-2 my-2">
      <h1>Páginas</h1>
      <h4 class="ml-4">Crea, edita o elimina páginas que sean visibles en el sitio web</h4>
    </div>
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
      <span slot="descripción" slot-scope="props">
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
      <span class="title" slot="título" slot-scope="props">
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
      <span slot="última_modificación_por" slot-scope="props">
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

      <!-- is main page slot -->
      <b-form-radio
        slot="pag_principal"
        slot-scope="props"
        name="radio-button"
        class="check-active"
        v-model="mainPageID"
        @change="changeMainPage(props.row.id)"
        :value="props.row.id"
      ></b-form-radio>
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
import timeout from '../../setTimeout.js'

export default {
  props: ["pages"],
  data: () => ({
    timeout: timeout,
    columns: [
      "pag_principal",
      "título",
      "url",
      "descripción",
      "creada_por",
      "activo",
      "última_modificación_por",
      "acciones"
    ],
    mainPageID: null,
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
    makeToast(msg, variant = "success", delay = timeout, append = false) {
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
            setTimeout(() => window.location.reload(), timeout);
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
    changeMainPage(id) {
      const _this = this

      let pageIndex = _this.tableData.findIndex(page => Boolean(page.is_mainPage))

      axios
        .get('/dashboard/pages/setAsMainPage/' + id)
        .then(res => {
          _this.makeToast(res.data)
          let pageIndex = _this.tableData.findIndex(page => Boolean(page.is_mainPage))
          _this.tableData[pageIndex].is_mainPage = false

          pageIndex = _this.tableData.findIndex(page => page.id === id)
          _this.tableData[pageIndex].is_mainPage = true
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
      console.log(row)
      if (row.is_subpage && row.main_page !== null) {
        return '/' + row.get_main_page.slug + '/' + row.slug
      }

      return '/' + row.slug
    }
  },
  mounted() {
    const _this = this
    _this.tableData = _this.pages.map(page => {
      page.is_active = Boolean(parseInt(page.is_active));
      page.is_mainPage = Boolean(parseInt(page.is_mainPage));

      if (page.is_mainPage)  {
        _this.mainPageID = page.id
      }

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
