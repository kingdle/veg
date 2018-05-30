export default {
    actions: {
        addOrdersRequest({dispatch}, formData) {
            return axios.post('/api/v1/orders', formData).then(response => {
                console.log(response.data)
                $('#AddOrdersModalCenter').modal('hide')
                dispatch('showNotification', {level: 'success', msg:  response.data.name})
            }).catch(errors => {
                $('#AddOrdersModalCenter').modal('hide')
                dispatch('showNotification', {level: 'error', msg: response.data.name})
            })
        },
    }
}
