<template>
    <div class="mg-orders">
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-row mb-3">
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-xs-12 col-md-9">
                                <div class="header-text-container">
                                    <div class="mb-3">
                                        <p class="vertical-middle">
                                            <span class="text-success text-bold m-r-5">|</span>
                                            订单列表
                                        </p>
                                        <mark>农户通过微信的"苗果"小程序发来订单需求，您需要尽快联系农户，并填写发送给农户确认，本订单才生效。</mark>
                                    </div>
                                    <div class="row">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">订单状态</th>
                                                <th scope="col">菜苗</th>
                                                <th scope="col">数量（棵）</th>
                                                <th scope="col">农户</th>
                                                <th scope="col">下单时间</th>
                                                <th scope="col">送苗时间</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>待处理</td>
                                                <td>西红柿 齐达利</td>
                                                <td>4000</td>
                                                <td>@伦清风</td>
                                                <td>1分钟前</td>
                                                <td>2018年7月20日上午</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>已发农户，待确认</td>
                                                <td>西红柿 齐达利</td>
                                                <td>4000</td>
                                                <td>@伦清风</td>
                                                <td>5分钟前</td>
                                                <td>2018年7月21日上午</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>订单已生效</td>
                                                <td>辣椒</td>
                                                <td>6000</td>
                                                <td>@王大明</td>
                                                <td>10分钟前</td>
                                                <td>2018年7月22日上午</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">4</th>
                                                <td>订单已生效</td>
                                                <td>西红柿 齐达利</td>
                                                <td>2000</td>
                                                <td>@伦清风</td>
                                                <td>20天前</td>
                                                <td>2018年7月30日下午</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1">首页</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">下一页</a>
                                            </li>
                                        </ul>
                                    </nav>
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
<style>

</style>
