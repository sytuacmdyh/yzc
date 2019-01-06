const oss = require('ali-oss');

const note = new Vue({
    el: '#createShare',
    data: {
        file: null,
        progress: 0,
        fileName: null,
        canSubmit: true
    },
    computed: {
        progress_int() {
            return _.floor(this.progress * 100)
        }
    },
    methods: {
        uploadOss: function (e, conf, userId) {
            let file = e.target.files[0];
            if (!file) return;

            this.canSubmit = false;// 阻止提交
            layer.load(2);

            let fileName = 'uploads/' + userId + '/' + file.name;
            new oss(conf).multipartUpload(fileName, file, {
                progress: p => this.progress = p
            }).then(res => {
                this.fileName = res.name;
                this.canSubmit = true;// 允许提交
                layer.closeAll();
            });
        },
        showLoading: function () {
            layer.load(2);
        },
    }
});
