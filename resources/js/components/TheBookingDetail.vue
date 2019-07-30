<template>
  <div class="page-content">
    <div class="page-bar">
      <div class="page-title-breadcrumb">
        <div class="pull-left">
          <div class="page-title">Booking Room</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
          <li>
            <i class="fa fa-home"></i>&nbsp;
            <router-link :to="{ name: 'dash-board'}" class="title">Home</router-link>&nbsp;
            <i class="fa fa-angle-right"></i>
          </li>
          <li class="active">Booking</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card card-box">
          <div class="card-head">
            <header>Booking No {{ booking.booking_id }}</header>
            <div class="col-md-10 col-sm-10 col-10">
              <div class="pull-right">
                <a @click="$router.go(-1)" class="btn btn-primary">Back</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="col-lg-12">
              <div class="card-box">
                <div class="card-header">User info</div>
                <div class="card-body">
                  <div class="table-scrollable">
                    <div
                      id="booking-table_wrapper"
                      class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer"
                    >
                      <div class="row">
                        <div
                          class="dataTables_scrollBody"
                          style="position: relative; overflow: auto; width: 100%;"
                        >
                          <table
                            class="table table-hover table-checkable order-column full-width dataTable no-footer"
                            id="booking-table"
                            role="grid"
                            aria-describedby="booking-table_info"
                            style="width: 1550px;"
                          >
                            <thead>
                              <tr role="row">
                                <th
                                  class="center sorting"
                                  aria-controls="booking-table"
                                  aria-label=" # : activate to sort column ascending"
                                >
                                  <div class="dataTables_sizing">User ID</div>
                                </th>
                                <th class="center sorting">
                                  <div class="dataTables_sizing">User Name</div>
                                </th>
                                <th class="center sorting">
                                  <div class="dataTables_sizing">User Phone</div>
                                </th>
                                <th class="center sorting">
                                  <div class="dataTables_sizing">User Email</div>
                                </th>

                                <th class="center sorting">
                                  <div class="dataTables_sizing">Tenants</div>
                                </th>
                                <th class="center sorting">
                                  <div class="dataTables_sizing">Booking Date</div>
                                </th>
                                <th class="center sorting">
                                  <div class="dataTables_sizing">Arrival Date</div>
                                </th>
                                <th class="center sorting">
                                  <div class="dataTables_sizing">Departure Date</div>
                                </th>
                              </tr>
                            </thead>

                            <tbody>
                              <tr class="gradeX even" role="row">
                                <td class="user-circle-img sorting_1">{{ booking.user_id }}</td>
                                <td class="center">{{ booking.user_name }}</td>
                                <td class="center">{{ booking.user_phone }}</td>
                                <td class="center">{{ booking.user_email }}</td>
                                <td class="center">{{ booking.tenants }}</td>
                                <td class="center">{{ booking.date_booking }}</td>
                                <td class="center">{{ booking.arrival_date}}</td>
                                <td class="center">{{ booking.departure_date}}</td>

                                <!-- <td class="center">
                                <router-link
                                  :to="{ name: 'booking-edit',params: { id: booking.user_id }}"
                                  class="btn btn-primary"
                                >
                                  <i class="fa fa-pencil"></i>
                                </router-link>
                                <button class="btn btn-danger">
                                  <i class="fa fa-trash-o"></i>
                                </button>
                                </td>-->
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- .table-scrollable -->
                </div>
                <!-- .card-body  -->
              </div>
            </div>
            <div class="col-lg-12">
              <div class="card-box">
                <div class="card-header">Room info</div>
                <div class="card-body">
                  <div class="mt-5">
                    <div
                      id="booking-table_wrapper"
                      class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer"
                    >
                      <div class="row">
                        <div
                          class="dataTables_scrollBody"
                          style="position: relative; overflow: auto; width: 100%;"
                        >
                          <table
                            class="table table-hover table-checkable order-column full-width dataTable no-footer"
                            id="booking-table"
                            role="grid"
                            aria-describedby="booking-table_info"
                            style="width: 1550px;"
                          >
                            <thead>
                              <tr role="row">
                                <th class="center sorting" style="width: 5%;">
                                  <div class="dataTables_sizing">Room ID</div>
                                </th>
                                <th class="center sorting" style="width:10%;">
                                  <div class="dataTables_sizing">Image</div>
                                </th>
                                <th class="center sorting" style="width:20%;">
                                  <div class="dataTables_sizing">Room title</div>
                                </th>
                                <th class="center sorting" style="width:10%;">
                                  <div class="dataTables_sizing">People of Room</div>
                                </th>
                                <th class="center sorting" style="width:10%;">
                                  <div class="dataTables_sizing">Price</div>
                                </th>

                                <th class="center sorting" style="width:10%;">
                                  <div class="dataTables_sizing">Room area</div>
                                </th>
                                <th class="center sorting" style="width:15%;">
                                  <div class="dataTables_sizing">province</div>
                                </th>
                              </tr>
                            </thead>

                            <tbody>
                              <tr class="gradeX even" role="row">
                                <td class="center">{{ booking.room_id }}</td>
                                <td class="center">
                                  <div class="box-image">
                                    <img :src="asset(booking.room_image_link)" alt />
                                  </div>
                                </td>
                                <td class="center">{{ booking.room_title }}</td>
                                <td
                                  class="center"
                                >{{ booking.room_peoples}}/{{ booking.room_people_max }}</td>
                                <td class="center">{{ booking.room_price }}</td>
                                <td class="center">{{ booking.room_area }}</td>
                                <td class="center">{{ booking.room_province }}</td>

                                <!-- <td class="center">
                                <router-link
                                  :to="{ name: 'booking-edit',params: { id: booking.user_id }}"
                                  class="btn btn-primary"
                                >
                                  <i class="fa fa-pencil"></i>
                                </router-link>
                                <button class="btn btn-danger">
                                  <i class="fa fa-trash-o"></i>
                                </button>
                                </td>-->
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- .table-scrollable -->
                </div>

                <!-- .card-body  -->
              </div>
              <div class="container mt-5 mb-5">
                <div class="row justify-content-center">
                  <div v-if="!status_booking.isEdit">
                    <p>
                      <strong>Status Booking:</strong>
                      <span
                        class="label"
                        :class="setLableByStatus(status_booking.name)"
                      >{{ status_booking.name }}</span>
                      <button v-if="booking.status_booking!='cancelled'" class="btn btn-primary" @click="status_booking.isEdit = true">Edit</button>
                    </p>

                    <button
                      class="btn btn-danger btn block"
                      @click="deleteBooking(booking.booking_id)"
                    >Delete This Booking</button>
                  </div>
                  <div class="col-lg-5" v-else>
                    <div class="row">
                      <strong>Status Booking:</strong>
                      <select class="form-control col-lg-4" v-model.lazy="status_booking.name">
                        <option value="pending" v-if="status_booking.name==='pending'">pending</option>
                        <option value="completed" >completed</option>
                        <option value="cancelled">cancelled</option>
                      </select>
                      <button
                        class="btn btn-success"
                        @click="updateBooking(booking.booking_id)"
                      >Save</button>
                      <button class="btn btn-danger" @click="status_booking.isEdit = false ">Cancel</button>
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
      booking: {},
      host_name: "",
      status_booking: {
        isEdit: false,
        name: ""
      }
    };
  },
  created() {
    this.host_name = window.location.origin;
    this.booking_id = parseInt(this.$route.params.id);
    this.getBookingById(this.booking_id);
  },
  methods: {
    getBookingById(booking_id) {
      axios
        .get("api/bookings/" + booking_id)
        .then(response => {
          this.booking = response.data.booking;
          this.status_booking.name = response.data.booking.status_booking;
        })
        .catch(error => {
          console.error(error.response);
        });
    },
    updateBooking(booking_id) {
      this.status_booking.isEdit = false;
      if (this.status_booking.name == this.booking.status_booking) {
        console.log("nothing");
      }
     else {
        axios
          .post(`api/bookings/${booking_id}/status-update`, {
            status_name: this.status_booking.name
          })
          .then(response => {
            if (this.status_booking.name == "completed") {
              this.booking.room_peoples =
                this.booking.room_peoples + this.booking.tenants;
              return axios.post(`api/rooms/updatePeople`, {
                room_id: this.booking.room_id,
                number_people: this.booking.room_peoples
              });
            }
          })
          .then(response => {
            console.log(response.data);
          })
          .catch(error => {
            console.error(error.response);
          });
      }
    },
    deleteBooking(booking_id) {
      this.isConfirmDelete(booking_id)
        .then(res => {
          return axios.delete(`api/bookings/${booking_id}`);
        })
        .then(res => {
          this.$router.go(-1);
        })
        .catch(err => {
          console.log(err.response);
        });
    },
    isConfirmDelete(idBooking) {
      return new Promise(function(resolve, reject) {
        swal(
          {
            title: "Are you sure?",
            text: `You will not be able to recover booking no ${idBooking}!`,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: `Yes, delete this booking!`,
            cancelButtonText: "No, cancel",
            closeOnConfirm: false
          },
          function(isConfirm) {
            if (isConfirm) {
              swal(
                "Deleted!",
                `booking no "${idBooking}" has been deleted.`,
                "success"
              );
              resolve("delete success");
            } else {
              reject("canelled delete");
            }
          }
        );
      });
    },
    setLableByStatus(status) {
      if (status == "pending") {
        return "label-info";
      } else if (status == "completed") {
        return "label-success";
      } else {
        return "label-warning";
      }
    },
    asset(fileName) {
      return this.host_name + "/" + fileName;
    }
  }
};
</script>
<style>
.box-image > img {
  max-width: 100%;
}
</style>
