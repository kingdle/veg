<template>
    <div class="container-fluid">
        <div class="row mg-main">
            <div class="collapse navbar-collapse sidebar-mobile" id="navbarTogglerDemo03">
                <sidebar></sidebar>
            </div>
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
        <edit-password-form></edit-password-form>
        <add-news-form></add-news-form>
    </div>
</template>

<script>
    import Sidebar from './../sidebar/Sidebar.vue'
    import EditProfileForm from './EditProfileForm.vue'
    import EditShopForm from './../shops/EditShopForm.vue'
    import EditPasswordForm from './../password/EditPasswordForm.vue'
    import AddNewsForm from './../news/AddNews.vue'
    export default{
        name: 'profile-wrapper',
        components: {
            Sidebar,
            EditProfileForm,
            EditShopForm,
            EditPasswordForm,
            AddNewsForm
        }
    }
</script>
<style>
.sidebar-mobile{
    background:#fff;
    padding:10px 0 10px 20px;
}
.sidebar-mobile .flex-column{
    display:flex;
    flex-direction: row !important;
}
.sidebar-mobile li{
    padding:5px;
}
.sidebar-mobile .router-link-exact-active{
    color: #f05d0d;
}
</style>
