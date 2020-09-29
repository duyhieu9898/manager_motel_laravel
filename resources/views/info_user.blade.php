@extends('layouts.app')

@section('main-container')
<div class="container">
    <div class="row">
        <div class="col-lg-8 profile-user" >
            <div class="card" style="border: none;background: none !important;">
                <div class="card-header">
                    <h3 class="card-title">User Information</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="control-label col-lg-3 text-right" for="email">Name:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="username" placeholder="Enter name" value={{ $userData->name }}  />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-lg-3 text-right" for="email">Email:</label>
                        <div class="col-lg-9">
                            <input type="email" class="form-control" name="email"
                                placeholder="Enter email" value={{ $userData->email }} />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-lg-3 text-right" for="tel">Phone:</label>
                        <div  class="col-lg-9">
                            <input type="tel" class="form-control" name="phone"
                                placeholder="Enter Phone" value={{ $userData->phone }} />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-lg-3 text-right" for="tel">Address:</label>
                        <div class="col-lg-9">
                            <input  class="info__address form-control" value="{{ $userData->address }}"
                                placeholder="Enter address of the room" readonly data-toggle="modal"
                                data-target="#adddress--model__edit" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div  class="col-lg-8">
                            <button @click="updateUser(currentUser)" type="submit" class="btn btn-primary">Save
                                info</button>
                            <button @click="isEdit = false" type="submit" class="btn btn-success">Canel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
