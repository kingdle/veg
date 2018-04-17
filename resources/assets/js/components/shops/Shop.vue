<template>
    <div class="mg-shop">
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-row mb-3">
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="panel text-center set-up-icon">
                                    <vue-core-image-upload
                                            class="btn"
                                            :crop="false"
                                            @imageuploaded="imageuploaded"
                                            :data="data"
                                            :headers="headers"
                                            :max-file-size="5242880"
                                            inputOfFile="img"
                                            cropRatio="1:1"
                                            url="/api/v1/shop/avatar" >
                                        <img class="rounded border-bottom user-avatar" :src="shop.avatar">
                                    </vue-core-image-upload>
                                    <!--<my-upload field="img"-->
                                               <!--@crop-success="cropSuccess"-->
                                               <!--@crop-upload-success="cropUploadSuccess"-->
                                               <!--@crop-upload-fail="cropUploadFail"-->
                                               <!--v-model="show"-->
                                               <!--:width="220"-->
                                               <!--:height="220"-->
                                               <!--url="/api/v1/shop/avatar"-->
                                               <!--:params="params"-->
                                               <!--:headers="headers"-->
                                               <!--img-format="png"></my-upload>-->
                                    <!--<a class="btn" @click="toggleShow">-->
                                        <!--<img class="rounded border-bottom user-avatar" :src="shop.avatar">-->
                                        <!--<p class="mc-image-uploader">-->
                                            <!--店铺头像-->
                                        <!--</p>-->
                                    <!--</a>-->

                                </div>
                                <div class="panel panel-default">
                                    <ul class="list-group">
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">
                                                苗果昵称:
                                            </p>
                                            <p class="set-up-item-content font-weight-bold text-dark">{{ shop.title }}</p>

                                        </li>
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">介绍:</p>
                                            <p class="set-up-item-content font-weight-bold text-dark">{{ shop.summary }}</p>
                                            <button type="button" class="btn btn-success f-r" data-toggle="modal"
                                                    data-target="#ShopModalCenter">
                                                修改
                                            </button>
                                        </li>
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">性质</p>
                                            <p class="set-up-item-content">{{ shop.property }}</p>

                                        </li>
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">照片数</p>
                                            <p class="set-up-item-content">{{ shop.pic_count }}</p>
                                        </li>
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">动态数</p>
                                            <p class="set-up-item-content">{{ shop.dynamic_count }}</p>
                                        </li>
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">地址：</p>
                                            <p class="set-up-item-content">{{ shop.address }}</p>
                                        </li>
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">您的苗果小程序码</p>
                                            <p class="set-up-item-content">
                                                <img class="m-3 mx-5" src="/images-pc/mg-code-mp.jpg" alt="苗果"
                                                     width="120"
                                                     height="120">
                                            </p>
                                        </li>
                                    </ul>
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
    import VueCoreImageUpload  from 'vue-core-image-upload';
//    import 'babel-polyfill'; // es6 shim
//    import myUpload from 'vue-image-crop-upload';
    export default {
        data() {
            return {
                data: {

                },
                headers: {
                    Authorization: 'Bearer ' + window.localStorage.getItem('jwt_token')
                }
            }
        },
        created(){
            this.$store.dispatch('setAuthShop')
        },
        computed: {
            ...mapState({
                shop: state => state.AuthShop
            })
        },
        components: {
            'vue-core-image-upload': VueCoreImageUpload,
        },
        methods: {
            imageuploaded(res) {
                if (res.errcode == 0) {
                    this.shop.avatar = res.data.src;
                }
            }
        }

    }

</script>
<style>
    .vue-image-crop-upload .vicp-wrap {
        -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.23);
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.23);
        position: fixed;
        display: block;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        z-index: 10000;
        margin: auto;
         width: 80% !important;
         height: 50% !important;
        padding: 25px;
         background-color:rgba(0, 0, 0, 0.23);
        border-radius: 2px;
        -webkit-animation: vicp 0.12s ease-in;
        animation: vicp 0.12s ease-in;
    }
</style>
