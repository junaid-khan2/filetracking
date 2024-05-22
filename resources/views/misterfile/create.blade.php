@extends('layouts.app',['page_title'=>'Master File'])
@section('content')
<section class="content">
    <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Master File</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('masterfile.store')}}">
                    @csrf
                  <div class="card-body">
                   <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <label for="Masterfile">Subject</label>
                            <input type="text" name="name" class="form-control" id="Masterfile" placeholder="Enter Subject">
                          </div>
                    </div>
                    <div class="col-4">

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
