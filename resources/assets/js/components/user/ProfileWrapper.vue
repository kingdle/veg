<template>
    <div class="container-fluid">
        <div class="row mg-main">
            <nav class="col-lg-1 col-md-1 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <router-link :to="{name: 'home'}" class="nav-link" exact>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                    概况
                                </router-link>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <router-link :to="{name: 'news'}" class="nav-link" activeClass="active" exact>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-file">
                                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="13 2 13 9 20 9"></polyline>
                                    </svg>
                                    动态
                                </router-link>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <router-link :to="{name: 'news'}" class="nav-link" activeClass="active" exact>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-shopping-cart">
                                        <circle cx="9" cy="21" r="1"></circle>
                                        <circle cx="20" cy="21" r="1"></circle>
                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                    </svg>
                                    订单
                                </router-link>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">

                                <router-link :to="{name: 'profile'}" class="nav-link" activeClass="active" exact>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-users">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    个人资料
                                </router-link>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <router-link :to="{name: 'profile.editProfile'}" class="nav-link" activeClass="active"
                                             exact>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-file-text">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                    修改资料
                                </router-link>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <router-link :to="{name: 'profile.editPassword'}" class="nav-link" activeClass="active"
                                             exact>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-file-text">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                    修改密码
                                </router-link>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main role="main" class="col-lg-11 col-md-10 ml-sm-auto pt-3 px-4">
                <!--<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">-->
                    <!--<h1 class="h2">概况</h1>-->
                <!--</div>-->
                <notification></notification>
                <div class="justify-content-between">
                    <router-view></router-view>
                </div>
            </main>
        </div>
        <div class="modal" id="ProfileModalCenter" tabindex="-1" role="dialog" aria-labelledby="ProfileModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">更新用户信息</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateProfile">
                            <div class="form-group" :class="{'has-error' : errors.has('name') }">
                                <label for="name" class="control-label">用户名</label>
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
    </div>
</template>

<script>
    import jwtToken from './../../helpers/jwt'
    import { ErrorBag } from 'vee-validate';
    import Notification from './../common/Notification'
    import * as types from './../../store/mutation-type'
    export default{
        name: 'profile-wrapper',
        created() {
            this.$store.dispatch('setAuthUser');
        },
        computed:{
            name: {
                get() {
                    return this.$store.state.AuthUser.name;
                },
                set(value) {
                    this.$store.commit({
                        type: types.UPDATE_PROFILE_NAME,
                        value: value
                    })
                }
            },
            email: {
                get() {
                    return this.$store.state.AuthUser.email;
                },
                set(value) {
                    this.$store.commit({
                        type: types.UPDATE_PROFILE_EMAIL,
                        value: value
                    })
                }
            }
        },
        methods:{
            updateProfile() {
                const formData = {
                    name: this.name
                }
                this.$store.dispatch('updateProfileRequest',formData).then(response => {
                    this.$router.push({name:'profile'})
                }).catch(error => {
                })
            }
        },
        components:{
            Notification
        }
    }
</script>
<style>
    .list-group-item.active {
        z-index: 2;
        color: #fff;
        background-color: #f06307;
        border-color: #f06307;
    }

    .list-group-item.active:hover {
        color: #fff;
        background-color: #f05d0d;
        border-color: #f05d0d;
    }

    .navbar {
        padding: 0.5rem 1.25rem;
        margin-bottom: 1rem;
        background-color: rgba(255, 255, 255, 0.8);
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }

    .bg-light {
        background-color: #3e495a !important;
    }

    .sidebar {
        background-color: #3e495a !important;
        padding-top: 10px;

        font-size: 16px;
        min-width: 130px;
        height: 100%;
        min-height: 100%;
        position: absolute;
    }

    .sidebar .nav-link.active {
        color: #f05d0d;
        background-color: #fff;
    }
    .mg-main{
        margin-top: -1rem;
    }

    .mg-main .col-md-1 {
        padding: 15px 0px;
    }
    .sidebar .nav-link {
        font-weight: 500;
        color: #fff;
        line-height: 60px;
    }

    .nav-link {
        display: block;
        padding: 0rem 0rem;
    }

    .sidebar .nav-link .feather {
        margin: 0px 4px 0px 15px;
    }

    svg:not(:root) {
        overflow: hidden;
    }

    .feather {
        width: 20px;
        height: 20px;
        vertical-align: text-bottom;
    }

</style>
