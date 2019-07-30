<template>
  <div class="page-content">
    <div class="page-bar">
      <div class="page-title-breadcrumb">
        <div class="pull-left">
          <div class="page-title">category</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
          <li>
            <i class="fa fa-home"></i>&nbsp;
            <router-link :to="{ name: 'dash-board'}" class="title">Home</router-link>&nbsp;
            <i class="fa fa-angle-right"></i>
          </li>
          <li class="active">category</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card-box">
          <div class="card-head">
            <header>Category Infomation</header>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12  category-management">
                <div class="row">
                  <div class="create-category mb-3">
                    <div class="row">
                      <div class="col-md-9">
                        <input
                          type="text"
                          v-model="categoryCreate.name"
                          class="form-control"
                          placeholder="Name..."
                        />
                        <div class="errors-create-category" v-if="errors.name!=null">
                          <p>{{ errors.name }}</p>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <button class="btn btn-primary" @click="createcategory">Create</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="list_category table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th style="width: 10%;">ID</th>
                        <th style="width: 70%;">Name</th>
                        <th style="width: 20%;">Action</th>
                      </tr>
                    </thead>
                    <tbody v-if="list_categories.length">
                      <tr v-for="(category, index) in list_categories" v-bind:key="category.id">
                        <td>{{ category.id }}</td>
                        <td v-if="!category.isEdit">{{ category.name }}</td>
                        <td v-else>
                          <input type="text" class="form-control" v-model.lazy="category.name" />
                        </td>
                        <td v-if="!category.isEdit">
                          <button class="btn btn-info" @click="category.isEdit = true"><i class="fa fa-pencil"></i></button>
                          <button
                            class="btn btn-danger"
                            @click="deletecategory(category,index)"
                          ><i class="fa fa-trash-o"></i></button>
                        </td>
                        <td v-else>
                          <button class="btn btn-primary" @click="updatecategory(category)">Save</button>
                          <button class="btn btn-danger" @click="category.isEdit = false ">Cancel</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
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
      categoryCreate: {
        name: null
      },
      list_categories: [],
      errors: {
        name: null
      }
    };
  },
  created() {
    this.getListcategories();
  },
  methods: {
    getListcategories() {
      axios
        .get("/api/categories/")
        .then(response => {
          this.list_categories = response.data;
          this.list_categories.forEach(category => {
            Vue.set(category, "isEdit", false);
          });
        })
        .catch(error => {
          console.log(error.response);
        });
    },
    createcategory() {
      axios
        .post("/api/categories/", {
          category: this.categoryCreate
        })
        .then(response => {
          console.log(response);
          //reset value
          this.categoryCreate = {};
          this.categoryCreate.role = "employee";
          //can not push category so id category defines the server side, id use for actions, should get all info from database
          this.getListcategories();
        })
        .catch(errors => {
          if (errors.response.data) {
            console.log(errors.response.data);
            this.errors.name = errors.response.data.errors["category.name"][0];
          }
        });
    },
    updatecategory(category) {
      console.log(category);
      axios
        .put("/api/categories/" + category.id, {
          category: category
        })
        .then(response => {
          console.log(response.data.result);
          console.log(response.data.role_id);
          category.isEdit = false;
        })
        .catch(errors => {
          console.log(errors.response);
          if (errors.response.data.errors)
            this.errors.name = errors.response.data.errors;
        });
    },
    deletecategory(category, index) {
        this.isConfirmDelete(category.name).then(res => {
            return axios.delete("/api/categories/" + category.id)
        })
        .then(response => {
          this.list_categories.splice(index, 1);
        })
        .catch(errors => {
          if (errors.response.data.errors) {
            console.log(errors.response.data.errors);
          }
        });
    },
    isConfirmDelete(nameCategory) {
      return new Promise(function(resolve, reject) {
        swal(
          {
            title: "Are you sure?",
            text: 'You will not be able to recover this category and rooms of category!',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: `Yes, delete "${nameCategory}"!`,
            cancelButtonText: "No, cancel",
            closeOnConfirm: false
          },
          function(isConfirm) {
            if (isConfirm) {
              swal(
                "Deleted!",
                `Category "${nameCategory}" and rooms of category has been deleted.`,
                "success"
              );
              resolve("delete success");
            } else {
              reject("canelled delete");
            }
          }
        );
      });
    }
  },
  computed: {
    checkEditcategory() {},
    checkCreatecategory() {
      this.errors = {
        name: null
      };
      if (this.categoryCreate.name === "") {
        this.errors.name = "category-Mame is a required field.";
      } else if (
        this.categoryCreate.name != null &&
        this.categoryCreate.name.length < 6
      ) {
        this.errors.name = "category-Name must be greater than 6 characters";
      }
    }
  },
  update() {
    this.checkCreatecategory;
  }
};
</script>
<style >
.errors-create-category > p {
  color: red;
}
</style>
