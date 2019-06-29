<template>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" style="width: 124px;">
        <input class="info__address width-ellipsis mdl-textfield__input" v-model="current_address" readonly data-toggle="modal" data-target="#dddress--model__edit" />
        <div class="modal fade" id="dddress--model__edit" tabindex="-1" role="dialog" aria-labelledby="modalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Adress Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row justify-content-center">
                             <div class="col-8 form-group">
                                 <input class="form-control" type="text" v-model="address.street" placeholder="enter Street">
                             </div>
                            <div class="col-8 form-group">
                                <select class="form-control" v-model="address.province" >
                                    <option hidden>Chose Province</option>
                                    <option v-bind:value="{ id: province.id }" v-for="province in list_provinces" :key="province.id">{{ province.name }}</option>
                                </select>
                            </div>
                            <div class="col-8 form-group" >
                                <select class="form-control" v-model="address.district" >
                                    <option hidden>Chose District</option>
                                    <option v-bind:value="{ id: district.id }" v-for="district in list_districts" :key="district.id">{{ district.name }}</option>
                                </select>
                            </div>
                            <div class="col-8 form-group">
                                <select class="form-control" v-model="address.ward" >
                                    <option hidden>Chose Ward</option>
                                    <option v-bind:value="{ id: ward.id }" v-for="ward in list_wards" :key="ward.id">{{ ward.name }}</option>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div>
                                <button type="button" class="btn  btn-secondary" data-dismiss="modal" >CLOSE</button>
                                <button type="button" class="btn  btn-primary" data-dismiss="modal" @click="updateAddressByRoom()">SAVE</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <label class="mdl-textfield__label">Address</label>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                room_id:'',
                address: {
                    street:'',
                    ward: 'Chose Ward',
                    district: 'Chose District',
                    province: "Chose Province",
                },
                current_address:'',
                list_provinces: [],
                list_districts: [],
                list_wards: [],
                hostName: null
            };
        },
        created() {
            this.hostName = window.location.origin;
            this.room_id=document.getElementById('js_room_id').value;
            this.getListProvinces();
            this.getAddressByRoom();
        },
        methods: {
            getAddressByRoom(){
                axios
                    .get(this.hostName + '/api/address/' + this.room_id)
                    .then(res => {
                        this.current_address = res.data;
                        this.$forceUpdate;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            updateAddressByRoom(){
                axios
                    .put(this.hostName + '/api/address/' + this.room_id,{address:this.address})
                    .then(res => {
                        this.getAddressByRoom();
                        console.log(res);
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            getListWardsByDistrict(disttictId) {
                axios
                    .get(this.hostName + '/api/wards/' + disttictId)
                    .then(res => {
                        this.list_wards = res.data;
                        this.$forceUpdate;

                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            getListDistrictsByProvince(provinceId) {
                axios
                    .get(this.hostName + '/api/districts/' + provinceId)
                    .then(res => {
                        this.list_districts = res.data;
                        this.$forceUpdate();
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            getListProvinces() {
                axios
                    .get(this.hostName + '/api/provinces')
                    .then(res => {
                        this.list_provinces = res.data;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            }

        },
        computed: {
            getProvince() {
                return this.address.province;
            },
            getDistrict() {
                return this.address.district;
            }
        },
        watch: {
            getProvince() {
                this.getListDistrictsByProvince(this.address.province.id);
                //reset value select default
                this.address.district= 'Chose District';
            },
            getDistrict() {
                this.getListWardsByDistrict(this.address.district.id);
                //reset value select default
                this.address.ward= 'Chose Ward';
            }
        },
    };
</script>
