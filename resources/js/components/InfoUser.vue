<template>
  <div>

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
  },
  mounted() {



  },
  methods: {
     async getCurrentUser() {
         try {
            let response = await axios.get("/getCurrentUser");
            this.currentUser = response.data;
            console.log(this.currentUser );

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


