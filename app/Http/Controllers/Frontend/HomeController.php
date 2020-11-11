<?php

namespace App\Http\Controllers\Frontend;

use App\Detail_photo;
use App\Evidence;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        return view('Frontend.Home.index');
    }


    public function getSecondary(Request $request)
    {
        $id_code_original = $request['id_code_original'];
        $evidence = Evidence::where('parent_id', $id_code_original)->get();
        return response()->json($evidence, 200);
    }


    public function readstorage()
    {
        return Storage::allFiles('public/finalImage/'.Auth::user()->id);
    }



    public function delete_upload_photos()
    {
        $files_photos = Storage::allFiles('public/photos/' . Auth::user()->id);
        Storage::delete($files_photos);
        return response()->json('ok', 200);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date_evidence' => 'required',
            'Number_evidence' => 'required',
            'code_original' => 'required',
            'secondary' => 'required',
            'page_number' => 'required|numeric',
            'image' => 'required',
        ], [
            'date_evidence.required' => 'فیلد تاریخ مدرک خالی است.',
            'date_evidence.digits' => ' مقدار ورودی برای فیلد تاریخ مدرک صحیح نمی باشد.',
            'Number_evidence.required' => 'فیلد شماره مدرک خالی است.',
            'code_original.required' => 'عنوان کد اصلی را انتخاب نمایید',
            'secondary.required' => 'عنوان کد فرعی را انتخاب نمایید',
            'page_number.required' => 'فیلد شماره صفحه خالی است.',
            'page_number.numeric' => ' مقدار ورودی شماره صفحه فقط عدد می باشد.',
            'image.required' => 'عکس را انتخاب نمایید.',
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 401);
        } else {
            $date_evidence = $request['date_evidence'];
            $Number_evidence = $request['Number_evidence'];
            $code_original = $request['code_original'];
            $secondary = $request['secondary'];
            $page_number = $request['page_number'];
            $name_image = $request['image'];
            $ext = $request['ext'];

            $name = $date_evidence . '-' . $Number_evidence . '-' . $code_original . '' . $secondary . '-' . '' . $page_number . '.' . '' . $ext;

            $user_id=Auth::user()->id;

            Storage::move('public/photos/' . $user_id . '/' . $name_image . '.' . $ext,'public/finalImage/' . $user_id . '/'. $name);

            Storage::delete('public/photos/'. $user_id . '/' . $name_image . '.' . $ext . '.jpg');


            $id = Auth::user()->id;
            $find_user = User::findorfail($id);
            $count_upload = User::where('id', $id)->get();
            foreach ($count_upload as $upload) {
                $x = $upload->upload + 1;
                $find_user->upload = $x;
                $find_user->save();
            }

            $date = Carbon::now()->format('Y-n-j');
            $new_detail_photo = new Detail_photo();
            $new_detail_photo->user_id = Auth::user()->id;
            $new_detail_photo->photo = $name;
            $new_detail_photo->date = $date;
            $new_detail_photo->save();

            return response()->json('success', 200);
        }
    }


    public function reset()
    {
        return view('passReset.index');
    }

    public function resetPass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'old_password' => 'required|min:8',
            'password' => 'required|string|min:8|confirmed',

        ], [
            'email.required' => 'ایمیل خود را وارد نمایید.',
            'email.email' => 'فرمت ایمیل وارد شده صحیح نمی باشد.',
            'email.max' => 'تعداد کاراکتر ایمیل بیش از حد مجاز است.',
            'email.string' => 'ایمیل خود را صحیح وارد نمایید.',
            'old_password.required' => 'رمز عبور قدیم خود را وارد نمایید.',
            'old_password.min' => 'رمز عبور قدیم باید بیش از 8 کاراکتر باشد.',
            'password.required' => 'رمز عبور جدید خود را وارد نمایید.',
            'password.min' => 'رمز عبور جدید باید بیش از 8 کاراکتر باشد.',
            'password.confirmed' => 'رمز عبور همخوانی ندارد.',

        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $email = $request['email'];
            $old_password = $request['old_password'];
            $user = User::where('email', $email)->first();
            $hash_pass = $user->password;

            if (Hash::check($old_password, $hash_pass)) {
                $find_user = User::findorfail($user->id);
                $find_user->password = Hash::make($request['password']);
                $find_user->save();
                Session::flash('success_change_pass', 'رمز عبور شما با موفقیت تغییر کرد.');
                return redirect('login');
            } else {
                Session::flash('not_found_user', 'کاربر یافت نشد.');
                return back();
            }
        }

    }


    public function movefile()
    {
        return view('Frontend.Move.index');
    }

}
