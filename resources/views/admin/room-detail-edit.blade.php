@extends('../layouts.admin')
@section('content-page')
<div id="app" class="page-content-wrapper">
    <div class="page-content" style="min-height:1639px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Edit Room Details</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="">Rooms</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Edit Room Details</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-head">
                        <header>Room No {{ $room['id'] }}</header>
                        <div class="mdl-menu__container is-upgraded">
                            <div class="mdl-menu__outline mdl-menu--bottom-right"></div>
                            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect mdl-js-ripple-effect--ignore-events" data-mdl-for="panel-button" data-upgraded=",MaterialMenu,MaterialRipple">
                                <li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1" data-upgraded=",MaterialRipple"><i class="material-icons">assistant_photo</i>Action<span class="mdl-menu__item-ripple-container"><span class="mdl-ripple"></span></span>
                                </li>
                                <li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1" data-upgraded=",MaterialRipple"><i class="material-icons">print</i>Another action<span class="mdl-menu__item-ripple-container"><span class="mdl-ripple"></span></span>
                                </li>
                                <li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1" data-upgraded=",MaterialRipple"><i class="material-icons">favorite</i>Something else here<span class="mdl-menu__item-ripple-container"><span class="mdl-ripple"></span></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body ">
                        <form class='row' method='POST' action="{{ route('room-update',$room['id'] )}}">
                            @csrf @method('PUT')
                            <div class="col-lg-12 p-t-20">
                                <div class="card-box">
                                    <div class="card-header">Room Infomation</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" style="width: 124px;">
                                                    <select name="category_id" id="category-room" class="mdl-textfield__input">
                                                        @foreach ($categories as $category)
                                                        @if ($category['name']==$room['category']['name'])
                                                        <option selected>{{ $category['name'] }}</option>
                                                        @else
                                                        <option>{{ $category['name'] }}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    <label for="category-room" class="pull-right margin-0">
                                                        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                                    </label>
                                                    <label for="category-room" class="mdl-textfield__label">Room Type</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">
                                                    <input name="room_title" class="mdl-textfield__input" type="text" value="{{ $room['title'] }}">
                                                    <label class="mdl-textfield__label">Room Title</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">
                                                    <input name="room_area" class="mdl-textfield__input" type="text" value="{{ $room['room_area'] }}">
                                                    <label class="mdl-textfield__label">Room Area</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">
                                                    <input name="maximum_peoples_number" class="mdl-textfield__input" type="text" value="{{ $room['maximum_peoples_number'] }}">
                                                    <label class="mdl-textfield__label">Room People</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">
                                                    <input name="room_price" class="mdl-textfield__input" type="text" value="{{ $room['price'] }}">
                                                    <label class="mdl-textfield__label">Room Rent</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 p-t-20">
                                                <address-form-component></address-form-component>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 p-t-20">
                                <div class="card-box">
                                    <div class="card-header">Room Description</div>
                                    <div class="">
                                        <textarea name="description" class="ckeditor mdl-textfield__input" id="description" cols="30" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 p-t-20">
                                <div class="card-box">
                                    <div class="card-header">Room Police And Term</div>
                                    <div class="">
                                        <textarea name="police_and_terms" class="ckeditor" id="police_and_terms"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 p-t-20">
                                <div class="card-box txt-full-width is-dirty is-upgraded">
                                    <div class="card-header">Room Convenients</div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($convenients as $convenient)
                                            @if (in_array($convenient['id'],$arrListConvenientsId))
                                            <div style="margin-top:6px;margin-left:0px" class="col-md-4 col-sm-4 col-xs-6">
                                                <input id="convenient_id_{{ $convenient['id'] }}" type="checkbox" name="convenient_id_{{ $convenient['id'] }}" checked>
                                                <label for="convenient_id_{{ $convenient['id'] }}" class="text-left go-text-right size14">{{$convenient['name'] }}</label>
                                            </div>
                                            @else
                                            <div style="margin-top:6px;margin-left:0px" class="col-md-4 col-sm-4 col-xs-6">
                                                <input id="convenient_id_{{ $convenient['id'] }}" type="checkbox" name="convenient_id_{{ $convenient['id'] }}">
                                                <label for="convenient_id_{{ $convenient['id'] }}" class="text-left go-text-right size14">{{$convenient['name'] }}</label>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 p-t-20">
                                <room-photo-component></room-photo-component>
                            </div>
                            <div class="col-lg-12 p-t-20 text-center">
                                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink" data-upgraded=",MaterialButton,MaterialRipple">Submit<span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
                                <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default" data-upgraded=",MaterialButton,MaterialRipple">Cancel<span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--passing data-->
<input id="js_room_id" type="hidden" value="{{ $room['id'] }}">
<input id="js_url_path_upload" type="hidden" value="{{ route('upload-image', $room['id'])}}">
<input id="js_url_path_delete" type="hidden" value="{{ route('delete-image')}}">
@endsection
@section('css')
<!-- my style -->
<link href="{!! asset('css/admin-rooms.css') !!}" rel="stylesheet" media="screen">
<!-- dropzone -->
<link href="{!! asset('admin_rooms/plugins/dropzone/dropzone.css') !!}" rel="stylesheet" media="screen">
@endsection
@section('script')
<!-- app -->
<script src="{!! asset('/js/app.js') !!}"></script>
<!-- dropzone -->
<script src="{!! asset('admin_rooms/plugins/dropzone/dropzone.js') !!}"></script>
<script src="{!! asset('admin_rooms/plugins/dropzone/dropzone-option.js') !!}"></script>
<!-- ckeditor -->
<script src="{!! asset('/ckeditor/ckeditor.js') !!}"></script>
<script type="text/javascript">
$(function() {
    CKEDITOR.instances.description.setData('{{ $room['
        description '] }}');
    CKEDITOR.instances.police_and_terms.setData('{{ $room['
        police_and_terms '] }}');
});

</script>
@endsection
{{-- <select name="room_status_id" id="room-status" class="mdl-textfield__input">
                                                        @foreach ($statusRoom as $status)
                                                        @if ($status['name']==$room['statusRoom']['name'])
                                                        <option selected>{{ $status['name'] }}</option>
                                                        @else
                                                        <option>{{ $status['name'] }}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    <label for="room-status" class="pull-right margin-0">
                                                        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                                    </label>
                                                    <label for="room-status" class="mdl-textfield__label">Status Booking</label> --}}