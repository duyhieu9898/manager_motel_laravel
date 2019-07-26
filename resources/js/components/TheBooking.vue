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
          <header>Booking</header>
        </div>
        <div class="card-body">
          <div class="col-lg-12">
            <div class="card-box">
              <div class="card-header">Booking Infomation</div>
              <div class="card-body">
                <div class="row p-b-20">
                  <div class="col-md-6 col-sm-6 col-6">
                    <div class="btn-group">
                      <a href="new_booking.html" id="addRow" class="btn btn-info">
                        Add New
                        <i class="fa fa-plus"></i>
                      </a>
                    </div>
                  </div>

                </div>
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
                                <div class="dataTables_sizing">ID</div>
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
                                <div class="dataTables_sizing">Arrive</div>
                              </th>
                              <th
                                class="center sorting"
                                aria-controls="booking-table"
                                aria-label=" Phone : activate to sort column ascending"
                              >
                                <div class="dataTables_sizing">Depart</div>
                              </th>
                              <th
                                class="center sorting"
                                aria-controls="booking-table"
                                aria-label=" Rent : activate to sort column ascending"
                              >
                                <div class="dataTables_sizing">Room type</div>
                              </th>
                              <th
                                class="center sorting"
                                aria-controls="booking-table"
                                aria-label=" Action : activate to sort column ascending"
                              >
                                <div class="dataTables_sizing">Payment</div>
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
                              v-for="booking in list_booking"
                              :key="booking.id"
                              class="gradeX even"
                              role="row"
                            >
                              <td class="user-circle-img sorting_1">{{ booking.id }}</td>
                              <td class="center">{{ booking.user_name }}</td>
                              <td class="center">{{ booking.user_phone }}</td>
                              <td class="center">
                                <a href="mailto:pooja@gmail.com">{{ booking.user_email }}</a>
                              </td>
                              <td class="center">{{ booking.created_at }}</td>
                              <td class="center">{{ booking.updated_at }}</td>
                              <td class="center">{{ booking.room_title }}</td>
                              <td class="center">
                                <!-- [ true ? setLableByStatus(status) : ''] -->
                                <span
                                  class="label label-sm"
                                  :class="setLableByStatus(booking.status_booking)"
                                >{{ booking.status_booking }}</span>
                              </td>
                              <td class="center">
                                <a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
                                  <i class="fa fa-pencil"></i>
                                </a>
                                <button class="btn btn-tbl-delete btn-xs">
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
      list_booking: {}
    };
  },
  created() {
    this.getListBooking();
  },
  methods: {
    getListBooking() {
      axios
        .get("api/booking")
        .then(response => {
          this.list_booking = response.data.booking;
        })
        .catch(error => {
          console.error(error.response);
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
    }
  }
};
</script>
