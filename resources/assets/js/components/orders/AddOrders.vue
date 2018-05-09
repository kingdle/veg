<template>
    <div class="news-add">
        <div class="modal bd-example-modal-lg" id="AddOrdersModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="ShopModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddOrdersModalLongTitle">
                            <label for="dynamic" class="control-label">新建订单</label>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <el-form ref="form" :inline="true" :model="form" label-width="80px">
                            <el-form-item label="农户姓名">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="电话">
                                <el-input v-model="form.phone"></el-input>
                            </el-form-item>
                            <el-form-item label="种苗品种">
                                <el-input v-model="form.vegName"></el-input>
                            </el-form-item>
                            <el-form-item label="数量">
                                <el-input v-model="form.count"></el-input>
                            </el-form-item>

                            <el-form-item label="送苗时间">
                                <el-col :span="11">
                                    <el-date-picker type="date" placeholder="选择日期" v-model="form.date1" style="width: 100%;"></el-date-picker>
                                </el-col>
                                <el-col class="line" :span="2">-</el-col>
                                <el-col :span="11">
                                    <el-time-picker type="fixed-time" placeholder="选择时间" v-model="form.time1" style="width: 100%;"></el-time-picker>
                                </el-col>
                            </el-form-item>
                            <el-form-item label="地址">
                                <el-input v-model="form.address"></el-input>
                            </el-form-item>
                            <el-form-item label="状态">
                                <el-radio-group v-model="form.state">
                                    <el-radio label="未送苗"></el-radio>
                                    <el-radio label="移送苗"></el-radio>
                                </el-radio-group>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="addOrders">立即创建</el-button>
                                <el-button>取消</el-button>
                            </el-form-item>
                        </el-form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    import jwtToken from './../../helpers/jwt'
    import {ErrorBag} from 'vee-validate';
    //    import * as types from './../../store/mutation-type'
    export default {
        data() {
            return {
                form: {
                    name: '',
                    vegName: '',
                    date1: '',
                    time1:'',
                    count: '',
                    phone: '',
                    address: '',
                    state: ''
                }
            }
        },
        mounted() {
            axios.get('/api/v1/tags').then(response => {
                this.options = response.data
            })
            axios.get('/api/v1/sort/all').then(response => {
                this.options2 = response.data
            })
        },
        methods: {
            addOrders() {
                console.log('submit!');
            }
        }
    }
</script>
<style>
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
</style>
