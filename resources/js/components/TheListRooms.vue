<template>
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">All Rooms</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                        <i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <router-link :to="{ name: 'all-room'}" class="title">
                            Room&nbsp;<i class="fa fa-angle-right"></i>
                        </router-link>
                    </li>
                    <li class="active">All Rooms</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>All Rooms</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="row p-b-20">
                            <div class="col-md-6 col-sm-6 col-6">
                                <div class="btn-group">
                                    <router-link :to="{ name: 'room-create' }"  id="addRow" class="btn btn-info">
                                            Add New <i class="fa fa-plus"></i>
                                    </router-link>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6">
                                <div class="btn-group pull-right">
                                    <a class="btn deepPink-bgcolor  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-print"></i> Print </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="table-scrollable">
                            <table class="table table-hover table-checkable order-column full-width" id="example4">
                                <thead>
                                    <tr>
                                        <th class="center"> # </th>
                                        <th> Category </th>
                                        <th > Title </th>
                                        <th class="center"> Area </th>
                                        <th class="center"> People </th>
                                        <th class="center"> Rent </th>
                                        <th class="center"> Province </th>
                                        <th class="center"> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX" v-for="(room,index) in list_rooms" :key="room.id"  >
                                        <td class="center">{{ index+1 }}</td>
                                        <td class="text-primary">{{ room.category.name }}</td>
                                        <td >{{ room.title }}</td>
                                        <td class="center">{{ room.room_area }} m</td>
                                        <td class="center">{{ room.maximum_peoples_number }}</td>
                                        <td class="center">{{ room.price }} vnd</td>
                                        <td class="center">{{ room.address.province.name }}</td>
                                        <td class="center">
                                            <router-link :to="{ name: 'room-edit',params: { id: room.id }}" class='btn btn-tbl-edit btn-xs' >
                                                <i class="fa fa-pencil"></i>
                                            </router-link>
                                            <a href="#" target="_blank" class='btn btn-tbl-delete btn-xs'>
                                                <i class="fa fa-trash-o "></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <nav class="">
                <ul class="pagination">
                    <li :class="[ pagination.current_page === 1 ? 'disabled' : '']" class="page-item">
                        <a class="page-link"
                        @click.prevent="changePage(pagination.current_page - 1)">
                            <span aria-hidden="true">prev</span>
                        </a>
                    </li>
                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[ page == isActived ? 'active' : '']">
                        <a class="page-link" @click.prevent="changePage(page)">{{ page }}</a>
                    </li>
                    <li :class="[ pagination.current_page === pagination.last_page ? 'disabled' : '']" class="page-item">
                        <a class="page-link" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
                            <span aria-hidden="true">next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            list_rooms:[],
            pagination: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 4,
        }
    },
    created(){
        this.getListRooms(1);
    },
    methods: {
        getListRooms(numPage) {
        axios
            .get(`/api/rooms?page=${numPage}`)
            .then(response => {
                this.list_rooms = response.data.rooms;
                this.pagination = response.data.pagination;
            })
            .catch(error => {
                console.error(error.response);
            });
        },
        changePage: function (page) {
          this.pagination.current_page = page;
          this.getListRooms(page);
        },
        nextPage(){
            if(this.pagination.current_page + 1 <= this.pagination.last_page){
                this.getListRooms(this.pagination.current_page + 1);
            }

        },
        prevPage(){
            if(this.pagination.current_page + 1 >= 1){
                this.getListRooms(this.pagination.current_page - 1);
            }
        },
        linksPaginate(){
            html =``
        }
    },
    computed: {
        isActived: function () {
            return this.pagination.current_page;
        },
        pagesNumber: function () {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;

        },

    },
}
</script>
