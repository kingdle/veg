<template>
    <div class="news-add">
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
                                <el-input v-model="addForm.userName"></el-input>
                            </el-form-item>
                            <el-form-item label="电话">
                                <el-input v-model="addForm.userPhone"></el-input>
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
                            <el-form-item label="数量">
                                <el-slider
                                        v-model="addForm.seedCount"
                                        :max="80000"
                                        :step="100"
                                        show-input>
                                </el-slider>
                            </el-form-item>
                            <el-form-item label="送苗日期">
                                <el-date-picker
                                        v-model="addForm.sendDate"
                                        type="daterange"
                                        start-placeholder="最晚育苗日期"
                                        end-placeholder="送苗日期"
                                        :default-time="['00:00:00', '23:59:59']">
                                </el-date-picker>
                            </el-form-item>
                            <el-form-item label="地址">
                                <el-input v-model="addForm.userAddress" id="maplocation" :readonly="true" data-toggle="modal" data-target="#SelectLocationModalCenter"></el-input>
                            </el-form-item>
                            <el-form-item label="是否送苗">
                                <el-switch v-model="addForm.orderState"></el-switch>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="addOrders">立即创建</el-button>
                                <el-button data-dismiss="modal">取消</el-button>
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
    import {ErrorBag} from 'vee-validate'

    export default {
        data() {
            return {
                addForm: {},
                selectTags: [],
                tags: [],
                max: '',
            }
        },

        mounted() {
            axios.get('/api/v1/tags').then(response => {
                this.tags = response.data
            })
        },
        methods: {
            addOrders() {
                const formData = {
                    name: this.addForm.userName,
                    phone: this.addForm.userPhone,
                    tags: this.selectTags,
                    count: this.addForm.seedCount,
                    sendDate: this.addForm.sendDate,
                    address: document.getElementById("maplocation").value,
                    state: this.addForm.orderState,
                }
                console.log(formData)
                this.$store.dispatch('addOrdersRequest', formData).then(response => {
                    this.$router.push({name: 'profile.Orders'})
//                    this.addForm = {}
//                    this.selectTags = []
                }).catch(error => {

                })
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

    .el-button:focus, .el-button:hover {
        background: #28a745 !important;
        border-color: #28a745 !important;
        color: #fff;
    }
</style>
