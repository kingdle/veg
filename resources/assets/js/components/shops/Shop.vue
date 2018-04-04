<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h4>{{shop.title}}</h4>
                    </div>
                    <div class="card-body">
                        <p>{{shop.summary}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.get('/api/shops/' + this.$route.params.id).then(response=>{
                this.shop = response.data
        })
        },
        data(){
            return{
                shop:{}
            }
        }
    }
</script>
