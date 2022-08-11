<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' =>  'required||unique:users|email',
            'password' => 'required|min:5'
        ];

        $messages = [
            'name.required' => 'Tên không được bỏ trống',
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Đã có Email này rồi, vui lòng chọn tên khác',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.min' => 'Phải chứa 5 kí tự',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login');
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $data = $request->only('email', 'password');

        if (Auth::attempt($data)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->withErrors(["status" => "Tài khoản không tồn tại!! Vui lòng nhập lại"]);
        }
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function allUsers()
    {
        $allUsers = User::paginate(5);
        $managerUsers = view('user.all_users')->with('allUsers', $allUsers);

        return view('layout')->with('user.all_users', $managerUsers);
        return view('user.all_users');
    }

    public function searchUser(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $result = User::query();

        if (!is_null($name)) {
            $result->where('name', 'like', '%' . $name . '%');
        }

        if (!is_null($email)) {
            $result->orWhere('email', 'like', '%' . $email . '%');
        }

        $result = $result->paginate(5);

        return view('user.all_users')->with([
            'allUsers' => $result
        ]);
    }

    public function getAddUser()
    {
        return view('user.add_users');
    }

    public function postAddUser(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' =>  'required||unique:users|email',
            'password' => 'required|min:5'
        ];

        $messages = [
            'name.required' => 'Tên không được bỏ trống',
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Đã có Email này rồi, vui lòng chọn tên khác',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.min' => 'Phải chứa 5 kí tự',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('listUsers');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $manager_users = view('user.edit_users')->with('user', $user);

        return view('layout')->with('user.edit_users', $manager_users);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->route('listUsers');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
