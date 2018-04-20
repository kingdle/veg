<template>
    <div class="card-columns">
        <div v-for="dynamic in dynamics" :key="dynamic.id" class="card card-img">
            <div class="mg-news-img">
                <!--<img v-for="(image,pics)" :src="dynamic.image" alt="">-->
                <img src="http://s3.mogucdn.com/mlcdn/bd3fc0/180415_3g3eejlhkfd842g627fk5ef4d7gfh_950x629.jpg_100x100.jpg"><img
                    src="http://s3.mogucdn.com/mlcdn/bd3fc0/180415_0agf38037ji8jk1j6l7akj7ii2bf5_2048x1360.jpg_100x100.jpg"><img
                    src="http://s3.mogucdn.com/mlcdn/bd3fc0/180415_4ad38l7a9j49i28k8l793l174gc3g_600x450.jpg_100x100.jpg"><img
                    src="http://s3.mogucdn.com/mlcdn/bd3fc0/180415_72fg7d62k3b1275fa6k1j1219dgj5_1024x650.jpg_100x100.jpg">
            </div>
            <div class="p-2">
                <p class="card-text mt-2 mb-0">
                    <router-link :to="{ name: 'dynamics', params: { id: dynamic.id }}">{{ dynamic.content }}</router-link>
                </p>
                <p class="card-text">
                    <small class="text-muted">
                        <svg id="i-clock" viewBox="0 0 32 32" width="10" height="10" fill="none"
                             stroke="currentcolor" stroke-linecap="round"
                             stroke-linejoin="round"
                             stroke-width="2">
                            <circle cx="16" cy="16" r="14"/>
                            <path d="M16 8 L16 16 20 20"/>
                        </svg>
                        {{ dynamic.published_at }}
                    </small>
                </p>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        mounted() {
            axios.get('/api/v1/dynamics/1').then(response => {
                console.log(response.data)
                this.dynamics = response.data.data
            })
        },
        data() {
            return{
                dynamics:[]
            }
        }
    }
</script>
<style>
    .mg-news-img {
        background: #f5f8fa;
    }

    .mg-news-img img {
        width: 72px;
        margin: 0 1px 1px 0;
    }

    .mg-news .card-img {
        border-top-left-radius: 0.5rem !important;
    }

    .mg-news-img img:first-child {
        border-top-left-radius: 0.5rem !important;
    }

    .mg-news-img img:last-child {
        border-bottom-right-radius: 0.5rem !important;
    }
</style>
