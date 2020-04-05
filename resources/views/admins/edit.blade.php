@extends('apps.app')



@section('content')

<section class="content-header p-4">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            تعديل بياناتي / {{ $admin->name }}
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              {{-- <li class="breadcrumb-item"><a href="#">خانه</a></li> --}}
              <li class="breadcrumb-item active">حسابي</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

<div class="row">
  <div class="col-md-8 p-4">


    <div class="card card-info">
      <div class="card-header">
       <h3 class="card-title"> <i class="fa fa-user ml-2"></i> حسابي </h3>
      </div>
    <form action="{{ route('admin.update',['id' => $admin->id]) }}" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
        @csrf
        {{method_field('PUT')}}
          <div class="row">
            <div class="form-group col-md-12 ">
              <label for="name">الإسم</label>
              <input type="text" class="form-control" name="name"  placeholder="الإسم" required value="{{ $admin->name }}">
            </div>

            <div class="form-group col-md-12 ">
              <label for="email">الإيميل</label>
              <input type="email" class="form-control" name="email"  placeholder="الإيميل" required  value="{{ $admin->email }}">
            </div>

            <div class="form-group col-md-12 ">
              <label for="address">العنوان</label>
              <input type="text" class="form-control" name="address"  placeholder="العنوان" required  value="{{ $admin->address }}">
            </div>
            
            <div class="form-group col-md-12 ">
              <label for="active">حالة الحساب</label>
              <select name="active" id="active" class="form-control" >
                  <option disabled selected>حالة الحساب</option>
                  <option value="1">نشط الأن</option>
                  <option value="0">معطل</option>
              </select>
            </div>

            @if ( $admin->count() > 1 )
             <div class="form-group col-md-12 ">
              <label for="active">نوع الحساب</label>
              <select name="account_type" id="account_type" class="form-control" >
                <option disabled selected>نوع الحساب</option>
                <option value="admin">admin</option>
                <option value="vendor">vendor</option>
              </select>
            </div>
            @endif

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
        <button type="submit" class="btn btn-info">تحديث</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
      </div>
    </form>
  </div>

  </div>
   <div class="col-md-4 p-4">
   <div class="card card-info">
      <div class="card-body box-profile">
          <div class="text-center">
            @if ($admin->image == null )
            <img class="profile-user-img img-fluid img-circle" src="{{asset('empty.png')}}" alt="User profile picture">
            @else
            <img class="profile-user-img img-fluid img-circle" src="{{url('/admin_uploads/admin_image').'/'.$admin->image}}" alt="User profile picture">
            @endif  
            </div>

          <h3 class="profile-username text-center">الصورة الشخصية</h3>
          </ul>
        </div>
        <!-- /.card-body -->
      </div>
</div>
</div>
@endsection

