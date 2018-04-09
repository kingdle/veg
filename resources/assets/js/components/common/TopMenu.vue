<template>
    <nav class="navbar navbar-default navbar-static-top sticky-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <router-link to="/" class="navbar-brand" exact>
                    <img src="/images-pc/logo-pc.png" alt="苗果" width="110" height="42">
                </router-link>
            </div>
            <div class="" id="app-navbar-collapse">
                <ul class="nav navbar-nav"></ul>
                <ul class="nav navbar-nav navbar-right">
                    <router-link v-if="!user.authenticated" to="/login" tag="li">
                        <a>登录</a>
                    </router-link>
                    <router-link v-if="!user.authenticated" to="/register" tag="li">
                        <a>注册</a>
                    </router-link>
                    <router-link v-if="user.authenticated" to="/profile" tag="li">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm" data-placement="bottom" title="控制台">{{
                                user.email }}
                            </button>
                            <button @click.prevent="logout" type="button"
                                    class="btn btn-info btn-sm" data-placement="bottom" title="退出">
                                <svg id="i-signout" viewBox="0 0 32 32" width="16" height="16" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M28 16 L8 16 M20 8 L28 16 20 24 M11 28 L3 28 3 4 11 4" />
                                </svg>
                            </button>
                        </div>
                    </router-link>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import {mapState} from 'vuex'
    export default {
        name: 'top-menu',
        computed: {
            ...mapState({
                    user: state => state.AuthUser
                }
            )
        },
        methods: {
            logout()
            {
                this.$store.dispatch('logoutRequest').then(response => {
                    this.$router.push({name: 'home'})
                })
            }
        }
    }
</script>
