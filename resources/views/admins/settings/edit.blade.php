@extends('apps.app')

@section('title')تعديل مدير@endsection


@section('content')

<section class="content-header p-4">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            تعديل  / {{ $setting->site_name }}
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              {{-- <li class="breadcrumb-item"><a href="#">خانه</a></li> --}}
              <li class="breadcrumb-item active">إعدادات</li>
            </ol>
          </div>
        </div>
      </div>
</section>

<div class="row">
  <div class="col-md-8 p-4">

    <div class="card card-info">
      <div class="card-header">
       <h3 class="card-title"> <i class="fa fa-coffee ml-2"></i> إعدادات </h3>
      </div>
    <form action="{{ route('setting.update',['id' => $setting->id]) }}" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
        @csrf
        {{method_field('PUT')}}
          <div class="row">
            <div class="form-group col-md-12 ">
              <label for="site_name">الإسم</label>
              <input type="text" class="form-control" name="site_name"  placeholder="الإسم" required value="{{ $setting->site_name }}">
            </div>

            <div class="form-group col-md-12 ">
              <label for="email">الإيميل</label>
              <input type="email" class="form-control" name="email"  placeholder="الإيميل" required  value="{{ $setting->email }}">
            </div>

            <div class="form-group col-md-12 ">
              <label for="address">العنوان</label>
              <input type="text" class="form-control" name="address"  placeholder="العنوان" required  value="{{ $setting->address }}">
            </div>

            <div class="form-group col-md-12 ">
              <label for="phone">رقم الهاتف</label>
              <input type="text" class="form-control" name="phone"  placeholder="العنوان" required  value="{{ $setting->phone }}">
            </div>

            <div class="form-group col-md-12 ">
              <label for="facebook_url">حساب الفيسبوك</label>
              <input type="text" class="form-control" name="facebook_url"  placeholder="العنوان" required  value="{{ $setting->facebook_url }}">
            </div>

            <div class="form-group col-md-12 ">
              <label for="twitter_url">حساب التويتر</label>
              <input type="text" class="form-control" name="twitter_url"  placeholder="العنوان" required  value="{{ $setting->twitter_url }}">
            </div>

            <div class="form-group col-md-12 ">
              <label for="instagram_url">حساب الإنستقرام</label>
              <input type="text" class="form-control" name="instagram_url"  placeholder="العنوان" required  value="{{ $setting->instagram_url }}">
            </div>
            

             <div class="form-group col-md-12 ">
                    <label for="site_image">الصورة</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input " name="site_image" id="file-image">
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
            @if ($setting->site_image == null )
            <img class="profile-user-img img-fluid img-circle" src="{{asset('empty.png')}}" alt="User profile picture">
            @else
            <img class="profile-user-img img-fluid img-circle" src="{{url('/admin_uploads/setting_image').'/'.$setting->site_image}}" alt="User profile picture">
            @endif  
            </div>

          <h3 class="profile-username text-center">اللوجو</h3>
          </ul>
        </div>
        <!-- /.card-body -->
      </div>
</div>
</div>

@endsection