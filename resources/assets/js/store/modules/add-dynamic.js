export default {
    actions: {
        addDynamicRequest({dispatch}, formData) {
            return axios.post('api/v1/news/addnews', formData).then(response => {
                console.log(response.data)
                dispatch('showNotification', {level: 'success', msg: '动态发布成功'})
            }).catch(errors => {
                dispatch('showNotification', {level: 'error', msg: '动态发布失败'})
            })
        },
    }
}
