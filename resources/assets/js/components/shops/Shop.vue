<template>
    <div class="container-fluid list-group-item mg-content">
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
                    <p class="set-up-item-label">
                        苗果昵称:
                    </p>
                    <p class="set-up-item-content font-weight-bold text-dark">{{ shop.title }}</p>

                </li>
                <li class="b-b p-b-20 p-t-20">
                    <p class="set-up-item-label">介绍:</p>
                    <p class="set-up-item-content font-weight-bold text-dark">{{ shop.summary }}</p>
                    <button type="button" class="btn btn-success f-r" data-toggle="modal"
                            data-target="#ShopModalCenter">
                        修改
                    </button>
                </li>
                <li class="b-b p-b-20 p-t-20">
                    <p class="set-up-item-label">性质</p>
                    <p class="set-up-item-content">{{ shop.property }}</p>

                </li>
                <li class="b-b p-b-20 p-t-20">
                    <p class="set-up-item-label">照片数</p>
                    <p class="set-up-item-content">{{ shop.pic_count }}</p>
                </li>
                <li class="b-b p-b-20 p-t-20">
                    <p class="set-up-item-label">动态数</p>
                    <p class="set-up-item-content">{{ shop.dynamic_count }}</p>
                </li>
                <li class="b-b p-b-20 p-t-20">
                    <p class="set-up-item-label">地址</p>
                    <p class="set-up-item-content">{{ shop.address }}</p>
                </li>
            </ul>
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
