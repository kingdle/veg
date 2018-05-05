<template>
    <div class="mg-news">
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-row mb-3 border-0">
                    <div class="card-body mt-2">
                        <div class="row my-3">
                            <div class="col-sm-6 col-7">
                                <div class="text-center mt-3 px-2"
                                     style="border-right:1px solid #eaeaea;">
                                    <a class="btn btn-success m-r-10 text-light" data-toggle="modal"
                                       data-target="#AddNewsModalCenter">发动态</a>
                                    <p class="mt-3 text-muted">在这留下美好的回忆。</p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-5">

                                <div class="p-0 text-center">
                                    <img class="text-algin"
                                         src="/images-pc/mg-code-mp.jpg" alt="苗果"
                                         width="90"
                                         height="90">
                                    <p class="card-title text-muted">您的苗果小程序码</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 border-top">
                            <dynamics :dynamics="dynamics"></dynamics>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Dynamics from './NewsList'
    export default {
        components:{
            Dynamics
        },
        mounted() {
            axios.get('/api/v1/dynamics-user').then(response => {
                this.dynamics = response.data.data
            })
        },
        data() {
            return{
                dynamics:[],
            }
        },
        methods: {

        },
    }

</script>
<style>
    .mg-news-img {
        background: #f5f8fa;
    }

    .mg-news-img img {
        width: 72px;
        margin: 0 1px 1px 0;
    }

    .mg-news .card-img {
        border-top-left-radius: 0.5rem !important;
    }


</style>
