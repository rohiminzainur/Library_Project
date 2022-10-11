var controller = new Vue({
    el: "#controller",
    data: {
        datas: [],
        gender: "",
        data: {},
        actionUrl,
        apiUrl,
        editStatus: false,
    },
    mounted: function() {
        this.datatable();
    },
    methods: {
        datatable() {
            const _this = this;
            _this.table = $("#dataTable")
                .DataTable({
                    ajax: {
                        url: _this.apiUrl,
                        type: "GET",
                    },
                    columns,
                })
                .on("xhr", function() {
                    _this.datas = _this.table.ajax.json().data;
                });
        },
        addData() {
            this.data = {};
            this.editStatus = false;
            $("#staticBackdrop").modal();
        },
        editData(event, row) {
            this.data = this.datas[row];
            this.editStatus = true;
            $("#staticBackdrop").modal();
        },
        deleteData(event, id) {
            if (confirm("Yakin Dihapus?")) {
                $(event.target).parents("tr").remove();
                axios
                    .post(this.actionUrl + "/" + id, { _method: "DELETE" })
                    .then((response) => {
                        alert("Data has been removed");
                    });
            }
        },
        submitForm(event, id) {
            event.preventDefault();
            const _this = this;
            var actionUrl = !this.editStatus ?
                this.actionUrl :
                this.actionUrl + "/" + id;
            axios
                .post(actionUrl, new FormData($(event.target)[0]))
                .then((response) => {
                    $("#staticBackdrop").modal("hide");
                    _this.table.ajax.reload();
                });
        },
    },
});