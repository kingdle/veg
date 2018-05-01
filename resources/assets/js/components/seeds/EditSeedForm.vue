<template>
    <div class="modal" id="SeedModalCenter" tabindex="-1" role="dialog" aria-labelledby="SeedModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="seedModalLongTitle">
                        <label for="name" class="control-label">新增电话</label>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="updateSeed">
                        <div class="form-group" :class="{'has-error' : errors.has('name') }">
                            <textarea
                                    v-model="phone"
                                    v-validate data-vv-rules="required" data-vv-as="介绍"
                                    rows="5"
                                    class="form-control" id="phone" name="phone" required></textarea>
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
        created() {
            this.$store.dispatch('setAuthSeed');
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
            updateSeed() {
                const formData = {
                    phone: this.phone,
                }
                this.$store.dispatch('updateSeedRequest', formData).then(response => {
                    this.$router.push({name: 'profile.Seed'})
                }).catch(error => {

                })
            }
        }
    }
</script>
