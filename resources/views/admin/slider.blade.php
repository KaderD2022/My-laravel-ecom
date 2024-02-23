@extends('admin_layouts.master')

@section('title')
    Account
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
            <h1>Sliders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sliders</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Sliders</h3>
              </div>
                @if (Session::has('status'))
                <br>
                <div class="alert alert-success">
                  <strong>{{ Session::get('status') }}</strong>
                </div>  
                @endif
              <input type="hidden" {{$increment=1}}>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Num.</th>
                    <th>Picture</th>
                    <th>Description one</th>
                    <th>Description Two</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($sliders as $slider)
                  <tr>
                    <td>{{$increment}}</td>
                    <td>
                      <img src="{{asset('storage/slider_images/'.$slider->image)}}" style="height : 50px; width : 50px" class="img-circle elevation-2" alt="User Image">
                    </td>
                    <td>
                      {{$slider->description1}}
                      
                    </td>
                    <td>
                      {{$slider->description2}}
                    </td>
                    <td>
                      @if ($slider->status == 1)
                        <form action=" {{url('/admin/unactivateslider/'.$slider->id)}} " method="POST">
                          @csrf
                          @method('PUT')
                          <input type="submit" value="Desactivate" class="btn btn-success">
                          
                        </form>
                        
                      @else
                        <form action=" {{url('/admin/activateslider/'.$slider->id)}} " method="POST">
                          @csrf
                          @method('PUT')
                          <input type="submit" value="Activate" class="btn btn-warning">
                          
                        </form>
                        

                      @endif
                      
                       <form action="{{ url('/admin/deleteslider/'.$slider->id)}}" method="POST" class="pull-right">
                          @csrf
                          @method("DELETE")
                          <input type="submit" value="Delete" href="#" id="delete" class="btn  btn-danger" >
                          {{-- <a href="#" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a> --}}

                        </form>
                         <a href="{{ url('/admin/editslider/'.$slider->id)}}" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a>
                      
                      
                    </td>
                  </tr>
                  <input type="hidden" {{$increment++}}>
                  @endforeach

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Num.</th>
                    <th>Picture</th>
                    <th>Description one</th>
                    <th>Description Two</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



@endsection
@section('scripts')
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('backend/dist/js/demo.js')}}"></script>
<script src="{{asset('backend/dist/js/bootbox.min.js')}}"></script>

<script src="{{asset('backend/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/responsive/bootstrap4.min.js')}}"></script>


<!-- jQuery -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- jquery-validation -->
<script src="{{asset('backend/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('backend/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->

<script src="{{asset('backend/dist/js/demo.js')}}"></script>
<script>
$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });
  $('#quickForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5
      },
      terms: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
{{-- <script>
  $(document).on("click", "#delete", function(e){
  e.preventDefault();
  var link = $(this).attr("href");
  bootbox.confirm("Do you really want to delete this element ?", function(confirmed){
    if (confirmed){
        window.location.href = link;
      };
    });
  });
</script> --}}

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection