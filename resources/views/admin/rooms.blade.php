@extends('../layouts.admin')
@section('content-page')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">All Bookings</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="">Booking</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">All Bookings</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>All Bookings</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="row p-b-20">
                            <div class="col-md-6 col-sm-6 col-6">
                                <div class="btn-group">
                                    <a href="add_room.html" id="addRow" class="btn btn-info">
                                        Add New <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6">
                                <div class="btn-group pull-right">
                                    <a class="btn deepPink-bgcolor  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-print"></i> Print </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="table-scrollable">
                            <table class="table table-hover table-checkable order-column full-width" id="example4">
                                <thead>
                                    <tr>
                                        <th class="center"> # </th>
                                        <th class="center"> Type </th>
                                        <th class="center"> Title </th>
                                        <th class="center"> Area </th>
                                        <th class="center"> People </th>
                                        <th class="center"> Rent </th>
                                        <th class="center"> Province </th>
                                        <th class="center"> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach ($rooms as $room)
										<tr class="odd gradeX">
	                                        <td class="center">{{ $room->id }}</td>
	                                        <td class="center">{{ $room->category->name }}</td>
	                                        <td class="center">{{ $room->title }}</td>
                                            <td class="center">{{ $room->address->province->name }}</td>
	                                        <td class="center">{{ $room->room_area }}m</td>
	                                        <td class="center">{{ $room->maximum_peoples_number }}</td>
	                                        <td class="center">{{ $room->price }} vnd</td>

	                                        <td class="center">
	                                            <a href="{{ route('room-edit',$room->id) }}" class="btn btn-tbl-edit btn-xs">
	                                                <i class="fa fa-pencil"></i>
	                                            </a>
	                                            <a class="btn btn-tbl-delete btn-xs">
	                                                <i class="fa fa-trash-o "></i>
	                                            </a>
	                                        </td>
                                    	</tr>
                                	@endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
