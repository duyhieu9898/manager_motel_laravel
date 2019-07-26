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
          <li>
            <router-link :to="{ name: 'all-room'}" class="title">
              Room&nbsp;
              <i class="fa fa-angle-right"></i>
            </router-link>
          </li>
          <li class="active">User</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card-head">
          <header>Room No {{ room.id }}</header>
        </div>
        <div class="card-body">
          <div class="col-lg-12">
            <div class="card-box">
              <div class="card-header">User Infomation</div>
              <div class="card-body">
                <div class="row"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
