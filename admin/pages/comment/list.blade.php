@extends('admin.layouts.main')
@section('title',"Danh sách $title")

@section('css')

@endsection
@section('content')

<style>
    .format-text{
        width: 450px;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 20px;
        -webkit-line-clamp: 10;
        display: -webkit-box;
        -webkit-box-orient: vertical;
    }
</style>
<div class="content-wrapper">

    @include('admin.partials.content-header',['name'=>"$title","key"=>"Danh sách $title"])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if(session("alert"))
                <div class="alert alert-success">
                    {{session("alert")}}
                </div>
                @elseif(session('error'))
                <div class="alert alert-warning">
                    {{session("error")}}
                </div>
                @endif
                <div class="text-right">
                    <a href="{{route('admin.comment.create',['parent_id'=>request()->parent_id??0])}}" class="btn  btn-info btn-md mb-2">+ Thêm mới</a>
                </div>
                <div class="card card-outline card-info">
                    <div class="card-header pt-2 pb-2">
                        <div class="cart-title">
                            <i class="fas fa-list"></i> @if($type_comment ==1) Danh sách bình luận @else Danh sách đánh giá sao @endif
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0 lb-list-category">
                    <table class="table table-head-fixed" style="font-size: 13px;">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Danh xưng</th>
                                <th>Họ và tên</th>
                                <th>Điện thoại</th>
                                <th class="white-space-nowrap">Nội dung</th>
                                @if($type_comment ==2)
                                    <th class="white-space-nowrap">Số sao đánh giá</th>
                                @endif
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td>{{$loop->index}}</td>
                                <td>{{$item->danh_xung == 1 ? 'Anh' : 'Chị'}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->phone}}</td>
                                <td class="format-text">{{$item->content}}</td>
                                @if($type_comment ==2)
                                    <td>{{$item->stars}}</td>
                                @endif
                                <td>
                                    <a class="btn btn-sm btn-info open-modal-reply-comment" data-toggle="modal" data-target="#modalReplyComment" data-name="{{$item->name}}" data-id="{{$item->id}}" data-type_comment={{$type_comment}} data-product_id="{{$item->products[0]->id}}">Trả lời</a>
                                    {{-- <a href="{{route('admin.comment.edit',['id'=>$item->id])}}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a> --}}
                                    <a data-url="{{route('admin.comment.destroy',['id'=>$item->id])}}" class="btn btn-sm btn-danger lb_delete"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="col-md-12">
                {{$data->links()}}
            </div>
        </div>
      </div>
    </div>
</div>

<!-- Modal send commnet-->
<div class="modal fade in" id="modalReplyComment">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <div class="modal-title single-start-title">Trả Lời “<span id="replyNameComment" class="f-w-500"></span>”</div>
            <input type="hidden" id="replyIdComment">
            <input type="hidden" id="replyTypeComment">
            <input type="hidden" id="productId">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form class="content" id="form_reply_comment">
                <div class="col-12">
                    <div class="form-group m-t-12">
                        <textarea id="contentComment" name="content" class="form-control" rows="5" placeholder="Nhập nội dung (Vui lòng gõ tiếng Việt có dấu)…"></textarea>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button id="sendComment" data-url="{{route('admin.comment.create')}}" class="btn btn-sm btn-info" class="button_plus txt-red">
                Gửi câu lời
            </button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('js')
<script>
    var removeChar = function (strInput) {
        return strInput.replace(/(<([^>]+)>)/gi, "").replace(/!|@|\$|%|\^|\*|\(|\#|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'||\"|\&|\#|\[|\]|~/g, "");
    };
    function openModalReplyComment() {
        $(document).on("click", ".open-modal-reply-comment", function () {
            var id = $(this).data("id");
            var name = $(this).data("name");
            var type_comment = $(this).data("type_comment");
            var product_id = $(this).data("product_id");
            $("#replyNameComment").text(name);
            $("#replyTypeComment").val(type_comment);
            $("#replyIdComment").val(id);
            $("#productId").val(product_id);
        });
    }


    function sendComment() {
        $(document).on("click", "#sendComment", function () {
            var url = $(this).data('url');
            var parent_id = $("#replyIdComment").val();
            var type_comment = $("#replyTypeComment").val();
            var product_id = $("#productId").val();
            var content = removeChar($("#contentComment").val());


            if (content == '') {
                alert('Vui lòng nhập đầy đủ câu trả lời!');
                return false;
            }
            $.ajax({
                url: url,
                type: "GET",
                data: { product_id: product_id, content: content, type_comment : type_comment, parent_id : parent_id},
                success: function (response) {
                    alert('Gửi câu trả lời thanhc công');
                    $('#form_reply_comment')[0].reset();
                    $('#modalReplyComment').modal('hide');
                },
                error: function (response) {
                    alert('Có lỗi, Vui lòng thử lại');
                },
            });
        });
    }

    $(document).ready(function () {

        openModalReplyComment();

        sendComment();
    });

</script>

@endsection
