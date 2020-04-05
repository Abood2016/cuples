@extends('apps.app')

@section('content')
    
<section class="content-header p-4">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <i class="fa fa-user"></i>  المدراء
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          {{-- <li class="breadcrumb-item"><a href="#">خانه</a></li> --}}
          <li class="breadcrumb-item active" >المدراء</li>
        </ol>
      </div>
    </div>
  </div>
      <a href="#" class="btn btn-info" data-toggle="modal" data-target="#add-window">إضافة مدير جديد</a>
</section>


<div class="card">
  <div class="card-body ">
      <table id="admins" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>الإسم</th>
          <th>الإيميل</th>
          <th>العنوان</th>
          <th>نوع الحساب</th>
          <th>حالة الحساب</th>
          <th>الصورة</th>
          <th>عمليات</th>
        </tr>
        </thead>
        <tbody>
            

       </tbody>
      </table>
  </div>
</div>

<!-- delete Modal -->  
<div class="modal delete-window mt-4"  tabindex="-1" role="dialog" id="delete-window">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" >
        <h5 class="modal-title">حذف مدير</h5>
        <a  class="fa fa-remove" data-dismiss="modal" aria-label="Close" title="إلغاء">
          {{-- <span aria-hidden="true">&times;</span> --}}
        </a>
      </div>
      <form id="admin-delete-form">
      <div class="modal-body">
               هل أنت متاكد من حذف <span id="admin-name-span" class="font-weight-bold"></span>
            @csrf
            {{-- {{ method_field('DELETE') }} --}}
            <input type="hidden" name="admin_id"  id="admin_id">
          </div>
          <div class="modal-footer justify-content-between">
            <button type="submit" class="btn btn-danger delete-admin-btn">حذف</button>
            <button type="button" class="btn btn-secondary p-2" data-dismiss="modal">إلغاء</button>
          </div>
        </form>
    </div>
  </div>
</div>


<div class="modal add-window" tabindex="-1" role="dialog" id="add-window">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">إضافة مدير جديد</h5>
        <a  class="fa fa-remove" data-dismiss="modal" aria-label="Close" title="إلغاء">
          {{-- <span aria-hidden="true">&times;</span> --}}
        </a>
      </div>
       <form id="new-admin" enctype="multipart/form-data">
          <div class="modal-body">
   
            @csrf
            <div class="row">
              <div class="form-group col-md-12">
                <label for="name">الإسم</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="الإسم" >
              </div>

          <div class="form-group col-md-12 ">
              <label for="email">الإيميل</label>
              <input type="email" class="form-control" name="email"  placeholder="الإيميل"   >
            </div>

            <div class="form-group col-md-12 ">
              <label for="address">العنوان</label>
              <input type="text" class="form-control" name="address"  placeholder="العنوان"  >
            </div>
            
            <div class="form-group col-md-12 ">
              <label for="active">حالة الحساب</label>
              <select name="active" id="active" class="form-control" >
                  <option disabled selected>حالة الحساب</option>
                  <option value="1">نشط الأن</option>
                  <option value="0">معطل</option>
              </select>
            </div>  

             <div class="form-group col-md-12 ">
              <label for="active">نوع الحساب</label>
              <select name="account_type" id="account_type" class="form-control" >
                <option disabled selected>نوع الحساب</option>
                <option value="admin">admin</option>
                <option value="vendor">vendor</option>
              </select>
            </div>

          
          <div class="form-group col-md-12 ">
              <label for="password">كلمة المرور</label>
              <input type="password" class="form-control" name="password"  placeholder="كلمة المرور" >
          </div>

          <div class="form-group col-md-12">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">تأكيد كلمة المرور</label>
                  <input id="password-confirm" type="password" class="form-control" placeholder="تأكيد كلمة المرور" name="password_confirmation"  autocomplete="new-password">
            </div>

            <div class="form-group col-md-12 ">
                    <label for="image">الصورة</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input " name="image" id="file-image">
                        <label class="custom-file-label" for="exampleInputFile">تحميل صورة</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
                <div id="thumb-output"></div>
            </div>
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
  
$(document).ready(function() {
     //delete admin script
  var $deleteAdmin = $('.delete-admin');
  var $deleteWindow = $('#delete-window');
  var $admin_id = $('#admin_id');
  var $deleteMessage = $('#delete-message');
    $(document).on('click','.delete-admin' , function(e){
    e.preventDefault();
    var admin_id = $(this).siblings('.admin-id').val();
    var admin_name = $(this).siblings('.admin-id').data('adminname');
    // var admin_name = $(this).);
    $admin_id.val(admin_id);
    $('#admin-name-span').text(admin_name);
    $deleteWindow.modal('show');

    
   $(document).on('click','.delete-admin-btn' , function(e){

       e.preventDefault();
        
        console.log(admin_id);
         $.ajax({

            type: 'POST',
            url:"{{route('delete.admin')}}",
              headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               
             },
            
            //contentType:false,
           cache:false,
            data:{
              "id":admin_id,
              "_method":'DELETE'
            },
         //   processData:false,
            dataType:"json",    
              success: function (response){
                if (response.status == 200) {

                  $deleteWindow.modal('hide');
                  alert(response.message);
                  table.ajax.reload();

                }else{
                alert(response.message);
                $deleteWindow.modal('hide');
                 location.reload(); 
                }
            },
        });

  });
 });


 

  //end delete admin script


});
</script>

<script type="text/javascript">
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }});
  $(document).ready(function(){
    
    $('#new-admin').on('submit',function(e){
        e.preventDefault();
          $.ajax({
            
            type: 'POST',
            url:"{{route('admin.store')}}",
              headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: new FormData(this),
            contentType:false,
            cache:false,
            processData:false,
            dataType:"json",    
              success: function (response){
                console.log(response)
                $('#add-window').modal('hide');
                table.ajax.reload();
                // alert(response.message);
            },
            error: function(error){
                alert('جميع الحقول مطلوبة');
            }
        });
    });
  });
  
</script>

<script>
     
       //image input show image by abed
    $(document).ready(function () {
        $('#file-image').on('change', function () { //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                $('#thumb-output').html(''); //clear html of output element
                var data = $(this)[0].files; //this file data

                $.each(data, function (index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function (file) { //trigger function on successful read
                            return function (e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element 
                                $('#thumb-output').append(img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
</script>

<script>

   $(function () {
  table = $("#admins").DataTable({
        "language": {
        },
        "ajax":"{{ route('admins') }}",
       "columns": [
                    {"data": "name"},
                    {"data": "email"},
                    {"data": "address"},
                    {"data": "account_type"},
                    {"data": null, render: function (data, type, row) {
                            if(data['active'] == '1'){
                              return 'نشط الأن';
                            }else{
                              return 'معطل';
                            } 
                    }},
                     {"data": null, render: function (data, type, row) {
                            // return data['image'];
                            if (!data['image']) {
                            return  "<img src='{{ asset('empty.png') }}' class='img-thumbnail' width='90px' style='border-radius: 20px'>"
                            }else{
                            return  "<img src='{{url('/admin_uploads/admin_image').'/'}}"+data['image']+"' style='width:80px' target='_blank'>"
                            }
                    }},

                  {data: 'action', name: 'action', orderable: false, searchable: false},

                ],
        "info" : false,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "autoWidth":false,
    });
  });
</script>


@endsection