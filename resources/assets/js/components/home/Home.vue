<template>
    <div >
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-row mb-3">
                    <div class="card-body mt-2">
                        <div class="title">
                            <span class="text-success text-bold m-r-5">|</span>
                            <span class="vertical-middle">运营概况</span>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-12 mg-home-top">
                                <div class="row text-center" style="white-space:nowrap;">
                                    <div class="col pt-2">
                                        <h5 class="card-title text-muted pt-2 mb-0" style="white-space:nowrap;">订单数</h5>
                                        <p class="card-text text-secondary" style="white-space:nowrap;">10</p>
                                    </div>
                                    <div class="col pt-2">
                                        <h5 class="card-title text-muted pt-2 mb-0" style="white-space:nowrap;">动态数</h5>
                                        <p class="card-text text-secondary" style="white-space:nowrap;">6</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-7">
                                <div class="text-center mt-3 px-2"
                                     style="border-right:1px solid #eaeaea;border-left:1px solid #eaeaea">
                                    <a href="#" class="btn btn-success " data-toggle="modal"
                                       data-target="#AddNewsModalCenter">发动态</a>
                                    <a href="#">
                                        <router-link :to="{name: 'profile.Orders'}" class="btn btn-success" activeClass="active" exact>
                                            查订单
                                        </router-link>
                                        </a>
                                    <p class="mt-3 text-muted">经常发动态就是最好的营销。</p>
                                </div>
                            </div>

                            <div class="col-sm-4 col-5">
                                <div class="p-0 text-center" style="">
                                    <img class="text-algin"
                                         src="/images-pc/mg-code-mp.jpg" alt="苗果"
                                         width="90"
                                         height="90">
                                    <p class="card-title text-muted">您的苗果小程序码</p>
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
                            <div class="col-12 text-center">
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
                                            <img src="https://avatars2.githubusercontent.com/u/2378022?v=4"
                                                 width="64px">
                                        </a>
                                    </div>
                                    <figcaption class="figure-caption">何家苗场</figcaption>
                                </figure>
                                <figure class="figure mr-2 text-center">
                                    <div class="contributor-pics">
                                        <a href="">
                                            <img src="https://avatars0.githubusercontent.com/u/1499009?v=4"
                                                 width="64px">
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
                                            <img src="https://avatars2.githubusercontent.com/u/8569015?v=4"
                                                 width="64px">
                                        </a>
                                    </div>
                                    <figcaption class="figure-caption">水南苗场</figcaption>
                                </figure>
                                <figure class="figure mr-2 text-center">
                                    <div class="contributor-pics">
                                        <a href="">
                                            <img src="https://avatars1.githubusercontent.com/u/1858004?v=4"
                                                 width="64px">
                                        </a>
                                    </div>
                                    <figcaption class="figure-caption">北慈苗场</figcaption>
                                </figure>
                                <figure class="figure mr-2 text-center">
                                    <div class="contributor-pics">
                                        <a href="">
                                            <img src="https://avatars2.githubusercontent.com/u/5693018?v=4"
                                                 width="64px">
                                        </a>
                                    </div>
                                    <figcaption class="figure-caption">北河崖苗场</figcaption>
                                </figure>
                                <figure class="figure mr-2 text-center">
                                    <div class="contributor-pics">
                                        <a href="">
                                            <img src="https://avatars0.githubusercontent.com/u/15792249?v=4"
                                                 width="64px">
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
                            <h5>老乡，您好!</h5>
                            <p class="mb-0 mt-3">
                                习主席说过：要让居民望得见山、看得见水、记得住乡愁。
                            </p>
                            <hr class="my-2">
                            <p>
                                每个人都有一份乡愁！而我们终于有机会来到家乡，编织梦想。战略家马云说过"梦想一定要有，万一实现了呢"，还有一句关于农业的"只有农村富，中国才会富，只有乡村强，中国才会强，只有乡村振兴，中国才会振兴"。
                                我们有一个梦想，就是要
                                <mark class="alert-success alert-link font-weight-bold">
                                    用科技创新农业，用智慧振兴中国，用智能改变世界。
                                </mark>
                            <p>在这个平台上您会得到所需的一切服务，只要您有创新的想法，我们就能在平台上为您实现。请多多帮助小<a
                                    href="https://veg.kim" target="_blank"
                                    class="alert-success alert-link">
                                苗果
                            </a>，我们会在您的呵护下生根发芽、茁壮成长，谢谢。
                            </p>
                            <p>
                                欢迎使用专业的种苗交易平台，目前我们上线了微信小程序，请通过微信搜索"<a href="https://veg.kim" target="_blank"
                                                                      class="alert-success alert-link">苗果</a>"，或者扫码找到我们。
                            </p>
                            </p>
                            <p>
                                ~~好了，就从苗开始，
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-md-row mb-3">
                    <div class="card-body mt-2">
                        <div class="input-group">
                            <textarea class="form-control bd-callout lead"
                                      rows="3"
                                      placeholder="创新驱动价值，欢迎提意见。"
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

    .mg-home-top .card-title {
        font-size: 12px;
    }

    .mg-home-top .card-text {
        font-size: 30px;
        font-weight: 700;
    }

    .mg-hello h2 {
        font-weight: 200;
    }

    .mg-hello p {
        text-indent: 2rem;
    }

    .mg-business .mg-img {
        width: 200px;
        height: 200px;
    }

    .verticalLine {
        width: 1px;
        height: 80px;
        background: #E5E5E5;
        float: left;
    }

    .contributor-pics img {
        border-radius: 50%;
        box-shadow: 0 0 20px #e4e8eb !important;
    }
</style>
