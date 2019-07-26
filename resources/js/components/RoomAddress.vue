<template>
  <div
    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width is-dirty is-upgraded"
    data-upgraded=",MaterialTextfield"
    style="width: 124px;"
  >
    <input
      class="info__address width-ellipsis mdl-textfield__input"
      v-model="current_address"
      placeholder="Enter address of the room"
      readonly
      data-toggle="modal"
      data-target="#adddress--model__edit"
    />
    <div
      class="modal fade"
      id="adddress--model__edit"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modalLongTitle"
      aria-hidden="true"
    >
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
                <input
                  class="form-control"
                  type="text"
                  v-model="address.street"
                  placeholder="enter Street"
                />
                <div class="errors" v-if="errors.address.street != null">
                  <p>{{ errors.address.street }}</p>
                </div>
              </div>
              <div class="col-8 form-group">
                <select class="form-control" v-model="address.province">
                  <option hidden>Chose Province</option>
                  <option
                    v-bind:value="{ id: province.id, name: province.name }"
                    v-for="province in list_provinces"
                    :key="province.id"
                  >{{ province.name }}</option>
                </select>
                <div class="errors" v-if="errors.address.province != null">
                  <p>{{ errors.address.province }}</p>
                </div>
              </div>
              <div class="col-8 form-group">
                <select class="form-control" v-model="address.district">
                  <option hidden>Chose District</option>
                  <option
                    v-bind:value="{ id: district.id, name: district.name }"
                    v-for="district in list_districts"
                    :key="district.id"
                  >{{ district.name }}</option>
                </select>
                <div class="errors" v-if="errors.address.district != null">
                  <p>{{ errors.address.district }}</p>
                </div>
              </div>
              <div class="col-8 form-group">
                <select class="form-control" v-model="address.ward">
                  <option hidden>Chose Ward</option>
                  <option
                    v-bind:value="{ id: ward.id, name: ward.name}"
                    v-for="ward in list_wards"
                    :key="ward.id"
                  >{{ ward.name }}</option>
                </select>
                <div class="errors" v-if="errors.address.ward != null">
                  <p>{{ errors.address.ward }}</p>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                <button type="button" class="btn btn-primary" @click="saveAddress()">SAVE</button>
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
  props: {
    room_id: {
      type: Number
    }
  },
  data() {
    return {
      address: {
        street: "",
        ward: "Chose Ward",
        district: "Chose District",
        province: "Chose Province"
      },
      current_address: "",
      list_provinces: [],
      list_districts: [],
      list_wards: [],
      host_name: null,
      errors: {
        address: {
          street: null,
          ward: null,
          district: null,
          province: null
        }
      }
    };
  },
  created() {
    if (this.room_id) {
      //if isset prop room id bind address input
      this.getAddressOfRoom();
    }
    this.getListProvinces();
  },
  methods: {
    getAddressOfRoom() {
      axios
        .get("/api/address/room/" + this.room_id)
        .then(res => {
          this.current_address = res.data;
        })
        .catch(err => {
          console.error(err);
        });
    },
    saveAddress() {
      if (this.checkAddress()) {
        if (this.room_id) {
          this.updateAddress();
        } else {
          this.createAddress();
        }
        var current_address = `${this.address.street} - ${this.address.ward.name}, ${this.address.district.name}, ${this.address.province.name}`;
        this.current_address = current_address;
        $("#adddress--model__edit").modal("hide");
      }
    },
    createAddress() {
      axios
        .post("/api/addresses/create", {
          street: this.address.street,
          ward: this.address.ward.id,
          district: this.address.district.id,
          province: this.address.province.id
        })
        .then(res => {
          //return id address
          console.log(res.data.message);
          this.$emit("address-id", res.data.address_id);
        })
        .catch(err => {
          console.error(err.response.data.message);
        });
    },
    updateAddress() {
      axios
        .put("/api/address/" + this.room_id, {
          street: this.address.street,
          ward: this.address.ward.id,
          district: this.address.district.id,
          province: this.address.province.id
        })
        .then(res => {
          console.log(res.data.message);
        })
        .catch(err => {
          console.error(err.response.data.message);
        });
    },
    getListWardsByDistrict(disttictId) {
      axios
        .get("/api/wards/" + disttictId)
        .then(res => {
          this.list_wards = res.data;
        })
        .catch(err => {
          console.error(err);
        });
    },
    getListDistrictsByProvince(provinceId) {
      axios
        .get("/api/districts/" + provinceId)
        .then(res => {
          this.list_districts = res.data;
        })
        .catch(err => {
          console.error(err);
        });
    },
    getListProvinces() {
      axios
        .get("/api/provinces")
        .then(res => {
          this.list_provinces = res.data;
        })
        .catch(err => {
          console.error(err);
        });
    },
    checkAddress() {
      //reset error
      this.errors.address.street = null;
      this.errors.address.ward = null;
      this.errors.address.district = null;
      this.errors.address.province = null;
      if (this.address.street === "") {
        this.errors.address.street = "Please enter Street.";
      }
      if (this.address.ward === "Chose Ward") {
        this.errors.address.ward = "Please choose Ward";
      }
      if (this.address.district === "Chose District") {
        this.errors.address.district = "Please choose District.";
      }
      if (this.address.province === "Chose Province") {
        this.errors.address.province = "Please choose Province.";
      }
      if (
        this.errors.address.street === null &&
        this.errors.address.province === null &&
        this.errors.address.district === null &&
        this.errors.address.ward === null
      ) {
        return true;
      }
      return false;
    }
  },
  computed: {
    getProvince() {
      return this.address.province;
    },
    getDistrict() {
      return this.address.district;
    },
    getWard() {
      return this.address.ward;
    },
    getStreet() {
      return this.address.street;
    }
  },
  watch: {
    getProvince() {
      if (this.address.province !== "Chose Province") {
        this.errors.address.province = null;
        this.getListDistrictsByProvince(this.address.province.id);
        //reset value select default
        this.address.district = "Chose District";
      }
    },
    getDistrict() {
      if (this.address.district !== "Chose Province") {
        this.errors.address.district = null;
        this.getListWardsByDistrict(this.address.district.id);
        //reset value select default
        this.address.ward = "Chose Ward";
      }
    },
    getWard() {
      if (this.address.ward !== "Chose Ward") {
        this.errors.address.ward = null;
      }
    },
    getStreet() {
      if (this.address.street !== "Chose Province") {
        this.errors.address.street = null;
      }
    }
  }
};
</script>
<style>
</style>
