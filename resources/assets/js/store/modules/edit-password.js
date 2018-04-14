export default {
    actions: {
        updatePasswordRequest({dispatch}, formData) {
            return axios.post('/api/user/password/update', formData).then(response => {
                $('#PasswordModalCenter').modal('hide')
                dispatch('showNotification', {level: 'success', msg: '更新密码成功'})
            }).catch(errors => {
                $('#PasswordModalCenter').modal('hide')
                dispatch('showNotification', {level: 'error', msg: '更新密码失败'})
            })
        },
    }
}
