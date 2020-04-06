@extends('apps.app')

@section('title')
    الإعدادات
@endsection


@section('content')

<section class="content-header p-4">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <i class="fa fa-coffee"></i>  الإعدادات
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          {{-- <li class="breadcrumb-item"><a href="#">خانه</a></li> --}}
          <li class="breadcrumb-item active" >الإعدادات</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<div class="card">
  <div class="card-body ">
      <table id="settings" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>الإسم</th>
          <th>الإيميل</th>
          <th>العنوان</th>
          <th>رقم الهاتف</th>
          <th>حساب الفيسبوك</th>
          <th>اللوجو</th>
          <th>عمليات</th>
        </tr>
        </thead>
        <tbody>
            

       </tbody>
      </table>
  </div>
</div>


<div class="modal edit-window" tabindex="-1" role="dialog" id="edit-window">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">إضافة مدير جديد</h5>
        <a  class="fa fa-remove" data-dismiss="modal" aria-label="Close" title="إلغاء">
          {{-- <span aria-hidden="true">&times;</span> --}}
        </a>
      </div>
       <form  enctype="multipart/form-data">
          <div class="modal-body">
            @csrf
            <div class="row">
              <div class="form-group col-md-12">
                <label for="site_name">الإسم</label>
                <input type="text" class="form-control" name="site_name" id="site_name" placeholder="الإسم" >
              </div>

          <div class="form-group col-md-12 ">
              <label for="email">الإيميل</label>
              <input type="email" class="form-control" name="email"  placeholder="الإيميل"   >
            </div>

            <div class="form-group col-md-12 ">
              <label for="address">العنوان</label>
              <input type="text" class="form-control" name="address"  placeholder="العنوان"  >
            </div>
            
            <input type="hidden" name="setting_id" id="edit_setting_id">

        </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-info">إضافة</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
        </div>
      </form>
      </div>
    </div>
</div>



@endsection


@section('js')
<script>

   $(function () {
    
    table = $("#settings").DataTable({
        "language": {
        },
        "ajax":"{{ route('settings') }}",
       "columns": [
                    {"data": "site_name"},
                    {"data": "email"},
                    {"data": "address"},
                    {"data": "phone"},
                    {"data": "facebook_url"},
                    {"data": null, render: function (data, type, row) {
                            return  "<img src='{{url('/admin_uploads/setting_image').'/'}}"+data['site_image']+"' style='width:90px'>"
                    }},

                  {data: 'action', name: 'action', orderable: false, searchable: false},

                ],
        "info" : false,
        "paging": false,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "autoWidth":false,
    });
  });
</script>

@endsection