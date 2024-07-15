@extends('layouts.app',['page_title'=>'User Create'])
@section('content')
<section class="content">
    <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Create User</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('users.store')}}">
                    @csrf
                  <div class="card-body">
                   <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="Masterfile">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email">
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
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" class="form-control" id="section">
                                <option value="Section" selected>Section</option>
                                <option value="Admin" >Admin</option>
                                <option value="Super Admin" >Super Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">

                        <button type="submit" class="btn btn-primary mt-4">Save <i class="fa fa-save"></i></button>
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
