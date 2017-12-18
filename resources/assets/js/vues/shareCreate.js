const note = new Vue({
    el: '#createShare',
    methods: {
        showLoading: function() {
            layer.load(2, {time: 10000});
        },
    }
});