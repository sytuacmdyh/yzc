/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
window.Vue = require('vue');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('example', require('./components/Example.vue'));
const app = new Vue({
    el: '#app',
    data: {
        title: '',
        content: '',
        classification: '',
    },
    mounted: function() {
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
            axios.post('/notes/' + noteId , {
                _method: 'PUT',
                status: 'completed'
            }).then(function(res) {
                addNoteMessage.update({
                    type: "success",
                    message: "delete success"
                });
                location.reload();
            }.bind(this)).catch(function(err) {
                addNoteMessage.update({
                    type: "error",
                    message: "delete failed"
                })
            }.bind(this));
    	},
        deleteNote: function(noteId) {
            var addNoteMessage = Messenger().info({
                message: "deleting...."
            });
            axios.post('/notes/' + noteId, {
                _method: 'DELETE'
            }).then(function(res) {
                addNoteMessage.update({
                    type: "success",
                    message: "delete success"
                });
                location.reload();
            }.bind(this)).catch(function(err) {
                addNoteMessage.update({
                    type: "error",
                    message: "delete failed"
                })
            }.bind(this));
        },
        submitAddNoteForm: function(event) {
            var addNoteMessage = Messenger().info({
                message: "processing...."
            });
            axios.post('/notes', {
                title: this.title,
                content: this.content,
                classification: this.classification,
            }).then(function(res) {
                addNoteMessage.update({
                    type: "success",
                    message: "add success"
                });
                $('#addNoteModal').modal('hide');
                setTimeout("location.reload()", 500);
            }.bind(this)).catch(function(err) {
                Messenger().error({
                    message: 123
                });
            }.bind(this));
        }
    }
});