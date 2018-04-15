<template>
    <div>
        <div class="jumbotron">
            <img class="float-right mr-5 pt-0 d-none d-md-block" src="/images-pc/mg-code-mp.jpg" alt="苗果" width="110" height="110">
            <h1 class="display-4">老乡，您好!</h1>
            <p class="lead">
                欢迎使用专业的菜苗交易平台，目前上线了微信小程序，请通过微信搜索"<a href="https://veg.kim" target="_blank" class="alert-success alert-link">苗果</a>"，或者扫码找到我们。
            </p>
            <hr class="my-4">
            <p class="lead mg-message">
                习主席说过：让居民望得见山、看得见水、记得住乡愁。
                <svg id="i-msg" viewBox="0 0 32 32" width="18" height="18" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <path d="M2 4 L30 4 30 22 16 22 8 29 8 22 2 22 Z" /></svg>
            </p>
            <p class="lead mg-message">
                每个人都有一份乡愁！而我们终于有机会来到家乡，编织梦想。科技圈的战略家马云说过："只有农村富，中国才会富，只有乡村强，中国才会强，只有乡村振兴，中国才会振兴"。我们有一个大梦想，就是要用<mark class="alert-success alert-link font-weight-bold">
                科技创新农业，用智慧振兴中国，用智能改变世界。
                </mark>
                在这个平台上您会得到所需的一切服务，请多多帮助小<a href="https://veg.kim" target="_blank" class="alert-success alert-link">
                苗果
            </a>，我们会在您的呵护下生根发芽、茁壮成长，谢谢。~~好了，就从苗开始，
                <svg id="i-compose" viewBox="0 0 32 32" width="18" height="18" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <circle cx="7" cy="16" r="2" />
                    <circle cx="16" cy="16" r="2" />
                    <circle cx="25" cy="16" r="2" />
                </svg>
            </p>
            <div class="input-group mt-5">
                <textarea class="form-control lead"
                          placeholder="只要您有创新的想法，我们就能在平台上实现，发送给我们的大梦想家。"
                          aria-label="With textarea"></textarea>
                <div class="input-group-append">
                    <button class="btn btn-success" type="button">想法</button>
                </div>
            </div>
        </div>
        <div class="panel text-center set-up-icon mg-home-content">
            <div class="mc-image-uploader">
                数据画像逐步开放，赋能每一位关心我们的用户。
            </div>
            <div class="mg-test-img">
                <figure class="figure">
                    <img :src=user.avatar class="img-thumbnail">
                    <figcaption class="figure-caption">西红柿订单趋势</figcaption>
                </figure>
            </div>
        </div>
        <div class="panel text-center panel-default mb-5 mg-footer">
            <hr class="my-4">
            <a href="https://veg.kim" target="_blank">苗果小程序 https://veg.kim</a>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    export default {
        created(){
            this.$store.dispatch('setAuthUser')
        },
        computed: {
            ...mapState({
                user: state => state.AuthUser
            })
        },
//        data(){
//            return {
//                shop: [],
//            }
//        },
//        created(){
//            this.fetchData()
//        },
//        watch: {
//            '$route': 'fetchData'
//        },
//        methods: {
//            fetchData(){
//                this.axios.get('/api/v1/shops/' + this.$route.params.id).then(response => {
//                    this.shop = response.data
//                })
//            }
//        }
    }

</script>
<style>
    #i-compose,#i-msg{
        color: #b0bdb8;
    }
    .jumbotron{
        background-color: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(0, 0, 0, 0.125);
    }
    .jumbotron .display-4{
        font-size: 3rem;
        font-weight: 300;
        line-height: 1.2;
    }
</style>
