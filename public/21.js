(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[21],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/UsersList.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/admin/UsersList.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  props: ["users"],
  data: function data() {
    return {
      columns: ["usuario", "nombre", "correo", "rol", "activo", "foto", "acciones"],
      roles: ["writer", "admin"],
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
        email: "",
        role: "",
        is_active: true,
        password: "",
        password_confirmation: ""
      },
      formPhoto: null,
      newPhoto: null
    };
  },
  methods: {
    showCreateModal: function showCreateModal() {
      this.$refs["create-modal"].show();
    },
    hideCreateModal: function hideCreateModal() {
      this.$refs["create-modal"].hide();
    },
    editUser: function editUser(user) {
      this.selectedUser = user;
      this.showEditModal();
    },
    deleteUser: function deleteUser(user) {
      this.selectedUser = user;
      this.showDeleteModal();
    },
    showEditModal: function showEditModal() {
      this.editForm = {
        name: this.selectedUser.name,
        username: this.selectedUser.username,
        email: this.selectedUser.email,
        role: this.selectedUser.role,
        photo: this.selectedUser.photo,
        is_active: Boolean(this.selectedUser.is_active)
      };
      this.$refs["edit-modal"].show();
    },
    showDeleteModal: function showDeleteModal() {
      this.$refs["delete-modal"].show();
    },
    hideEditModal: function hideEditModal() {
      this.$refs["edit-modal"].hide();
      this.editForm = {};
      this.selectedUser = null;
      this.formPhoto = null;
    },
    hideDeleteModal: function hideDeleteModal() {
      this.$refs["delete-modal"].hide();
    },
    handleCheckBoxChange: function handleCheckBoxChange(row) {
      var _this = this;

      var uIdx = _this.tableData.findIndex(function (user) {
        return row.id === user.id;
      });

      _this.tableData[uIdx].is_active = !_this.tableData[uIdx].is_active;
      axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("/dashboard/users/changeActiveState/".concat(row.id), {
        is_active: _this.tableData[uIdx].is_active
      }).then(function (res) {
        if (res.status === 200) {
          _this.makeToast(res.data, "info", 2000);
        }
      })["catch"](function (err) {
        return console.log(err);
      });
    },
    onEditSubmit: function onEditSubmit() {
      var _this = this;

      var form = new FormData();
      Object.keys(_this.editForm).forEach(function (key) {
        if (key === "is_active") {
          form.append(key, Number(_this.editForm[key]));
          return;
        }

        if (key !== "photo") form.append(key, _this.editForm[key]);
      });
      _this.formPhoto && form.append("photo", _this.formPhoto);
      axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("/dashboard/users/edit/".concat(_this.selectedUser.id), form, {
        headers: {
          "Content-Type": "multipart/form-data"
        }
      }).then(function (res) {
        if (res.status === 200) {
          _this.makeToast(res.data);

          _this.hideEditModal();

          setTimeout(function () {
            return window.location.reload();
          }, 3000);
        }
      })["catch"](function (err) {
        _this.makeToast(err.response.data, "danger");
      });
    },
    onReset: function onReset() {
      this.editForm = {};
    },
    onResetCreate: function onResetCreate() {
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
    makeToast: function makeToast(msg) {
      var variant = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "success";
      var delay = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 3000;
      var append = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : false;
      this.$bvToast.toast("".concat(msg), {
        title: "Evento de actualización de usuario",
        autoHideDelay: delay,
        appendToast: append,
        variant: variant
      });
    },
    onCreateSubmit: function onCreateSubmit() {
      var _this = this;

      var form = new FormData();
      Object.keys(_this.createForm).forEach(function (key) {
        if (key === "is_active") form.append(key, Number(_this.createForm[key]));else form.append(key, _this.createForm[key]);
      });
      _this.newPhoto && form.append("photo", _this.newPhoto);
      axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("/dashboard/users/create/", form, {
        headers: {
          "Content-Type": "multipart/form-data"
        }
      }).then(function (res) {
        if (res.status === 200) {
          _this.makeToast(res.data);

          _this.hideEditModal();

          setTimeout(function () {
            return window.location.reload();
          }, 2000);
        }
      })["catch"](function (err) {
        _this.makeToast(err.response.data, "danger");
      });
    },
    submitDeleteUser: function submitDeleteUser() {
      var _this = this;

      axios__WEBPACK_IMPORTED_MODULE_0___default.a["delete"]("/dashboard/users/".concat(_this.selectedUser.id)).then(function (res) {
        if (res.status === 200) {
          _this.makeToast(res.data);

          _this.hideDeleteModal();

          setTimeout(function () {
            return window.location.reload();
          }, 2000);
        }
      })["catch"](function (err) {
        _this.makeToast(err.response.data, "danger");
      });
    }
  },
  computed: {
    editPhotoURL: function editPhotoURL() {
      return this.formPhoto ? URL.createObjectURL(this.formPhoto) : null;
    },
    newPhotoUrl: function newPhotoUrl() {
      return this.newPhoto ? URL.createObjectURL(this.newPhoto) : null;
    }
  },
  mounted: function mounted() {
    this.tableData = this.users.map(function (user) {
      user.is_active = user.is_active === 1;
      return user;
    });
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/UsersList.vue?vue&type=style&index=0&lang=scss&":
/*!********************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/admin/UsersList.vue?vue&type=style&index=0&lang=scss& ***!
  \********************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".action-container {\n  display: flex;\n  justify-content: space-around;\n}\n.action-container a:hover {\n  cursor: pointer;\n}\n.check-active {\n  display: block;\n  margin: 0 auto;\n}\n.profile-img {\n  width: 50px;\n  height: 50px;\n  margin: 0 auto;\n  display: block;\n}\n.edit-form .user-photo {\n  position: relative;\n}\n.edit-form .user-photo .edit-photo {\n  position: absolute;\n  bottom: 0;\n  left: 4px;\n}\n.edit-form .user-photo img {\n  max-width: 110px;\n}\n.VueTables__search {\n  display: none;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/UsersList.vue?vue&type=style&index=0&lang=scss&":
/*!************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/admin/UsersList.vue?vue&type=style&index=0&lang=scss& ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../../../node_modules/vue-loader/lib??vue-loader-options!./UsersList.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/UsersList.vue?vue&type=style&index=0&lang=scss&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/UsersList.vue?vue&type=template&id=3b52a01f&":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/admin/UsersList.vue?vue&type=template&id=3b52a01f& ***!
  \*************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "b-button",
        { attrs: { variant: "primary" }, on: { click: _vm.showCreateModal } },
        [_vm._v("Crear nuevo usuario")]
      ),
      _vm._v(" "),
      _c("v-client-table", {
        attrs: {
          data: _vm.tableData,
          columns: _vm.columns,
          options: _vm.options
        },
        scopedSlots: _vm._u([
          {
            key: "acciones",
            fn: function(props) {
              return _c("div", { staticClass: "action-container" }, [
                _c(
                  "a",
                  {
                    staticClass: "text-dark",
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        {
                          _vm.editUser(props.row)
                        }
                      }
                    }
                  },
                  [
                    _c("font-awesome-icon", { attrs: { icon: ["fa", "edit"] } })
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "a",
                  {
                    staticClass: "text-danger",
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        {
                          _vm.deleteUser(props.row)
                        }
                      }
                    }
                  },
                  [
                    _c("font-awesome-icon", {
                      attrs: { icon: ["fa", "trash"] }
                    })
                  ],
                  1
                )
              ])
            }
          },
          {
            key: "foto",
            fn: function(props) {
              return _c("b-img", {
                staticClass: "profile-img",
                attrs: {
                  thumbnail: "",
                  fluid: "",
                  src: props.row.photo || "/images/default-user.png",
                  alt: "user photo"
                }
              })
            }
          },
          {
            key: "activo",
            fn: function(props) {
              return _c("b-form-checkbox", {
                staticClass: "check-active",
                attrs: {
                  name: "check-button",
                  checked: props.row.is_active,
                  switch: ""
                },
                on: {
                  change: function($event) {
                    return _vm.handleCheckBoxChange(props.row)
                  }
                }
              })
            }
          },
          {
            key: "nombre",
            fn: function(props) {
              return _c("span", {}, [_vm._v(_vm._s(props.row.name))])
            }
          },
          {
            key: "usuario",
            fn: function(props) {
              return _c("span", {}, [_vm._v(_vm._s(props.row.username))])
            }
          },
          {
            key: "correo",
            fn: function(props) {
              return _c("span", {}, [_vm._v(_vm._s(props.row.email))])
            }
          },
          {
            key: "rol",
            fn: function(props) {
              return _c("span", {}, [_vm._v(_vm._s(props.row.role))])
            }
          }
        ])
      }),
      _vm._v(" "),
      _c(
        "b-modal",
        {
          ref: "delete-modal",
          attrs: { "hide-footer": "" },
          scopedSlots: _vm._u([
            {
              key: "modal-title",
              fn: function() {
                return [
                  _c("span", { staticClass: "text-danger" }, [
                    _vm._v(
                      "Eliminando usuario " + _vm._s(_vm.selectedUser.username)
                    )
                  ])
                ]
              },
              proxy: true
            }
          ])
        },
        [
          _vm._v(" "),
          _vm.selectedUser
            ? _c(
                "div",
                { staticClass: "d-block text-center" },
                [
                  _c("h3", [
                    _vm._v(
                      "¿Estas seguro de que deseas eliminar a " +
                        _vm._s(_vm.selectedUser.name) +
                        "?"
                    )
                  ]),
                  _vm._v(" "),
                  _c("i", [
                    _vm._v(
                      "Todos los post y páginas creadas por este usuario serán eliminadas"
                    )
                  ]),
                  _vm._v(" "),
                  _c(
                    "b-button",
                    {
                      staticClass: "mt-3",
                      attrs: { block: "", variant: "danger" },
                      on: { click: _vm.submitDeleteUser }
                    },
                    [_vm._v("Confirmar")]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-button",
                    {
                      staticClass: "mt-3",
                      attrs: { block: "" },
                      on: { click: _vm.hideDeleteModal }
                    },
                    [_vm._v("Cancelar")]
                  )
                ],
                1
              )
            : _vm._e()
        ]
      ),
      _vm._v(" "),
      _c(
        "b-modal",
        {
          ref: "edit-modal",
          attrs: { "hide-footer": "" },
          scopedSlots: _vm._u([
            {
              key: "modal-title",
              fn: function() {
                return [
                  _c("span", [
                    _vm._v(
                      "Editando Usuario: " +
                        _vm._s(_vm.selectedUser && _vm.selectedUser.username)
                    )
                  ])
                ]
              },
              proxy: true
            }
          ])
        },
        [
          _vm._v(" "),
          _vm.selectedUser
            ? _c(
                "div",
                { staticClass: "d-block" },
                [
                  _c(
                    "b-form",
                    {
                      staticClass: "edit-form",
                      on: {
                        submit: function($event) {
                          $event.preventDefault()
                          return _vm.onEditSubmit($event)
                        },
                        reset: _vm.onReset
                      }
                    },
                    [
                      _c(
                        "b-form-group",
                        { staticClass: "user-photo" },
                        [
                          _c(
                            "picture",
                            [
                              _c("b-img", {
                                attrs: {
                                  thumbnail: "",
                                  fluid: "",
                                  src:
                                    _vm.editPhotoURL || _vm.selectedUser.photo,
                                  alt: "user photo"
                                }
                              })
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c("b-form-file", {
                            attrs: {
                              accept: "image/*",
                              placeholder: "Choose a photo (Max. 2MB)",
                              "drop-placeholder": "Drop file here...",
                              "max-size": "2048"
                            },
                            model: {
                              value: _vm.formPhoto,
                              callback: function($$v) {
                                _vm.formPhoto = $$v
                              },
                              expression: "formPhoto"
                            }
                          }),
                          _vm._v(" "),
                          _c("div", { staticClass: "mt-3" }, [
                            _vm._v(
                              "Selected file: " +
                                _vm._s(_vm.formPhoto ? _vm.formPhoto.name : "")
                            )
                          ])
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "b-form-group",
                        {
                          attrs: {
                            id: "input-group-2",
                            label: "Nombre:",
                            "label-for": "input-2"
                          }
                        },
                        [
                          _c("b-form-input", {
                            attrs: {
                              id: "input-2",
                              required: "",
                              placeholder: "Jose Quintero"
                            },
                            model: {
                              value: _vm.editForm.name,
                              callback: function($$v) {
                                _vm.$set(_vm.editForm, "name", $$v)
                              },
                              expression: "editForm.name"
                            }
                          })
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "b-form-group",
                        {
                          attrs: {
                            id: "input-group-2",
                            label: "Usuario:",
                            "label-for": "input-2"
                          }
                        },
                        [
                          _c("b-form-input", {
                            attrs: {
                              id: "input-2",
                              required: "",
                              placeholder: "jose_usuario"
                            },
                            model: {
                              value: _vm.editForm.username,
                              callback: function($$v) {
                                _vm.$set(_vm.editForm, "username", $$v)
                              },
                              expression: "editForm.username"
                            }
                          })
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "b-form-group",
                        {
                          attrs: {
                            id: "input-group-1",
                            label: "Correo:",
                            "label-for": "input-1"
                          }
                        },
                        [
                          _c("b-form-input", {
                            attrs: {
                              id: "input-1",
                              type: "email",
                              required: "",
                              placeholder: "Enter email"
                            },
                            model: {
                              value: _vm.editForm.email,
                              callback: function($$v) {
                                _vm.$set(_vm.editForm, "email", $$v)
                              },
                              expression: "editForm.email"
                            }
                          })
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "b-form-group",
                        {
                          attrs: {
                            id: "input-group-3",
                            label: "Rol:",
                            "label-for": "input-3"
                          }
                        },
                        [
                          _c("b-form-select", {
                            attrs: {
                              id: "input-3",
                              options: _vm.roles,
                              required: ""
                            },
                            model: {
                              value: _vm.editForm.role,
                              callback: function($$v) {
                                _vm.$set(_vm.editForm, "role", $$v)
                              },
                              expression: "editForm.role"
                            }
                          })
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "b-form-group",
                        { attrs: { id: "input-group-4" } },
                        [
                          _c(
                            "b-form-checkbox",
                            {
                              model: {
                                value: _vm.editForm.is_active,
                                callback: function($$v) {
                                  _vm.$set(_vm.editForm, "is_active", $$v)
                                },
                                expression: "editForm.is_active"
                              }
                            },
                            [_vm._v("Usuario activo")]
                          )
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "b-button",
                        { attrs: { type: "submit", variant: "success" } },
                        [_vm._v("Guardar Cambios")]
                      ),
                      _vm._v(" "),
                      _c(
                        "b-button",
                        { attrs: { type: "reset", variant: "outline-danger" } },
                        [_vm._v("Limpiar")]
                      )
                    ],
                    1
                  )
                ],
                1
              )
            : _vm._e(),
          _vm._v(" "),
          _c(
            "b-button",
            {
              staticClass: "mt-3",
              attrs: { block: "" },
              on: { click: _vm.hideEditModal }
            },
            [_vm._v("Cancelar")]
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "b-modal",
        {
          ref: "create-modal",
          attrs: { "hide-footer": "" },
          scopedSlots: _vm._u([
            {
              key: "modal-title",
              fn: function() {
                return [_c("span", [_vm._v("Nuevo Usuario")])]
              },
              proxy: true
            }
          ])
        },
        [
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "d-block" },
            [
              _c(
                "b-form",
                {
                  staticClass: "edit-form",
                  on: {
                    submit: function($event) {
                      $event.preventDefault()
                      return _vm.onCreateSubmit($event)
                    },
                    reset: _vm.onResetCreate
                  }
                },
                [
                  _c(
                    "b-form-group",
                    { staticClass: "user-photo" },
                    [
                      _c(
                        "picture",
                        [
                          _c("b-img", {
                            attrs: {
                              thumbnail: "",
                              fluid: "",
                              src:
                                _vm.newPhotoUrl || "/images/default-user.png",
                              alt: "user photo"
                            }
                          })
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c("b-form-file", {
                        attrs: {
                          accept: "image/*",
                          placeholder: "Choose a photo (Max. 2MB)",
                          "drop-placeholder": "Drop file here..."
                        },
                        model: {
                          value: _vm.newPhoto,
                          callback: function($$v) {
                            _vm.newPhoto = $$v
                          },
                          expression: "newPhoto"
                        }
                      }),
                      _vm._v(" "),
                      _c("div", { staticClass: "mt-3" }, [
                        _vm._v(
                          "Selected file: " +
                            _vm._s(_vm.newPhoto ? _vm.newPhoto.name : "")
                        )
                      ])
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-form-group",
                    { attrs: { label: "Nombre:", "label-for": "input-2" } },
                    [
                      _c("b-form-input", {
                        attrs: { required: "", placeholder: "Jose Quintero" },
                        model: {
                          value: _vm.createForm.name,
                          callback: function($$v) {
                            _vm.$set(_vm.createForm, "name", $$v)
                          },
                          expression: "createForm.name"
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-form-group",
                    { attrs: { label: "Usuario:", "label-for": "input-2" } },
                    [
                      _c("b-form-input", {
                        attrs: { required: "", placeholder: "jose_usuario" },
                        model: {
                          value: _vm.createForm.username,
                          callback: function($$v) {
                            _vm.$set(_vm.createForm, "username", $$v)
                          },
                          expression: "createForm.username"
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-form-group",
                    { attrs: { label: "Correo:", "label-for": "input-1" } },
                    [
                      _c("b-form-input", {
                        attrs: {
                          type: "email",
                          required: "",
                          placeholder: "Enter email"
                        },
                        model: {
                          value: _vm.createForm.email,
                          callback: function($$v) {
                            _vm.$set(_vm.createForm, "email", $$v)
                          },
                          expression: "createForm.email"
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-form-group",
                    { attrs: { label: "Contraseña:", "label-for": "input-2" } },
                    [
                      _c("b-form-input", {
                        attrs: {
                          required: "",
                          type: "password",
                          placeholder: "********"
                        },
                        model: {
                          value: _vm.createForm.password,
                          callback: function($$v) {
                            _vm.$set(_vm.createForm, "password", $$v)
                          },
                          expression: "createForm.password"
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-form-group",
                    {
                      attrs: {
                        label: "Repita la contraseña:",
                        "label-for": "input-2"
                      }
                    },
                    [
                      _c("b-form-input", {
                        attrs: {
                          required: "",
                          type: "password",
                          placeholder: "********"
                        },
                        model: {
                          value: _vm.createForm.password_confirmation,
                          callback: function($$v) {
                            _vm.$set(
                              _vm.createForm,
                              "password_confirmation",
                              $$v
                            )
                          },
                          expression: "createForm.password_confirmation"
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-form-group",
                    { attrs: { label: "Rol:", "label-for": "input-3" } },
                    [
                      _c("b-form-select", {
                        attrs: { options: _vm.roles, required: "" },
                        model: {
                          value: _vm.createForm.role,
                          callback: function($$v) {
                            _vm.$set(_vm.createForm, "role", $$v)
                          },
                          expression: "createForm.role"
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-form-group",
                    [
                      _c(
                        "b-form-checkbox",
                        {
                          model: {
                            value: _vm.createForm.is_active,
                            callback: function($$v) {
                              _vm.$set(_vm.createForm, "is_active", $$v)
                            },
                            expression: "createForm.is_active"
                          }
                        },
                        [_vm._v("Usuario activo")]
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-button",
                    { attrs: { type: "submit", variant: "success" } },
                    [_vm._v("Crear Usuario")]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-button",
                    { attrs: { type: "reset", variant: "outline-danger" } },
                    [_vm._v("Limpiar")]
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "b-button",
            {
              staticClass: "mt-3",
              attrs: { block: "" },
              on: { click: _vm.hideCreateModal }
            },
            [_vm._v("Cancelar")]
          )
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return normalizeComponent; });
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent (
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier, /* server only */
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = shadowMode
      ? function () { injectStyles.call(this, this.$root.$options.shadowRoot) }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functional component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ "./resources/assets/js/components/admin/UsersList.vue":
/*!************************************************************!*\
  !*** ./resources/assets/js/components/admin/UsersList.vue ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _UsersList_vue_vue_type_template_id_3b52a01f___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./UsersList.vue?vue&type=template&id=3b52a01f& */ "./resources/assets/js/components/admin/UsersList.vue?vue&type=template&id=3b52a01f&");
/* harmony import */ var _UsersList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./UsersList.vue?vue&type=script&lang=js& */ "./resources/assets/js/components/admin/UsersList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _UsersList_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./UsersList.vue?vue&type=style&index=0&lang=scss& */ "./resources/assets/js/components/admin/UsersList.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _UsersList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _UsersList_vue_vue_type_template_id_3b52a01f___WEBPACK_IMPORTED_MODULE_0__["render"],
  _UsersList_vue_vue_type_template_id_3b52a01f___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/components/admin/UsersList.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/assets/js/components/admin/UsersList.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/assets/js/components/admin/UsersList.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_UsersList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./UsersList.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/UsersList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_UsersList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/assets/js/components/admin/UsersList.vue?vue&type=style&index=0&lang=scss&":
/*!**********************************************************************************************!*\
  !*** ./resources/assets/js/components/admin/UsersList.vue?vue&type=style&index=0&lang=scss& ***!
  \**********************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_UsersList_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader!../../../../../node_modules/css-loader!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../../../node_modules/vue-loader/lib??vue-loader-options!./UsersList.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/UsersList.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_UsersList_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_UsersList_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_UsersList_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_UsersList_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_UsersList_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/assets/js/components/admin/UsersList.vue?vue&type=template&id=3b52a01f&":
/*!*******************************************************************************************!*\
  !*** ./resources/assets/js/components/admin/UsersList.vue?vue&type=template&id=3b52a01f& ***!
  \*******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_UsersList_vue_vue_type_template_id_3b52a01f___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./UsersList.vue?vue&type=template&id=3b52a01f& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/UsersList.vue?vue&type=template&id=3b52a01f&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_UsersList_vue_vue_type_template_id_3b52a01f___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_UsersList_vue_vue_type_template_id_3b52a01f___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);