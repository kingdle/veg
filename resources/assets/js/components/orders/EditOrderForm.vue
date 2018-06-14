<template>
    <div class="modal bd-example-modal-lg" id="editOrderModalCenter" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOrderModalLongTitle">
                        <label class="control-label">编辑订单</label>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body tags">
                    <el-form ref="editForm" :model="editForm" label-width="80px" size="medium">
                        <el-form-item label="农户姓名">
                            <el-input v-model="editForm.userName" placeholder="农户通过苗果小程序发送来的订单，姓名为微信昵称"></el-input>
                        </el-form-item>
                        <el-form-item label="电话">
                            <el-input v-model="editForm.userPhone" placeholder="默认为农户注册微信时的手机号"></el-input>
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
                                    v-model="editForm.seedCount"
                                    :max="80000"
                                    :step="100"
                                    show-input
                                    input-size="mini">
                            </el-slider>
                        </el-form-item>
                        <el-form-item label="单价(元)">
                            <el-input-number
                                    v-model="editForm.UnitPrice"
                                    size="mini"
                                    :precision="2"
                                    :step="0.1"
                                    :min="0">
                            </el-input-number>
                        </el-form-item>
                        <el-form-item label="送苗日期" size="mini">
                            <el-date-picker
                                    v-model="editForm.sendDate"
                                    type="daterange"
                                    start-placeholder="最晚育苗日期"
                                    end-placeholder="送苗日期"
                                    :default-time="['00:00:00', '23:59:59']">
                            </el-date-picker>
                        </el-form-item>
                        <el-form-item label="是否送苗" size="mini" class="is-state">
                            <el-switch v-model="editForm.orderState"
                                       active-value="1"
                                       inactive-value="0"
                                       active-color="#B1AFAD"
                                       inactive-color="#87CC82"
                                       active-text="已送苗"
                                       inactive-text="未送苗"></el-switch>
                        </el-form-item>
                        <el-form-item label="是否付款" size="mini" class="is-payment">
                            <el-switch v-model="editForm.orderPayment"
                                       active-value="1"
                                       inactive-value="0"
                                       active-color="#B1AFAD"
                                       inactive-color="#f06307"
                                       active-text="已付款"
                                       inactive-text="未付款"></el-switch>
                        </el-form-item>
                        <el-form-item label="地址">
                            <el-input v-model="editForm.userAddress" placeholder="请填写完表单后再选择地址" id="maplocation"
                                      :readonly="true" data-toggle="modal"
                                      data-target="#SelectLocationModalCenter"></el-input>
                        </el-form-item>

                        <el-form-item>
                            <el-button type="primary" @click="editOrder">立即创建</el-button>
                            <el-button type="info" data-dismiss="modal">取消</el-button>
                        </el-form-item>
                    </el-form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import jwtToken from './../../helpers/jwt'
    import {ErrorBag} from 'vee-validate';
    import * as types from './../../store/mutation-type'
    export default {
        created() {
            this.$store.dispatch('setAuthShop');
        },
        data() {
            return {
                editForm: {},
                selectTags: [],
                tags: [],
                max: '',
                orders:{}
            }
        },

        mounted() {
            axios.get('/api/v1/tags').then(response => {
                this.tags = response.data
            })
        },
        computed: {
            summary: {
                get() {
                    return this.$store.state.order;
                },
                set(value) {
                    this.$store.commit({
                        type: types.UPDATE_SHOP_SUMMARY,
                        value: value
                    })
                }
            },
        },
        methods: {
            editOrder() {
                const formData = {

                }
                this.$store.dispatch('editOrderRequest', formData).then(response => {
                    this.$router.push({name: 'profile.Orders'})
                }).catch(error => {

                })
            }
        }
    }
</script>
