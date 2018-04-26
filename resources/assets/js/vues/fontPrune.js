const fontPrune = new Vue({
    el: '#fontPrune',
    data: {
        file_ttf: null,
        file_txt: null,
    },
    mounted: function () {
        this.$nextTick(function () {
            // Code that will run only after the
            // entire view has been rendered
        })
    },
    methods: {
        showLoading: function () {
            layer.load(2);
        },
        fileInputChange: function (e) {
            if (e.target.name === 'file_ttf') {
                this.file_ttf = e.target.files;
            } else if (e.target.name === 'file_txt') {
                this.file_txt = e.target.files;
            }
        },
    }
});