@extends('layouts.app',['page_title'=>'Section Create'])
@section('content')
<section class="content">
    <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Create Section</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('sections.store')}}">
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
                            <label for="code">Code</label>
                            <input type="text" name="code" class="form-control" id="code" placeholder="Enter Code">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="in_out">Internal / External</label>
                            <select name="in_out" class="form-control" id="section">
                                <option value="Internal" selected>Internal</option>
                                <option value="External" >External</option>
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
