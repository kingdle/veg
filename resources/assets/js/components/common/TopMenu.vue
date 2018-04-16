<template>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid px-0">
            <div class="navbar-header">
                <router-link to="/" class="navbar-brand" exact>
                    <img src="/images-pc/logo-pc.png" alt="苗果" width="110" height="42">
                </router-link>
                <div v-if="user.authenticated" class="d-block d-sm-none d-none d-sm-block d-md-none float-right pt-2">
                    <button class="navbar-toggler btn btn-outline-secondary btn-sm pt-2 px-0" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                        <svg id="i-menu" viewBox="0 0 32 32" width="20" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1">
                            <path d="M4 8 L28 8 M4 16 L28 16 M4 24 L28 24" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="" id="app-navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <router-link v-if="!user.authenticated" to="/login" tag="li">
                        <a>登录</a>
                    </router-link>
                    <router-link v-if="!user.authenticated" to="/register" tag="li">
                        <a>注册</a>
                    </router-link>
                    <router-link v-if="user.authenticated" :to="{name: 'profile.Home'}" tag="li">
                        <div class="btn-group">
                            <!--<img class="rounded border-bottom user-top-avatar" :src=user.avatar>-->
                            <button type="button" class="btn btn-success btn-sm user-top-phone" data-placement="bottom" title="控制台">
                                <svg id="i-user" viewBox="0 0 32 32" width="16" height="16" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M22 11 C22 16 19 20 16 20 13 20 10 16 10 11 10 6 12 3 16 3 20 3 22 6 22 11 Z M4 30 L28 30 C28 21 22 20 16 20 10 20 4 21 4 30 Z" />
                                </svg>
                                <span>{{ user.phone }}</span>
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
