<template>
    <div class="mg-shop">
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-row mb-3">
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="panel text-center set-up-icon">
                                    <img class="rounded border-bottom"
                                         src="http://s3.mogucdn.com/mlcdn/bd3fc0/180316_83ih0fig3c94d2a9ilc0aae01abhe_144x144.png_100x100.png">
                                    <div class="mc-image-uploader">
                                        店铺头像
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <ul class="list-group">
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">
                                                苗果昵称:
                                            </p>
                                            <p class="set-up-item-content font-weight-bold text-dark">{{ shop.title }}</p>

                                        </li>
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">介绍:</p>
                                            <p class="set-up-item-content font-weight-bold text-dark">{{ shop.summary }}</p>
                                            <button type="button" class="btn btn-success f-r" data-toggle="modal"
                                                    data-target="#ShopModalCenter">
                                                修改
                                            </button>
                                        </li>
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">性质</p>
                                            <p class="set-up-item-content">{{ shop.property }}</p>

                                        </li>
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">照片数</p>
                                            <p class="set-up-item-content">{{ shop.pic_count }}</p>
                                        </li>
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">动态数</p>
                                            <p class="set-up-item-content">{{ shop.dynamic_count }}</p>
                                        </li>
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">地址：</p>
                                            <p class="set-up-item-content">{{ shop.address }}</p>
                                        </li>
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">您的苗果小程序码</p>
                                            <p class="set-up-item-content">
                                                <img class="m-3 mx-5" src="/images-pc/mg-code-mp.jpg" alt="苗果"
                                                     width="120"
                                                     height="120">
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
</template>

<script>
    import {mapState} from 'vuex'
    export default {
        created(){
            this.$store.dispatch('setAuthShop')
        },
        computed: {
            ...mapState({
                shop: state => state.AuthShop
            })
        },
//        data(){
//            return {
//                shop: [],
//            }
//        },
//        created(){
//            this.fetchData()
//        },
//        watch: {
//            '$route': 'fetchData'
//        },
//        methods: {
//            fetchData(){
//                this.axios.get('/api/v1/shops/' + this.$route.params.id).then(response => {
//                    this.shop = response.data
//                })
//            }
//        }
    }

</script>
