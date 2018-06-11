<template>
    <div class="mg-order-list">
        <el-table
                :data="orders"
                :default-sort = "{prop: 'orders'}"
        >
            <el-table-column
                    prop="id"
                    label="序号"
                    sortable
                    width="80">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="姓名"
                    sortable
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="phone"
                    label="电话"
                    sortable
                    width="140">
            </el-table-column>
            <el-table-column
                    prop="tag.name"
                    label="苗子品种"
                    sortable
                    width="120">
            </el-table-column>
            <el-table-column
                    prop='start_at'
                    label="最晚育苗日期"
                    sortable
                    :formatter="dateFormat"
                    width="140">
            </el-table-column>
            <el-table-column
                    prop="end_at"
                    label="送苗日期"
                    sortable
                    :formatter="dateFormat"
                    width="120">
            </el-table-column>

            <el-table-column
                    prop="address + villageInfo"
                    label="地址"
                    sortable
                    >
            </el-table-column>
            <el-table-column
                    prop="villageInfo"
                    label="村"
                    sortable
                    width="120"
            >
            </el-table-column>
            <el-table-column
                    prop="state"
                    label="是否送苗"
                    sortable
                    :formatter="switchFormat"
                    width="100">
            </el-table-column>

        </el-table>

    </div>
</template>
<script>
    export default {
        props: ['orders'],
        methods: {
            dateFormat:function(row, column) {
                var date = row[column.property];
                if (date == undefined) {
                    return "";
                }
                return date.substring(0,10);
            },
            switchFormat:function(row, column) {
                var switchs = row[column.property];
                if (switchs === '0') {
                    return "未送苗";
                }
                return '已送苗';
            },
        }
    }
</script>
<style>
    .el-table .warning-row {
        background: oldlace;
    }

    .el-table .success-row {
        background: #f0f9eb;
    }
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
