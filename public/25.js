(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[25],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/MenuList.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/admin/MenuList.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuedraggable__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuedraggable */ "./node_modules/vuedraggable/dist/vuedraggable.common.js");
/* harmony import */ var vuedraggable__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vuedraggable__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_1__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  props: ['pages'],
  data: function data() {
    return {
      pagesList: []
    };
  },
  components: {
    draggable: vuedraggable__WEBPACK_IMPORTED_MODULE_0___default.a
  },
  methods: {
    handleDrop: function handleDrop(e, a) {
      console.log(e, a);
    },
    handleMove: function handleMove(e, a) {
      var aux = 0;
      aux = this.pagesList[e.draggedContext.index].menu_order;
      this.pagesList[e.draggedContext.index].menu_order = this.pagesList[e.relatedContext.index].menu_order;
      this.pagesList[e.relatedContext.index].menu_order = aux;
    },
    handleMoveSub: function handleMoveSub(e, a) {
      var item;
      var y;
      var id = e.draggedContext.element.main_page;
      var order;
      var _iteratorNormalCompletion = true;
      var _didIteratorError = false;
      var _iteratorError = undefined;

      try {
        for (var _iterator = this.pagesList[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
          item = _step.value;

          if (item.id === id) {
            order = item.menu_order - 1;
            break;
          }
        }
      } catch (err) {
        _didIteratorError = true;
        _iteratorError = err;
      } finally {
        try {
          if (!_iteratorNormalCompletion && _iterator["return"] != null) {
            _iterator["return"]();
          }
        } finally {
          if (_didIteratorError) {
            throw _iteratorError;
          }
        }
      }

      y = this.pagesList[order].get_subpages[e.draggedContext.index].menu_order;
      this.pagesList[order].get_subpages[e.draggedContext.index].menu_order = this.pagesList[order].get_subpages[e.relatedContext.index].menu_order;
      this.pagesList[order].get_subpages[e.relatedContext.index].menu_order = y;
    },
    saveMenu: function saveMenu() {
      var _this = this;

      axios__WEBPACK_IMPORTED_MODULE_1___default.a.post('/dashboard/menu/updateOrder', _this.pagesList).then(function (res) {
        return _this.makeToast(res.data);
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
    makeToast: function makeToast(msg) {
      var variant = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "success";
      var delay = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 3000;
      var append = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : false;
      this.$bvToast.toast("".concat(msg), {
        title: "Evento de actualización del menú",
        autoHideDelay: delay,
        appendToast: append,
        variant: variant
      });
    }
  },
  mounted: function mounted() {
    this.pagesList = this.pages.map(function (page, mainIdx) {
      if (!page.menu_order) page.menu_order = mainIdx + 1;

      if (page.get_subpages.length > 0) {
        page.get_subpages = page.get_subpages.map(function (subpage, index) {
          if (!subpage.menu_order) subpage.menu_order = index + 1;
          return subpage;
        });
        page.get_subpages.sort(function (link1, link2) {
          return link1.menu_order - link2.menu_order;
        });
      }

      return page;
    });
  },
  computed: {
    dragOptions: function dragOptions() {
      return {
        animation: 200,
        group: "main",
        disabled: false,
        ghostClass: "ghost"
      };
    },
    dragOptionsSub: function dragOptionsSub() {
      return {
        animation: 200,
        disabled: false,
        ghostClass: "ghost"
      };
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/MenuList.vue?vue&type=template&id=0510fe58&":
/*!************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/admin/MenuList.vue?vue&type=template&id=0510fe58& ***!
  \************************************************************************************************************************************************************************************************************************/
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
        "draggable",
        _vm._b(
          {
            attrs: { move: _vm.handleMove },
            model: {
              value: _vm.pagesList,
              callback: function($$v) {
                _vm.pagesList = $$v
              },
              expression: "pagesList"
            }
          },
          "draggable",
          _vm.dragOptions,
          false
        ),
        [
          _c(
            "transition-group",
            { attrs: { type: "transition", name: "flip-list" } },
            _vm._l(_vm.pagesList, function(menuItem) {
              return _c(
                "div",
                { key: menuItem.id, staticClass: "container" },
                [
                  _c(
                    "b-list-group",
                    [
                      _c(
                        "b-list-group-item",
                        {
                          directives: [
                            {
                              name: "b-toggle",
                              rawName: "v-b-toggle.:aria-controls",
                              value: menuItem.title,
                              expression: "menuItem.title",
                              modifiers: { ":aria-controls": true }
                            }
                          ],
                          staticClass: " d-flex w-50 align-items-center",
                          attrs: { button: "" }
                        },
                        [
                          _c(
                            "b-row",
                            { staticClass: "w-100" },
                            [
                              _c("b-col", { attrs: { cols: "1" } }, [
                                _c("span", [
                                  _vm._v(_vm._s(menuItem.menu_order))
                                ])
                              ]),
                              _vm._v(" "),
                              _c("b-col", { attrs: { cols: "1" } }, [
                                _c("span", [_vm._v("-")])
                              ]),
                              _vm._v(" "),
                              _c("b-col", { attrs: { cols: "9" } }, [
                                _c("span", [_vm._v(_vm._s(menuItem.title))])
                              ]),
                              _vm._v(" "),
                              _c("b-col", { attrs: { cols: "1" } }, [
                                menuItem.get_subpages.length > 0
                                  ? _c("span", [
                                      _c("i", {
                                        staticClass: "fas fa-caret-down"
                                      })
                                    ])
                                  : _vm._e()
                              ])
                            ],
                            1
                          )
                        ],
                        1
                      ),
                      _vm._v(" "),
                      menuItem.get_subpages.length > 0
                        ? _c(
                            "div",
                            [
                              _c(
                                "draggable",
                                _vm._b(
                                  {
                                    attrs: { move: _vm.handleMoveSub },
                                    model: {
                                      value: menuItem.get_subpages,
                                      callback: function($$v) {
                                        _vm.$set(menuItem, "get_subpages", $$v)
                                      },
                                      expression: "menuItem.get_subpages"
                                    }
                                  },
                                  "draggable",
                                  _vm.dragOptionsSub,
                                  false
                                ),
                                [
                                  _c(
                                    "transition-group",
                                    {
                                      attrs: {
                                        type: "aaa",
                                        name: "flip-list-sub"
                                      }
                                    },
                                    _vm._l(menuItem.get_subpages, function(
                                      submenuItem
                                    ) {
                                      return _c(
                                        "div",
                                        { key: submenuItem.id },
                                        [
                                          _c(
                                            "b-collapse",
                                            { attrs: { id: menuItem.title } },
                                            [
                                              _c(
                                                "b-list-group-item",
                                                {
                                                  staticClass: "w-50",
                                                  attrs: {
                                                    button: "",
                                                    variant: "secondary"
                                                  }
                                                },
                                                [
                                                  _c(
                                                    "b-row",
                                                    { staticClass: "w-100" },
                                                    [
                                                      _c("b-col", {
                                                        attrs: { cols: "1" }
                                                      }),
                                                      _vm._v(" "),
                                                      _c(
                                                        "b-col",
                                                        {
                                                          attrs: { cols: "1" }
                                                        },
                                                        [
                                                          _c("span", [
                                                            _vm._v(
                                                              _vm._s(
                                                                submenuItem.menu_order
                                                              )
                                                            )
                                                          ])
                                                        ]
                                                      ),
                                                      _vm._v(" "),
                                                      _c(
                                                        "b-col",
                                                        {
                                                          attrs: { cols: "1" }
                                                        },
                                                        [
                                                          _c("span", [
                                                            _vm._v("-")
                                                          ])
                                                        ]
                                                      ),
                                                      _vm._v(" "),
                                                      _c(
                                                        "b-col",
                                                        {
                                                          attrs: { cols: "9" }
                                                        },
                                                        [
                                                          _c("span", [
                                                            _vm._v(
                                                              _vm._s(
                                                                submenuItem.title
                                                              )
                                                            )
                                                          ])
                                                        ]
                                                      )
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
                                      )
                                    }),
                                    0
                                  )
                                ],
                                1
                              )
                            ],
                            1
                          )
                        : _vm._e()
                    ],
                    1
                  )
                ],
                1
              )
            }),
            0
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "b-row",
        { staticClass: "mt-5" },
        [
          _c(
            "b-col",
            { staticClass: "ml-5" },
            [
              _c(
                "b-button",
                {
                  staticClass: "submit-btn ",
                  attrs: { size: "lg", type: "submit", variant: "primary" },
                  on: { click: _vm.saveMenu }
                },
                [_vm._v("Guardar")]
              )
            ],
            1
          )
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "mb-5 ml-5" }, [
      _c("h1", {}, [_vm._v("Menú")]),
      _vm._v(" "),
      _c("h5", { staticClass: "secondary" }, [
        _vm._v("Arrastra y mueve las páginas para cambiar el orden")
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/assets/js/components/admin/MenuList.vue":
/*!***********************************************************!*\
  !*** ./resources/assets/js/components/admin/MenuList.vue ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _MenuList_vue_vue_type_template_id_0510fe58___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./MenuList.vue?vue&type=template&id=0510fe58& */ "./resources/assets/js/components/admin/MenuList.vue?vue&type=template&id=0510fe58&");
/* harmony import */ var _MenuList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./MenuList.vue?vue&type=script&lang=js& */ "./resources/assets/js/components/admin/MenuList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _MenuList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _MenuList_vue_vue_type_template_id_0510fe58___WEBPACK_IMPORTED_MODULE_0__["render"],
  _MenuList_vue_vue_type_template_id_0510fe58___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/components/admin/MenuList.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/assets/js/components/admin/MenuList.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./resources/assets/js/components/admin/MenuList.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_MenuList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./MenuList.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/MenuList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_MenuList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/assets/js/components/admin/MenuList.vue?vue&type=template&id=0510fe58&":
/*!******************************************************************************************!*\
  !*** ./resources/assets/js/components/admin/MenuList.vue?vue&type=template&id=0510fe58& ***!
  \******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_MenuList_vue_vue_type_template_id_0510fe58___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./MenuList.vue?vue&type=template&id=0510fe58& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/admin/MenuList.vue?vue&type=template&id=0510fe58&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_MenuList_vue_vue_type_template_id_0510fe58___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_MenuList_vue_vue_type_template_id_0510fe58___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);