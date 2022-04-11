@extends('admin.layout.app')
@section('title', 'QL menu')
@section('content_admin')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>QL Menu</h1>
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
                                <div class="col-sm-3" style="margin-left: 10px">
                                    <a href="{{ route('add_menu') }}" class="btn btn-info">Thêm</a> |
                                    <!-- <a href="#" class="btn btn-warning">Xuất excel</a> | -->
                                    <a href="javascript:void(0)" class="btn btn-danger" style="" id="menu_delete">Xóa</a>
                                    <!-- SEARCH FORM -->
                                </div>
                                <form class="form-inline ml-3 float-right" style="padding-top: 10px; padding-left: 0px!important">
                                    <div class="input-group input-group-sm">
                                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" id="menu_search">
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <select class="form-control" id="menu_status">
                                            <option value="">--Trạng thái--</option>
                                            <option value="1" style="font-weight: bold!important">Đang hiển thị</option>
                                            <option value="0" style="font-weight: bold!important">Đang ẩn</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">STT</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Mô tả</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Thứ tự</th>
                                        <th scope="col">Ngày tạo</th>
                                        <th scope="col">Ngày cập nhật</th>
                                        <th scope="col">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody id="menu_table">
                                    @foreach ($menus as $key => $menu)
                                        <tr>
                                            <th scope="row"><input class="form-check-input" type="checkbox" value="{{ $menu->id }}" id="{{ $menu->id }}"></th>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{{ $menu->name }}</td>
                                            <td>{!! $menu->description !!}</td>
                                            @if ($menu->status == 1)
                                                <td>✔ Đang hiển thị</td>
                                            @else
                                                <td><span style="color:red">✘ Đang ẩn</span></td>
                                            @endif
                                            <td>{{ $menu->m_order }}</td>
                                            <td>{{ $menu->created_at }}</td>
                                            <td>{{ $menu->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('edit_menu', $menu->id) }}"><i class="fas fa-edit"></i></a> |
                                                <a href="javascript:void(0)" onclick="ajaxDeleteMenu({{ $menu->id }})"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4" id="count_menu">Show {{ $menus->count() }} of {{ $menus->total() }} result</div>
                                    <div class="col-md-8">
                                        <ul class="pagination float-right">
                                            {{-- Nguyên tắc : (currentPage - 1) * LIMIT --}}
                                            <li class="page-item"><a class="page-link" href="admin/menus?page=1">First</a></li>
                                            {{-- nếu page hiện tại > page đầu thì hiện nút privew --}}
                                            @if($menus->currentPage() > 1)
                                                <li class="page-item"><a class="page-link" href="admin/menus?page={{ $menus->currentPage() - 1 }}">Previous</a></li>
                                            @endif
                                            <li class="page-item active"><a class="page-link" href="admin/menus?page={{ $menus->currentPage() }}">{{ $menus->currentPage() }}</a></li>
                                            @if($menus->currentPage() < $menus->lastPage())
                                                <li class="page-item"><a class="page-link" href="admin/menus?page={{ $menus->currentPage() + 1 }}">{{ $menus->currentPage() + 1 }}</a></li>
                                                @if($menus->currentPage() < $menus->lastPage() - 2)
                                                    <li class="page-item"><a class="page-link" href="admin/menus?page={{ $menus->currentPage() + 2 }}">{{ $menus->currentPage() + 2 }}</a></li>
                                                @endif
                                                @if($menus->currentPage() < $menus->lastPage() - 3)
                                                    <li class="page-item"><a class="page-link" href="admin/menus?page={{ $menus->currentPage() + 3 }}">{{ $menus->currentPage() + 3 }}</a></li>
                                                @endif
                                            @endif
                                            {{-- nếu page hiện tại < page cuối thì hiện nút next --}}
                                            @if($menus->currentPage() < $menus->lastPage())
                                                <li class="page-item"><a class="page-link" href="admin/menus?page={{ $menus->currentPage() + 1 }}">Next</a>
                                            @endif
                                            <li class="page-item"><a class="page-link" href="admin/menus?page={{ $menus->lastPage() }}">Last</a></li>
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
        $(document).ready(function(){
            // ajax tìm kiếm
            $('#menu_search').on('keyup',function(){
                load_ajax();
            })
            $('#menu_status').on('change',function(){
                load_ajax();
            })
            function load_ajax(){
                $.ajax({
                    url : '{{ route('search_menu') }}',
                    type : 'get',
                    data : {
                        'status' : $('#menu_status').val(),
                        'key' : $('#menu_search').val(),
                    },
                    success : function (data){
                        console.log(data);
                        $('tbody').html(data);
                        $('#count_menu').html('Tìm thấy <b>' + $('#menu_table').find('tr').length + '</b> Kết quả');
                    }
                });
            }
        });
    </script>
    <script>
        // ajax xóa user
        function ajaxDeleteMenu(id) {
            //alert(id);
            $.confirm({
                title: 'Xác Nhận!',
                content: 'Bạn có chắc chắn muốn xóa (những) tài khoản này ?',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'Ok',
                        btnClass: 'btn-red',
                        action: function(){
                            $.ajax({
                                url : '{{ route('delete_menu') }}',
                                type : 'post',
                                data : {
                                    'id': id,
                                },
                                success : function (data){
                                    console.log(data);
                                    if(data == "success") {
                                        toastr.success('Xóa menu thành công!');
                                        setTimeout(function(){location.reload(); }, 1000);
                                    }
                                    else {
                                        toastr.error('Xóa không thành công, vui lòng chọn một menu!');
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
        $('#menu_delete').click(function(){
            let listId = '';
            $.each($("input[type=checkbox]:checked"), function(){
                listId += $(this).val() + ',';
            });
            listId = listId.substring(0, listId.length - 1);
            console.log(listId);
            ajaxDeleteMenu(listId);
        })
    </script>
    <script>
        $(document).ready(function() {
            $("ul li:nth-child(3) > a").addClass("active");
        });
    </script>
@stop

