<template>
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">User Information</h3>
      </div>
      <div class="panel-body">
        <div class="form-group row">
          <label class="control-label col-sm-2" for="email">Name:</label>
          <p v-if="!isEdit">{{ currentUser.name }}</p>
          <div v-else class="col-sm-10">
            <input
              type="email"
              class="form-control"
              id="email"
              placeholder="Enter email"
              v-model="currentUser.name"
            />
            <div class="errors" v-if="errors.name">
              <p>{{ errors.name[0] }}</p>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-sm-2" for="email">Email:</label>
          <p v-if="!isEdit">{{ currentUser.email }}</p>
          <div v-else class="col-sm-10">
            <input
              type="email"
              class="form-control"
              id="email"
              placeholder="Enter email"
              v-model="currentUser.email"
            />
            <div class="errors" v-if="errors.email">
              <p>{{ errors.email[0] }}</p>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-sm-2" for="tel">Phone:</label>
          <p v-if="!isEdit">{{ currentUser.phone }}</p>
          <div v-else class="col-sm-10">
            <input
              type="tel"
              class="form-control"
              id="tel"
              placeholder="Enter Phone"
              v-model="currentUser.phone"
            />
            <div class="errors" v-if="errors.phone">
              <p>{{ errors.phone[0] }}</p>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-sm-2" for="tel">Address:</label>
          <div class="col-sm-10">
            <user-address-component
              @address-id="getAddressId"
              :user_id="currentUser.id"
              :address_id="currentUser.address_id"
              :is_edit="isEdit"
            ></user-address-component>
            <div class="errors" v-if="errors.address">
              <p>{{ errors.address[0] }}</p>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <div v-if="!isEdit" class="col-sm-offset-3 col-md-12">
            <button @click="isEdit = true" type="submit" class="btn btn-success">Edit</button>
          </div>
          <div v-else class="col-lg-offset-2 col-lg-8">
            <button @click="updateUser(currentUser)" type="submit" class="btn btn-primary">Save info</button>
            <button @click="isEdit = false" type="submit" class="btn btn-success">Canel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      currentUser: {
        name: "",
        email: "",
        phone: "",
        address_id: null
      },
      errors: {
        name: null,
        email: null,
        phone: null,
        address: null
      },
      isEdit: false,
      counter: 0
    };
  },
  created() {
    this.getCurrentUser();
  },
  methods: {
    getCurrentUser() {
      axios
        .get("/getCurrentUser")
        .then(response => {
          this.currentUser = response.data;
          this.checkEditUser;
        })
        .catch(error => {
          console.log(error);
        });
    },
    updateUser(user) {
      console.log(user);
      axios
        .put("/api/users/" + user.id, {
          user: user
        })
        .then(response => {
          console.log(response.data);
          this.isEdit = false;
        })
        .catch(errors => {
          console.log(errors.response);
          if (errors.response.data.errors)
            this.errors.name = errors.response.data.errors;
        });
    },
    getAddressId(id) {
      this.currentUser.address_id = id;
    },
    validateEmail(email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
    checkEditUser() {
      this.errors = {
        name: null,
        email: null,
        phone: null,
        address: null
      };
      if (this.currentUser.name === "") {
        this.errors.name = ["User-Mame is a required field."];
      } else if (
        this.currentUser.name != null &&
        this.currentUser.name.length < 6
      ) {
        this.errors.name = ["User-Name must be greater than 6 characters"];
      }
      if (this.currentUser.email === "") {
        this.errors.email = ["Email-Address is a required field."];
      } else if (
        this.currentUser.email != null &&
        !this.validateEmail(this.currentUser.email)
      ) {
        this.errors.email = ["Email-Address is not valid."];
      }
      if (this.currentUser.phone === "") {
        this.errors.phone = ["Phone-Number is a required field."];
      } else if (
        this.currentUser.phone != null &&
        this.currentUser.phone.length != 10
      ) {
        this.errors.phone = ["Phone-Number must be 10 digits."];
      }
    }
  },
  watch: {
    currentUser: {
      handler: function() {
        console.log("change");
        this.errors = {
          name: null,
          email: null,
          phone: null,
          address: null
        };
        if (this.currentUser.name === "") {
          this.errors.name = ["User-Mame is a required field."];
        } else if (
          this.currentUser.name != null &&
          this.currentUser.name.length < 6
        ) {
          this.errors.name = ["User-Name must be greater than 6 characters"];
        }
        if (this.currentUser.email === "") {
          this.errors.email = ["Email-Address is a required field."];
        } else if (
          this.currentUser.email != null &&
          !this.validateEmail(this.currentUser.email)
        ) {
          this.errors.email = ["Email-Address is not valid."];
        }
        if (this.currentUser.phone === "") {
          this.errors.phone = ["Phone-Number is a required field."];
        } else if (
          this.currentUser.phone != null &&
          this.currentUser.phone.length != 10
        ) {
          this.errors.phone = ["Phone-Number must be 10 digits."];
        }
        if (this.currentUser.address_id === null) {
          this.errors.address = ["Please enter Address user"];
        }
      },
      deep: true
    }
  }
};
</script>


