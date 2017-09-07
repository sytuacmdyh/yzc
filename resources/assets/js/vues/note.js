const note = new Vue({
    el: '#noteContainer',
    data: {
        title: '',
        content: '',
        classification: '',
        errors: [],
    },
    mounted: function() {
        // Messenger.options = {
        //     extraClasses: 'messenger-fixed messenger-on-bottom messenger-on-right',
        //     theme: 'ice'
        // };
        $('[data-toggle="tooltip"]').tooltip();
    },
    methods: {
    	completeNote: function(noteId) {
            axios.post('/notes/' + noteId , {
                _method: 'PUT',
                status: 'completed'
            }).then(function(res) {
                layer.msg('success!!',{
                    icon: 1,
                    time: 1000
                }, function(){
                    location.reload();
                });
            });
    	},
        deleteNoteForce: function(noteId) {
            layer.confirm('Sure to delete this note completely?', {
              btn: ['ok','cancle'] //按钮
            }, function(){
                axios.post("/notes/delete",{
                    noteId: noteId
                }).then(function(res) {
                    layer.msg('success!!',{
                        icon: 1,
                        time: 1000
                    }, function(){
                        location.reload();
                    });
                });
            });
        },
        deleteNote: function(noteId) {
            axios.post('/notes/' + noteId, {
                _method: 'DELETE'
            }).then(function(res) {
                layer.msg('success!!',{
                    icon: 1,
                    time: 1000
                }, function(){
                    location.reload();
                });
            });
        },
        submitAddNoteForm: function(event) {
            this.errors.splice(0);
            axios.post('/notes', {
                title: this.title,
                content: this.content,
                classification: this.classification,
            }).then(function(res) {
                layer.msg('success!!',{
                    icon: 1,
                    time: 1000
                }, function(){
                    $('#addNoteModal').modal('hide');
                    setTimeout("location.reload()", 500);
                });
            }).catch(function(err) {
                if(err.response.status==422){
                    var data = err.response.data.errors;
                    for(var item in data){
                        this.errors.push(item+' :: '+data[item]);
                    }
                }
            }.bind(this));
        }
    }
});