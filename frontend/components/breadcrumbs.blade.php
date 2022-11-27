<div class="text-left wrap-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                    <ul class="breadcrumb">
                        <li class="breadcrumbs-item">
                            <a href="{{ makeLink('home') }}">{{ __('home.home') }}</a>
                        </li>

                        {{-- {{dd($breadcrumbs)}} --}}

                        @foreach ($breadcrumbs as $item)
                            @if(!empty($item['slug_full']))
                                @if ($loop->last)
                                <li class="breadcrumbs-item active"><a href="{{ $item['slug_full'] }}" class="currentcat">{{ $item['name'] }}</a></li>
                                @else
                                <li class="breadcrumbs-item"><a href="{{ $item['slug_full'] }}" class="currentcat">{{ $item['name'] }}</a></li>
                                @endif
                            @else
                                @if ($loop->last)
                                <li class="breadcrumbs-item active"><a href="{{ makeLink($type,$item['id']??'',$item['slug']??'') }}" class="currentcat">{{ $item['name'] }}</a></li>
                                @else
                                <li class="breadcrumbs-item"><a href="{{ makeLink($type,$item['id']??'',$item['slug'])??'' }}" class="currentcat">{{ $item['name'] }}</a></li>
                                @endif
                            
                            @endif
                        @endforeach

                        
                    </ul>
            </div>
        </div>
    </div>
</div>
