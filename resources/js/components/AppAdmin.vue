<template>
  <div class="admin-app">
    <!-- start header -->
    <div class="page-header navbar navbar-fixed-top">
      <div class="page-header-inner">
        <!-- logo start -->
        <div class="page-logo">
          <a :href="host_name">
            <img alt :src="asset('admin_rooms/img/logo.png')" />
            <span class="logo-default">Motel</span>
          </a>
        </div>
        <!-- logo end -->
        <ul class="nav navbar-nav navbar-left in">
          <li>
            <a href="#" class="menu-toggler sidebar-toggler">
              <i class="icon-menu"></i>
            </a>
          </li>
        </ul>
        <!-- start mobile menu -->
        <a
          href="javascript:;"
          class="menu-toggler responsive-toggler"
          data-toggle="collapse"
          data-target=".navbar-collapse"
        >
          <span></span>
        </a>
        <!-- end mobile menu -->
        <!-- start header menu -->
        <div class="top-menu">
          <ul class="nav navbar-nav pull-right">
            <!-- start notification dropdown -->
            <li
              class="dropdown dropdown-extended dropdown-notification"
              id="header_notification_bar"
            >
              <a
                href="javascript:;"
                class="dropdown-toggle"
                data-toggle="dropdown"
                data-hover="dropdown"
                data-close-others="true"
              >
                <i class="fa fa-bell-o"></i>
                <span class="badge headerBadgeColor1">6</span>
              </a>
              <ul class="dropdown-menu animated swing">
                <li class="external">
                  <h3>
                    <span class="bold">Notifications</span>
                  </h3>
                  <span class="notification-label purple-bgcolor">New 6</span>
                </li>
                <li>
                  <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
                    <li>
                      <a href="javascript:;">
                        <span class="time">just now</span>
                        <span class="details">
                          <span class="notification-icon circle deepPink-bgcolor">
                            <i class="fa fa-check"></i>
                          </span> Congratulations!.
                        </span>
                      </a>
                    </li>
                    <li>
                      <a href="javascript:;">
                        <span class="time">3 mins</span>
                        <span class="details">
                          <span class="notification-icon circle purple-bgcolor">
                            <i class="fa fa-user o"></i>
                          </span>
                          <b>John Micle</b>is now following you.
                        </span>
                      </a>
                    </li>
                    <li>
                      <a href="javascript:;">
                        <span class="time">7 mins</span>
                        <span class="details">
                          <span class="notification-icon circle blue-bgcolor">
                            <i class="fa fa-comments-o"></i>
                          </span>
                          <b>Sneha Jogi</b>sent you a message.
                        </span>
                      </a>
                    </li>
                    <li>
                      <a href="javascript:;">
                        <span class="time">12 mins</span>
                        <span class="details">
                          <span class="notification-icon circle pink">
                            <i class="fa fa-heart"></i>
                          </span>
                          <b>Ravi Patel</b>like your photo.
                        </span>
                      </a>
                    </li>
                    <li>
                      <a href="javascript:;">
                        <span class="time">15 mins</span>
                        <span class="details">
                          <span class="notification-icon circle yellow">
                            <i class="fa fa-warning"></i>
                          </span> Warning!
                        </span>
                      </a>
                    </li>
                    <li>
                      <a href="javascript:;">
                        <span class="time">10 hrs</span>
                        <span class="details">
                          <span class="notification-icon circle red">
                            <i class="fa fa-times"></i>
                          </span> Application error.
                        </span>
                      </a>
                    </li>
                  </ul>
                  <div class="dropdown-menu-footer">
                    <a href="javascript:void(0)">All notifications</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- end notification dropdown -->
            <!-- start message dropdown -->
            <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
              <a
                href="javascript:;"
                class="dropdown-toggle"
                data-toggle="dropdown"
                data-hover="dropdown"
                data-close-others="true"
              >
                <i class="fa fa-envelope-o"></i>
                <span class="badge headerBadgeColor2">2</span>
              </a>
              <ul class="dropdown-menu animated slideInDown">
                <li class="external">
                  <h3>
                    <span class="bold">Messages</span>
                  </h3>
                  <span class="notification-label cyan-bgcolor">New 2</span>
                </li>
                <li>
                  <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
                    <li>
                      <a href="#">
                        <span class="photo">
                          <img
                            :src="asset('admin_rooms/img/user/user2.jpg')"
                            class="img-circle"
                            alt
                          />
                        </span>
                        <span class="subject">
                          <span class="from">Sarah Smith</span>
                          <span class="time">Just Now</span>
                        </span>
                        <span class="message">Jatin I found you on LinkedIn...</span>
                      </a>
                    </li>
                  </ul>
                  <div class="dropdown-menu-footer">
                    <a href="#">All Messages</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- end message dropdown -->
            <!-- start manage user dropdown -->
            <li class="dropdown dropdown-user">
              <a
                href="javascript:;"
                class="dropdown-toggle"
                data-toggle="dropdown"
                data-hover="dropdown"
                data-close-others="true"
              >
                <img alt class="img-circle" :src="asset('admin_rooms/img/dp.jpg')" />
                <span class="username username-hide-on-mobile">{{ currentUser.name }}</span>
                <i class="fa fa-angle-down"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-default animated jello">
                <li>
                  <a href="/profile">
                    <i class="icon-user"></i> Profile
                  </a>
                </li>
                <li>
                  <a href="/logout">
                    <i class="icon-logout"></i> Log Out
                  </a>
                </li>
              </ul>
            </li>
            <!-- end manage user dropdown -->
          </ul>
        </div>
      </div>
    </div>
    <!-- end header -->
    <!-- start page container -->
    <div class="page-container">
      <!-- start sidebar menu -->
      <div class="sidebar-container">
        <div class="sidemenu-container navbar-collapse collapse fixed-menu">
          <div id="remove-scroll">
            <ul
              class="sidemenu page-header-fixed p-t-20"
              data-keep-expanded="false"
              data-auto-scroll="true"
              data-slide-speed="200"
            >
              <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                  <span></span>
                </div>
              </li>
              <li class="sidebar-user-panel">
                <div class="user-panel">
                  <div class="row">
                    <div class="sidebar-userpic">
                      <img :src="asset('admin_rooms/img/dp.jpg')" class="img-responsive" alt />
                    </div>
                  </div>
                  <div class="profile-usertitle">
                    <div class="sidebar-userpic-name">{{ currentUser.name }}</div>
                    <div class="profile-usertitle-job">Manager</div>
                  </div>
                  <div class="sidebar-userpic-btn">
                    <a
                      class="tooltips"
                      href="/profile"
                      data-placement="top"
                      data-original-title="Profile"
                    >
                      <i class="material-icons">person_outline</i>
                    </a>
                    <a
                      class="tooltips"
                      href="email_inbox.html"
                      data-placement="top"
                      data-original-title="Mail"
                    >
                      <i class="material-icons">mail_outline</i>
                    </a>
                    <a
                      class="tooltips"
                      href="chat.html"
                      data-placement="top"
                      data-original-title="Chat"
                    >
                      <i class="material-icons">chat</i>
                    </a>
                    <a
                      class="tooltips"
                      href="/logout"
                      data-placement="top"
                      data-original-title="Logout"
                    >
                      <i class="material-icons">input</i>
                    </a>
                  </div>
                </div>
              </li>
              <li class="menu-heading">
                <span>-- Main</span>
              </li>
              <li class="nav-item start js-route-link">
                <router-link :to="{ name: 'dash-board'}" class="nav-link nav-toggle">
                  <span class="title">Dashboard</span>
                  <span class="selected"></span>
                </router-link>
              </li>
              <li class="nav-item js-route-link">
                <router-link :to="{ name: 'categories'}">
                  <i class="material-icons">widgets</i>
                  <span class="title">Category</span>
                  <span class="selected"></span>
                </router-link>
              </li>
              <li class="nav-item js-route-link">
                <router-link :to="{ name: 'list-bookings'}">
                  <i class="material-icons">business_center</i>
                  <span class="title">Booking</span>
                  <span class="selected"></span>
                </router-link>
              </li>
              <li class="nav-item js-route-link">
                <router-link :to="{ name: 'all-room'}" class="nav-link nav-toggle">
                  <i class="material-icons">vpn_key</i>
                  <span class="title">Rooms</span>
                  <span class="selected"></span>
                </router-link>
              </li>
              <li class="nav-item js-route-link">
                <router-link :to="{ name: 'user'}">
                  <i class="material-icons">group</i>
                  <span class="title">User</span>
                  <span class="selected"></span>
                </router-link>
              </li>
              <li class="nav-item js-route-link">
                 <router-link :to="{ name: 'user'}">
                  <i class="material-icons">store</i>
                  <span class="title">Convenients</span>
                  <span class="selected"></span>
                </router-link>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- end sidebar menu -->
      <!-- start page content -->
      <div class="page-content-wrapper">
        <transition name="fade-down" mode="out-in" appear>
            <router-view></router-view>
        </transition>
      </div>
      <!-- end page content -->
    </div>

    <!-- start footer -->
    <!-- end page container -->
    <div class="page-footer">
      <div class="page-footer-inner">
        2018 &copy; Spice Hotel Template By
        <a
          href="mailto:redstartheme@gmail.com"
          target="_top"
          class="makerCss"
        >RedStar Theme</a>
      </div>
      <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
      </div>
    </div>
    <!-- end footer -->
  </div>
</template>
<script>
export default {
  data() {
    return {
      host_name: "",
      currentUser:{
          name:''
      }
    };
  },
  created() {
    this.host_name = window.location.origin;
    this.getCurrentUser()
  },
  mounted() {
    $(".js-route-link").click(function(e) {
      $(".js-route-link").removeClass("active");
      e.currentTarget.classList.add("active");
    });
  },
  methods: {
    asset(fileName) {
      return this.host_name + "/" + fileName;
    },
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
  }
};
</script>
<style lang="css">
.errors > p {
  margin: 0 !important;
  color: #dc3545;
  font-size: 14px;
}
.fade-down-enter-active {
  animation-name: fadeInDown;
  animation-duration: 0.5s;
}
.fade-down-leave-active {
  animation-name: fadeOutDown;
  animation-duration: 0.4s;
}

@keyframes fadeInDown {
  from {
    transform: translate3d(50px, 0, 0);
  }
  to {
    transform: none;
  }
}

@keyframes fadeOutDown {
  from {
    transform: none;
  }
  to {
    transform: translate3d(50px, 0, 0);
  }
}
</style>
