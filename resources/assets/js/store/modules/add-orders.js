export default {
    actions: {
        addOrdersRequest({dispatch}, formData) {
            var myDate = new Date();
            return axios.post('/api/v1/orders', formData).then(response => {
                console.log(response.data)
                $('#AddOrdersModalCenter').modal('hide')
                dispatch('showNotification', {level: 'success', msg: '订单创建成功'+'-'+response.data.name+'-'+myDate.toLocaleTimeString()})
            }).catch(errors => {
                $('#AddOrdersModalCenter').modal('hide')
                dispatch('showNotification', {level: 'error', msg: '订单创建失败'+myDate.toLocaleTimeString()})
            })
        },
    }
}
