@extends('layouts.app',['page_title'=>'Assign Sections'])
@section('content')
<section class="content">
    <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Assign Section</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('assign.sections') }}">
                    @csrf
                  <div class="card-body">
                   <div class="row">
                    <div class="col-12 mb-2">
                        <label for="user">Select User:</label>
                        <select class="form-control" name="user_id" id="user">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @foreach($sections as $section)
                    <div class="col-3">
                        
                        <div class="form-group">
                            <label>{{ $section->name }}</label>
                            <input type="checkbox" name="section_ids[]" value="{{ $section->id }}">
                        </div>
                       
                    </div>
                    @endforeach
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
