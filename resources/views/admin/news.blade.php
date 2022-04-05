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
                                <a href="{{ route('add_news') }}" class="btn btn-info">Thêm</a> |
                                <!-- <a href="#" class="btn btn-warning">Xuất excel</a> | -->
                                <a href="javascript:void(0)" class="btn btn-danger" style="" id="news_delete">Xóa</a>
                                <!-- SEARCH FORM -->
                                <form class="form-inline ml-3 float-right">
                                    <div class="input-group input-group-sm">
                                        <input class="form-control form-control-navbar" type="search"
                                               placeholder="Search" aria-label="Search" id="news_search">
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <select class="form-control" id="news_status">
                                            <option value="">--Trạng thái--</option>
                                            <option value="1" style="font-weight: bold!important">Đang hiển thị</option>
                                            <option value="0" style="font-weight: bold!important">Đang ẩn</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">STT</th>
                                        <th scope="col">Mô tả</th>
                                        <th scope="col">Nội dung</th>
                                        <th scope="col">Ảnh</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Ngày tạo</th>
                                        <th scope="col">Ngày cập nhật</th>
                                        <th scope="col">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody id="menus_table">
                                    @foreach ($news as $key => $new)
                                        <tr>
                                            <th>
                                                <input class="form-check-input" type="checkbox" value="{{ $new->id }}" id="{{ $new->id }}" style="margin-top: -5px">
                                            </th>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{!! $new->description !!}</td>
                                            <td>{!! $new->content !!}</td>
                                            <td>
                                                @if($new->img)
                                                    <a onclick="debugBase64('data:image/png;base64,{{ $new->img }}')">
                                                        <img src="data:image/png;base64,{{ $new->img }}" style="width: 100px; cursor: pointer">
                                                    </a>
                                                @endif
                                            </td>
                                            @if ($new->status == 1)
                                                <td>✔ Đang hiển thị</td>
                                            @else
                                                <td><span style="color:red">✘ Đang ẩn</span></td>
                                            @endif
                                            <td>{{ $new->created_at }}</td>
                                            <td>{{ $new->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('edit_news', $new->id) }}"><i
                                                            class="fas fa-edit"></i></a> |
                                                <a href="javascript:void(0)"
                                                   onclick="ajaxDeleteNews({{ $new->id }})"><i
                                                            class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4" id="count_content">Show {{ $news->count() }}
                                        of {{ $news->total() }} result
                                    </div>
                                    <div class="col-md-8">
                                        <ul class="pagination float-right">
                                            {{-- Nguyên tắc : (currentPage - 1) * LIMIT --}}
                                            <li class="page-item"><a class="page-link" href="admin/news?page=1">First</a>
                                            </li>
                                            {{-- nếu page hiện tại > page đầu thì hiện nút privew --}}
                                            @if($news->currentPage() > 1)
                                                <li class="page-item"><a class="page-link"
                                                                         href="admin/news?page={{ $news->currentPage() - 1 }}">Previous</a>
                                                </li>
                                            @endif
                                            <li class="page-item active"><a class="page-link"
                                                                            href="admin/news?page={{ $news->currentPage() }}">{{ $news->currentPage() }}</a>
                                            </li>
                                            @if($news->currentPage() < $news->lastPage())
                                                <li class="page-item"><a class="page-link"
                                                                         href="admin/news?page={{ $news->currentPage() + 1 }}">{{ $news->currentPage() + 1 }}</a>
                                                </li>
                                                @if($news->currentPage() < $news->lastPage() - 2)
                                                    <li class="page-item"><a class="page-link"
                                                                             href="admin/news?page={{ $news->currentPage() + 2 }}">{{ $news->currentPage() + 2 }}</a>
                                                    </li>
                                                @endif
                                                @if($news->currentPage() < $news->lastPage() - 3)
                                                    <li class="page-item"><a class="page-link"
                                                                             href="admin/news?page={{ $news->currentPage() + 3 }}">{{ $news->currentPage() + 3 }}</a>
                                                    </li>
                                                @endif
                                            @endif
                                            {{-- nếu page hiện tại < page cuối thì hiện nút next --}}
                                            @if($news->currentPage() < $news->lastPage())
                                                <li class="page-item"><a class="page-link"
                                                                         href="admin/news?page={{ $news->currentPage() + 1 }}">Next</a>
                                            @endif
                                            <li class="page-item"><a class="page-link"
                                                                     href="admin/news?page={{ $news->lastPage() }}">Last</a>
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
            $('#news_search').on('keyup', function () {
                load_ajax();
            })
            $('#news_status').on('change', function () {
                load_ajax();
            })

            function load_ajax() {
                $.ajax({
                    url: '{{ route('search_news') }}',
                    type: 'get',
                    data: {
                        'status': $('#news_status').val(),
                        'key': $('#news_search').val(),
                    },
                    success: function (data) {
                        console.log(data);
                        $('tbody').html(data);
                        $('#count_news').html('Tìm thấy <b>' + $('#news_table').find('tr').length + '</b> Kết quả');
                    }
                });
            }
        });
    </script>
    <script>
        // ajax xóa user
        function ajaxDeleteNews(id) {
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
                        action: function () {
                            $.ajax({
                                url: '{{ route('delete_news') }}',
                                type: 'post',
                                data: {
                                    'id': id,
                                },
                                success: function (data) {
                                    console.log(data);
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
        $('#news_delete').click(function () {
            let listId = '';
            $.each($("input[type=checkbox]:checked"), function () {
                listId += $(this).val() + ',';
            });
            listId = listId.substring(0, listId.length - 1);
            console.log(listId);
            ajaxDeleteNews(listId);
        })
    </script>
    <script>
        function debugBase64(base64URL){
            var win = window.open();
            win.document.write('<iframe src="' + base64URL  + '" frameborder="0" style="border:0; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%;" allowfullscreen></iframe>');
        }
    </script>
    <script>
        $(document).ready(function() {
            $("ul li:nth-child(5) > a").addClass("active");
        });
    </script>
@stop

