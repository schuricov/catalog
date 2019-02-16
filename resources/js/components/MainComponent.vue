<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Main component</div>
                    
                    <div id="example-2">
                        <!-- `greet` — это название метода, определённого ниже -->
                        <button v-on:click="greet">Поприветствовать</button>
                    </div>


                    <div class="card-body">
                        Main component test.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }

    function request(val) {

        let xhr = new XMLHttpRequest;
        let params =
            'type' + '=' + encodeURIComponent(val);

        xhr.open('GET', 'api/v1/documents/10/attachment/upload/?' + params, true);
        xhr.responseType = 'text';
        xhr.onreadystatechange = function () {

            if (xhr.readyState == 4) {
                xhr.onreadystatechange = null;

                if (xhr.status == 200) {

                    let data = xhr.response;
                    console.log(data);

                    let json = JSON.parse(data);
                    // console.log(json);

                    // statusPin = json;
                    // setColorPins(json);                                                                                     // function sets up for all id on the page got from request
                }
            }
        };

        xhr.send(null);                                     // body
    }
</script>
