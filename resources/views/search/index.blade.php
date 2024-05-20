@extends('layouts.app',['page_title'=>'General Search'])
@section('content')
<section class="content">
    <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Search</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                  <div class="card-body">
                   <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="misterfile">Subject</label>
                            <textarea class="form-control textarea" name="" id="" cols="30" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="initiatedby">Initiated By</label>

                            <select class="form-control" name="initiatedby" id="initiatedby">
                                <option value="">User1</option>
                                <option value="">User2</option>
                                <option value="">User3</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="initiatedby">File Type</label>
                            <select class="form-control" name="initiatedby" id="initiatedby">
                                <option value="">File Type1</option>
                                <option value="">File Type2</option>
                                <option value="">File Type3</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="initiatedby">Flag</label>
                            <select class="form-control" name="initiatedby" id="initiatedby">
                                <option value="">Flag 1</option>
                                <option value="">Flag 2</option>
                                <option value="">Flag 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="initiatedby">File Purpose</label>
                            <select class="form-control" name="initiatedby" id="initiatedby">
                                <option value="">File Purpose1</option>
                                <option value="">File Purpose2</option>
                                <option value="">File Purpose3</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="initiatedby">From Date</label>
                            <input type="date" name="" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="initiatedby">To Date</label>
                            <input type="date" name="" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-12 ">
                        <button type="submit" class="btn btn-primary mt-4">Generate Report <i class="fa fa-report"></i></button>
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
