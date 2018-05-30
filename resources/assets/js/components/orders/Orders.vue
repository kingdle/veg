<template>
    <div class="mg-orders">
        <add-order></add-order>
        <select-location></select-location>
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-row mb-3">
                    <div class="card-body mt-2">
                        <div class="title">
                            <span class="text-success text-bold m-r-5">|</span>
                            <span class="vertical-middle">订单统计</span>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-12 mg-home-top">
                                <div class="row text-center" style="white-space:nowrap;">
                                    <div class="col pt-2">
                                        <h5 class="card-title text-muted pt-2 mb-0" style="white-space:nowrap;">订单数</h5>
                                        <p class="card-text text-secondary" style="white-space:nowrap;">
                                            {{OrderCharts.ordersCount}}
                                        </p>
                                    </div>
                                    <div class="col pt-2">
                                        <h5 class="card-title text-muted pt-2 mb-0" style="white-space:nowrap;">苗子数</h5>
                                        <p class="card-text text-secondary" style="white-space:nowrap;">
                                            {{OrderCharts.seedCount}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-7">
                                <div class="text-center mt-3 px-2"
                                     style="border-right:1px solid #eaeaea;border-left:1px solid #eaeaea">
                                    <a href="#" class="btn btn-success " data-toggle="modal"
                                       data-target="#AddOrdersModalCenter">新建订单</a>
                                    <p class="mt-3 text-muted">经常发动态就是最好的营销。</p>
                                </div>
                            </div>

                            <div class="col-sm-4 col-5">
                                <div class="p-0 text-center" style="">
                                    <img class="text-algin"
                                         :src="yourshop.code" alt=""
                                         width="90"
                                         height="90">
                                    <p class="card-title text-muted">您的苗果小程序码</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-row mb-3 border-0">
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="header-text-container">
                                    <div class="mb-3">
                                        <p class="vertical-middle">
                                            <span class="text-success text-bold m-r-5">|</span>
                                            订单列表
                                            <mark>农户在访问"苗果"小程序时，会看到自己在您的苗场订购的苗子订单数量和品种。</mark>
                                        </p>
                                    </div>
                                    <div class="body-container">
                                        <div class="my-3 border-top">
                                            <orders :orders="orders"></orders>
                                        </div>
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center">
                                                <li class="page-item" v-if="pagination.current_page > 1">
                                                    <a class="page-link" href="#" aria-label="Previous"
                                                       @click.prevent="changePage(pagination.current_page - 1)">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>
                                                <li class="page-item" v-for="page in pagesNumber"
                                                    :class="[ page == isActived ? 'active' : '']">
                                                    <a class="page-link" href="#"
                                                       @click.prevent="changePage(page)">{{ page }}</a>
                                                </li>
                                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                                    <a class="page-link" href="#" aria-label="Next"
                                                       @click.prevent="changePage(pagination.current_page + 1)">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
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
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    import Orders from './OrdersList'
    import AddOrder from './AddOrders'
    import SelectLocation from './SelectLocation'

    export default {
        created(){
            this.$store.dispatch('setAuthShop')
        },
        computed: {
            ...mapState({
                yourshop: state => state.AuthShop
            }),
            isActived: function () {
                return this.pagination.current_page;
            },
            pagesNumber: function () {
                if (!this.pagination.to) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        components:{
            Orders,
            AddOrder,
            SelectLocation
        },
        mounted() {
            axios.get('/api/v1/orders-lists').then(response => {
                this.orders = response.data.data
                this.pagination = response.data.meta
            })
            axios.get('/api/v1/countOrder').then(response => {
                this.OrderCharts = response.data
            })
        },
        data() {
            return{
                orders:[],
                pagination: {
                    total: 0,
                    per_page: 0,
                    from: 0,
                    to: 0,
                    current_page: 1
                },
                offset: 9,
                OrderCharts: {"ordersCount": '', "seedCount": ''},
            }
        },
        methods: {
            changePage: function (page) {
                this.pagination.current_page = page;
                axios.get('/api/v1/orders-lists?page='+page).then(response => {
                    this.orders = response.data.data
                })
            }
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
    .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #f06307;
        border-color: #f06307;
    }
    .page-link {
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #f06307;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }
    .page-link:hover {
        color: #f06307;
        text-decoration: none;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }
</style>
