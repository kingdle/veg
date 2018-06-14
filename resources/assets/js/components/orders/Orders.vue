<template>
    <div class="mg-orders">
        <edit-order></edit-order>
        <div class="modal bd-example-modal-lg" id="AddOrdersModalCenter" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddOrdersModalLongTitle">
                            <label class="control-label">新建订单</label>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body tags">
                        <el-form ref="addForm" :model="addForm" label-width="80px" size="medium">
                            <el-form-item label="农户姓名">
                                <el-input v-model="addForm.userName" placeholder="农户通过苗果小程序发送来的订单，姓名为微信昵称"></el-input>
                            </el-form-item>
                            <el-form-item label="电话">
                                <el-input v-model="addForm.userPhone" placeholder="默认为农户注册微信时的手机号"></el-input>
                            </el-form-item>
                            <el-form-item label="苗子品种">
                                <el-select
                                        v-model="selectTags"
                                        name="selectTags"
                                        :readonly="true"
                                        filterable
                                        remote
                                        allow-create
                                        default-first-option
                                        placeholder="请选择或新建品种">
                                    <el-option
                                            v-for="tag in tags"
                                            :key="tag.id"
                                            :label="tag.name +'('+ tag.bio+')'"
                                            :value="tag.id">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                            <el-form-item label="数量(株)">
                                <el-slider
                                        v-model="addForm.seedCount"
                                        :max="80000"
                                        :step="100"
                                        show-input
                                        input-size="mini">
                                </el-slider>
                            </el-form-item>
                            <el-form-item label="单价(元)">
                                <el-input-number
                                        v-model="addForm.UnitPrice"
                                        size="mini"
                                        :precision="2"
                                        :step="0.1"
                                        :min="0">
                                </el-input-number>
                            </el-form-item>
                            <el-form-item label="送苗日期" size="mini">
                                <el-date-picker
                                        v-model="addForm.sendDate"
                                        type="daterange"
                                        start-placeholder="最晚育苗日期"
                                        end-placeholder="送苗日期"
                                        :default-time="['00:00:00', '23:59:59']">
                                </el-date-picker>
                            </el-form-item>
                            <el-form-item label="是否送苗" size="mini" class="is-state">
                                <el-switch v-model="addForm.orderState"
                                           active-value="1"
                                           inactive-value="0"
                                           active-color="#B1AFAD"
                                           inactive-color="#87CC82"
                                           active-text="已送苗"
                                           inactive-text="未送苗"></el-switch>
                            </el-form-item>
                            <el-form-item label="是否付款" size="mini" class="is-payment">
                                <el-switch v-model="addForm.orderPayment"
                                           active-value="1"
                                           inactive-value="0"
                                           active-color="#B1AFAD"
                                           inactive-color="#f06307"
                                           active-text="已付款"
                                           inactive-text="未付款"></el-switch>
                            </el-form-item>
                            <el-form-item label="地址">
                                <el-input v-model="addForm.userAddress" placeholder="请填写完表单后再选择地址" id="maplocation"
                                          :readonly="true" data-toggle="modal"
                                          data-target="#SelectLocationModalCenter"></el-input>
                            </el-form-item>

                            <el-form-item>
                                <el-button type="primary" @click="addOrders">立即创建</el-button>
                                <el-button type="info" data-dismiss="modal">取消</el-button>
                            </el-form-item>
                        </el-form>
                    </div>
                </div>
            </div>
        </div>
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
                                            <!--<orders :orders="orders"></orders>-->
                                            <el-table
                                                    :data="orders"
                                                    align="left"
                                                    style="width: 100%"
                                            >
                                                <el-table-column
                                                        prop="id"
                                                        label="序号"
                                                        sortable
                                                        width="80"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop="name"
                                                        label="姓名"
                                                        sortable
                                                        :formatter="nameFormat"
                                                        width="100"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop="phone"
                                                        label="电话"
                                                        sortable
                                                        width="110"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop="tag.name"
                                                        label="苗子品种"
                                                        sortable
                                                        width="110"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop="count"
                                                        label="数量(株)"
                                                        sortable
                                                        width="100"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop="unit_price"
                                                        label="单价(元)"
                                                        width="80"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop='start_at'
                                                        label="育苗日期"
                                                        sortable
                                                        :formatter="dateFormat"
                                                        width="110"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop="end_at"
                                                        label="送苗日期"
                                                        sortable
                                                        :formatter="dateFormat"
                                                        width="110"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        label="地址"
                                                        sortable
                                                >
                                                    <template slot-scope="scope">
                                                        <i class="el-icon-location-outline"></i>
                                                        <span style="margin-left: 3px">{{ scope.row.address }}，{{ scope.row.villageInfo }}</span>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column
                                                        prop="state"
                                                        label="送苗？"
                                                        width="80"
                                                        :filters="[{ text: '未送苗', value: '0' }, { text: '已送苗', value: '1' }]"
                                                        :filter-method="filterTag"
                                                        filter-placement="bottom-end">
                                                    <template slot-scope="scope">
                                                        <el-tooltip content="标记是否送苗" placement="top">
                                                            <el-switch
                                                                    v-model="scope.row.state"
                                                                    active-color="#B1AFAD"
                                                                    inactive-color="#87CC82"
                                                                    active-value="1"
                                                                    inactive-value="0"
                                                                    @click.native.prevent="updateState(scope.$index, scope.row)"
                                                            >
                                                            </el-switch>
                                                        </el-tooltip>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column
                                                        prop="payment"
                                                        label="结账？"
                                                        width="80"
                                                        :filters="[{ text: '未付款', value: '0' }, { text: '已付款', value: '1' }]"
                                                        :filter-method="filterTag"
                                                        filter-placement="bottom-end">
                                                    <template slot-scope="scope">
                                                        <el-tooltip content="标记是否付款" placement="top">
                                                            <el-switch
                                                                    v-model="scope.row.payment"
                                                                    active-color="#B1AFAD"
                                                                    inactive-color="#f06307"
                                                                    active-value="1"
                                                                    inactive-value="0"
                                                                    @click.native.prevent="updatePayment(scope.$index, scope.row)"
                                                            >
                                                            </el-switch>
                                                        </el-tooltip>
                                                    </template>
                                                </el-table-column>

                                                <el-table-column
                                                        fixed="right"
                                                        label="操作"
                                                        width="120"
                                                >
                                                    <template slot-scope="scope">
                                                        <el-tooltip class="item" effect="dark" content="编辑"
                                                                    placement="left">
                                                            <el-button
                                                                    data-toggle="modal"
                                                                    data-target="#editOrderModalCenter"
                                                                    @click.native.prevent="handleEdit(scope.$index, scope.row)"
                                                                    type="primary" icon="el-icon-edit"
                                                                    size="mini">
                                                            </el-button>
                                                        </el-tooltip>
                                                        <el-tooltip class="item" effect="dark" content="删除"
                                                                    placement="top">
                                                            <el-button
                                                                    @click.native.prevent="handleDelete(scope.$index, scope.row)"
                                                                    type="info" icon="el-icon-delete"
                                                                    size="mini">
                                                            </el-button>
                                                        </el-tooltip>
                                                    </template>
                                                </el-table-column>
                                            </el-table>
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
                                                <li class="page-item"
                                                    v-if="pagination.current_page < pagination.last_page">
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
//    import Orders from './OrdersList'
    import EditOrder from './EditOrder'
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
        components: {
//            Orders,
//            AddOrder,
            EditOrder,
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
            axios.get('/api/v1/tags').then(response => {
                this.tags = response.data
            })
        },
        data() {
            return {
                orders: [],
                pagination: {
                    total: 0,
                    per_page: 0,
                    from: 0,
                    to: 0,
                    current_page: 1
                },
                offset: 9,
                OrderCharts: {"ordersCount": '', "seedCount": ''},
                addForm: {UnitPrice: '1.00',},
                selectTags: [],
                tags: [],
                max: '',

            }
        },
        methods: {
            changePage: function (page) {
                this.pagination.current_page = page;
                axios.get('/api/v1/orders-lists?page=' + page).then(response => {
                    this.orders = response.data.data
                })
            },
            dateFormat: function (row, column) {
                var date = row[column.property];
                if (date == undefined) {
                    return "";
                }
                return date.substring(0, 10);
            },
            switchFormat: function (row, column) {
                var switchs = row[column.property];
                if (switchs === '0') {
                    return "未送苗";
                }
                return '已送苗';
            },
            nameFormat: function (row, column) {
                var nname = row[column.property];
                if (nname === '') {
                    if (row.nickname === null) {
                        return '';
                    }
                    return row.nickname + '(昵称)';
                }
                return nname;
            },
            addVillageInfoFormat: function (row, column) {
                if (row.address === null) {
                    return '未标注位置';
                }
                return row.address + '，' + row.villageInfo;
            },
            handleEdit(index, row) {
                console.log(index, row);
                const formData = {
                    name: this.addForm.userName,
                    phone: this.addForm.userPhone,
                    tags: this.selectTags,
                    count: this.addForm.seedCount,
                    unit_price: this.addForm.UnitPrice,
                    sendDate: this.addForm.sendDate,
                    address: document.getElementById("maplocation").value,
                    state: this.addForm.orderState,
                    payment: this.addForm.orderPayment,
                }
                this.$store.dispatch('updateOrders', formData).then(response => {
                    this.$router.push({name: 'profile.Orders'})
                }).catch(error => {

                })
            },
            handleDelete(index, row) {
                axios.delete('/api/v1/orders/' + row.id).then(response => {
                    this.orders.splice(index, 1)
                })
            },
            updatePayment(index, row) {
                const formData = {
                    payment: row.payment,
                    id: row.id,
                }
//                axios.post('/api/v1/orders/updateState' ,formData).then(response => {
//                    console.log(response.data)
//                })
                this.$store.dispatch('updatePaymentRequest', formData).then(response => {
                    this.orders = response.data
                }).catch(error => {

                })
            },
            updateState(index, row) {
                const formData = {
                    state   : row.state,
                    id: row.id,
                }
                this.$store.dispatch('updateStateRequest', formData).then(response => {
                    this.orders = response.data
                }).catch(error => {

                })
            },
            filterTag(value, row) {
                return row.state === value;
            },
            addOrders() {
                const formData = {
                    name: this.addForm.userName,
                    phone: this.addForm.userPhone,
                    tags: this.selectTags,
                    count: this.addForm.seedCount,
                    unit_price: this.addForm.UnitPrice,
                    sendDate: this.addForm.sendDate,
                    address: document.getElementById("maplocation").value,
                    state: this.addForm.orderState,
                    payment: this.addForm.orderPayment,
                }
                axios.post('/api/v1/orders', formData).then(response => {
                    this.orders = response.data.order.data
                    $('#AddOrdersModalCenter').modal('hide')
                })
//                this.$store.dispatch('addOrdersRequest', formData).then(response => {
//                    this.orders = response.data.order.data
////                    this.$router.push({name: 'profile.Orders',})
////                    this.addForm = {}
////                    this.selectTags = []
//                }).catch(error => {
//
//                })
            }
        }
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

    .el-table .warning-row {
        background: oldlace;
    }

    .el-table .success-row {
        background: #f0f9eb;
    }

    .mg-news-img {
        background: #f5f8fa;
    }

    .mg-news-img img {
        width: 80px;
        margin: 0 1px 1px 0;
    }

    .mg-news .card-img {
        border-top-left-radius: 0.5rem !important;
    }

    .mg-news-img img:first-child {
        border-top-left-radius: 0.5rem !important;
    }

    .mg-news-img img:last-child {
        border-bottom-right-radius: 0.5rem !important;
    }

    .bd-example-border-utils [class^=border] {
        display: inline-block;
        width: 18%;
        height: 5rem;
        margin: .25rem;
        background-color: #f5f5f5;
    }

    .el-button + .el-button {
        margin-left: 0px;
        margin-top: 3px;
    }

    .mg-news-img img:first-child {
        border-top-left-radius: 0.5rem !important;
    }

    .mg-news-img img:last-child {
        border-bottom-right-radius: 0.5rem !important;
    }

    .mg-upload-image .el-upload--picture-card {
        background-color: #fbfdff;
        border: 1px dashed #c0ccda;
        border-radius: 6px;
        box-sizing: border-box;
        width: 82px;
        height: 82px;
        line-height: 82px;
        vertical-align: top;
    }

    .mg-upload-image .el-upload-list--picture-card .el-upload-list__item {
        width: 82px;
        height: 82px;
    }

    .tags .el-select {
        display: block;
    }

    .el-date-table td.current:not(.disabled) span {
        color: #fff;
        background-color: #f06307;
    }

    .el-date-table td.today span {
        color: #f06307;
        font-weight: 700;
    }

    .el-radio__input.is-checked .el-radio__inner {
        border-color: #f06307;
        background: #f06307;
    }

    .el-radio__input.is-checked + .el-radio__label {
        color: #f06307;
    }

    .el-button--primary {
        color: #fff;
        background-color: #f06307;
        border-color: #f06307;
    }

    .tags .el-select {
        display: block;
    }

    .el-slider__bar {
        background-color: #f06307;
    }

    .el-slider__button {
        border: 2px solid #f06307;
        background-color: #fff;
    }

    .el-switch.is-checked .el-switch__core {
        border-color: #f06307;
        background-color: #f06307;
    }

    .el-range-editor.is-active, .el-range-editor.is-active:hover {
        border-color: #f06307;
    }

    .el-select .el-input.is-focus .el-input__inner {
        border-color: #f06307;
    }

    .el-input__inner:focus {
        border-color: #f06307;
        outline: 0;
    }

    .el-select-dropdown.is-multiple .el-select-dropdown__item.selected {
        color: #f06307;
        background-color: #fff;
    }

    .el-select-dropdown__item.selected {
        color: #f06307;
        font-weight: 700;
    }

    .el-date-table td.end-date span, .el-date-table td.start-date span {
        background-color: #f06307;
    }

    .is-payment .el-switch__label.is-active {
        color: #f06307;
    }

    .is-state .el-switch__label.is-active {
        color: rgb(135, 204, 130);
    }

    .el-button:focus, .el-button:hover {
        background: #28a745 !important;
        border-color: #28a745 !important;
        color: #fff;
    }
</style>
