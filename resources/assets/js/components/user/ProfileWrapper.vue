<template>
    <div class="container-fluid">
        <div class="row mg-main">
            <nav class="col-lg-1 col-md-1 d-none d-md-block bg-light sidebar">
                <sidebar></sidebar>
            </nav>
            <main role="main" class="col-lg-11 col-md-10 ml-sm-auto pt-3 px-4">
                <div class="justify-content-between">
                    <router-view></router-view>
                </div>
            </main>
        </div>
        <edit-profile-form></edit-profile-form>
        <edit-shop-form></edit-shop-form>
    </div>
</template>

<script>
    import Sidebar from './../sidebar/Sidebar.vue'
    import EditProfileForm from './EditProfileForm.vue'
    import EditShopForm from './../shops/EditShopForm.vue'
    export default{
        name: 'profile-wrapper',
        components: {
            Sidebar,
            EditProfileForm,
            EditShopForm
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

    .mg-main {
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
