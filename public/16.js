(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[16],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/PagesList.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/admin/PagesList.vue?vue&type=script&lang=js& ***!
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

/* harmony default export */ __webpack_exports__["default"] = ({
  props: ["pages"],
  data: function data() {
    return {
      columns: ["titulo", "url", "descripcion", "creada_por", "activo", "ultima_modificacion_por", "acciones"],
      tableData: [],
      options: {
        perPage: 10,
        perPageValues: [10, 20, 50]
      },
      selectedPost: null
    };
  },
  methods: {
    deletePost: function deletePost(post) {
      this.selectedPost = post;
      this.showDeleteModal();
    },
    showDeleteModal: function showDeleteModal() {
      this.$refs["delete-modal"].show();
    },
    hideDeleteModal: function hideDeleteModal() {
      this.$refs["delete-modal"].hide();
    },
    makeToast: function makeToast(msg) {
      var variant = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "success";
      var delay = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 3000;
      var append = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : false;
      this.$bvToast.toast("".concat(msg), {
        title: "Evento de actualización de post",
        autoHideDelay: delay,
        appendToast: append,
        variant: variant
      });
    },
    submitDeletePost: function submitDeletePost() {
      var _this = this;

      axios__WEBPACK_IMPORTED_MODULE_0___default.a["delete"]("/dashboard/pages/".concat(_this.selectedPost.id)).then(function (res) {
        if (res.status === 200) {
          _this.makeToast(res.data);

          _this.hideDeleteModal();

          setTimeout(function () {
            return window.location.reload();
          }, 3000);
        }
      })["catch"](function (err) {
        var data = err.response.data;

        if (data.errors !== undefined || data.errors !== null) {
          var errors = Object.values(data.errors).toString();

          _this.makeToast(errors, "danger");
        } else {
          _this.makeToast(data, "danger");
        }
      });
    },
    handleCheckBoxChange: function handleCheckBoxChange(row) {
      var _this = this;

      var pageIdx = _this.tableData.findIndex(function (page) {
        return row.id === page.id;
      });

      _this.tableData[pageIdx].is_active = !_this.tableData[pageIdx].is_active;
      axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("/dashboard/pages/changeActiveState/".concat(row.id), {
        is_active: _this.tableData[pageIdx].is_active
      }).then(function (res) {
        if (res.status === 200) {
          _this.makeToast(res.data, "info", 2000);
        }
      })["catch"](function (err) {
        var data = err.response.data;

        if (data.errors !== undefined || data.errors !== null) {
          var errors = Object.values(data.errors).toString();

          _this.makeToast(errors, "danger");
        } else {
          _this.makeToast(data, "danger");
        }
      });
    },
    generateSlug: function generateSlug(row) {
      if (row.main_page !== null) {
        return '/' + row.get_main_page.slug + '/' + row.slug;
      }

      return '/' + row.slug;
    }
  },
  mounted: function mounted() {
    this.tableData = this.pages.map(function (page) {
      page.is_active = Boolean(parseInt(page.is_active));
      return page;
    });
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/PagesList.vue?vue&type=style&index=0&lang=scss&":
/*!********************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/admin/PagesList.vue?vue&type=style&index=0&lang=scss& ***!
  \********************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".action-container {\n  display: flex;\n  justify-content: space-around;\n}\n.action-container a:hover {\n  cursor: pointer;\n}\n.check-active {\n  display: block;\n  margin: 0 auto;\n}\n.profile-img {\n  width: 100px;\n  margin: 0 auto;\n  display: block;\n}\n.title {\n  width: 200px;\n  display: block;\n}\n.url {\n  display: block;\n  width: 200px;\n}\n.edit-form .user-photo {\n  position: relative;\n}\n.edit-form .user-photo .edit-photo {\n  position: absolute;\n  bottom: 0;\n  left: 4px;\n}\n.edit-form .user-photo img {\n  max-width: 110px;\n}\n.VueTables__search {\n  display: none;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/PagesList.vue?vue&type=style&index=0&lang=scss&":
/*!************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/admin/PagesList.vue?vue&type=style&index=0&lang=scss& ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../../../node_modules/vue-loader/lib??vue-loader-options!./PagesList.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/PagesList.vue?vue&type=style&index=0&lang=scss&");

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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/PagesList.vue?vue&type=template&id=6b56f44a&":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/admin/PagesList.vue?vue&type=template&id=6b56f44a& ***!
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
        { attrs: { href: "/dashboard/pages/create", variant: "primary" } },
        [_vm._v("Crear una nueva página")]
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
                    attrs: { href: "pages/edit/" + props.row.id }
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
                          _vm.deletePost(props.row)
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
            key: "descripcion",
            fn: function(props) {
              return _c("span", {}, [
                _vm._v(
                  "\n      " + _vm._s(props.row.meta_description) + "\n    "
                )
              ])
            }
          },
          {
            key: "url",
            fn: function(props) {
              return _c("span", { staticClass: "url" }, [
                _c("a", { attrs: { href: _vm.generateSlug(props.row) } }, [
                  _vm._v(
                    "\n        " +
                      _vm._s(_vm.generateSlug(props.row)) +
                      "\n      "
                  )
                ])
              ])
            }
          },
          {
            key: "titulo",
            fn: function(props) {
              return _c("span", { staticClass: "title" }, [
                _c(
                  "a",
                  { attrs: { href: "/dashboard/pages/edit/" + props.row.id } },
                  [_vm._v("\n        " + _vm._s(props.row.title) + "\n      ")]
                )
              ])
            }
          },
          {
            key: "creada_por",
            fn: function(props) {
              return _c("span", {}, [
                _vm._v(
                  "\n      " + _vm._s(props.row.created_by.username) + "\n    "
                )
              ])
            }
          },
          {
            key: "ultima_modificacion_por",
            fn: function(props) {
              return _c("span", {}, [
                _vm._v(
                  "\n      " +
                    _vm._s(props.row.last_modified_by.username) +
                    "\n    "
                )
              ])
            }
          },
          {
            key: "activo",
            fn: function(props) {
              return _c("b-form-checkbox", {
                staticClass: "check-active",
                attrs: {
                  name: "check-button",
                  checked: Boolean(props.row.is_active),
                  switch: ""
                },
                on: {
                  change: function($event) {
                    return _vm.handleCheckBoxChange(props.row)
                  }
                },
                model: {
                  value: props.row.is_active,
                  callback: function($$v) {
                    _vm.$set(props.row, "is_active", $$v)
                  },
                  expression: "props.row.is_active"
                }
              })
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
                    _c("b", [_vm._v("Eliminando:")]),
                    _vm._v(
                      "\n        " + _vm._s(_vm.selectedPost.title) + "\n      "
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
          _vm.selectedPost
            ? _c("div", { staticClass: "d-block text-center" }, [
                _c("h3", [
                  _vm._v("¿Estas seguro de que deseas eliminar esta página?")
                ])
              ])
            : _vm._e(),
          _vm._v(" "),
          _c(
            "b-button",
            {
              staticClass: "mt-3",
              attrs: { block: "", variant: "danger" },
              on: { click: _vm.submitDeletePost }
            },
            [_vm._v("Eliminar")]
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

/***/ "./resources/assets/js/components/admin/PagesList.vue":
/*!************************************************************!*\
  !*** ./resources/assets/js/components/admin/PagesList.vue ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PagesList_vue_vue_type_template_id_6b56f44a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PagesList.vue?vue&type=template&id=6b56f44a& */ "./resources/assets/js/components/admin/PagesList.vue?vue&type=template&id=6b56f44a&");
/* harmony import */ var _PagesList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PagesList.vue?vue&type=script&lang=js& */ "./resources/assets/js/components/admin/PagesList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _PagesList_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./PagesList.vue?vue&type=style&index=0&lang=scss& */ "./resources/assets/js/components/admin/PagesList.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _PagesList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _PagesList_vue_vue_type_template_id_6b56f44a___WEBPACK_IMPORTED_MODULE_0__["render"],
  _PagesList_vue_vue_type_template_id_6b56f44a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/components/admin/PagesList.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/assets/js/components/admin/PagesList.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/assets/js/components/admin/PagesList.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PagesList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./PagesList.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/PagesList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PagesList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/assets/js/components/admin/PagesList.vue?vue&type=style&index=0&lang=scss&":
/*!**********************************************************************************************!*\
  !*** ./resources/assets/js/components/admin/PagesList.vue?vue&type=style&index=0&lang=scss& ***!
  \**********************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_PagesList_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader!../../../../../node_modules/css-loader!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../../../node_modules/vue-loader/lib??vue-loader-options!./PagesList.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/PagesList.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_PagesList_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_PagesList_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_PagesList_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_PagesList_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_PagesList_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/assets/js/components/admin/PagesList.vue?vue&type=template&id=6b56f44a&":
/*!*******************************************************************************************!*\
  !*** ./resources/assets/js/components/admin/PagesList.vue?vue&type=template&id=6b56f44a& ***!
  \*******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PagesList_vue_vue_type_template_id_6b56f44a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./PagesList.vue?vue&type=template&id=6b56f44a& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/PagesList.vue?vue&type=template&id=6b56f44a&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PagesList_vue_vue_type_template_id_6b56f44a___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PagesList_vue_vue_type_template_id_6b56f44a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);