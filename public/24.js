(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[24],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/HomeDashboard.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/admin/HomeDashboard.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/HomeDashboard.vue?vue&type=template&id=e9d1cc64&":
/*!*****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/admin/HomeDashboard.vue?vue&type=template&id=e9d1cc64& ***!
  \*****************************************************************************************************************************************************************************************************************************/
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
      _vm._m(0),
      _vm._v(" "),
      _c(
        "b-card-group",
        { attrs: { deck: "" } },
        [
          _c(
            "b-card",
            {
              staticClass: "m-3",
              attrs: { "header-tag": "header" },
              scopedSlots: _vm._u([
                {
                  key: "header",
                  fn: function() {
                    return [
                      _c("h6", { staticClass: "mb-0 text-uppercase" }, [
                        _vm._v("Páginas")
                      ])
                    ]
                  },
                  proxy: true
                }
              ])
            },
            [
              _vm._v(" "),
              _c("b-card-text", [
                _vm._v("Revisa una de las páginas o modifica una creada")
              ]),
              _vm._v(" "),
              _c(
                "b-button-group",
                [
                  _c(
                    "b-button",
                    {
                      staticClass: "mx-2",
                      attrs: {
                        href: "/dashboard/pages/create",
                        variant: "primary"
                      }
                    },
                    [
                      _c("font-awesome-icon", {
                        attrs: { icon: ["fas", "plus"] }
                      }),
                      _c("br"),
                      _vm._v(" Crear una nueva página")
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-button",
                    {
                      staticClass: "mx-2",
                      attrs: { href: "/dashboard/pages", variant: "info" }
                    },
                    [
                      _c("font-awesome-icon", {
                        attrs: { icon: ["fas", "book-open"] }
                      }),
                      _c("br"),
                      _vm._v(" Administrar páginas")
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "b-card",
            {
              staticClass: "m-3",
              attrs: { "header-tag": "header" },
              scopedSlots: _vm._u([
                {
                  key: "header",
                  fn: function() {
                    return [
                      _c("h6", { staticClass: "mb-0 text-uppercase" }, [
                        _vm._v("Menú")
                      ])
                    ]
                  },
                  proxy: true
                }
              ])
            },
            [
              _vm._v(" "),
              _c("b-card-text", [
                _vm._v("Modifica el orden o los botones del menú")
              ]),
              _vm._v(" "),
              _c(
                "b-button",
                {
                  staticClass: "mx-2",
                  attrs: { href: "/dashboard/menu", variant: "primary" }
                },
                [
                  _c("font-awesome-icon", {
                    attrs: { icon: ["fas", "pager"] }
                  }),
                  _c("br"),
                  _vm._v(" Administrar menú")
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "b-card",
            {
              staticClass: "m-3",
              attrs: { "header-tag": "header" },
              scopedSlots: _vm._u([
                {
                  key: "header",
                  fn: function() {
                    return [
                      _c("h6", { staticClass: "mb-0 text-uppercase" }, [
                        _vm._v("Administrar Usuarios")
                      ])
                    ]
                  },
                  proxy: true
                }
              ])
            },
            [
              _vm._v(" "),
              _c("b-card-text", [
                _vm._v(
                  "Ten el control de todas los usuarios que administran el sitio y de los roles que tendrán"
                )
              ]),
              _vm._v(" "),
              _c(
                "b-button-group",
                [
                  _c(
                    "b-button",
                    {
                      staticClass: "mx-2",
                      attrs: { href: "/dashboard/users", variant: "primary" }
                    },
                    [
                      _c("font-awesome-icon", {
                        attrs: { icon: ["fas", "user-plus"] }
                      }),
                      _c("br"),
                      _vm._v(" Crear usuarios")
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-button",
                    {
                      staticClass: "mx-2",
                      attrs: { href: "/dashboard/users", variant: "info" }
                    },
                    [
                      _c("font-awesome-icon", {
                        attrs: { icon: ["fas", "users-cog"] }
                      }),
                      _c("br"),
                      _vm._v(" Administrar usuarios")
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "b-card-group",
        { attrs: { deck: "" } },
        [
          _c(
            "b-card",
            {
              attrs: { "header-tag": "header" },
              scopedSlots: _vm._u([
                {
                  key: "header",
                  fn: function() {
                    return [
                      _c("h6", { staticClass: "mb-0 text-uppercase" }, [
                        _vm._v("Preguntas Frecuentes")
                      ])
                    ]
                  },
                  proxy: true
                }
              ])
            },
            [
              _vm._v(" "),
              _c(
                "b-button-group",
                [
                  _c(
                    "b-button",
                    {
                      staticClass: "mx-2",
                      attrs: {
                        href: "/dashboard/questions",
                        variant: "primary"
                      }
                    },
                    [
                      _c("font-awesome-icon", {
                        attrs: { icon: ["fas", "plus"] }
                      }),
                      _c("br"),
                      _vm._v(" Crear nueva pregunta")
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-button",
                    {
                      staticClass: "mx-2",
                      attrs: { href: "/dashboard/questions", variant: "info" }
                    },
                    [
                      _c("font-awesome-icon", {
                        attrs: { icon: ["fas", "cog"] }
                      }),
                      _c("br"),
                      _vm._v(" Administrar preguntas")
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "b-card",
            {
              attrs: { "header-tag": "header" },
              scopedSlots: _vm._u([
                {
                  key: "header",
                  fn: function() {
                    return [
                      _c("h6", { staticClass: "mb-0 text-uppercase" }, [
                        _vm._v("Encuestas")
                      ])
                    ]
                  },
                  proxy: true
                }
              ])
            },
            [
              _vm._v(" "),
              _c(
                "b-button-group",
                [
                  _c(
                    "b-button",
                    {
                      staticClass: "mx-2",
                      attrs: { href: "/dashboard/surveys", variant: "primary" }
                    },
                    [
                      _c("font-awesome-icon", {
                        attrs: { icon: ["fas", "plus"] }
                      }),
                      _c("br"),
                      _vm._v(" Crear nueva encuesta")
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-button",
                    {
                      staticClass: "mx-2",
                      attrs: { href: "/dashboard/surveys", variant: "info" }
                    },
                    [
                      _c("font-awesome-icon", {
                        attrs: { icon: ["fas", "cog"] }
                      }),
                      _c("br"),
                      _vm._v(" Administrar encuestas")
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _vm._m(1)
    ],
    1
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "caja bg-light p-3" }, [
      _c("h1", [_vm._v("Bienvenido al Panel de administración")]),
      _vm._v(" "),
      _c("h4", { staticClass: "ml-4" }, [
        _vm._v(
          "Desde acá podrás Administrar el sitio web, agregar o Administrar páginas, responder preguntas, hacer encuestas y administrar usuarios"
        )
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", [
      _c("h3", { staticClass: "text-center" }, [
        _vm._v("Sitio web creador por ...")
      ])
    ])
  }
]
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

/***/ "./resources/assets/js/components/admin/HomeDashboard.vue":
/*!****************************************************************!*\
  !*** ./resources/assets/js/components/admin/HomeDashboard.vue ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _HomeDashboard_vue_vue_type_template_id_e9d1cc64___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./HomeDashboard.vue?vue&type=template&id=e9d1cc64& */ "./resources/assets/js/components/admin/HomeDashboard.vue?vue&type=template&id=e9d1cc64&");
/* harmony import */ var _HomeDashboard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./HomeDashboard.vue?vue&type=script&lang=js& */ "./resources/assets/js/components/admin/HomeDashboard.vue?vue&type=script&lang=js&");
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _HomeDashboard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _HomeDashboard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__[key]; }) }(__WEBPACK_IMPORT_KEY__));
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _HomeDashboard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _HomeDashboard_vue_vue_type_template_id_e9d1cc64___WEBPACK_IMPORTED_MODULE_0__["render"],
  _HomeDashboard_vue_vue_type_template_id_e9d1cc64___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/components/admin/HomeDashboard.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/assets/js/components/admin/HomeDashboard.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************!*\
  !*** ./resources/assets/js/components/admin/HomeDashboard.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_HomeDashboard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./HomeDashboard.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/HomeDashboard.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_HomeDashboard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_HomeDashboard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_HomeDashboard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_HomeDashboard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_HomeDashboard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/assets/js/components/admin/HomeDashboard.vue?vue&type=template&id=e9d1cc64&":
/*!***********************************************************************************************!*\
  !*** ./resources/assets/js/components/admin/HomeDashboard.vue?vue&type=template&id=e9d1cc64& ***!
  \***********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_HomeDashboard_vue_vue_type_template_id_e9d1cc64___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./HomeDashboard.vue?vue&type=template&id=e9d1cc64& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/HomeDashboard.vue?vue&type=template&id=e9d1cc64&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_HomeDashboard_vue_vue_type_template_id_e9d1cc64___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_HomeDashboard_vue_vue_type_template_id_e9d1cc64___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);