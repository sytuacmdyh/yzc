/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/vues/note.js":
/***/ (function(module, exports) {

var note = new Vue({
    el: '#noteContainer',
    data: {
        title: '',
        content: '',
        classification: ''
    },
    mounted: function mounted() {
        Messenger.options = {
            extraClasses: 'messenger-fixed messenger-on-bottom messenger-on-right',
            theme: 'ice'
        };
        $('[data-toggle="tooltip"]').tooltip();
    },
    methods: {
        completeNote: function function_name(noteId) {
            var addNoteMessage = Messenger().info({
                message: "processing...."
            });
            axios.post('/notes/' + noteId, {
                _method: 'PUT',
                status: 'completed'
            }).then(function (res) {
                addNoteMessage.update({
                    type: "success",
                    message: "delete success"
                });
                location.reload();
            }.bind(this)).catch(function (err) {
                addNoteMessage.update({
                    type: "error",
                    message: "delete failed"
                });
            }.bind(this));
        },
        deleteNoteForce: function (noteId) {
            layer.confirm('Sure to delete this note completely?', {
                btn: ['ok', 'cancle'] //按钮
            }, function () {
                axios.post("/notes/delete", {
                    noteId: noteId
                }).then(function (res) {
                    layer.msg('success!!', function () {
                        location.reload();
                    });
                }).catch(function (err) {
                    layer.msg('failed', function () {
                        // location.reload();
                    });
                });
            }, function () {});
        }.bind(this),
        deleteNote: function deleteNote(noteId) {
            var addNoteMessage = Messenger().info({
                message: "deleting...."
            });
            axios.post('/notes/' + noteId, {
                _method: 'DELETE'
            }).then(function (res) {
                addNoteMessage.update({
                    type: "success",
                    message: "delete success"
                });
                location.reload();
            }.bind(this)).catch(function (err) {
                addNoteMessage.update({
                    type: "error",
                    message: "delete failed"
                });
            }.bind(this));
        },
        submitAddNoteForm: function submitAddNoteForm(event) {
            var addNoteMessage = Messenger().info({
                message: "processing...."
            });
            axios.post('/notes', {
                title: this.title,
                content: this.content,
                classification: this.classification
            }).then(function (res) {
                addNoteMessage.update({
                    type: "success",
                    message: "add success"
                });
                $('#addNoteModal').modal('hide');
                setTimeout("location.reload()", 500);
            }.bind(this)).catch(function (err) {
                Messenger().error({
                    message: 123
                });
            }.bind(this));
        }
    }
});

/***/ }),

/***/ 1:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/vues/note.js");


/***/ })

/******/ });