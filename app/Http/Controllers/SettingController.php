<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();

        return view('admins.settings.index')->with([
            'settings' => $settings
        ]);
    }

    public function EditSetting($id)
    {
        $setting = Setting::findOrFail($id); 
        return view('admins.settings.edit')->with([
            'setting' => $setting
        ]);
    }

    public function update(Request $request ,$id)
    {
        $setting = Setting::findOrFail($id);
        $requstArray = $request->all();

        if ($request->hasFile('site_image')) {

            $file = $request->file('site_image');
            $fileName = time() . Str::random(12) . '.' . $file->getClientOriginalExtension();
            if (File::exists(public_path('admin_uploads/setting_image/') . $setting->site_image)) {
                File::delete(public_path('admin_uploads/setting_image/') .  $setting->site_image);
            }
            $file->move(public_path('admin_uploads/setting_image'), $fileName);
            $requstArray = ['site_image' => $fileName] + $requstArray; 
        }

        if ($request->email != $setting->email) {
            $email = Setting::where('email', $request->email)->first();
            if ($email == null) {
                $requstArray['email'] = $request->email;
            }
        }

       
        $setting->update($requstArray);

        alert()->success('تم تعديل البيانات','تمت العملية');
        // Session::flash('message', ' تم  تعديل بيانات ' . $admin->name . ' بنجاح');
        return redirect()->back();
    }

    

    public function getSettings()
    {

        $settings = Setting::get();

        return DataTables::of($settings)->addColumn('action', function ($settings) {
            return '<input type="hidden" value="' . $settings['id'] . '" class="setting-id"
                    name="setting_id" id="setting_id">
                    <a href="' . route("edit.setting", ['id' => $settings->id]) . '" class="edit-setting "><i class="fa fa-edit"></i></a>';
        })->make(true);
    }
}
