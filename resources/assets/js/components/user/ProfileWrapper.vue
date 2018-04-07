<template>
    <div class="container-fluid">
        <div class="row">
            <nav class=" d-none d-md-block bg-light sidebar">
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
                                    营销
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

                    </ul>


                </div>

            </nav>
            <div class="side-nav-content-menu-sub" data-reactid=".1.0.1">
                <div class="active side-nav-content-menu-sub-item" data-reactid=".1.0.1.$0">
                    <router-link :to="{name: 'profile.editProfile'}" class="nav-link" activeClass="active"
                                 exact>
                        修改资料
                    </router-link>
                </div>
                <div class=" side-nav-content-menu-sub-item" data-reactid=".1.0.1.$1">
                    <router-link :to="{name: 'profile.editPassword'}" class="nav-link" activeClass="active"
                                 exact>
                        修改密码
                    </router-link>
                </div>
            </div>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div class="chartjs-size-monitor"
                     style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                    <div class="chartjs-size-monitor-expand"
                         style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink"
                         style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">概况</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <button class="btn btn-sm btn-outline-secondary">分享</button>
                            <button class="btn btn-sm btn-outline-secondary">返回</button>
                        </div>

                    </div>

                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <transition name="fade" mode="out-in">
                        <router-view></router-view>
                    </transition>
                </div>
            </main>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="list-group">
                </div>
            </div>
            <div class="col-md-10">

            </div>
        </div>
    </div>
</template>

<script>
    export default{
        name: 'profile-wrapper'
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

    .sidebar {
        background-color: #3e495a !important;
        padding-top: 10px;
        margin-top: -1rem;
        font-size: 16px;
        width: 130px;
        height: 100%;
        min-height: 100%;
        position: absolute;
    }

    .bg-light {
        background-color: #3e495a !important;
    }

    .sidebar .nav-link.active {
        color: #f05d0d;
        background-color: #fff;
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

    .side-nav-content-menu-sub {
        height: 100%;
        width: 140px;
        background: #fff;
        min-height: 100%;
        margin-top: -1rem;
        padding: 10px;
        position: absolute;
        left: 130px;
    }

    .side-nav-content-menu-sub .active {
        background-color: #f5f5f5;
    }

    .side-nav-content-menu-sub-item {
        height: 40px;
        width: 100%;
        line-height: 40px;
        list-style: none;
        display: inline-block;
        overflow: hidden;
        text-align: left;
        margin-top: 10px;
        padding-left: 10px;
        border-radius: 2px;
    }

    .side-nav-content-menu-sub-item a {
        color: #666;
        font-size: 14px;
        display: block;
    }
</style>
