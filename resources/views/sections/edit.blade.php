@extends('layouts.app',['page_title'=>'Section Edit'])
@section('content')
<section class="content">
    <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Section</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('sections.update',$sections->id)}}">
                    @csrf
                    @method('PUT')
                  <div class="card-body">
                   <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="Masterfile">Name</label>
                            <input type="text" name="name" value="{{$sections->name}}" class="form-control" id="name" placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" name="code" value="{{$sections->code}}" class="form-control" id="code" placeholder="Enter Code">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="in_out">Internal / External</label>
                            <select name="in_out" class="form-control" id="section">
                                <option value="Internal" @if($sections->in_out == "Internal") selected @endif>Internal</option>
                                <option value="External" @if($sections->in_out == "External") selected @endif>External</option>
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
