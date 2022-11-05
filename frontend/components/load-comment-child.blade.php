
<div class="warp-item-child-comment">
    <div class="item-rep-comment">
        <div class="item-vote-header">
            <div class="item-vote-title-left fleft">
                <span class="item-vote-user">{{$childValue->name}}</span>
            </div>
            <div class="item-vote-time-right fright">
                <i class="far fa-clock"></i>
                {{$childValue->created_at->format('d/m/Y')}}
            </div>
            <div class="cboth"></div>
        </div>
        <div class="box-cmt__box-question">
            <div class="item-vote-question">
                {{-- <strong>Phản hồi:</strong> --}}
                {!! $childValue->content !!}
            </div>
    
            <div class="btn-rep-cmt respondent">
                <div class="lc_reply link">
                    <a class="btn-modal-create-comment open-modal-reply-comment" data-toggle="modal" data-target="#modalReplyComment" data-name="{{$childValue->name}}" data-id="{{$childValue->id}}" data-type_comment={{$childValue->type_comment}}>Trả lời</a>
                </div>
                <div class="lc_like link js-like" data-url="{{route('product.like.comment')}}" data-id="{{$childValue->id}}">
                    <span class="icon-like">
                        @if($childValue->like > 0)
                            <i class="fa fa-thumbs-up"></i>
                        @endif
                    </span>
                    Thích
                    <span class="product-review-cout total-like-{{$childValue->id}}" data-like="{{$childValue->like}}">
                        {{$childValue->like > 0 ? '('.$childValue->like.')' : ''}}</span>
                </div>
            </div>
        </div>
    </div>
</div>