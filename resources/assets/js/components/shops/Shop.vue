<template>
    <div class="container-fluid list-group-item mg-content">
        <div class="panel text-center set-up-icon">
            <img class="rounded border-bottom" src="http://s3.mogucdn.com/mlcdn/bd3fc0/180316_83ih0fig3c94d2a9ilc0aae01abhe_144x144.png_100x100.png">
            <div class="mc-image-uploader">
                修改店铺头像
            </div>
        </div>
        <div class="panel panel-default">
            <ul class="list-group">
                <li class="b-b p-b-20 p-t-20">
                    <p class="set-up-item-label">
                        苗果昵称:
                    </p>
                    <p class="set-up-item-content font-weight-bold text-dark">{{ shop.title }}</p>
                    <button type="button" class="btn btn-success f-r" data-toggle="modal" data-target="#ProfileModalCenter">
                        修改
                    </button>
                </li>
                <li class="b-b p-b-20 p-t-20">
                    <p class="set-up-item-label">介绍:</p>
                    <p class="set-up-item-content font-weight-bold text-dark">{{ shop.summary }}</p>

                </li>
                <li class="b-b p-b-20 p-t-20">
                    <p class="set-up-item-label">认证主体</p>
                    <p class="set-up-item-content">{{ shop.property }} {{ shop.user_id }}</p>

                </li>
                <li class="b-b p-b-20 p-t-20">
                    <p class="set-up-item-label">照片数</p>
                    <p class="set-up-item-content">{{ shop.pic_count }}</p>
                </li>
                <li class="b-b p-b-20 p-t-20">
                    <p class="set-up-item-label">动态数</p>
                    <p class="set-up-item-content">{{ shop.dynamic_count }}</p>
                </li>
                <li class="b-b p-b-20 p-t-20">
                    <p class="set-up-item-label">地址</p>
                    <p class="set-up-item-content">{{ shop.address }}</p>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    export default {
        name: 'top-menu',
        created() {
            this.$store.dispatch('setAuthUser');
        },
        computed: {
            ...mapState({
                user: state => state.AuthUser
            })
        },
        mounted() {
            axios.get('/api/v1/shops/' + this.$route.params.id).then(response=>{
                this.shop = response.data
            })
        },
        data(){
            return{
                shop:{}
            }
        }
    }

</script>
<style>
    .mg-content{
        min-height:700px;
        background: #fff;
        padding: 40px;

    }
    .mc-image-uploader {
        height: 30px;
        color: #f06307;
        border: none;
        margin: 10px auto;
    }
    .set-up-icon img {

        background-color: #f4f3f4;
    }
    .list-group li{
        list-style-type:none;
    }
    .list-group li p{
        margin:0px 1rem;
        padding: 0px;
    }
    .list-group li a {
        z-index: 2;
        color: #f06307;
    }
    .b-b{
        border-bottom: 1px solid #dedede;
    }
    .p-b-20{
        padding-bottom:20px;
    }
    .p-t-20{
        padding-top:20px;
    }
    .f-r{
        float: right;
    }
    .set-up-item-label{
        min-width: 60px;
        text-align: right;
        font-size: 14px;
        line-height: 30px;
        float: left;
    }
    .set-up-item-content {
        margin-left: 30px;
        font-size: 18px;
        line-height: 28px;
        float: left;
    }
</style>
