@extends('layouts.app',['page_title'=>'User Edit'])
@section('content')
<section class="content">
    <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit User</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('users.update',$user->id)}}">
                    @csrf
                    @method('PUT')
                  <div class="card-body">
                   <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="Masterfile">Name</label>
                            <input type="text" value="{{$user->name}}" name="name" class="form-control" id="name" placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" value="{{$user->email}}" name="email" class="form-control" id="email" placeholder="Enter Email">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" name="password" class="form-control" id="password" placeholder="Enter Password">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="Masterfile">Section</label>
                            <select name="section" class="form-control" id="section">
                                <option value="" disabled selected>Select Section</option>
                                @foreach ($sections as $item)
                                    @if ($item->id == $user->section)
                                    <option selected value="{{$item->id}}">{{$item->name}}</option>

                                    @else

                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" class="form-control" id="section">
                                <option value="Section" @if ($user->role == "Section") selected @endif>Section</option>
                                <option @if ($user->role == "Admin") selected  @endif value="Admin" >Admin</option>
                                <option @if ($user->role == "Super Admin") selected  @endif value="Super Admin" >Super Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">

                        <button type="submit" class="btn btn-primary mt-4">Update <i class="fa fa-edit"></i></button>
                    </div>
                   </div>

                  </div>

                </form>
              </div>
            </div>
          </div>
    </div>
</section>
@endsection
