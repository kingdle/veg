<template>
    <div class="modal" id="AddNewsModalCenter" tabindex="-1" role="dialog" aria-labelledby="ShopModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddNewsModalLongTitle">
                        <label for="dynamic" class="control-label">发动态</label>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="AddNews">
                        <div class="form-group" :class="{'has-error' : errors.has('dynamic') }">
                            <textarea
                                    v-model="dynamic"
                                    v-validate data-vv-rules="required" data-vv-as="动态文字"
                                    placeholder="请输入内容（最多输入2000个）"
                                    rows="5"
                                    class="form-control" id="dynamic" name="dynamic" required></textarea>
                            <span class="help-block" v-show="errors.has('dynamic')">{{errors.first('dynamic')}}</span>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">确定</button>
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
        created() {
            this.$store.dispatch('setAuthShop');
        },
        computed: {
            dynamic: {
                get() {
                    return this.$store.state.AuthShop.dynamic;
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
            updateShop() {
                const formData = {
                    dynamic: this.dynamic,
                }
                this.$store.dispatch('addNewsRequest', formData).then(response => {
                    this.$router.push({name: 'profile.Shop'})
                }).catch(error => {

                })
            }
        }
    }
</script>
