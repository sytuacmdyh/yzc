const note = new Vue({
    el: '#noteContainer',
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
        deleteNoteForce: function(noteId) {
            layer.confirm('Sure to delete this note completely?', {
              btn: ['ok','cancle'] //按钮
            }, function(){
                axios.post("/notes/delete",{
                    noteId: noteId
                }).then(function(res) {
                    layer.msg('success!!', function(){
                        location.reload();
                    });
                }).catch(function(err) {
                    layer.msg('failed', function(){
                        // location.reload();
                    });
                });
            },function(){});
        }.bind(this),
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