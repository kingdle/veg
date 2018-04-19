<template>
    <div class="news-add">
        <div class="modal bd-example-modal-lg" id="AddNewsModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="ShopModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
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
                        <form @submit.prevent="updateNews">
                            <div class="form-group" :class="{'has-error' : errors.has('dynamic') }">
                                <label for="dynamic" class="col-form-label">文字:
                                    <span class="help-block mr-2"
                                          v-show="errors.has('dynamic')">{{errors.first('dynamic')}}</span>
                                </label>
                                <textarea
                                        v-model="dynamic"
                                        v-validate data-vv-rules="required" data-vv-as="动态文字"
                                        placeholder="请输入内容（最多输入1800个）"
                                        rows="3"
                                        :class="{'input': true, 'is-invalid': errors.has('dynamic') }"
                                        class="form-control" id="dynamic" name="dynamic" required></textarea>

                            </div>
                            <div class="form-group news-img">
                                <label for="dynamic" class="col-form-label">图片:
                                    <a class="text-info" v-if="images.length >0" @click="removeImage">移除全部图片</a>
                                    <!--<button class="btn btn-outline-success btn-sm" v-if="images.length >0" @click='uploadImage'>上传</button>-->
                                </label>
                                <ul>
                                        <li v-if="images.length >0" v-for="(key,image) in images">
                                            <img class="border" :src="key"/>
                                            <a href="#" class="text-danger close" aria-label="Close"
                                               style="position: absolute;" @click='delImage(image)'>
                                                <span class="btn-close">&times;</span>
                                            </a>
                                        </li>
                                    <li class="addPic" @click="addPic">
                                        <img class="" src="/images-pc/upload.png"/>
                                    </li>
                                    <input type="file" @change="onFileChange" multiple style="display: none;">

                                </ul>
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
    </div>

</template>
<script>
    import jwtToken from './../../helpers/jwt'
    import {ErrorBag} from 'vee-validate';
    import * as types from './../../store/mutation-type'
    export default {
        data() {
            return {
                dynamic: '',
                images: []
            }
        },
        methods: {
            addPic(e){
                e.preventDefault();
                $('input[type=file]').trigger('click');
                return false;
            },
            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)return;
                this.createImage(files);
            },
            createImage(file) {
                if (typeof FileReader === 'undefined') {
                    return false;
                }
                var image = new Image();
                var vm = this;
                var leng = file.length;
                for (var i = 0; i < leng; i++) {
                    var reader = new FileReader();
                    reader.readAsDataURL(file[i]);
                    reader.onload = function (e) {
                        vm.images.push(e.target.result);
                    };
                }
            },
            delImage: function (index) {
                this.images.splice(index, 1);
            },
            removeImage: function (e) {
                this.images = [];
            },
            updateNews() {
                const formData = {
                    dynamic: this.dynamic,
                    images:this.images
                }
                this.$store.dispatch('addNewsRequest', formData).then(response => {
                    this.$router.push({name: 'profile.News'})
                }).catch(error => {

                })
            }
        }
    }
</script>
<style>
    .news-add .modal-body ul {
        list-style: none outside none;
        margin: 0;
        padding: 0;
    }

    .news-add .modal-body li {
        margin: 0 10px;
        display: inline;
    }

    .news-add .modal-body img {
        width: 72px;
        height: 72px;
        margin: auto;
        display: inline;
        margin-bottom: 10px;
    }

    .news-add .modal-body .btn-close {
        position: absolute;
        z-index: 999;
        top: -4px;
        right: -4px;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: #D50000 !important;
        color: #fff;
        font-size: 12px;
        text-align: center;
        cursor: pointer;
    }

    .news-add .modal-body li {
        margin: 0 5px 0 0;
        display: inline;
    }

    .news-add .modal-body li img {
        border-radius: 5px;
    }
    .news-add .modal-body .addPic img{
        align-content: center;
        width: 72px;
        height: 72px;
    }
</style>
