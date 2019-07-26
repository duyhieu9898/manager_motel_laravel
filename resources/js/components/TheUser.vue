<template>
  <div class="page-content">
    <div class="page-bar">
      <div class="page-title-breadcrumb">
        <div class="pull-left">
          <div class="page-title">User</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
          <li>
            <i class="fa fa-home"></i>&nbsp;
            <router-link :to="{ name: 'dash-board'}" class="title">
              Home
            </router-link>&nbsp;
            <i class="fa fa-angle-right"></i>
          </li>
          <li class="active">User</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card-box">
          <div class="card-head">
            <header>User Infomation</header>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12 user-management">
                <div class="list_user table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Phone</td>
                        <td>Role</td>
                        <td v-if="checkIsAdmin">Action</td>
                      </tr>
                    </thead>
                    <tbody v-if="list_users.length">
                      <tr v-for="(user, index) in list_users" v-bind:key="user.id">
                        <td>{{ user.id }}</td>
                        <td v-if="!user.isEdit">{{ user.name }}</td>
                        <td v-else>
                          <input type="text" class="form-control" v-model.lazy="user.name" />
                        </td>
                        <td v-if="!user.isEdit">{{ user.email }}</td>
                        <td v-else>
                          <input type="text" class="form-control" v-model.lazy="user.email" />
                        </td>
                        <td v-if="!user.isEdit">{{ user.phone }}</td>
                        <td v-else>
                          <input class="form-control" type="text" v-model.lazy="user.phone" />
                        </td>
                        <td v-if="!user.isEdit">
                          <span v-for="role in user.roles" v-bind:key="role.id">{{ role.name }}</span>
                        </td>
                        <td v-else>
                          <div v-if="user.roles.length">
                            <div v-for="role in user.roles" v-bind:key="role.id">
                              <select class="form-control" v-model.lazy="role.name">
                                <option value="customer">Customer</option>
                                <option value="owner">Owner</option>
                                <option value="admin">Admin</option>
                              </select>
                            </div>
                          </div>
                        </td>
                        <td v-if="checkIsAdmin&&!user.isEdit">
                          <button class="btn btn-success" @click="user.isEdit = true">Edit</button>
                          <button class="btn btn-danger" @click="deleteUser(user,index)">Delete</button>
                        </td>
                        <td v-else-if="checkIsAdmin">
                          <button class="btn btn-primary" @click="updateUser(user)">Save</button>
                          <button class="btn btn-danger" @click="user.isEdit = false ">Cancel</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="create-user container" v-if="checkIsAdmin">
                  <div class="row">
                    <div class="col-md-3">
                      <input
                        type="text"
                        v-model="userCreate.name"
                        class="form-control"
                        placeholder="Name..."
                      />
                      <div class="errors-create-user" v-if="errors.name!=null">
                        <p>{{ errors.name }}</p>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <input
                        type="email"
                        v-model="userCreate.email"
                        class="form-control"
                        placeholder="User email..."
                        autocomplete="true"
                      />
                      <div class="errors-create-user" v-if="errors.email!=null">
                        <p>{{ errors.email }}</p>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <input
                        type="tel"
                        v-model="userCreate.phone"
                        class="form-control"
                        placeholder="User Phone..."
                        autocomplete="true"
                      />
                      <div class="errors-create-user" v-if="errors.phone!=null">
                        <p>{{ errors.phone }}</p>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <select class="form-control" v-model.lazy="userCreate.role">
                        <option value="customer">Customer</option>
                        <option value="owner">Owner</option>
                        <option value="admin">Admin</option>
                      </select>
                    </div>
                    <div class="col-md-3 mt-3">
                      <button class="btn btn-primary" @click="createUser">Create</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
      userCreate: {
        name: null,
        email: null,
        phone: null,
        role: "customer"
      },
      currentUser: {},
      list_users: [],
      errors: {
        name: null,
        email: null,
        phone: null
      }
    };
  },
  created() {
    this.getCurrentUser();
    this.getListUsers();
  },
  methods: {
    getCurrentUser() {
      axios
        .get("/getCurrentUser")
        .then(response => {
          this.currentUser = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getListUsers() {
      axios
        .get("/api/users/")
        .then(response => {
          this.list_users = response.data;
          this.list_users.forEach(user => {
            Vue.set(user, "isEdit", false);
          });
        })
        .catch(error => {
          console.log(error.response);
        });
    },
    createUser() {
      axios
        .post("/api/users/", {
          user: this.userCreate
        })
        .then(response => {
          console.log(response);
          //reset value
          this.userCreate = {};
          this.userCreate.role = "employee";
          //can not push user so id user defines the server side, id use for actions, should get all info from database
          this.getListUsers();
        })
        .catch(errors => {
          if (errors.response.data) {
            console.log(errors.response.data);
            this.errors.name = errors.response.data.errors["user.name"][0];
            this.errors.email = errors.response.data.errors["user.email"][0];
          }
        });
    },
    updateUser(user) {
      console.log(user);
      axios
        .put("/api/users/" + user.id, {
          user: user
        })
        .then(response => {
          console.log(response.data.result);
          console.log(response.data.role_id);
          user.isEdit = false;
        })
        .catch(errors => {
          console.log(errors.response);
          if (errors.response.data.errors)
            this.errors.name = errors.response.data.errors;
        });
    },
    deleteUser(user, index) {
      axios
        .delete("/api/users/" + user.id)
        .then(response => {
          console.log(response.data.result);
          this.list_users.splice(index, 1);
        })
        .catch(errors => {
          if (errors.response.data.errors) {
            console.log(errors.response.data.errors);
          }
        });
    },
    validateEmail(email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }
  },
  computed: {
    checkIsAdmin() {
      if (this.currentUser.roles) {
        let check = false;
        this.currentUser.roles.forEach(role => {
          if (role.name === "admin") {
            check = true;
          }
        });
        return check;
      }
    },
    checkEditUser() {},
    checkCreateUser() {
      this.errors = {
        name: null,
        email: null,
        phone: null
      };
      if (this.userCreate.name === "") {
        this.errors.name = "User-Mame is a required field.";
      } else if (
        this.userCreate.name != null &&
        this.userCreate.name.length < 6
      ) {
        this.errors.name = "User-Name must be greater than 6 characters";
      }
      if (this.userCreate.email === "") {
        this.errors.email = "Email-Address is a required field.";
      } else if (
        this.userCreate.email != null &&
        !this.validateEmail(this.userCreate.email)
      ) {
        this.errors.email = "Email-Address is not valid.";
      }
      if (this.userCreate.phone === "") {
        this.errors.phone = "Phone-Number is a required field.";
      } else if (
        this.userCreate.phone != null &&
        this.userCreate.phone.length != 10
      ) {
        this.errors.phone = "Phone-Number must be 10 digits.";
      }
    }
  },
  update() {
    this.checkCreateUser;
  }
};
</script>
<style lang="scss" scoped>
.errors-create-user > p {
  color: red;
}
</style>
