<template>
    <div>
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-md-row mb-3">
                    <div class="card-body mt-2">
                        <div class="input-group">
                            <textarea class="form-control bd-callout lead"
                                      rows="3"
                                      placeholder="欢迎使用苗果小程序，只要您有创新的想法，我们就能在平台上实现，请发送给我们的大梦想家。"
                                      aria-label="With textarea"></textarea>
                            <div class="input-group-append">
                                <button class="btn btn-success" type="button">想法</button>
                            </div>
                        </div>
                    </div>
                    <img class="m-3 mx-5 flex-auto d-none d-md-block" src="/images-pc/mg-code-mp.jpg" alt="苗果"
                         width="110"
                         height="110">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-md-row mb-3">
                    <div class="card-body mt-2">
                        <div class="">
                            <div class="bg-white h-150 p-20 min-w-1000 m-t-15 m-b-20 b-radius box-shadow">
                                <div class="text-555">
                                    <span class="text-success text-bold m-r-5">|</span>
                                    <span class="vertical-middle">运营概况</span>
                                </div>
                                <div class="m-t-5">
                                    <div class="float-left w-per-33 h-80  flex-center">
                                        <div class="w-per-50 fl text-center">
                                            <p class="text-muted text-sm"> 动态数</p>
                                            <p class="text-30 text-bold text-555"> 4</p>
                                        </div>
                                        <div class="w-per-50 fl text-center">
                                            <p class="text-muted text-sm"> 订单数</p>
                                            <p class="text-30 text-bold text-555"> 2</p>
                                        </div>
                                    </div>
                                    <div class="verticalLine"></div>
                                    <div class="float-left w-per-33 h-80 flex-center">
                                        <div class="fl text-center m-auto">
                                            <a class="btn btn-success w-114 h-l-36 m-r-10" href="/dynamic/publish"
                                               target="_blank"> 发表动态</a>
                                            <a class="btn btn-success w-114 h-l-36" href="/photo"
                                               target="_blank"> 上传图片</a>
                                        </div>
                                    </div>
                                    <div class="verticalLine"></div>
                                    <div class="float-left w-per-33 h-150 m-t--30">
                                        <p class="text-sm text-muted m-t-5 text-center"> 您的小程序码</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-md-row mb-3">
                    <div class="card-body mt-2">
                        <div class="mg-business">
                            <div class="mb-3">
                                <span class="text-success text-bold m-r-5">|</span>
                                <span class="vertical-middle">您周边的育苗场</span>
                            </div>
                            <div class="col-12">
                                <figure class="figure mr-2 text-center">
                                    <div class="contributor-pics">
                                        <a href="">
                                            <img :src=user.avatar width="64">
                                        </a>
                                    </div>
                                    <figcaption class="figure-caption">水南苗场</figcaption>
                                </figure>
                                <figure class="figure mr-2 text-center">
                                    <div class="contributor-pics">
                                        <a href="">
                                            <img src="https://avatars2.githubusercontent.com/u/2378022?v=4" width="64px">
                                        </a>
                                    </div>
                                    <figcaption class="figure-caption">何家苗场</figcaption>
                                </figure>
                                <figure class="figure mr-2 text-center">
                                    <div class="contributor-pics">
                                        <a href="">
                                            <img src="https://avatars0.githubusercontent.com/u/1499009?v=4" width="64px">
                                        </a>
                                    </div>
                                    <figcaption class="figure-caption">董家稻庄苗场</figcaption>
                                </figure>
                                <figure class="figure mr-2 text-center">
                                    <div class="contributor-pics">
                                        <a href="">
                                            <img src="https://avatars3.githubusercontent.com/u/270923?v=4" width="64px">
                                        </a>
                                    </div>
                                    <figcaption class="figure-caption">水南苗场</figcaption>
                                </figure>
                                <figure class="figure mr-2 text-center">
                                    <div class="contributor-pics">
                                        <a href="">
                                            <img src="https://avatars2.githubusercontent.com/u/8569015?v=4" width="64px">
                                        </a>
                                    </div>
                                    <figcaption class="figure-caption">水南苗场</figcaption>
                                </figure>
                                <figure class="figure mr-2 text-center">
                                    <div class="contributor-pics">
                                        <a href="">
                                            <img src="https://avatars1.githubusercontent.com/u/1858004?v=4" width="64px">
                                        </a>
                                    </div>
                                    <figcaption class="figure-caption">北慈苗场</figcaption>
                                </figure>
                                <figure class="figure mr-2 text-center">
                                    <div class="contributor-pics">
                                        <a href="">
                                            <img src="https://avatars2.githubusercontent.com/u/5693018?v=4" width="64px">
                                        </a>
                                    </div>
                                    <figcaption class="figure-caption">北河崖苗场</figcaption>
                                </figure>
                                <figure class="figure mr-2 text-center">
                                    <div class="contributor-pics">
                                        <a href="">
                                            <img src="https://avatars0.githubusercontent.com/u/15792249?v=4" width="64px">
                                        </a>
                                    </div>
                                    <figcaption class="figure-caption">水南苗场</figcaption>
                                </figure>
                                <figure class="figure mr-2 text-center">
                                    <div class="contributor-pics">
                                        <a href="">
                                            <img src="https://avatars2.githubusercontent.com/u/25668?v=4" width="64px">
                                        </a>
                                    </div>
                                    <figcaption class="figure-caption">大伦苗场</figcaption>
                                </figure>
                                <figure class="figure mr-2 text-center">
                                    <div class="contributor-pics">
                                        <a href="">
                                            <img src="https://avatars1.githubusercontent.com/u/523906?v=4" width="64px">
                                        </a>
                                    </div>
                                    <figcaption class="figure-caption">南慈苗场</figcaption>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-md-row mb-3">
                    <div class="card-body mt-2">
                        <div class="mg-hello p-2">
                            <h2>老乡，您好!</h2>
                            <p class="lead">
                                欢迎使用专业的种苗交易平台，目前我们上线了微信小程序，请通过微信搜索"<a href="https://veg.kim" target="_blank"
                                                                      class="alert-success alert-link">苗果</a>"，或者扫码找到我们。
                            </p>
                            <hr class="my-2">
                            <p class="lead mg-message">
                                习主席说过：让居民望得见山、看得见水、记得住乡愁。
                            </p>
                            <p class="lead mg-message">
                                每个人都有一份乡愁！而我们终于有机会来到家乡，编织梦想。战略家马云说过两句话，一句是"梦想一定要有，万一实现了呢"，另一句是"只有农村富，中国才会富，只有乡村强，中国才会强，只有乡村振兴，中国才会振兴"。
                                我们有一个梦想，就是要
                                <mark class="alert-success alert-link font-weight-bold">
                                    用科技创新农业，用智慧振兴中国，用智能改变世界。
                                </mark>
                            <p class="lead mg-message">在这个平台上您会得到所需的一切服务，请多多帮助小<a href="https://veg.kim" target="_blank"
                                                                                  class="alert-success alert-link">
                                苗果
                            </a>，我们会在您的呵护下生根发芽、茁壮成长，谢谢。
                            </p>
                            </p>
                            <p class="lead mg-message">
                                ~~好了，就从苗开始，
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel text-center panel-default mb-5 px-0 mg-footer">
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
    .bd-callout {
        border: 0px solid #eee;
        border-left-color: #7bc276;
        border-left-width: .1rem;
        border-radius: .1rem;
    }

    .mg-hello h2 {
        font-weight: 200;
    }

    .mg-hello .lead {
        font-size: 1rem;
    }

    .mg-business .mg-img {
        width: 200px;
        height: 200px;
    }
    .contributor-pics img {
        border-radius: 50%;
    }
</style>
