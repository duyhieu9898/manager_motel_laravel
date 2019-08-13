<template>
  <div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">User Information</h3>
      </div>
      <div class="card-body">
        <div class="form-group row">
          <label class="control-label col-lg-3 text-right" for="email">Name:</label>
          <p v-if="!isEdit">{{ currentUser.name }}</p>
          <div v-else class="col-lg-9">
            <input
              v-validate="'required|min:6|max:18'"
              type="text"
              class="form-control"
              placeholder="Enter email"
              v-model="currentUser.name"
              name="username"
            />
            <span v-show="errors.has('username')" class="errors">{{ errors.first('username') }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-lg-3 text-right" for="email">Email:</label>
          <p v-if="!isEdit">{{ currentUser.email }}</p>
          <div v-else class="col-lg-9">
            <input
              v-validate="'required|email'"
              type="email"
              class="form-control"
              name="email"
              placeholder="Enter email"
              v-model="currentUser.email"
            />
            <span v-show="errors.has('email')" class="errors">{{ errors.first('email') }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-lg-3 text-right" for="tel">Phone:</label>
          <p v-if="!isEdit">{{ currentUser.phone }}</p>
          <div v-else class="col-lg-9">
            <input
              v-validate="'digits:10'"
              type="tel"
              class="form-control"
              name="phone"
              placeholder="Enter Phone"
              v-model="currentUser.phone"

            />
            <span v-show="errors.has('phone')" class="errors">{{ errors.first('phone') }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-lg-3 text-right" for="tel">Address:</label>
          <div class="col-lg-9">
            <user-address-component
              @address-id="getAddressId"
              :user_id="currentUser.id"
              :address_id="currentUser.address_id"
              :is_edit="isEdit"
            ></user-address-component>

          </div>
        </div>
        <div class="form-group row">
          <div v-if="!isEdit" class="col-md-12">
            <button @click="isEdit = true" type="submit" class="btn btn-success">Edit</button>
          </div>
          <div v-else class="col-lg-8">
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
      isEdit: false,
      counter: 0
    };
  },
  created() {
    this.getCurrentUser();
        try {
            Echo.channel('chat-room.1').listen('ChatMessageWasReceived', function(data) {
                console.log(data.user, data.chatMessage);
            });
            Echo.private('chat-room.1')
            .listen('ChatMessageWasReceived', (e) => {
                console.log("fdsfksdlfk")
            });
        } catch (error) {
            console.log(error);

        }
  },
  mounted() {


  },
  methods: {
     async getCurrentUser() {
         try {
            let response = await axios.get("/getCurrentUser");
            this.currentUser = response.data;
            this.checkEditUser;
         } catch (error) {
            console.log(error);
         }
    },
    async updateUser(user) {
        if (this.errors.any()) {
            alertify.notify("You must fix all errors in the form ", "error", 7);
            return;
        }
        try {
            await axios.put("/api/users/" + user.id, {
                name: user.name,
                email: user.email,
                phone:user.phone,
                address_id:user.address_id
            })
            this.isEdit = false;
            alertify.notify("update user success", "success", 7)
        } catch (error) {
            alertify.notify("An error occurred, Please contact support for notification", "error", 7)
            console.log(error);
        }
    },
    getAddressId(id) {
      this.currentUser.address_id = id;
    },
  },
};
</script>


