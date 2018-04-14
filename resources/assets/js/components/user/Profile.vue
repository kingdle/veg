<template>
    <div class="container-fluid list-group-item mg-content">
        <div class="panel text-center set-up-icon">
            <img class="rounded border-bottom user-avatar" :src=user.avatar>
            <div class="mc-image-uploader">
                修改头像
            </div>
        </div>
        <div class="panel panel-default">
            <ul class="list-group">
                <li class="b-b p-b-20 p-t-20">
                    <p class="set-up-item-label">
                        姓名:
                    </p>
                    <p class="set-up-item-content font-weight-bold text-dark">{{ user.name }}</p>
                    <button type="button" class="btn btn-success f-r" data-toggle="modal" data-target="#ProfileModalCenter">
                        修改
                    </button>
                </li>
                <li class="b-b p-b-20 p-t-20">
                    <p class="set-up-item-label">邮箱:</p>
                    <p class="set-up-item-content font-weight-bold text-dark">{{ user.email }}</p>
                </li>
                <li class="b-b p-b-20 p-t-20">
                    <p class="set-up-item-label">
                        密码:
                    </p>
                    <p class="set-up-item-content font-weight-bold text-dark">密码就不显示了</p>
                    <button type="button" class="btn btn-success f-r" data-toggle="modal" data-target="#PasswordModalCenter">
                        修改
                    </button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    export default {
        computed: {
            ...mapState({
                user: state => state.AuthUser
            })
        },
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
        width: 110px;
        height: 110px;
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
