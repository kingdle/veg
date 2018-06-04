<template>
    <div class="mg-order-list">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">序号</th>
                <th scope="col">农户</th>
                <th scope="col">电话</th>
                <th scope="col">苗子品种</th>
                <th scope="col">数量(株)</th>
                <th scope="col">育-送苗时间</th>
                <th scope="col">地址</th>
                <th scope="col">是否送苗</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="order in orders" :key="order.id">
                <th scope="row">{{order.id}}</th>
                <td v-if="order.name !== ''">{{order.name}}</td>
                <td v-else-if="order.name === ''">{{order.nickname}}</td>
                <td>{{order.phone}}</td>
                <td>
                    <span v-if="order.tag_id === '0'">未选择品种</span>
                    <span v-else>
                        {{order.tag.name}}({{order.tag.bio}})
                    </span>
                </td>
                <td>{{order.count}}</td>
                <td>{{order.start_at | moment("YYYY年M月D日")}}-{{order.end_at | moment("M月D日")}}</td>
                <td>{{order.address}}，{{order.villageInfo}}</td>
                <td>{{order.state}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    export default {
        props: ['orders'],
    }
</script>
<style>
    .mg-news-img {
        background: #f5f8fa;
    }

    .mg-news-img img {
        width: 80px;
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

    .bd-example-border-utils [class^=border] {
        display: inline-block;
        width: 18%;
        height: 5rem;
        margin: .25rem;
        background-color: #f5f5f5;
    }

    .mg-order-list {
        text-align: center;
    }

    .border {
        border: 1px solid #dee2e6 !important;
    }

</style>
