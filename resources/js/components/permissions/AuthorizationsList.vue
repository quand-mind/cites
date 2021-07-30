<template>
  <div>
    <div class="caja bg-light p-2 my-2">
      <h1>Autorizaciones</h1>
      <h4 class="ml-4">Realice la solicitud para la aprobación de autorizaciones.</h4>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import moment from "moment";

export default {
   props: ["words"],
  data: () => ({
  }),
  methods: {
    showCreateModal() {
      this.$refs["create-modal"].show();
      this.form = {
        word: "",
        description: "",
      };
    },
    hideCreateModal() {
      this.$refs["create-modal"].hide();
    },
    showEditModal(row) {
      this.$refs["edit-modal"].show();
      this.selectedWord = row;
      this.form = {
        word: this.selectedWord.word,
        description: this.selectedWord.description,
      };
    },
    hideEditModal() {
      this.$refs["edit-modal"].hide();
    },
    onSubmit() {
      axios
        .post(`/dashboard/glosary`, {...this.form})
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), 300)
        })
        .catch(err => {
          console.log(err)
          this.makeToast(err.toString(), 'danger')
        });
    },
    onReset() {},
    onSubmitEdit() {

      axios
        .post(`/dashboard/glosary/edit/${this.selectedWord.id}`, this.form)
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), 300)
        })
        .catch(err => {
          this.makeToast(err.toString(), 'danger')
        });
    },
    deleteWord (row) {
      let _this = this

      axios
        .delete(`/dashboard/glosary/${row.id}`)
        .then(res => {
          this.makeToast(res.data)
          setTimeout(() => window.location.reload(), 300)
        })
        .catch(err => {
          _this.makeToast(err.response.data, 'danger')
        })
    },
    onResetEdit() {},
    makeToast(msg, variant = "success", delay = 3000, append = false) {
      // Create a new toast
      this.$bvToast.toast(`${msg}`, {
        title: "Actualización de la palabra",
        autoHideDelay: delay,
        appendToast: append,
        variant
      });
    }
  },
  mounted() {
  }
};
</script>

<style lang="scss">
// Table styles

// hide default filter
.VueTables__search {
  display: none;
}
</style>