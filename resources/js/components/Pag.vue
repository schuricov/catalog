<template>

    <div class="app-pagination">

        <h6 class="num-page">Page {{this.current}} / {{this.totalPages}}</h6>
        <nav aria-label="pagination">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" v-on:click="fun(pagination[0])">Prew</a>
                </li>

                <!--<li class="page-item" v-for="(value) in pages[4]">-->
                    <!--<a class="page-link" v-bind:id="value" v-on:click="fun(value)">{{value}}</a>-->
                    <!--&lt;!&ndash;<a class="page-link" v-bind:id="value" v-on:click="fun(value)" v-bind:style="{ color: activeColor}">{{value}}</a>&ndash;&gt;-->
                <!--</li>-->

                <li class="page-item">
                    <a class="page-link" href="#" v-on:click="fun(pagination[1])">Next</a>
                </li>
            </ul>
        </nav>

    </div>

</template>

<style>
    .pagination {
        justify-content: center;
        margin-top: 5%;
    }
    .num-page{
        text-align: right;
    }

</style>

<script>

    export default {

        props: ['current', 'totalPages', 'fun'],
        data: function () {
            return {
                counter: this.totalPages,
                numberPages: '',
                // activeColor: 'red',
            }
        },
        methods: {
            changeMessage(event) {
                this.message = event.target.value;
                this.$emit('messageChanged', this.message);
            }
        },
        computed: {
            pagination() {
                let
                    pagination, next, prev,
                    total = this.totalPages,
                    current = this.current
                ;

                prev = (current === 1) ? current : current - 1;
                next = (current >= total) ? current : current + 1;
                pagination = [prev, next];

                return pagination;
            },
        }
    }

</script>