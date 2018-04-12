<template>
    <div class="modal" id="ProfileModalCenter" tabindex="-1" role="dialog" aria-labelledby="ProfileModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        <label for="name" class="control-label">苗果昵称(店铺名)</label>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="updateProfile">
                        <div class="form-group" :class="{'has-error' : errors.has('name') }">
                            <input v-model="name"
                                   v-validate data-vv-rules="required" data-vv-as="邮箱"
                                   id="name" type="text" class="form-control" name="name" required>
                            <span class="help-block" v-show="errors.has('name')">{{errors.first('name')}}</span>
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
    import { ErrorBag } from 'vee-validate';
    import * as types from './../../store/mutation-type'
    export default {
        created() {
            this.$store.dispatch('setAuthUser');
        },
        computed:{
            summary: {
                get() {
                    return this.$store.state.AuthUser.name;
                },
                set(value) {
                    this.$store.commit({
                        type: types.UPDATE_SHOP_SUMMARY,
                        value: value
                    })
                }
            },
            avatar: {
                get() {
                    return this.$store.state.AuthUser.avatar;
                },
                set(value) {
                    this.$store.commit({
                        type: types.UPDATE_SHOP_AVATAR,
                        value: value
                    })
                }
            }
        },
        methods:{
            updateShop() {
                const formData = {
                    summary: this.summary,
                    avatar: this.avatar
                }
                this.$store.dispatch('updateShopRequest',formData).then(response => {
                    this.$router.push({name:'shop'})
                }).catch(error=>{

                })
            }
        }
    }
</script>
