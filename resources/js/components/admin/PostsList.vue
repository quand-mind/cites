<template>
  <div>
    <b-button href="/dashboard/posts/create" variant="primary">Crear un nuevo post</b-button>
    <v-client-table :data="tableData" :columns="columns" :options="options">
      <!-- actions slot -->
      <div class="action-container" slot="acciones" slot-scope="props">
        <a class="text-dark" :href="`posts/edit/${props.row.id}`">
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

      <!-- user photo slot -->
      <b-img
        thumbnail
        fluid
        class="profile-img"
        slot="foto"
        slot-scope="props"
        :src="
                    props.row.image && props.row.image.url
                "
        :alt="props.row.image && props.row.image.alt_img"
      ></b-img>

      <!-- is active slot -->
      <b-form-checkbox
        slot="activo"
        slot-scope="props"
        name="check-button"
        class="check-active"
        v-model="props.row.is_active"
        switch
        @change="handleCheckBoxChange(props.row)"
      ></b-form-checkbox>

      <!-- name slot -->
      <span slot="descripcion" slot-scope="props">
        {{
        props.row.meta_description
        }}
      </span>

      <!-- username slot -->
      <span class="title" slot="titulo" slot-scope="props">
        <a :href="`/dashboard/posts/edit/${props.row.id}`">
          {{
          props.row.title
          }}
        </a>
      </span>

      <!-- email slot -->
      <span slot="autor" slot-scope="props">
        {{
        props.row.author.username
        }}
      </span>

      <!-- role slot -->
      <span slot="fecha_de_publicacion" slot-scope="props">
        {{
        props.row.publish_date
        }}
      </span>
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
        <h3>¿Estas seguro de que deseas eliminar este post?</h3>
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
  props: ["posts"],
  data: () => ({
    timeout: timeout,
    columns: [
      "foto",
      "titulo",
      "descripcion",
      "fecha_de_publicacion",
      "autor",
      "activo",
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
    handleCheckBoxChange(row) {
      let _this = this;
      let postIdx = _this.tableData.findIndex(post => row.id === post.id);
      _this.tableData[postIdx].is_active = !_this.tableData[postIdx].is_active;

      axios
        .post(`/dashboard/posts/changeActiveState/${row.id}`, {
          is_active: _this.tableData[postIdx].is_active
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
        .post(`/dashboard/posts/edit/${_this.selectedPost.id}`, form, {
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
          _this.makeToast(err.response.data, "danger");
        });
    },

    makeToast(msg, variant = "success", delay = timeout, append = false) {
      this.$bvToast.toast(`${msg}`, {
        title: "Evento de actualización de post",
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
        .post(`/dashboard/users/create/`, form, {
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
          _this.makeToast(err.response.data, "danger");
        });
    },
    submitDeletePost() {
      let _this = this;

      axios
        .delete(`/dashboard/posts/${_this.selectedPost.id}`)
        .then(res => {
          if (res.status === 200) {
            _this.makeToast(res.data);
            _this.hideDeleteModal();
            setTimeout(() => window.location.reload(), timeout);
          }
        })
        .catch(err => {
          _this.makeToast(err.response.data, "danger");
        });
    }
  },
  mounted() {
    this.tableData = this.posts.map(post => {
      post.is_active = post.is_active === 1;
      return post;
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
