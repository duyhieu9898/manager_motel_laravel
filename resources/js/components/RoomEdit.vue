<template>
<div class="page-content">
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Edit Room Details</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="">Rooms</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Edit Room Details</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-head">
                    <header>Room No {{ data.room.id }}</header>
                    <div class="mdl-menu__container is-upgraded">
                        <div class="mdl-menu__outline mdl-menu--bottom-right"></div>
                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect mdl-js-ripple-effect--ignore-events" data-mdl-for="panel-button" data-upgraded=",MaterialMenu,MaterialRipple">
                            <li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1" data-upgraded=",MaterialRipple"><i class="material-icons">assistant_photo</i>Action<span class="mdl-menu__item-ripple-container"><span class="mdl-ripple"></span></span>
                            </li>
                            <li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1" data-upgraded=",MaterialRipple"><i class="material-icons">print</i>Another action<span class="mdl-menu__item-ripple-container"><span class="mdl-ripple"></span></span>
                            </li>
                            <li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1" data-upgraded=",MaterialRipple"><i class="material-icons">favorite</i>Something else here<span class="mdl-menu__item-ripple-container"><span class="mdl-ripple"></span></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body ">
                        <div class="col-lg-12 p-t-20">
                            <div class="card-box">
                                <div class="card-header">Room Infomation</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" style="width: 124px;">
                                                <select   name="category_id" id="category-room" class="mdl-textfield__input">
                                                    <!-- v-if="" -->
                                                    <option  v-model="dataRoomEdit.category" v-for="category in data.categories" v-if="category.id==data.room.category_id" :key="category.id" checked>{{ category.name }}</option>
                                                    <option v-model="dataRoomEdit.category" v-for="category in data.categories" v-if="category.id!=data.room.category_id" :key="category.id">{{ category.name }}</option>
                                                </select>
                                                <label for="category-room" class="pull-right margin-0">
                                                    <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                                </label>
                                                <label for="category-room" class="mdl-textfield__label">Room Type</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">
                                                <input name="room_title" class="mdl-textfield__input" type="text" v-model="dataRoomEdit.title">
                                                <label class="mdl-textfield__label">Room Title</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">
                                                <input name="room_area" class="mdl-textfield__input" type="text" v-model="dataRoomEdit.area">
                                                <label class="mdl-textfield__label">Room Area</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">
                                                <input name="maximum_peoples_number" class="mdl-textfield__input" type="text" v-model="dataRoomEdit.peoples">
                                                <label class="mdl-textfield__label">Room People</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">
                                                <input name="room_price" class="mdl-textfield__input" type="text" v-model="dataRoomEdit.price">
                                                <label class="mdl-textfield__label">Room Price</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <address-form-component :room_id="data.room.id"></address-form-component>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 p-t-20">
                            <div class="card-box">
                                <div class="card-header">Room Description</div>
                                <div class="">
                                    <ckeditor :editor="editor" v-model="dataRoomEdit.description" :config="editorConfig"></ckeditor>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 p-t-20">
                            <div class="card-box">
                                <div class="card-header">Room Police And Term</div>
                                <div class="">
                                    <ckeditor :editor="editor" v-model="dataRoomEdit.policeAndTerms" :config="editorConfig" ></ckeditor>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 p-t-20">
                            <div class="card-box txt-full-width is-dirty is-upgraded">
                                <div class="card-header">Room Convenients</div>
                                <div class="card-body">
                                    <div class="row">
                                        <convenients-form-component
                                            :convenients="data.convenients"
                                            :convenients_room="data.arrListConvenientsId"
                                            @convenients_edit="convenients_edit"
                                            ></convenients-form-component>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 p-t-20">
                            <room-photo-component :room_id="data.room.id"></room-photo-component>
                        </div>
                        <div class="col-lg-12 p-t-20 text-center">
                            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink" data-upgraded=",MaterialButton,MaterialRipple">Submit<span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
                            <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default" data-upgraded=",MaterialButton,MaterialRipple">Cancel<span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

</template>


<script>
var Dropzone = require("dropzone");
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {
    data() {
        return {
            editor: ClassicEditor,
            editorConfig: {},
            data:{},
            dataRoomEdit:{
                category:{
                    id:0
                },
                title:'',
                area:0,
                peoples:0,
                price:0,
                description:'',
                policeAndTerms:'',
                list_convenients_id:[],
            },
            hostName: '',
        }
    },
    created(){
        this.hostName = window.location.origin;
        this.roomId = this.$route.params.id;
        this.getRoom(this.roomId);
    },
    methods: {
        getRoom(roomId) {
        axios
            .get(this.hostName + `/api/rooms/${roomId}/edit`)
            .then(response => {
                this.data = response.data;
                this.dataRoomEdit.category.id = this.data.room.category_id;
                this.dataRoomEdit.title = this.data.room.title;
                this.dataRoomEdit.area = this.data.room.room_area;
                this.dataRoomEdit.peoples = this.data.room.maximum_peoples_number;
                this.dataRoomEdit.price = this.data.room.price;
                this.dataRoomEdit.description=this.data.room.description;
                this.dataRoomEdit.policeAndTerms=this.data.room.police_and_terms;
                this.dataRoomEdit.description=this.data.room.description;
            })
            .catch(error => {
                console.error(error);
            });
        },
        convenients_edit(arrConvenients){
            this.dataRoomEdit.list_convenients_id=arrConvenients;
        }
    },
}

</script>
<style>
@import '../../../public/admin_rooms/plugins/dropzone/dropzone.css';
.image-room {
    border-radius: 5px;
    overflow: hidden;
    height: 242px;
    position: relative;
    border: 2px solid #c7b78c;
}

.image-room img {
    max-width: 100%;
    position: absolute;
    margin: auto;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

</style>
