const note = new Vue({
    el: '#noteContainer',
    data: {
        title: '',
        content: '',
        classification: '',
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
    		layer.load(2, {time: 10000});
            axios.post('/notes/' + noteId , {
                _method: 'PUT',
                status: 'completed'
            }).then(function(res) {
                layer.closeAll('loading');
                layer.msg('success!!',{
                    icon: 1,
                    time: 1000
                }, function(){
                    location.reload();
                });
            }).catch(function(err) {
                layer.closeAll('loading');
                layer.msg('failed',{
                    icon: 2,
                    time: 2000
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
                    layer.closeAll('loading');
                    layer.msg('success!!',{
                        icon: 1,
                        time: 1000
                    }, function(){
                        location.reload();
                    });
                }).catch(function(err) {
                    layer.closeAll('loading');
                    layer.msg('failed',{
                        icon: 2,
                        time: 2000
                    });
                });
            },function(){});
        },
        deleteNote: function(noteId) {
            layer.load(2, {time: 10000});
            axios.post('/notes/' + noteId, {
                _method: 'DELETE'
            }).then(function(res) {
                layer.closeAll('loading');
                layer.msg('success!!',{
                    icon: 1,
                    time: 1000
                }, function(){
                    location.reload();
                });
            }).catch(function(err) {
                layer.closeAll('loading');
                layer.msg('failed',{
                    icon: 2,
                    time: 2000
                });
            });
        },
        submitAddNoteForm: function(event) {
            layer.load(2, {time: 10000});
            axios.post('/notes', {
                title: this.title,
                content: this.content,
                classification: this.classification,
            }).then(function(res) {
                layer.closeAll('loading');
                layer.msg('success!!',{
                    icon: 1,
                    time: 1000
                }, function(){
                    $('#addNoteModal').modal('hide');
                    setTimeout("location.reload()", 500);
                });
            }).catch(function(err) {
                layer.closeAll('loading');
                layer.msg('failed',{
                    icon: 2,
                    time: 2000
                });
            });
        }
    }
});