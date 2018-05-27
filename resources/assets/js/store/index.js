import Vue from 'vue'
import Vuex from 'vuex'

import AuthUser from './modules/auth-user'
import AuthShop from './modules/auth-shop'
import AuthSeed from './modules/auth-seed'
import Login from './modules/login'
import EditProfile from './modules/edit-profile'
import EditPassword from './modules/edit-password'
import EditShop from './modules/edit-shop'
import Notification from './modules/notification'

import AddNews from './modules/add-news'
import addDynamicRequest from './modules/add-dynamic'
import sendMessageRequest from './modules/send-message'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        AuthUser,
        AuthShop,
        AuthSeed,
        Login,
        EditProfile,
        EditPassword,
        EditShop,
        Notification,
        AddNews,
        addDynamicRequest,
        sendMessageRequest
    },
    strict: true
})
