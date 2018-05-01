<template>
    <div class="home">
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="flex-md-row mb-3">
                    <div class="card-body mt-2">
                        <div class="mg-business">
                            <div class="col-12 text-center">
                                <!--<div class="figure mr-4 text-center">-->
                                    <!--<div class="new-shops">-->
                                        <!--<img src="images-pc/mg-code-mp.jpg">-->
                                    <!--</div>-->
                                    <!--<h6 class="text-secondary pt-2 mb-0">扫这个码入驻</h6>-->

                                <!--</div>-->
                                <div v-for="shop in shops" :key="shop.id" class="figure mr-4 text-center">
                                    <div class="contributor-pics">
                                        <a href="#">
                                            <img :src="shop.avatar+'!mp.v100'"
                                                 width="80px">
                                        </a>
                                    </div>
                                    <h6 class="shop-title pt-2 mb-0">{{shop.title}}</h6>
                                    <div class="figure-caption font-weight-light text-lowercase pb-2">
                                        {{shop.published_at | moment("from") }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 w-100per m-b-100 overflow-auto">
                <div class="w-1200 py-5 m-auto">
                    <h2 class=" text-center">
                    苗果服务在您身边</h2>
                    <p class="text-sm text-center letter-10  m-b-45">
                        专业的种苗交易平台，基于微信小程序。</p>
                    <div class="my-5">
                        <div class="fl flex-4 text-center">
                            <a class="inline-block m-auto shop" href="#"><img
                                    class="hoverImg" style="width:288px;"
                                    src="https://images.veg.kim/pc/home-code.png">
                            </a>
                            <h6 class="text-secondary pt-2 mb-0">微信扫这个码就能找到我们</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                shops: [],
            }
        },
        mounted() {
            axios.get('/api/v1/shops').then(response => {
                this.shops = response.data.data
            })
        },


    }
</script>
<style>
    .bd-callout {
        border: 0px solid #eee;
        border-left-color: #7bc276;
        border-left-width: .1rem;
        border-radius: .1rem;
    }

    .mg-home-top .card-title {
        font-size: 12px;
    }

    .mg-home-top .card-text {
        font-size: 30px;
        font-weight: 700;
    }

    .mg-hello h2 {
        font-weight: 200;
    }

    .mg-hello p {
        text-indent: 2rem;
    }

    .mg-business .mg-img {
        width: 200px;
        height: 200px;
    }

    .verticalLine {
        width: 1px;
        height: 80px;
        background: #E5E5E5;
        float: left;
    }

    .contributor-pics img {
        border-radius: 50%;
        box-shadow: 0 2px 15px #b1afad !important;
    }

    .contributor-pics img:hover {
        border-radius: 10%;
        box-shadow: 0 0 10px #b1afad !important;
    }

    .new-shops img{
        height:120px;
        weight:120px;
        margin-right:10px;
        border-radius: 10%;
        box-shadow: 0 0 20px #d3e1d7 !important;
    }
    .shop-title {
        color: #35393c;
    }
</style>
