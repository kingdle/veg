<template>
    <div class="mg-seed">
        <edit-seed-form></edit-seed-form>
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-row mb-3 border-0">
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="" class="table-hover table table-striped table-bordered dataTable"
                                       cellspacing="0" width="100%" role="grid" aria-describedby="table-normal_info">
                                    <form @submit.prevent="addSeed(newSeed)">

                                    <thead>
                                    <tr role="row">
                                        <th>
                                            <input class="form-control"
                                                   v-model="newSeed.title"
                                                   type="text" placeholder="公司名">
                                        </th>
                                        <th>
                                            <input class="form-control"
                                                   v-model="newSeed.username"
                                                   type="text" placeholder="联系人">
                                        </th>
                                        <th>
                                            <input class="form-control"
                                                   v-model="newSeed.phone"
                                                   type="text" placeholder="手机">
                                        </th>
                                        <th>
                                            <input class="form-control"
                                                   v-model="newSeed.email"
                                                   type="text" placeholder="邮箱">
                                        </th>
                                        <th>
                                            <input class="form-control"
                                                   v-model="newSeed.address"
                                                   type="text" placeholder="地址">
                                        </th>
                                        <th>
                                            <input class="form-control"
                                                   v-model="newSeed.web_url"
                                                   type="text" placeholder="网站">
                                        </th>
                                        <th>
                                            <input class="form-control"
                                                   v-model="newSeed.remark"
                                                   type="text" placeholder="备注">
                                        </th>
                                        <th class="sorting">
                                            <button class="btn btn-success" type="submit">添加</button>
                                        </th>
                                    </tr>
                                    <tr role="row">
                                        <th class="sorting_asc">单位</th>
                                        <th class="sorting">联系人</th>
                                        <th class="sorting">手机</th>
                                        <th class="sorting">邮箱</th>
                                        <th class="sorting">地址</th>
                                        <th class="sorting">网站</th>
                                        <th class="sorting">备注</th>
                                        <th class="sorting">修改</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(seed,index) in seeds" :key="seed.id" role="row" class="odd">
                                        <td class="sorting_1">{{seed.title}}</td>
                                        <td>{{seed.username}}</td>
                                        <td>{{seed.phone}}</td>
                                        <td>{{seed.email}}</td>
                                        <td>{{seed.address}}</td>
                                        <td>{{seed.web_url}}</td>
                                        <td>{{seed.remark}}</td>
                                        <td>
                                            <button
                                                    @click="deleteSeeds(index,seed)"
                                                    type="button" class="btn btn-info btn-sm f-l">
                                                删除
                                            </button>
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#SeedModalCenter">
                                                修改
                                            </button>

                                        </td>
                                    </tr>
                                    </tbody>
                                    </form>

                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="table-normal_info" role="status" aria-live="polite">Showing
                                    51 to 57 of 57 entries
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="table-normal_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous" id="table-normal_previous">
                                            <a href="#" aria-controls="table-normal" data-dt-idx="0" tabindex="0"
                                               class="page-link">Previous</a>
                                        </li>
                                        <li class="paginate_button page-item ">
                                            <a href="#" aria-controls="table-normal"
                                               data-dt-idx="1" tabindex="0"
                                               class="page-link">1</a>
                                        </li>
                                        <li class="paginate_button page-item ">
                                            <a href="#" aria-controls="table-normal"
                                               data-dt-idx="2" tabindex="0"
                                               class="page-link">2</a>
                                        </li>
                                        <li class="paginate_button page-item ">
                                            <a href="#" aria-controls="table-normal"
                                               data-dt-idx="3" tabindex="0"
                                               class="page-link">3</a>
                                        </li>

                                        <li class="paginate_button page-item next disabled" id="table-normal_next">
                                            <a href="#" aria-controls="table-normal" data-dt-idx="4" tabindex="0"
                                               class="page-link">Next</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import EditSeedForm from './EditSeedForm.vue'

    export default {
        data(){
            return {
                seeds:[],
                newSeed:[
                    {title:'',username:'',phone:'',email:'',address:'',web_url:'',remark:''}
                ]
            }
        },
        mounted() {
            axios.get('/api/v1/seeds').then(response => {
                this.seeds = response.data.data
            })
        },
        methods:{
            addSeed(newSeed){
                const formData = {
                    title: this.newSeed.title,
                    username: this.newSeed.username,
                    property: this.newSeed.property,
                    content: this.newSeed.content,
                    phone: this.newSeed.phone,
                    email: this.newSeed.email,
                    address: this.newSeed.address,
                    web_url: this.newSeed.web_url,
                    remark: this.newSeed.remark
                }
                this.axios.post('/api/v1/seeds',formData).then(response =>{
                    this.seeds.push(response.data)
                })

                this.newSeed={title:'',username:'',phone:'',email:'',address:'',web_url:'',remark:''}
            },
            deleteSeeds(index,seed){
                this.axios.delete('/api/v1/seeds/'+ seed.id).then(response =>{
                    console.log(response.data)
                    this.seeds.splice(index,1)
                })
            },
            toggleCompletion(seed){
                this.axios.patch('/api/v1/seeds'+ seed.id).then(response =>{
                    console.log(response.data)
                    this.seeds.push(response.data)
                })
            }
        },
        components: {
            EditSeedForm
        }
    }
</script>
