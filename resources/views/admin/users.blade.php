@extends('admin.layout.app')
@section('title', 'QL tài khoản')
@section('content_admin')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>QL Tài Khoản</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col-sm-12">
                                    @if(Auth::user()->role == 1)
                                    <a href="{{ route('add_user') }}" class="btn btn-info" style="margin-left: 15px">Thêm</a> |
                                    <!-- <a href="#" class="btn btn-warning">Xuất excel</a> | -->
                                    <a href="javascript:void(0)" class="btn btn-danger" style="" id="user_delete">Xóa</a>
                                    @endif
                                    <!-- SEARCH FORM -->
                                    <form class="form-inline ml-3 float-right" style="padding-top: 10px; padding-left: 0px!important">
                                        <div class="input-group input-group-sm">
                                            <input class="form-control form-control-navbar" type="search"
                                                   placeholder="Search" aria-label="Search" id="user_search">
                                            {{-- <div class="input-group-append">
                                              <button class="btn btn-navbar" type="button" style="border: 0.5px solid #ccc">
                                                <i class="fas fa-search"></i>
                                              </button>
                                            </div> --}}
                                        </div>
                                        <div class="input-group input-group-sm">
                                            <select class="form-control" id="user_status">
                                                <option value="">--Trạng thái--</option>
                                                <option value="1" style="font-weight: bold!important">Đang hoạt động
                                                </option>
                                                <option value="0" style="font-weight: bold!important">Huỷ kích hoạt</option>
                                            </select>
                                        </div>
                                        <div class="input-group input-group-sm">
                                            <select class="form-control" id="user_level">
                                                <option value="">--Quyền--</option>
                                                <option value="0" style="font-weight: bold!important">Người dùng</option>
                                                <option value="1" style="font-weight: bold!important">Quản trị</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">STT</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Quyền</th>
                                        <th scope="col">Ngày tạo</th>
                                        <th scope="col">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody id="user_table">
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <th scope="row"><input class="form-check-input" type="checkbox"
                                                                   value="{{ $user->id }}" id="{{ $user->id }}"></th>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            @if ($user->status == 1)
                                                <td>✔ Đang hoạt động</td>
                                            @else
                                                <td><span style="color:red">✘ Huỷ kích hoạt</span></td>
                                            @endif
                                            @if ($user->role == 1)
                                                <td><span style="color:red">Quản trị viên</span></td>
                                            @else
                                                <td>Người dùng</td>
                                            @endif
                                            <td>{{ $user->created_at }}</td>
                                            <td>
                                                {{-- <a href="#"><i class="fas fa-eye"></i></a> |  --}}
                                                @if(Auth::user()->role == 1)
                                                    <a href="{{ route('edit_user', $user->id) }}"><i
                                                                class="fas fa-edit"></i></a> |
                                                    <a href="javascript:void(0)"
                                                       onclick="ajaxDeleteUser({{ $user->id }})"><i
                                                                class="fas fa-trash"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4" id="count_user">Show {{ $users->count() }}
                                        of {{ $users->total() }} result
                                    </div>
                                    <div class="col-md-8">
                                        <ul class="pagination float-right">
                                            {{-- Nguyên tắc : (currentPage - 1) * LIMIT --}}
                                            <li class="page-item"><a class="page-link"
                                                                     href="admin/users?page=1">First</a></li>
                                            {{-- nếu page hiện tại > page đầu thì hiện nút privew --}}
                                            @if($users->currentPage() > 1)
                                                <li class="page-item"><a class="page-link"
                                                                         href="admin/users?page={{ $users->currentPage() - 1 }}">Previous</a>
                                                </li>
                                            @endif
                                            <li class="page-item active"><a class="page-link"
                                                                            href="admin/users?page={{ $users->currentPage() }}">{{ $users->currentPage() }}</a>
                                            </li>
                                            @if($users->currentPage() < $users->lastPage())
                                                <li class="page-item"><a class="page-link"
                                                                         href="admin/users?page={{ $users->currentPage() + 1 }}">{{ $users->currentPage() + 1 }}</a>
                                                </li>
                                                @if($users->currentPage() < $users->lastPage() - 2)
                                                    <li class="page-item"><a class="page-link"
                                                                             href="admin/users?page={{ $users->currentPage() + 2 }}">{{ $users->currentPage() + 2 }}</a>
                                                    </li>
                                                @endif
                                                @if($users->currentPage() < $users->lastPage() - 3)
                                                    <li class="page-item"><a class="page-link"
                                                                             href="admin/users?page={{ $users->currentPage() + 3 }}">{{ $users->currentPage() + 3 }}</a>
                                                    </li>
                                                @endif
                                            @endif
                                            {{-- nếu page hiện tại < page cuối thì hiện nút next --}}
                                            @if($users->currentPage() < $users->lastPage())
                                                <li class="page-item"><a class="page-link"
                                                                         href="admin/users?page={{ $users->currentPage() + 1 }}">Next</a>
                                            @endif
                                            <li class="page-item"><a class="page-link"
                                                                     href="admin/users?page={{ $users->lastPage() }}">Last</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@stop
@section('script')
    <script>
        $(document).ready(function () {
            // ajax tìm kiếm
            $('#user_search').on('keyup', function () {
                load_ajax();
            })
            $('#user_status').on('change', function () {
                load_ajax();
            })
            $('#user_level').on('change', function () {
                load_ajax();
            })

            function load_ajax() {
                $.ajax({
                    url: '{{ route('search_user') }}',
                    type: 'get',
                    data: {
                        'status': $('#user_status').val(),
                        'role': $('#user_level').val(),
                        'key': $('#user_search').val(),
                    },
                    success: function (data) {
                        console.log(data);
                        $('tbody').html(data);
                        $('#count_user').html('Tìm thấy <b>' + $('#user_table').find('tr').length + '</b> Kết quả');
                    }
                });
            }
        });
    </script>
    <script>
        // ajax xóa user
        function ajaxDeleteUser(id) {
            //alert(id);
            $.confirm({
                title: 'Xác Nhận!',
                content: 'Bạn có chắc chắn muốn xóa (những) bản ghi này ?',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'Ok',
                        btnClass: 'btn-red',
                        action: function () {
                            $.ajax({
                                url: '{{ route('delete_user') }}',
                                type: 'post',
                                data: {
                                    'id': id,
                                },
                                success: function (data) {
                                    if (data == "success") {
                                        toastr.success('Xóa tài khoản thành công!');
                                        setTimeout(function () {
                                            location.reload();
                                        }, 1000);
                                    } else {
                                        toastr.error('Xóa không thành công, vui lòng chọn một tài khoản!');
                                    }
                                }
                            });
                        }
                    },
                    close: function () {
                    }
                }
            });
        }
    </script>
    <script>
        // xóa hàng loạt
        $('#user_delete').click(function () {
            let listId = '';
            $.each($("input[type=checkbox]:checked"), function () {
                listId += $(this).val() + ',';
            });
            listId = listId.substring(0, listId.length - 1);
            console.log(listId);
            ajaxDeleteUser(listId);
        })
    </script>
    <script>
        $("ul li:nth-child(2) > a").addClass("active");
    </script>
@stop

