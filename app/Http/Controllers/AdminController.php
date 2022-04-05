<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Menus;
use App\Models\Contents;
use App\Models\News;


class AdminController extends Controller
{
    // Author: Toandn - 11:20AM
    // link img: env('APP_URL')."/images/".$content->img;
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
                return redirect()->route('login')->with('err', 'Tài khoản Không có quyền truy cập');
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
        $users = DB::table('users')->orderBy('id', 'DESC')->paginate(50);
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
                <td>
                    <a href="admin/users/edit/'.$user->id.'"><i class="fas fa-edit"></i></a> |
                    <a href="javascript:void(0)" onclick=ajaxDeleteUser('.$user->id.')><i class="fas fa-trash"></i></a>
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
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function menus() {
        $menus = DB::table('menus')->orderBy('m_order', 'ASC')->paginate(50);
        return view('admin.menu', ['menus' => $menus]);
    }
    public function addMenu() {
        return view('admin.menu_add');
    }
    public function pAddMenu(Request $request) {
        $request->validate([
            'name'     => 'required',
        ], [
            'name.required'  => 'Tên menu không được để trống',
        ]);
        $menu = new Menus;
        $menu->name             = $request->name;
        $menu->description      = $request->menu_description;
        $menu->status           = $request->status;
        $menu->m_order          = $request->m_order;
        if(!$menu->save()) {
            return redirect()->back()->with('err', 'Có lỗi, vui lòng thử lại');
        }
        return redirect()->back()->with('success', 'Thêm menu thành công!');
    }
    public function editMenu($id) {
        $menu = Menus::find($id);
        if(isset($menu)) {
            return view('admin.menu_edit', ['menu' => $menu]);
        }
        else return redirect()->back();

    }
    public function pEditMenu(Request $request) {
        $menu = Menus::find($request->id);
        $menu->name             = $request->name;
        $menu->description      = $request->menu_description;
        $menu->status           = $request->status;
        $menu->m_order          = $request->m_order;
        if(!$menu->save()) {
            return redirect()->back()->with('err', 'Có lỗi, vui lòng thử lại');
        }
        return redirect()->back()->with('success', 'Cập nhật menu thành công!');

    }
    public function searchMenu(Request $request) {
        $key = $request->key;
        $output = '';
        $menus = DB::table('menus')
            ->where('status', 'LIKE', '%'.$request->status.'%')
            ->where(function ($query) use ($key) {
                $query->where('name', 'LIKE', '%'.$key.'%')
                    ->orWhere('description', 'LIKE', '%'.$key.'%')
                    ->orWhere('created_at', 'LIKE', '%'.$key.'%');
            })
            ->get();
        if ($menus) {
            foreach ($menus as $key => $menu) {
                $menu->status == 1 ? $menu->status = "✔ Đang hiển thị" : $menu->status = "<span style='color:red'>✘ Đang ẩn</span>";
                $output .= '<tr>
                <th scope="row"><input class="form-check-input" type="checkbox" value="'.$menu->id.'" id="'.$menu->id.'"></th>
                <th scope="row">' . ($key + 1) . '</th>
                <td>' . $menu->name . '</td>
                <td>' . $menu->description . '</td>
                <td>' . $menu->status . '</td>
                <td>' . $menu->m_order . '</td>
                <td>' . $menu->created_at . '</td>
                <td>' . $menu->updated_at . '</td>
                <td>
                    <a href="admin/menus/edit/'.$menu->id.'"><i class="fas fa-edit"></i></a> |
                    <a href="javascript:void(0)" onclick=ajaxDeleteMenu('.$menu->id.')><i class="fas fa-trash"></i></a>
                    </td>
                </tr>';
            }
            echo $output;
        }

    }
    public function deleteMenu(Request $request) {
        $arrId = explode(",",$request->id);
        foreach ($arrId as $id) {
            if($id == '' || $id == NULL) {
                return 'error';
                die();
            }
            $menu = Menus::find($id);
            $menu->delete();
        }
        return "success";
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function contents() {
        $contents = DB::table('contents')
            ->join('menus', 'menus.id', '=','contents.id_menu')
            ->select('contents.*', 'menus.name', 'menus.id as m_id')
            ->orderBy('id', 'DESC')->paginate(50);
        $menus = DB::table('menus')->orderBy('id', 'DESC')->get();
        return view('admin.content', ['contents' => $contents, 'menus' => $menus]);
    }
    public function addContent() {
        $menus = DB::table('menus')
            ->where('status',1)
            ->get();
        return view('admin.content_add', ['menus' => $menus]);
    }
    public function pAddContent(Request $request) {
        $content = new Contents;
        $content->id_menu          = $request->id_menu;
        $content->description      = $request->description;
        $content->content          = $request->content;
        $content->status          = $request->status;
        if ($request->hasFile('img')) {
            $file       = $request->file('img');
            $name       = $file->getClientOriginalName();
            $extension  = $file->extension();
            $newname    = rand()."_".date("d_m_Y")."_".$name;
            $file->move("images", $newname);
            $content->img = $newname;
        }
        else $content->img = "";
        if(!$content->save()) {
            return redirect()->back()->with('err', 'Có lỗi, vui lòng thử lại');
        }
        return redirect()->back()->with('success', 'Thêm nội dung thành công!');
    }
    public function editContent($id) {
        $menus = DB::table('menus')
            ->get();
        $content = Contents::find($id);
        if(isset($content)) {
            return view('admin.content_edit', ['content' => $content, 'menus' => $menus]);
        }
        else return redirect()->back();

    }
    public function pEditContent(Request $request) {
        $content = Contents::find($request->id);
        $content->id_menu          = $request->id_menu;
        $content->description      = $request->description;
        $content->content          = $request->content;
        $content->status          = $request->status;
        if(isset($content->img) && $content->img != '' && $content->img != NULL) {
            $old_file_path      = "images/".$content->img;
        }
        else $old_file_path = '';
        if($request->hasFile("img")) {
            $file       = $request->file('img');
            $name       = $file->getClientOriginalName();
            $extension  = $file->extension();
            $newname    = rand()."_".date("d_m_Y")."_".$name;
            $file->move("images", $newname);
            // nếu tồn tại file cũ thì xóa
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }
            $content->img = $newname;
        }
        if($request->delete == 1) $content->img = NULL;
        if(!$content->save()) {
            return redirect()->back()->with('err', 'Có lỗi, vui lòng thử lại');
        }
        return redirect()->back()->with('success', 'Cập nhật nội dung thành công!');

    }
    public function searchContent(Request $request) {
        $key = $request->key;
        $output = '';
        $contents = DB::table('contents')
            ->join('menus', 'menus.id', '=','contents.id_menu')
            ->select('contents.*', 'menus.name', 'menus.id as m_id')
            ->where('contents.status', 'LIKE', '%'.$request->status.'%')
            ->where('contents.id_menu', 'LIKE', '%'.$request->id_menu.'%')
            ->where(function ($query) use ($key) {
                $query->where('contents.description', 'LIKE', '%'.$key.'%')
                    ->orWhere('contents.content', 'LIKE', '%'.$key.'%')
                    ->orWhere('contents.created_at', 'LIKE', '%'.$key.'%');
            })
            ->get();
        if ($contents) {
            foreach ($contents as $key => $content) {
                $content->status == 1 ? $content->status = "✔ Đang hiển thị" : $content->status = "<span style='color:red'>✘ Đang ẩn</span>";
                if($content->img) {
                    $link = "<a href='images/$content->img'><img src='images/$content->img' style='width: 100px; cursor: pointer'></a>";
                }
                else $link = '';
                $output .= '<tr>
                <th scope="row"><input class="form-check-input" type="checkbox" value="'.$content->id.'" id="'.$content->id.'" style="margin-top: -5px"></th>
                <th scope="row">' . ($key + 1) . '</th>
                <td>' . $content->name . '</td>
                <td>' . $link . '</td>
                <td>' . $content->description . '</td>
                <td>' . $content->content . '</td>
                <td>' . $content->status . '</td>
                <td>' . $content->created_at . '</td>
                <td>' . $content->updated_at . '</td>
                <td>
                    <a href="admin/contents/edit/'.$content->id.'"><i class="fas fa-edit"></i></a> |
                    <a href="javascript:void(0)" onclick=ajaxDeleteContent('.$content->id.')><i class="fas fa-trash"></i></a>
                    </td>
                </tr>';
            }
            echo $output;
        }

    }
    public function deleteContent(Request $request) {
        $arrId = explode(",",$request->id);
        foreach ($arrId as $id) {
            if($id == '' || $id == NULL) {
                return 'error';
                die();
            }
            $content = Contents::find($id);
            $content->delete();
        }
        return "success";
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function news() {
        $news = DB::table('news')->orderBy('id', 'DESC')->paginate(50);
        return view('admin.news', ['news' => $news]);
    }
    public function addNews() {
        return view('admin.news_add');
    }
    public function pAddNews(Request $request) {
        $news = new News;
        $news->description          = $request->description;
        $news->content          = $request->content;
        $news->status          = $request->status;
        if ($request->hasFile('img')) {
            $file       = $request->file('img');
            $name       = $file->getClientOriginalName();
            $extension  = $file->extension();
            $newname    = rand()."_".date("d_m_Y")."_".$name;
            $file->move("images", $newname);
            $news->img = $newname;
        }
        else $news->img = "";
        if(!$news->save()) {
            return redirect()->back()->with('err', 'Error');
        }
        return redirect()->back()->with('success', 'Success!');
    }
    public function editNews($id) {
        $new = News::find($id);
        if(isset($new)) {
            return view('admin.news_edit', ['new' => $new]);
        }
        else return redirect()->back();

    }
    public function pEditNews(Request $request) {
        $new = News::find($request->id);
        $new->description      = $request->description;
        $new->content          = $request->content;
        $new->status          = $request->status;
        if(isset($new->img) && $new->img != '' && $new->img != NULL) {
            $old_file_path      = "images/".$new->img;
        }
        else $old_file_path = '';
        if($request->hasFile("img")) {
            $file       = $request->file('img');
            $name       = $file->getClientOriginalName();
            $extension  = $file->extension();
            $newname    = rand()."_".date("d_m_Y")."_".$name;
            $file->move("images", $newname);
            // nếu tồn tại file cũ thì xóa
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }
            $new->img = $newname;
        }
        if($request->delete == 1) $new->img = NULL;
        if(!$new->save()) {
            return redirect()->back()->with('err', 'Có lỗi, vui lòng thử lại');
        }
        return redirect()->back()->with('success', 'Cập nhật nội dung thành công!');

    }
    public function searchNews(Request $request) {
        $key = $request->key;
        $output = '';
        $news = DB::table('news')
            ->where('status', 'LIKE', '%'.$request->status.'%')
            ->where(function ($query) use ($key) {
                $query->where('content', 'LIKE', '%'.$key.'%')
                    ->orWhere('description', 'LIKE', '%'.$key.'%')
                    ->orWhere('created_at', 'LIKE', '%'.$key.'%');
            })
            ->get();
        if ($news) {
            foreach ($news as $key => $new) {
                $new->status == 1 ? $new->status = "✔ Đang hiển thị" : $new->status = "<span style='color:red'>✘ Đang ẩn</span>";
                if($new->img) {
                    $link = "<a onclick=debugBase64('data:image/png;base64,$new->img')><img src='data:image/png;base64,$new->img' style='width: 100px; cursor: pointer'></a>";
                }
                else $link = '';
                $output .= '<tr>
                <th scope="row"><input class="form-check-input" type="checkbox" value="'.$new->id.'" id="'.$new->id.'" style="margin-top: -5px"></th>
                <th scope="row">' . ($key + 1) . '</th>
                <td>' . $new->description . '</td>
                <td>' . $new->content . '</td>
                <td>' . $link . '</td>
                <td>' . $new->status . '</td>
                <td>' . $new->created_at . '</td>
                <td>' . $new->updated_at . '</td>
                <td>
                    <a href="admin/news/edit/'.$new->id.'"><i class="fas fa-edit"></i></a> |
                    <a href="javascript:void(0)" onclick=ajaxDeleteNews('.$new->id.')><i class="fas fa-trash"></i></a>
                    </td>
                </tr>';
            }
            echo $output;
        }

    }
    public function deleteNews(Request $request) {
        $arrId = explode(",",$request->id);
        foreach ($arrId as $id) {
            if($id == '' || $id == NULL) {
                return 'error';
                die();
            }
            $new = News::find($id);
            $new->delete();
        }
        return "success";
    }

}
