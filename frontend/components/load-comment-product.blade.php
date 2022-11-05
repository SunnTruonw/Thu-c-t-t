<div class="content-comment">
    <!--start item-vote -->
    @if(!empty($data) && count($data) > 0)
    @foreach($data as $comment)
    
    <div class="item-vote fleft">
        <div class="item-vote-header">
            <div class="item-vote-title-left fleft">
                <span class="item-vote-avatar"> {{ucfirst(substr("$comment->name", 0, 1))}}</span>
                <span class="item-vote-user">{{$comment->name}}</span>
            </div>
            <div class="item-vote-time-right fright">
                <i class="far fa-clock"></i>
                {{$comment->created_at->format('d/m/Y')}}
            </div>
            <div class="cboth"></div>
        </div>
        <div class="item-vote-info">
            @if($comment->stars && $comment->type_comment == 2)
            <div class="item-vote-raiting">
                {{-- <strong>Đánh giá:</strong> --}}
                <span class="pro-item-start-rating">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $comment->stars)
                            <i class="star-bold far fa-star"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </span>
            </div>
            @endif
            <div class="item-vote-question">
                {{-- <strong>Nhận xét:</strong> --}}
                {!! $comment->content !!}
            </div>
            <div class="btn-rep-cmt respondent">
                <div class="lc_reply link">
                    <a class="btn-modal-create-comment open-modal-reply-comment" data-toggle="modal" data-target="#modalReplyComment" data-name="{{$comment->name}}" data-id="{{$comment->id}}" data-type_comment={{$comment->type_comment}}>Trả lời</a>
                </div>
                <div class="lc_like link js-like" data-url="{{route('product.like.comment')}}" data-id="{{$comment->id}}">
                    <span class="icon-like">
                        @if($comment->like > 0)
                            <i class="fa fa-thumbs-up"></i>
                        @endif
                    </span>
                    Thích
                    <span class="product-review-cout total-like-{{$comment->id}}" data-like="{{$comment->like}}">
                        {{$comment->like > 0 ? '('.$comment->like.')' : ''}}
                    </span>
                </div>
            </div>
        </div>
    
        <div class="item-comment__box-rep-comment fleft">
            <div class="list-rep-comment">
                @php
                    $commentM = new App\Models\Comment();
                    $listIdCommentChild = $commentM->getALlCommentChildrenAndSelf($comment->id);
                    unset($listIdCommentChild[0]); 
                    $commentChilds = $commentM->whereIn('id', $listIdCommentChild)->get();
                @endphp
                @foreach ($commentChilds as $childValue)
                    @include('frontend.components.load-comment-child', ['childs' => $childValue])
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
</div>
{{-- @else
<div class="empty-data fleft txt-center w-100">
    <h4 class="text-center empty__cate-title">Không có bình luận nào.</h4>
</div> --}}
@endif
<!--end item-vote -->

