<template>
  <div>

  </div>
</template>

<script>
export default {

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
      errorsCustom: {
        address: {
          street: null,
          ward: null,
          district: null,
          province: null
        }
      }
    };
  },

  methods: {
    getAddressById() {
      axios
        .get("/api/address/" + this.address_id)
        .then(res => {
          var address = res.data.address;
          this.current_address = `${address.street}, ${address.ward} - ${address.district} - ${address.province}`;
        })
        .catch(err => {
          console.error(err);
        });
    },
    saveAddress() {
      if (this.checkAddress()) {
        if (this.current_address != "") {
            console.log('updata');

          this.updateAddress();
        } else {
            console.log('create');
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
        .put("/api/address/" + this.address_id, {
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
      this.errorsCustom.address.street = null;
      this.errorsCustom.address.ward = null;
      this.errorsCustom.address.district = null;
      this.errorsCustom.address.province = null;
      if (this.address.street === "") {
        this.errorsCustom.address.street = "Please enter Street.";
      }
      if (this.address.ward === "Chose Ward") {
        this.errorsCustom.address.ward = "Please choose Ward";
      }
      if (this.address.district === "Chose District") {
        this.errorsCustom.address.district = "Please choose District.";
      }
      if (this.address.province === "Chose Province") {
        this.errorsCustom.address.province = "Please choose Province.";
      }
      if (
        this.errorsCustom.address.street === null &&
        this.errorsCustom.address.province === null &&
        this.errorsCustom.address.district === null &&
        this.errorsCustom.address.ward === null
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
        this.errorsCustom.address.province = null;
        this.getListDistrictsByProvince(this.address.province.id);
        //reset value select default
        this.address.district = "Chose District";
      }
    },
    getDistrict() {
      if (this.address.district !== "Chose Province") {
        this.errorsCustom.address.district = null;
        this.getListWardsByDistrict(this.address.district.id);
        //reset value select default
        this.address.ward = "Chose Ward";
      }
    },
    getWard() {
      if (this.address.ward !== "Chose Ward") {
        this.errorsCustom.address.ward = null;
      }
    },
    getStreet() {
      if (this.address.street !== "Chose Province") {
        this.errorsCustom.address.street = null;
      }
    },
    address_id: {
      handler: function() {
        this.getAddressById();
        console.log("reload bind data getAddressById");
      }
    }
  }
};
</script>
<style>
.errorsCustom span {
    color: red;
}
</style>
