@extends('admin.layout.app')
@section('title', 'QL nội dung')
<style>
    .table > tbody > tr > td {
        vertical-align: middle;
    }

    .table > tbody > tr > th {
        vertical-align: middle;
    }
</style>
@section('content_admin')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>QL nội dung</h1>
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
                                    <a href="{{ route('add_content') }}" class="btn btn-info" style="margin-left: 15px">Thêm</a> |
                                    <!-- <a href="#" class="btn btn-warning">Xuất excel</a> | -->
                                    <a href="javascript:void(0)" class="btn btn-danger" style="" id="content_delete">Xóa</a>
                                    <!-- SEARCH FORM -->
                                    <form class="form-inline ml-3 float-right" style="padding-top: 10px; padding-left: 0px!important">
                                        <div class="input-group input-group-sm">
                                            <input class="form-control form-control-navbar" type="search"
                                                   placeholder="Search" aria-label="Search" id="content_search">
                                        </div>
                                        <div class="input-group input-group-sm">
                                            <select class="form-control" id="content_status">
                                                <option value="">--Trạng thái--</option>
                                                <option value="1" style="font-weight: bold!important">Đang hiển thị</option>
                                                <option value="0" style="font-weight: bold!important">Đang ẩn</option>
                                            </select>
                                        </div>
                                        <div class="input-group input-group-sm">
                                            <select class="form-control" id="id_menu">
                                                <option value="">--Tên menu--</option>
                                                @foreach ($menus as $menu)
                                                    <option value="{{ $menu->id }}"
                                                            style="font-weight: bold!important">{{ $menu->name }}</option>
                                                @endforeach
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
                                        <th scope="col">Tên menu</th>
                                        <th scope="col">Ảnh</th>
                                        <th scope="col">Mô tả</th>
                                        <th scope="col">Nội dung</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Ngày tạo</th>
                                        <th scope="col">Ngày cập nhật</th>
                                        <th scope="col">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody id="content_table">
                                    @foreach ($contents as $key => $content)
                                        <tr>
                                            <th>
                                                <input class="form-check-input" type="checkbox" value="{{ $content->id }}" id="{{ $content->id }}" style="margin-top: -5px">
                                            </th>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{{ $content->name }}</td>
                                            <td>
                                                @if($content->img)
                                                    @php
                                                        $type = explode(".",$content->img);
                                                    @endphp
                                                    @if(end($type) == "mp4")
                                                        <video width="100" controls>
                                                            <source src="images/{{ $content->img }}" type="video/mp4">
                                                        </video>
                                                    @else
                                                        <a href="images/{{ $content->img }}"><img src="images/{{ $content->img }}" style="width: 100px; cursor: pointer"></a>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{!! $content->description !!}</td>
                                            <td>{!! $content->content !!}</td>
                                            @if ($content->status == 1)
                                                <td>✔ Đang hiển thị</td>
                                            @else
                                                <td><span style="color:red">✘ Đang ẩn</span></td>
                                            @endif
                                            <td>{{ $content->created_at }}</td>
                                            <td>{{ $content->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('edit_content', $content->id) }}"><i
                                                            class="fas fa-edit"></i></a> |
                                                <a href="javascript:void(0)"
                                                   onclick="ajaxDeleteContent({{ $content->id }})"><i
                                                            class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4" id="count_content">Show {{ $contents->count() }}
                                        of {{ $contents->total() }} result
                                    </div>
                                    <div class="col-md-8">
                                        <ul class="pagination float-right">
                                            {{-- Nguyên tắc : (currentPage - 1) * LIMIT --}}
                                            <li class="page-item"><a class="page-link" href="admin/contents?page=1">First</a>
                                            </li>
                                            {{-- nếu page hiện tại > page đầu thì hiện nút privew --}}
                                            @if($contents->currentPage() > 1)
                                                <li class="page-item"><a class="page-link"
                                                                         href="admin/contents?page={{ $contents->currentPage() - 1 }}">Previous</a>
                                                </li>
                                            @endif
                                            <li class="page-item active"><a class="page-link"
                                                                            href="admin/contents?page={{ $contents->currentPage() }}">{{ $contents->currentPage() }}</a>
                                            </li>
                                            @if($contents->currentPage() < $contents->lastPage())
                                                <li class="page-item"><a class="page-link"
                                                                         href="admin/contents?page={{ $contents->currentPage() + 1 }}">{{ $contents->currentPage() + 1 }}</a>
                                                </li>
                                                @if($contents->currentPage() < $contents->lastPage() - 2)
                                                    <li class="page-item"><a class="page-link"
                                                                             href="admin/contents?page={{ $contents->currentPage() + 2 }}">{{ $contents->currentPage() + 2 }}</a>
                                                    </li>
                                                @endif
                                                @if($contents->currentPage() < $contents->lastPage() - 3)
                                                    <li class="page-item"><a class="page-link"
                                                                             href="admin/contents?page={{ $contents->currentPage() + 3 }}">{{ $contents->currentPage() + 3 }}</a>
                                                    </li>
                                                @endif
                                            @endif
                                            {{-- nếu page hiện tại < page cuối thì hiện nút next --}}
                                            @if($contents->currentPage() < $contents->lastPage())
                                                <li class="page-item"><a class="page-link"
                                                                         href="admin/contents?page={{ $contents->currentPage() + 1 }}">Next</a>
                                            @endif
                                            <li class="page-item"><a class="page-link"
                                                                     href="admin/contents?page={{ $contents->lastPage() }}">Last</a>
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
            $('#content_search').on('keyup', function () {
                load_ajax();
            })
            $('#content_status').on('change', function () {
                load_ajax();
            })
            $('#id_menu').on('change', function () {
                load_ajax();
            })

            function load_ajax() {
                $.ajax({
                    url: '{{ route('search_content') }}',
                    type: 'get',
                    data: {
                        'status': $('#content_status').val(),
                        'key': $('#content_search').val(),
                        'id_menu': $('#id_menu').val()
                    },
                    success: function (data) {
                        console.log(data);
                        $('tbody').html(data);
                        $('#count_content').html('Tìm thấy <b>' + $('#content_table').find('tr').length + '</b> Kết quả');
                    }
                });
            }
        });
    </script>
    <script>
        // ajax xóa user
        function ajaxDeleteContent(id) {
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
                                url: '{{ route('delete_content') }}',
                                type: 'post',
                                data: {
                                    'id': id,
                                },
                                success: function (data) {
                                    if (data == "success") {
                                        toastr.success('Xóa nội dung thành công!');
                                        setTimeout(function () {
                                            location.reload();
                                        }, 1000);
                                    } else {
                                        toastr.error('Xóa không thành công, vui lòng chọn một nội dung!');
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
        $('#content_delete').click(function () {
            let listId = '';
            $.each($("input[type=checkbox]:checked"), function () {
                listId += $(this).val() + ',';
            });
            listId = listId.substring(0, listId.length - 1);
            console.log(listId);
            ajaxDeleteContent(listId);
        })
    </script>
    <script>
        function debugBase64(base64URL){
            var win = window.open();
            win.document.write('<iframe src="' + base64URL  + '" frameborder="0" style="border:0; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%;" allowfullscreen></iframe>');
        }
    </script>
    <script>
        $("ul li:nth-child(4) > a").addClass("active");
    </script>
@stop

