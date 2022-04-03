<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminController extends Controller
{
    // Author: Toandn - 11:20AM
    public function login() {
        return view('admin.login');
    }
    public function postLogin(Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            //$id = Auth::id();
            $user = Auth::user();
            if($user->role == 1) {
                return redirect()->route('index')->with('success','Đăng nhập thành công');
            }
            else {
                redirect()->route('login')->with('err', 'Tài khoản Không có quyền truy cập');
            }
        }
        else {
            return redirect()->route('login')->with('err', 'Tài khoản hoặc mật khẩu không chính xác');
        }

    }

    public function register() {
        return view('admin.register');
    }
    public function recoverPass() {
        return view('admin.recover-pass');
    }
    public function logOut() {
        Auth::logout();
        return redirect()->route('login')->with('success','Đăng xuất thành công');
    }

    public function index() {
        return view('admin.index');
    }

    public function users() {
        $users = DB::table('users')->orderBy('id', 'DESC')->paginate(15);
        return view('admin.users', ['users' => $users]);
    }
    public function addUser() {
        return view('admin.user_add');
    }
    public function pAddUser(Request $request) {
        $request->validate([
            'email'     => 'unique:users',
            'password'  => 'same:repass',
            ], [
            'email.unique'  => 'Email đã tồn tại, vui lòng nhập email khác',
            'password.same' => 'Mật khẩu nhập lại không trùng nhau',
        ]);
        $user = new User;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->status   = 1;
        $user->password = bcrypt($request->password);
        $user->role     = $request->role;
        if(!$user->save()) {
            return redirect()->back()->with('err', 'Có lỗi, vui lòng thử lại');
        }
        return redirect()->back()->with('success', 'Thêm tài khoản thành công!');
    }
    public function editUser($id) {
        $user = User::find($id);
        if(isset($user)) {
           return view('admin.user_edit', ['user' => $user]);
        }
        else return redirect()->back();

    }
    public function pEditUser(Request $request) {
         // nếu người dùng đổi email thì validate email
        if($request->email != $request->current_email) {
            $request->validate([
            'email'     => 'unique:users',
            ], [
            'email.unique'  => 'Email ' .$request->email. ' đã tồn tại, vui lòng nhập email khác',
            ]);
        }
        // nếu đổi mật khẩu mới thì mã hóa. mật khẩu cũ không cần vì đã được mã hóa sẵn
        if($request->password != $request->current_password) {
            $request->password = bcrypt($request->password);
        }
        $user = User::find($request->id);
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->status   = $request->status;
        $user->password = $request->password;
        $user->role     = $request->role;
        if(!$user->save()) {
            return redirect()->back()->with('err', 'Có lỗi, vui lòng thử lại');
        }
        return redirect()->back()->with('success', 'Cập nhật tài khoản thành công!');

    }
    public function searchUser(Request $request) {
        $key = $request->key;
        $output = '';
        $users = DB::table('users')
           ->where('status', 'LIKE', '%'.$request->status.'%')
           ->where('role', 'LIKE', '%'.$request->role.'%')
           ->where(function ($query) use ($key) {
               $query->where('name', 'LIKE', '%'.$key.'%')
                     ->orWhere('email', 'LIKE', '%'.$key.'%')
                     ->orWhere('created_at', 'LIKE', '%'.$key.'%');
           })
           ->get();
        if ($users) {
            foreach ($users as $key => $user) {
                $user->status == 1 ? $user->status = "✔ Đang hoạt động" : $user->status = "<span style='color:red'>✘ Huỷ kích hoạt</span>";
                $user->role == 1 ? $user->role = "<span style='color:red'>Quản trị viên</span>" : $user->role = "Người dùng";
                $output .= '<tr>
                <th scope="row"><input class="form-check-input" type="checkbox" value="'.$user->id.'" id="'.$user->id.'"></th>
                <th scope="row">' . ($key + 1) . '</th>
                <td>' . $user->name . '</td>
                <td>' . $user->email . '</td>
                <td>' . $user->status . '</td>
                <td>' . $user->role . '</td>
                <td>' . $user->created_at . '</td>
                <td>| 
                    <a href="admin/users/edit/'.$user->id.'"><i class="fas fa-edit"></i></a> |
                    <a href="javascript:void(0)" onclick=ajaxDeleteUser('.$user->id.')><i class="fas fa-trash"></i></a> | 
                    </td>
                </tr>';
            }
            echo $output;
        }

    }
    public function deleteUser(Request $request) {
        $arrId = explode(",",$request->id);
        foreach ($arrId as $id) {
            if($id == '' || $id == NULL) {
                return 'error';
                die();
            }
            $user = User::find($id);
            $user->delete();
        }
        return "success";
    }



}
