import jwtToken from './../../helpers/jwt'

export default {
    actions: {
        loginRequest({dispatch}, formData) {
            axios.defaults.headers['Content-Type'] = 'application/x-www-form-urlencoded;charset=UTF-8';  //此处是增加的代码，设置请求头的类型

            return axios.post('/api/login', formData).then(response => {
                dispatch('loginSuccess', response.data)
            })
        },
        loginSuccess({dispatch}, tokenResponse) {
            jwtToken.setToken(tokenResponse.token)
            jwtToken.setAuthId(tokenResponse.auth_id)
            dispatch('setAuthUser')
        },
        logoutRequest({dispatch}) {
            return axios.post('/api/logout')
                .then(response => {
                    jwtToken.removeToken();
                    dispatch('unsetAuthUser');
                });
        }
    }
}
