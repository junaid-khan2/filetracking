@extends('layouts.app',['page_title'=>'Edit Sections'])
@section('content')
<section class="content">
    <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Sections for {{ $user->name }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('update.user.sections', $user->id) }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                  <div class="card-body">
                   <div class="row">
                    <div class="col-12 mb-2">
                        <label for="user">Select User:</label>
                        <select class="form-control" name="user_id_disabled" id="user" disabled>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}" {{ $u->id == $user->id ? 'selected' : '' }}>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @foreach($sections as $section)
                    <div class="col-3">
                        <div class="form-group">
                            <input type="checkbox" name="section_ids[]" value="{{ $section->id }}"
                                {{ $user->multiSection->contains($section->id) ? 'checked' : '' }}>
                            <label>{{ $section->name }}</label>
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
