<template>
    <div class="container">

        <div class="row">
            <div id="input" class="col-sm-5">
                <input id="fileUpload" type="file" name="image" multiple="" @change="init">
            </div>
        </div>

        <hr>

        <p class="text-center" id="lblError" style="color: red;"></p>
        <br />

        <div class="main">
                <div class="child" v-for="(value) in output">
                    <a v-bind:href="route('getDocument', value.pdf)">
                    <img class="img" id="img-img" v-bind:src="route('getPreview', value.preview)"  alt="PDF">
                    </a>
                    <div class="delete" v-on:click="deleteFile(route('root') + value.pdf)"></div>
                </div>
        </div>

        <hr>
        <pag :totalPages="totalPages" :current="current" :fun="getPage" ></pag>

    </div>

</template>

<style>

    .container {
        color: gray;
    }

    .main {
        width: 100%;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: left;
    }

    .child{
        width: 25%;
        position: relative;

    }

    .img{
        z-index: 1;
        margin: 5px;
        width: 90%;
        border-radius: 8px;
        border: 1px solid #dfe0e1;
    }

    .delete {
        position: absolute;
        right: 30px;
        bottom: 20px;
        width: 10%;
        height: 10%;
        opacity: 0.3;
    }
    .delete:hover {
        opacity: 1;
    }
    .delete:before, .delete:after {
        position: absolute;
        left: 15px;
        content: ' ';
        height: 100%;
        width: 15%;
        background-color: #be2929;
    }
    .delete:before {
        transform: rotate(45deg);
    }
    .delete:after {
        transform: rotate(-45deg);
    }

</style>

<script>

    export default {

        props: ['numPage'],
        beforeMount(){
            this.getPage();
        },
        data() {
            return {
                output: [],
                totalPages: 1,
            }
        },
        methods: {
            async init(){
                if(this.validate()){
                    this.fileInputChange();
                }
            },
            route(route, item = null){
                {
                    let root = 'api/v1/documents/';
                    let map = {
                        'root'          : root,
                        'getDocument'   : root + item + '/attachment/download',
                        'getPreview'    : root + item + '/attachment/download/preview',
                        'upload'        : root + item + '/attachment/upload',
                    };

                    return map[route];
                }
            },
            validate() {
                let allowedFiles = [".pdf"];
                let fileUpload = document.getElementById("fileUpload").files[0].name;
                let lblError = document.getElementById("lblError");
                let regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
                if (!regex.test(fileUpload.toLowerCase())) {
                    lblError.innerHTML = "Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.";
                    return false;
                } else {
                    lblError.innerHTML = "";
                    return true;
                }
            },
            async fileInputChange() {

                let files = Array.from(event.target.files);

                for (let item of files) {
                    await this.uploadFile(item);
                }
            },
            async uploadFile(item){

                let fileUpload = document.getElementById("fileUpload").files[0].name;
                fileUpload = fileUpload.toLowerCase();
                let doc = fileUpload.split('.').slice(0, -1).join('.');

                let form = new FormData();
                    form.append('image', item);

                await axios.post(this.route('upload', doc), form)
                    .then(responce => {
                        this.getPage(this.totalPages);
                    })

                    .catch(error => {
                        console.log(error);
                    })

            },
            getPage(page = 1){

                this.current = page;

                let form = new FormData();
                let way = this.route('root') + '?page=' + page;
                axios.get(way, form)
                    .then(responce => {
                        this.output = responce.data['data'];
                        this.totalPages = responce.data['pages'];
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            deleteFile(file){

                let form = new FormData();
                axios.delete(file, form)
                    .then(responce => {
                        this.getPage();
                    })
                    .catch(error => {
                        console.log(error);
                    })

            }
        }
    }
</script>
