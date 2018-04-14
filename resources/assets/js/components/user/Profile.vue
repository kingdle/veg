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
