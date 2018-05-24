<template>
    <div class="home">
        <div class="row">
            <div class="col-12 w-100per m-b-100 overflow-auto">
                <div class="w-1200 py-5 m-auto">
                    <h2 class=" text-center">
                        苗果服务在您身边</h2>
                    <p class="text-sm text-center letter-10  m-b-45">
                        专业种苗服务平台，探索农业生产数据，赋予农户辨别市场变化的能力。</p>
                    <div class="my-0">
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
                                <div class="mr-4 text-center">
                                    <div class="code-pics">
                                        <ul>
                                            <li v-for="shop in shops" :key="shop.id">
                                                <a href="#" @mouseenter="showActive(shop.id)"
                                                   @mouseleave="showActive(0)">
                                                    <img :src="shop.avatar+'!mp.v200'" width="100px">
                                                    <img v-show="active === shop.id" class="hide_tab"
                                                         :src="shop.code+'!mp.v200'" width="100px">
                                                </a>
                                                <h6 class="shop-title pt-2 mb-0">{{shop.title}}</h6>
                                                <p class="figure-caption font-weight-light text-lowercase pb-2">
                                                    {{shop.updated_at.date | moment("from") }} 来过
                                                </p>
                                            </li>
                                        </ul>

                                    </div>

                                </div>
                            </div>
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
                active: 0
            }
        },
        mounted() {
            axios.get('/api/v1/shops').then(response => {
                this.shops = response.data.data
            })
        },
        methods: {
            showActive(index) {
                this.active = index;
            }
        }


    }
</script>

<style>
    .shop-title{
        width: 120px;
        height: 28px;
        line-height: 28px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .code-pics img {
        border-radius: 50%;
        box-shadow: 0 0 20px #e4e8eb !important;
    }
    .code-pics {
        float: right;
    }
    .code-pics ul {
        margin-left: 1px;
        padding-left:0px !important;
    }
    .code-pics ul li {
        display: inline-block;
        margin: 20px 10px;
        width: 100px;
        height: 100px;
    }
    .code-pics ul li a {
        position: relative;
        display: inline-block;
        width: 100px;
        height: 100px;
    }
    .hide_tab {
        position: absolute;
        bottom: 0;
        z-index:999;
        margin-left: -50px;
    }
</style>
