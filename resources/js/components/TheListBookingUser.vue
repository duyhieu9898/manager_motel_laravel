<template>
  <div class="page-content">
    <div class="page-bar">
      <div class="page-title-breadcrumb">
        <div class="pull-left">
          <div class="page-title">User Booking</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
          <li>
            <i class="fa fa-home"></i>&nbsp;
            <a class="parent-item" href="index.html">Home</a>&nbsp;
            <i class="fa fa-angle-right"></i>
          </li>
          <li class="active">Booking</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card-head">
          <header>User Booking</header>
        </div>
        <div class="card-body">
          <div class="col-lg-12">
            <div class="card-box">
              <div class="card-header">User Booking</div>
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
                              <th
                                class="center sorting"
                                aria-controls="booking-table"
                                aria-label=" Type : activate to sort column ascending"
                              >
                                <div class="dataTables_sizing">Name</div>
                              </th>
                              <th
                                class="center sorting"
                                aria-controls="booking-table"
                                aria-label=" AC/Non AC : activate to sort column ascending"
                              >
                                <div class="dataTables_sizing">Phone</div>
                              </th>
                              <th
                                class="center sorting"
                                aria-controls="booking-table"
                                aria-label=" Meal : activate to sort column ascending"
                              >
                                <div class="dataTables_sizing">Mail</div>
                              </th>
                              <th
                                class="center sorting"
                                aria-controls="booking-table"
                                aria-label=" Bad Capacity : activate to sort column ascending"
                              >
                                <div class="dataTables_sizing">Booking date</div>
                              </th>
                              <th
                                class="center sorting"
                                aria-controls="booking-table"
                                aria-label=" Type : activate to sort column ascending"
                              >
                                <div class="dataTables_sizing">Action</div>
                              </th>
                            </tr>
                          </thead>

                          <tbody>
                            <tr
                              v-for="user_booking in list_user_bookings"
                              :key="user_booking.id"
                              class="gradeX even"
                              role="row"
                            >
                              <td class="user-circle-img sorting_1">{{ user_booking.id }}</td>
                              <td class="center">{{ user_booking.name }}</td>
                              <td class="center">{{ user_booking.phone }}</td>
                              <td class="center">
                                <a :href="'mailto:'+user_booking.email">{{ user_booking.email }}</a>
                              </td>
                              <td class="center">{{ user_booking.updated_at }}</td>
                              <td class="center">
                                <router-link
                                  :to="{ name: 'user_booking-edit',params: { id: user_booking.user_id }}"
                                  class="btn btn-primary"
                                >
                                  <i class="fa fa-pencil"></i>
                                </router-link>
                                <button class="btn btn-danger">
                                  <i class="fa fa-trash-o"></i>
                                </button>
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
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      list_user_bookings: {}
    };
  },
  created() {
    this.getListuser_booking();
  },
  methods: {
    getListuser_booking() {
      axios
        .get("api/users/bookings")
        .then(response => {
          this.list_user_bookings = response.data.user_booking;
        })
        .catch(error => {
          console.error(error.response);
        });
    }
  }
};
</script>
