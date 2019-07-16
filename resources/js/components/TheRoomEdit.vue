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
                <li><router-link :to="{ name: 'all-room'}" class="title">
                        Room&nbsp;<i class="fa fa-angle-right"></i>
                    </router-link>
                </li>
                <li class="active">Edit Room Details</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-head">
                    <header>Room No {{ room.id }}</header>
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
                                                <select v-model="room.category_id"  class="mdl-textfield__input category-room">
                                                    <option  v-for="category in categories" v-if="category.id==room.category_id" :key="category.id" :value="category.id" checked>{{ category.name }}</option>
                                                    <option  v-for="category in categories" v-if="category.id!=room.category_id" :key="category.id" :value="category.id">{{ category.name }}</option>
                                                </select>
                                                <label for="category-room" class="pull-right margin-0">
                                                    <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                                </label>
                                                <label for="category-room" class="mdl-textfield__label">Room Type</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">
                                                <input type="text"  class="mdl-textfield__input" v-model.trim="room.title" >
                                                <label class="mdl-textfield__label">Room Title</label>
                                                <div class="errors" v-if="errors.title!=null">
                                                    <p>{{ errors.title[0] }}</p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">
                                                <!-- <input type="number" class="mdl-textfield__input"  v-model.number="dataRoomEdit.area"> -->
                                                <money v-model="room.room_area" v-bind="size" class="mdl-textfield__input" maxlength="6"></money>
                                                <label class="mdl-textfield__label">Room Area</label>
                                                <div class="errors" v-if="errors.area!=null">
                                                    <p>{{ errors.area[0] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">
                                                <money v-model="room.maximum_peoples_numbe" v-bind="people" class="mdl-textfield__input" maxlength='15'></money>
                                                <label class="mdl-textfield__label">Room People</label>
                                                <div class="errors" v-if="errors.maximum_peoples_number!=null">
                                                    <p>{{ errors.maximum_peoples_number[0] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">
                                                <!-- <input type="number"  v-model.lazy="dataRoomEdit.price" > -->
                                                <money v-model="room.price" v-bind="money" class="mdl-textfield__input" maxlength="15"></money>
                                                <label class="mdl-textfield__label">Room Price</label>
                                                <div class="errors" v-if="errors.price!=null">
                                                    <p>{{ errors.price[0] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                            <room-address-component :room_id="room.id"></room-address-component>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 p-t-20">
                            <div class="card-box">
                                <div class="card-header">Room Description</div>
                                <div class="">
                                    <ckeditor :editor="editor" v-model.lazy.trim="room.description" :config="editorConfig"></ckeditor>
                                </div>
                                <div class="errors" v-if="errors.description!=null">
                                    <p>{{ errors.description[0] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 p-t-20">
                            <div class="card-box">
                                <div class="card-header">Room Police And Term</div>
                                <div class="">
                                    <ckeditor :editor="editor" v-model.lazy.trim="room.police_and_terms" :config="editorConfig"></ckeditor>
                                </div>
                                <div class="errors" v-if="errors.police_and_terms!=null">
                                    <p>{{ errors.police_and_terms[0] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 p-t-20">
                            <div class="card-box txt-full-width is-dirty is-upgraded">
                                <div class="card-header">Room Convenients</div>
                                <div class="card-body">
                                    <div class="row">
                                        <room-convenients-component
                                            :convenients="convenients"
                                            :convenientsRoom="list_convenients_id"
                                            @arr-convenients-id="getArrConvenientId"
                                            ></room-convenients-component>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 p-t-20">
                            <room-photo-component :room_id="room.id"></room-photo-component>
                        </div>
                        <div class="col-lg-12 p-t-20 text-center">
                            <button @click="updateRoom()" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink" >Submit<span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
                            <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default" >Cancel<span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
    data() {
        return {
            editor:ClassicEditor,
            editorConfig: {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote','insertTable' ],
            },
            categories:[],
            convenients:[],
            list_convenients_id:[],
            room:{
                id:0,
                address_id:0,
                category_id:0,
                description:'',
                maximum_peoples_number:0,
                police_and_terms:'',
                price:0,
                room_area:0,
                title:'',
                list_convenients_id:[]
            },
            host_name : '',
            errors:{
                title:null,
                area:null,
                maximum_peoples_number:null,
                price:null,
                description:null,
                police_and_terms:null,
                check:true,
            },
            money:{
                decimal: ',',
                thousands: ',',
                suffix: ' VNĐ',
                precision: 0,
                masked: false
            },
            size:{
                decimal: ',',
                thousands: ',',
                precision: 0,
                suffix: ' M',
                masked: false
            },
            people: {
                decimal: ',',
                thousands: ',',
                precision: 0,
                suffix: ' Pleople/Room',
                masked: false
            }
        }
    },
    created(){
        this.host_name = window.location.origin;
        this.room.id = parseInt(this.$route.params.id);
        this.getRoom(this.roomId);
    },
    methods: {
        getRoom(roomId) {
            axios
                .get(this.host_name + `/api/rooms/${this.room.id}/edit`)
                .then(response => {
                    this.room = response.data.room;
                    this.categories = response.data.categories;
                    this.list_convenients_id = response.data.arrListConvenientsId;
                    this.convenients = response.data.convenients;
                })
                .catch(errors => {
                    console.error(errors.response.data);
                });
        },
        //!listen event emit
        getArrConvenientId(arrConvenients){
            this.list_convenients_id=arrConvenients;
        },
        updateRoom(){
            if(this.errors.check){
                // this.updateRoom();
                console.log('update');



                axios
                    .put(this.host_name + '/api/rooms/' + this.room.id,
                        {
                            category_id:this.room.category_id,
                            title:this.room.title,
                            price:this.room.price,
                            room_area:this.room.room_area,
                            maximum_peoples_number:this.room.maximum_peoples_number,
                            police_and_terms:this.room.police_and_terms,
                            description:this.room.description,
                            list_convenients_id:this.list_convenients_id,
                        }
                    )
                    .then(res => {
                        console.log(res.data);
                        history.back();
                    })
                    .catch(errors => {
                        console.log(errors.response.data);
                        this.errors=errors.response.data.errors
                    });
            }
        }
    },
    watch:{
        room:{
            handler: function () {
                this.errors={title:null, area:null, maximum_peoples_number:null, price:null, description:null, police_and_terms:null, check:true}
                if (this.room.title==="") {
                    this.errors.title=['Please enter Title.'];
                    this.errors.check=false;
                } else if (this.room.title.split(' ').length < 5) {
                    this.errors.title=['Title at least 5 words.'];
                    this.errors.check=false;
                }
                if(this.room.room_area===0){
                    this.errors.area=['Please enter Area.'];
                    this.errors.check=false;
                }
                if(this.room.maximum_peoples_number===''){
                    this.errors.maximum_peoples_number=['Please enter Number of peoples.'];
                    this.errors.check=false;
                }
                if(this.room.price===0){
                    this.errors.price=['Please enter Price of Room.'];
                    this.errors.check=false;
                }
                if(this.room.description===""){
                    this.errors.description=['Please enter Description.'];
                    this.errors.check=false;
                }
                if(this.room.police_and_terms===""){
                    this.errors.police_and_terms=['Please enter PoliceAndTerms.'];
                    this.errors.check=false;
                }
            },
            deep: true
        }
    }
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
