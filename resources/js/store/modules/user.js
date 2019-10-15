const state = {
  listUser: null,
  currentUser: {
    id: null,
    name: null,
    role: null,
    email: null,
    phone: null,
    address_id: null,
    api_token: null,
    email_verified_at: null,
    created_at: null,
    updated_at: null
  }
};

const getters = {
  listUser(state) {
    return state.listUser
  },
  currentUser(state) {
    return state.currentUser
  },

};

const actions = {
  async getCurrentUser({ commit }) {
    try {
      let response = await axios.get('/getCurrentUser');
      let currentUser = response.data;
      commit('GET_CURRENT_USER', currentUser)
    } catch (error) {
      console.log(error);
    }
  },
  async getListUser({ commit }) {
    try {
      let response = await axios.get("/api/users/")
      const listUser = response.data;
      listUser.forEach(user => {
        this._vm.$set(user, "isEdit", false);
      });
      commit('GET_LIST_USER', listUser)
    } catch (error) {
      console.log(error);
    }
  },
  async createUser({ commit }, userItem) {
    try {
      let response = await axios.post("/api/users/", userItem.id);
      //send notify
      alertify.notify(`CREATE success user with name is "${userItem.name}"`, "success", 7);
      //update list user side client
      userItem.id = response.data.userId;
      userItem.roles = [{ name: userItem.role }];
      this._vm.$set(userItem, "isEdit", false);
      commit('INSERT_ITEM_IN_LIST', userItem)
    } catch (error) {
      console.log(error.response);
      alertify.notify('There was an unexpected error', "error", 7);
    }
  },
  async updateUser(user) {
    try {
      await this._vm.axios.put("/api/users/" + user.id, {
        name: user.name,
        email: user.email,
        phone: user.phone,
        roleId: user.roles[0].id
      });
    } catch (error) {
      console.log(error.response);
      alertify.notify('There was an unexpected error', "error", 7);
    }
  },
  async deleteUser(user, index) {
    try {
      await this.axios.delete("/api/users/" + user.id);
      alertify.notify("DELETE user with id is " + user.id, "warning", 7);
      this.list_users.splice(index, 1);
    } catch (error) {
      alertify.notify('There was an unexpected error', "error", 7);
      console.log(errors.response);
    }
  },
};

const mutations = {
  GET_LIST_USER(state, data) {
    state.listUser = data
  },
  GET_CURRENT_USER(state, data) {
    state.currentUser = data
  },
  INSERT_ITEM_IN_LIST(state, userItem) {
    state.listUser.push(userItem)
  },
};

export default {
  state,
  actions,
  mutations,
  getters,
};
