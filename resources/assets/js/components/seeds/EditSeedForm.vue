<template>
    <div class="modal" id="SeedModalCenter" tabindex="-1" role="dialog" aria-labelledby="SeedModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="seedModalLongTitle">
                        <label class="control-label">修改商户信息</label>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="updateSeed(newSeed)">
                        <div class="form-group" :class="{'has-error' : errors.has('name') }">
                            <input class="form-control"
                                   v-model="newSeed.title"
                                   type="text" placeholder="公司名">
                            <input class="form-control"
                                   v-model="newSeed.username"
                                   type="text" placeholder="联系人">
                            <input class="form-control"
                                   v-model="newSeed.phone"
                                   type="text" placeholder="手机">
                            <input class="form-control"
                                   v-model="newSeed.email"
                                   type="text" placeholder="邮箱">
                            <input class="form-control"
                                   v-model="newSeed.address"
                                   type="text" placeholder="地址">
                            <input class="form-control"
                                   v-model="newSeed.web_url"
                                   type="text" placeholder="网站">
                            <input class="form-control"
                                   v-model="newSeed.remark"
                                   type="text" placeholder="备注">
                            <span class="help-block" v-show="errors.has('phone')">{{errors.first('phone')}}</span>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">确定修改</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                        </div>
                    </form>
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
        data(){
            return {
                seeds:[],
                newSeed:[
                    {title:'',username:'',phone:'',email:'',address:'',web_url:'',remark:''}
                ]
            }
        },
        mounted() {
            axios.get('/api/v1/seeds/:id').then(response => {
                this.seeds = response.data.data
            })
        },
        computed: {
            phone: {
                get() {
                    return this.$store.state.AuthSeed.phone;
                },
                set(value) {
                    this.$store.commit({
                        type: types.UPDATE_SEED_PHONE,
                        value: value
                    })
                }
            },
        },
        methods: {
            updateSeed(index,seed){
                axios.post('/api/v1/seeds/'+ seed.id).then(response =>{
                    console.log(response.data)
                    this.seeds.splice(index,1)
                })
            }
        }
    }
</script>
