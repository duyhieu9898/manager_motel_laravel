<template>
  <div class="page-content">
    <div class="page-bar">
      <div class="page-title-breadcrumb">
        <div class="pull-left">
          <div class="page-title">Add New Details</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
          <li>
            <i class="fa fa-home"></i>&nbsp;
             <router-link :to="{ name: 'dash-board'}" class="title">
              Home
            </router-link>&nbsp;
            <i class="fa fa-angle-right"></i>
          </li>
          <li>
            <router-link :to="{ name: 'all-room'}" class="title">
              Room&nbsp;
              <i class="fa fa-angle-right"></i>
            </router-link>
          </li>
          <li class="active">Add New Room</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-head">
            <header>Add New Room</header>
            <div class="mdl-menu__container is-upgraded">
              <div class="mdl-menu__outline mdl-menu--bottom-right"></div>
              <ul
                class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect mdl-js-ripple-effect--ignore-events"
                data-mdl-for="panel-button"
                data-upgraded=",MaterialMenu,MaterialRipple"
              >
                <li
                  class="mdl-menu__item mdl-js-ripple-effect"
                  tabindex="-1"
                  data-upgraded=",MaterialRipple"
                >
                  <i class="material-icons">assistant_photo</i>Action
                  <span class="mdl-menu__item-ripple-container">
                    <span class="mdl-ripple"></span>
                  </span>
                </li>
                <li
                  class="mdl-menu__item mdl-js-ripple-effect"
                  tabindex="-1"
                  data-upgraded=",MaterialRipple"
                >
                  <i class="material-icons">print</i>Another action
                  <span class="mdl-menu__item-ripple-container">
                    <span class="mdl-ripple"></span>
                  </span>
                </li>
                <li
                  class="mdl-menu__item mdl-js-ripple-effect"
                  tabindex="-1"
                  data-upgraded=",MaterialRipple"
                >
                  <i class="material-icons">favorite</i>Something else here
                  <span class="mdl-menu__item-ripple-container">
                    <span class="mdl-ripple"></span>
                  </span>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div class="col-lg-12 p-t-20">
              <div class="card-box">
                <div class="card-header">Room Infomation</div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-6 p-t-20">
                      <div
                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width is-dirty is-upgraded"
                        data-upgraded=",MaterialTextfield"
                        style="width: 124px;"
                      >
                        <select
                          v-model="room.category_id"
                          class="mdl-textfield__input category-room"
                        >
                          <option hidden>Chose type of the room</option>
                          <option
                            v-for="category in list_categories"
                            :key="category.id"
                            :value="category.id"
                          >{{ category.name }}</option>
                        </select>
                        <label for="category-room" class="pull-right margin-0">
                          <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                        </label>
                        <label for="category-room" class="mdl-textfield__label">Room Type</label>
                        <div class="errors" v-if="errors.category_id">
                          <p>{{ errors.category_id[0] }}</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 p-t-20">
                      <div
                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded"
                        data-upgraded=",MaterialTextfield"
                      >
                        <input
                          type="text"
                          class="mdl-textfield__input"
                          v-model.trim="room.title"
                          placeholder="Enter title of the room"
                        />
                        <label class="mdl-textfield__label">Room Title</label>
                        <div class="errors" v-if="errors.title ">
                          <p>{{ errors.title[0] }}</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 p-t-20">
                      <div
                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded"
                        data-upgraded=",MaterialTextfield"
                      >
                        <money
                          v-model="room.room_area"
                          v-bind="size"
                          class="mdl-textfield__input"
                          maxlength="6"
                        ></money>
                        <label class="mdl-textfield__label">Room Area</label>
                        <div class="errors" v-if="errors.room_area">
                          <p>{{ errors.room_area[0] }}</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 p-t-20">
                      <div
                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded"
                        data-upgraded=",MaterialTextfield"
                      >
                        <money
                          v-model="room.maximum_peoples_number"
                          v-bind="people"
                          class="mdl-textfield__input"
                          maxlength="15"
                        ></money>
                        <label class="mdl-textfield__label">Room People</label>
                        <div class="errors" v-if="errors.maximum_peoples_number">
                          <p>{{ errors.maximum_peoples_number[0] }}</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 p-t-20">
                      <div
                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded"
                        data-upgraded=",MaterialTextfield"
                      >
                        <!-- <input type="number"  v-model.lazy="dataRoomEdit.price" > -->
                        <money
                          v-model="room.price"
                          v-bind="money"
                          class="mdl-textfield__input"
                          maxlength="14"
                        ></money>
                        <label class="mdl-textfield__label">Room Price</label>
                        <div class="errors" v-if="errors.price">
                          <p>{{ errors.price[0] }}</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 p-t-20">
                      <!--emit address id -->
                      <room-address-component @address-id="getAddressId"></room-address-component>
                      <div class="errors" v-if="errors.address_id">
                        <p>{{ errors.address_id[0] }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12 p-t-20">
              <div class="card-box">
                <div class="card-header">Room Description</div>
                <div class>
                  <ckeditor
                    :editor="editor"
                    v-model.lazy.trim="room.description"
                    :config="editorConfig"
                  ></ckeditor>
                </div>
                <div class="errors" v-if="errors.description">
                  <p>{{ errors.description[0] }}</p>
                </div>
              </div>
            </div>
            <div class="col-lg-12 p-t-20">
              <div class="card-box">
                <div class="card-header">Room Police And Term</div>
                <div class>
                  <ckeditor
                    :editor="editor"
                    v-model.lazy.trim="room.police_and_terms"
                    :config="editorConfig"
                  ></ckeditor>
                </div>
                <div class="errors" v-if="errors.police_and_terms">
                  <p>{{ errors.police_and_terms[0] }}</p>
                </div>
              </div>
            </div>
            <div class="col-lg-12 p-t-20">
              <div class="card-box txt-full-width is-dirty is-upgraded">
                <div class="card-header">Room Convenients</div>
                <div class="card-body">
                  <div class="row">
                    <room-convenients-component
                      :convenients="list_convenients"
                      @arr-convenients-id="getArrConvenientsId"
                    ></room-convenients-component>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12 p-t-20">
              <room-photo-component @arr-images-id="getArrImagesId"></room-photo-component>
              <div class="errors" v-if="errors.list_images_id">
                <p>{{ errors.list_images_id[0] }}</p>
              </div>
            </div>
            <div class="col-lg-12 p-t-20 text-center">
              <button
                @click="saveRoom()"
                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink"
              >
                Submit
                <span class="mdl-button__ripple-container">
                  <span class="mdl-ripple"></span>
                </span>
              </button>
              <button
                @click="$router.go(-1)"
                type="button"
                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default"
              >
                Cancel
                <span class="mdl-button__ripple-container">
                  <span class="mdl-ripple"></span>
                </span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {
        toolbar: [
          "heading",
          "|",
          "bold",
          "italic",
          "link",
          "bulletedList",
          "numberedList",
          "blockQuote",
          "insertTable"
        ]
      },
      list_categories: [],
      list_convenients: [],
      placeholder: {
        title: "Enter title of the room",
        address: "Enter address of the room"
      },
      room: {
        category_id: "Chose type of the room",
        address_id: null,
        title: null,
        room_area: 0,
        maximum_peoples_number: 1,
        price: 0,
        description: null,
        police_and_terms: null,
        address_id: null,
        list_convenients_id: [],
        list_images_id: []
      },
      host_name: "",
      errors: {
        address_id: null,
        category_id: null,
        title: null,
        room_area: null,
        maximum_peoples_number: null,
        price: null,
        room_area: null,
        description: null,
        police_and_terms: null,
        list_images_id: null,
        check: true,
        on: false
      },
      money: {
        decimal: ",",
        thousands: ",",
        suffix: " VNĐ",
        precision: 0,
        masked: false
      },
      size: {
        decimal: ",",
        thousands: ",",
        precision: 0,
        suffix: " M",
        masked: false
      },
      people: {
        decimal: ",",
        thousands: ",",
        precision: 0,
        suffix: " Pleople/Room",
        masked: false
      }
    };
  },
  created() {
    this.getFormData();
  },
  methods: {
    getFormData() {
      axios
        .get("/api/rooms/create")
        .then(res => {
          this.list_categories = res.data.categories;
          this.list_convenients = res.data.convenients;
        })
        .catch(err => {
          console.log(err.response.data);
        });
    },
    getArrConvenientsId(arrConvenientsId) {
      this.room.list_convenients_id = arrConvenientsId;
    },
    getAddressId(addressId) {
      this.room.address_id = addressId;
    },
    getArrImagesId(arrImagesId) {
      this.room.list_images_id = arrImagesId;
    },
    saveRoom() {
      if (this.errors.check) {
        axios
          .post(this.host_name + "/api/rooms/", {
            category_id: this.room.category_id,
            address_id: this.room.address_id,
            title: this.room.title,
            description: this.room.description,
            room_area: this.room.room_area,
            maximum_peoples_number: this.room.maximum_peoples_number,
            police_and_terms: this.room.police_and_terms,
            list_convenients_id: this.room.list_convenients_id,
            list_images_id: this.room.list_images_id,
            price: this.room.price
          })
          .then(res => {
            console.log(res);
            history.back();
          })
          .catch(err => {
            console.log(err.response.data);
            this.errors = err.response.data.errors;
            this.errors.on = true;
          });
      }
    }
  },
  watch: {
    room: {
      handler: function() {
        if (!this.errors.on) {
          console.log("on off");
          this.errors = {
            address_id: null,
            category_id: null,
            title: null,
            room_area: null,
            maximum_peoples_number: null,
            price: null,
            description: null,
            police_and_terms: null,
            list_images_id: null,
            check: true
          };
          if (this.room.title === "") {
            this.errors.title = ["Please enter Title."];
            this.errors.check = false;
          } else if (
            this.room.title !== null &&
            this.room.title.split(" ").length < 5
          ) {
            this.errors.title = ["Title at least 5 words."];
            this.errors.check = false;
          }
          if (this.room.room_area < 10 && this.room.room_area != 0) {
            this.errors.room_area = ["Room area is too small."];
            this.errors.check = false;
          }
          if (this.room.maximum_peoples_number === 0) {
            this.errors.maximum_peoples_number = [
              "Please enter Number of peoples."
            ];
            this.errors.check = false;
          }
          if (this.room.description === "") {
            this.errors.description = ["Please enter Description."];
            this.errors.check = false;
          }
          if (this.room.police_and_terms === "") {
            this.errors.police_and_terms = ["Please enter PoliceAndTerms."];
            this.errors.check = false;
          }
        } else {
          console.log("on on");

          this.errors = {
            address_id: null,
            category_id: null,
            title: null,
            room_area: null,
            maximum_peoples_number: null,
            price: null,
            description: null,
            police_and_terms: null,
            list_images_id: null,
            category_id: null,
            check: true,
            on: true
          };

          if (!Number.isInteger(this.room.category_id)) {
            this.errors.category_id = ["The room category field is required."];
            this.errors.category_id = false;
          }

          if (this.room.title === "" || this.room.title === null) {
            this.errors.title = ["The room title field is required."];
            this.errors.check = false;
          } else if (
            this.room.title !== null &&
            this.room.title.split(" ").length < 5
          ) {
            this.errors.title = ["Title at least 5 words."];
            this.errors.check = false;
          }
          if (this.room.price === 0) {
            this.errors.price = ["The room price field is required."];
            this.errors.check = false;
          }
          if (this.room.room_area < 10) {
            this.errors.room_area = ["The room area field is required."];
            this.errors.check = false;
          }
          if (this.room.maximum_peoples_number === 0) {
            this.errors.maximum_peoples_number = [
              "The people field is required."
            ];
            this.errors.check = false;
          }
          if (this.room.description === "" || this.room.description === null) {
            this.errors.description = [
              "The police and terms field is required."
            ];
            this.errors.check = false;
          }
          if (
            this.room.police_and_terms === "" ||
            this.room.description === null
          ) {
            this.errors.police_and_terms = [
              "The police and terms field is required."
            ];
            this.errors.check = false;
          }
          if (this.room.list_images_id.length == 0) {
            this.errors.list_images_id = ["Please enter PoliceAndTerms."];
            this.errors.check = false;
          }
          if (this.room.address_id === null) {
            this.errors.address_id = ["The room address field is required."];
            this.errors.check = false;
          }
        }
      },
      deep: true
    }
  }
};
</script>
<style>
@import "../../../public/admin_rooms/plugins/dropzone/dropzone.css";
.image-room {
  border-radius: 5px;
  overflow: hidden;
  height: 242px;
  position: relative;
  border: 2px solid #c7b78c;
}

.image-room img {
  max-width: 100%;
  position: absolute;
  margin: auto;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}
</style>
