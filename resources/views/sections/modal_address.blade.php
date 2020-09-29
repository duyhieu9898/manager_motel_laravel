<div
    class="modal fade"
    id="adddress--model__edit"
    tabindex="-1"
    role="dialog"
    aria-labelledby="modalLongTitle"
    aria-hidden="true"
>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Adress Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-lg-offset-2 col-lg-8 form-group">
                        <input class="form-control" type="text" v-model="address.street"
                            placeholder="enter Street" />
                    </div>
                    <div class="col-lg-offset-2 col-lg-8 form-group">
                        <select class="form-control" v-model="address.province" id="provinces">
                            <option hidden>Chose Province</option>
                            <option v-bind:value="{ id: province.id, name: province.name }"
                                v-for="province in list_provinces" :key="province.id">
                                    province.name </option>
                        </select>

                    </div>
                    <div class="col-lg-offset-2 col-lg-8 form-group">
                        <select class="form-control" id="districts">
                            <option hidden>Chose District</option>
                            <option v-bind:value="{ id: district.id, name: district.name }"
                                v-for="district in list_districts" :key="district.id">
                                    district.name </option>
                        </select>

                    </div>
                    <div class="col-lg-offset-2 col-lg-8 form-group">
                        <select class="form-control" id="ward">
                            <option hidden>Chose Ward</option>
                            <option v-bind:value="{ id: ward.id, name: ward.name}"
                                v-for="ward in list_wards" :key="ward.id"> ward.name
                            </option>
                        </select>

                    </div>
                </div>
                <div class="modal-footer">
                    <div>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">CLOSE</button>
                        <button type="button" class="btn btn-primary"
                            @click="saveAddress()">SAVE</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('footer')
<!-- app -->
<script src="js/modal-address.js"></script>
@endsection
