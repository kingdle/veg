import VueRouter from 'vue-router'
import Store from './store/index'
import jwtToken from './helpers/jwt'

let routes = [
    {
        path: '/',
        name: 'home',
        component: require('./components/pages/Home'),
        meta: {}
    },
    {
        path: '/about',
        component: require('./components/pages/About'),
        meta: {}
    },
    {
        path: '/shops/:id',
        name: 'shops',
        component: require('./components/shops/Shop'),
        meta: {requiresAuth: true}
    },
    {
        path: '/register',
        name: 'register',
        component: require('./components/register/Register'),
        meta: {requiresGuest: true}
    },
    {
        path: '/login',
        name: 'login',
        component: require('./components/login/Login'),
        meta: {requiresGuest: true}
    },
    {
        path: '/confirm',
        name: 'confirm',
        component: require('./components/confirm/Email'),
        meta: {}
    },
    {
        path: '/profile',
        component: require('./components/user/ProfileWrapper'),
        children: [
            {
                path: '',
                name: 'profile',
                component: require('./components/user/Profile'),
                meta: {requiresAuth: true}
            },
            {
                path: '/edit-profile',
                name: 'profile.editProfile',
                component: require('./components/user/EditProfile'),
                meta: {requiresAuth: true}
            },
            {
                path: '/edit-password',
                name: 'profile.editPassword',
                component: require('./components/password/EditPassword'),
                meta: {requiresAuth: true}
            },
            {
                path: '/shop',
                name: 'profile.Shop',
                component: require('./components/shops/Shop'),
                meta: {requiresAuth: true}
            },
            {
                path: '/edit-shop',
                name: 'profile.editShop',
                component: require('./components/shops/EditShop'),
                meta: {requiresAuth: true}
            },
            {
                path: '/orders',
                name: 'profile.Orders',
                component: require('./components/orders/Orders'),
                meta: {requiresAuth: true}
            },
            {
                path: '/news',
                name: 'profile.News',
                component: require('./components/news/News'),
                meta: {requiresAuth: true}
            },
            {
                path: '/addnews',
                name: 'AddNews',
                component: require('./components/news/AddNews'),
                meta: {requiresAuth: true}
            },
            {
                path: '/dynamic',
                name: 'Dynamic',
                component: require('./components/news/Index'),
                meta: {requiresAuth: true}
            },
            {
                path: '/home',
                name: 'profile.Home',
                component: require('./components/home/Home'),
                meta: {requiresAuth: true}
            }
        ],
        meta: {requiresAuth: true}
    }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth) {
    if (Store.state.AuthUser.authenticated || jwtToken.getToken()) {
        return next()
    } else {
        return next({'name': 'login'})
    }
}
if (to.meta.requiresGuest) {
    if (Store.state.AuthUser.authenticated || jwtToken.getToken()) {
        return next({'name': 'home'})
    } else {
        return next()
    }
}
next()
})

export default router
