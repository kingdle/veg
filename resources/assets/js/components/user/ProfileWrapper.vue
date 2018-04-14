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
        <edit-password-form></edit-password-form>
    </div>
</template>

<script>
    import Sidebar from './../sidebar/Sidebar.vue'
    import EditProfileForm from './EditProfileForm.vue'
    import EditShopForm from './../shops/EditShopForm.vue'
    import EditPasswordForm from './../password/EditPasswordForm.vue'
    export default{
        name: 'profile-wrapper',
        components: {
            Sidebar,
            EditProfileForm,
            EditShopForm,
            EditPasswordForm
        }
    }
</script>
<style>


</style>
