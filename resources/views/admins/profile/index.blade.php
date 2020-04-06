@extends('apps.app')

@section('title')الحساب الشخصي | {{ $admin->name }} @endsection


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
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <i class="fa fa-user ml-2"></i> حسابي </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  action="{{ route('profile.update') }}"  method="POST" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}

                <div class="card-body">
                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">الإسم</label>

                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="name" value="{{ ( !is_null($admin)) ?  $admin->name : ''}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">الإيميل</label>

                    <div class="col-sm-12">
                      <input type="email" class="form-control" name="email" id="email"  value="{{ ( !is_null($admin)) ?  $admin->email : ''}}">
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="address" class="col-sm-2 control-label"> العنوان</label>

                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="address" name="address"  value="{{ ( !is_null($admin)) ?  $admin->address : ''}}">
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="account_type" class="col-sm-2 control-label"> الحساب</label>

                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="account_type"  disabled value="{{ ( !is_null($admin)) ?  $admin->account_type : ''}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="created_at" class="col-sm-2 control-label">الإنضمام</label>

                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="created_at"  disabled  value="{{$admin->created_at->diffForHumans()}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="image">الصورة</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="file-image">
                        <label class="custom-file-label" for="exampleInputFile">تحميل صورة</label>
                        
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                    </div>
                </div>
                <div id="thumb-output"></div>
            </div>

                  <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">الباسورد</label>

                    <div class="col-sm-12">
                      <input type="password" class="form-control" name="password" id="password" placeholder="كلمة المرور">
                    </div>
                  </div>
                
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">تحديث</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
         
          </div>

          <div class="col-md-4 p-4">

            <!-- Profile Image -->
            <div class="card card-info">
             <div class="card-body box-profile">
                <div class="text-center">
                  @if ($admin->image == null)
                  <img class="profile-user-img img-fluid img-circle" src="{{asset('empty.png')}}" alt="User profile picture">
                  @else
                  <img class="profile-user-img img-fluid img-circle" src="{{url('/admin_uploads/admin_image').'/'.$admin->image}}" alt="User profile picture">
                  @endif
                </div>

                <h3 class="profile-username text-center">{{ $admin->name }}</h3>

                <p class="text-muted text-center">{{ $admin->account_type }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>{{ $admin->email }}</b> <a class="float-right">الإيميل:</a>
                </li>
                  <li class="list-group-item">
                    <b>{{$admin->created_at->diffForHumans()}}</b> <a class="float-right"> تاريخ الإنضمام:</a>
                  </li>
                  <li class="list-group-item">
                    <b> {{ $admin->address }}</b> <a class="float-right">العنوان : </a>

                  </li>
                    <li class="list-group-item">
                    <b> {{ $admin->activity()  }}</b> <a class="float-right">حالة الحساب : </a>

                  </li>
                </ul>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

</div>
</div>

@endsection
