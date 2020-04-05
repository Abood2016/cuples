<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        return view('admins.profile.index')->with([
            'admin' => Auth::user(),
        ]);
    }


    public function store(Request $request)
    {
        $array = [];

    $admin =  $request->validate([
            'name' => 'required',
            'email' => 'required|unique:admins|max:255',
            'active' => 'required',
            'account_type' => 'required',
            'password' => 'required|confirmed',
            // 'image' => 'required'
        ]);

        $Image = null;
        if ($request->hasFile('image')) {
            $image = $request->image;
            $Image = time() . $image->getClientOriginalName();
            $image->move('admin_uploads/admin_image/', $Image);
        }

        Admin::create([
        'name' => $request->name,
        'email' => $request->email,
        'address' => $request->address,
        'active' => $request->active,
        'account_type' => $request->account_type,
        'password' => Hash::make($request->password),
         'image' => $Image,
        ]);

        Session::flash('message', ' تم إضافة المدير بنجاح');
        return response()->json([
            'message' => 'تم إضافة المدير بنجاح'
        ],200);

    }


    public function showAdmins(){
        $admins = Admin::paginate(5);
        return view('admins.admins')->with([
            'admins' => $admins
        ]);
    }

    public function getAdmins()
    {

         $admins = Admin::get();

        return Datatables::of($admins)->addColumn('action', function ($admins) {

            return '<input type="hidden" value="' . $admins['id'] . '" class="admin-id".
                    data-adminname="'. $admins['name'].'"
                    name="admin_id" id="admin_id">
                    <a href="'. route("edit.update", ['id' => $admins['id']]) . '" class="edit-admin"><i class="fa fa-edit"></i></a>
                    <a href="#"  class="delete-admin"><i class="fa fa-remove"></i></a>
                 ';
        })->make(true);
    }

    public function editAdmin($id)
    {

        $admin = Admin::find($id);
        return view('admins.edit')->with([
            'admin' => $admin,
        ]);

    }

    public function Updateprofile(Request $request)
    {

        $admin = Admin::findOrFail(auth()->user()->id);
        $array = [];

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $fileName = time() . Str::random(12) . '.' . $file->getClientOriginalExtension();
            if (File::exists(public_path('admin_uploads/admin_image/') . $admin->image)) {
                File::delete(public_path('admin_uploads/admin_image/') .  $admin->image);
            }
            $file->move(public_path('admin_uploads/admin_image'), $fileName);
            $array = ['image' => $fileName] + $array;
        }

        if ($request->email != $admin->email) {
            $email = Admin::where('email', $request->email)->first();
            if ($email == null) {
                $array['email'] = $request->email;
            }
        }

        if ($request->name != $admin->name) {
            $array['name'] = $request->name;
        }

        if ($request->address != $admin->address) {
            $array['address'] = $request->address;
        }


        if ($request->password != '') {
            $array['password'] = Hash::make($request->password);
        }
        if (!empty($array)) {
            $admin->update($array);
        }
        Session::flash('message', ' تم  تعديل حساب ' . $admin->name . ' بنجاح');
        return redirect()->back();

    }


    public function UpdateAdmin(Request $request , $id)
    {
        $admin = Admin::findOrFail($id);
        $array = [];

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $fileName = time() . Str::random(12) . '.' . $file->getClientOriginalExtension();
            if (File::exists(public_path('admin_uploads/admin_image/') . $admin->image)) {
                File::delete(public_path('admin_uploads/admin_image/') .  $admin->image);
            }
            $file->move(public_path('admin_uploads/admin_image'), $fileName);
            $array = ['image' => $fileName] + $array;
        }

        if ($request->email != $admin->email) {
            $email = Admin::where('email', $request->email)->first();
            if ($email == null) {
                $array['email'] = $request->email;
            }
        }

        if ($request->name != $admin->name) {
            $array['name'] = $request->name;
        }

        if ($request->address != $admin->address) {
            $array['address'] = $request->address;
        }

        if ($request->active == "1") {
        
            $admin->active = "1";
        
        }elseif ($request->active == "0") {
          
            $admin->active = "0";
       
        }

        if ($request->account_type == "admin") {
     
            $admin->account_type = "admin";
     
            }elseif($request->account_type == "vendor") {

                $admin->account_type = "vendor";
            }

        $admin->save();
        if (!empty($array)) {
            $admin->update($array);
        }

        Session::flash('message', ' تم  تعديل بيانات ' . $admin->name . ' بنجاح');
        return redirect()->route('show.admins');
    }

    public function destroy(Request $request)
    {
      if (is_null($request->id) || empty($request->id)) {
            Session::flash('message', 'الأدمن مطلوب');
            return \redirect()->back();
        }

        $id = $request->id;
        $admin =  Admin::find($id);
        // dd($request->id);
        if (auth()->user()->id == $request->id) {
            return response()->json(['message' => ' لا يمكن حذف الحساب', 'status' => 404]);
        }
       
            if (File::exists(public_path('admin_uploads/admin_image/') . $admin->image)) {
                File::delete(public_path('admin_uploads/admin_image/') .  $admin->image);
            }
            $admin->delete();

            Session::flash('message', ' تم  حذف الحساب  بنجاح');
            return response()->json(['message' => ' تم  حذف الحساب  بنجاح', 'status' => 200]);
    
        
    }


}
