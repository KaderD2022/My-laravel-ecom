@extends('admin_layouts.master')

@section('title')
    Update Slider
@endsection

@section('content')

@if (count($errors) > 0)
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
 
    @endforeach
  </ul>
</div>  
@endif

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Slider</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Slider</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Update slider</h3>
              </div>
                @if (Session::has('status'))
                <br>
                <div class="alert alert-success">
                  <strong>{{ Session::get('status') }}</strong>
                </div>  
                @endif

              <!-- /.card-header -->
              <!-- form start -->
              <form action=" {{url('/admin/updateslider/'.$slider->id)}} "  method="POST" enctype="multipart/form-data" id="sliderForm">
                @csrf

                @method("PUT")
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Slider description 1</label>
                    <input type="text" name="description1" value="{{$slider->description1}}" class="form-control" id="exampleInputEmail1" placeholder="Enter slider description" required >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Slider description 2</label>
                    <input type="text" name="description2" value="{{$slider->description2}}" class="form-control" id="exampleInputEmail1" placeholder="Enter slider description" required>
                  </div>
                  <label for="exampleInputFile">Slider image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file"  name="image" class="custom-file-input" id="exampleInputFile" >
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <!-- <button type="submit" class="btn btn-warning">Submit</button> -->
                  <input type="submit" class="btn btn-warning" value="Update" >
                </div>
              </form>
            </div>
            <!-- /.card --> 
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection
