@php($lang_id = app()->getLocale())
<div class="tabs tabs-dark mb-4 pb-2">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link show active text-1 font-weight-bold text-uppercase" href="#recentPosts" data-bs-toggle="tab">
            Terbaru
        </a></li>
        <li class="nav-item"><a class="nav-link text-1 font-weight-bold text-uppercase" href="#popularPosts" data-bs-toggle="tab">
            Populer
        </a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" id="popularPosts">
            <ul class="simple-post-list">
                @foreach (Helper::getPost([["popular"=>1]]) as $item)    
                    <li>
                        <div class="post-image">
                            <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                <a href="{{ $item->url($lang_id) }}">
                                    <img src="{{ $item->image_url("thumbnail") }}" width="50" height="50" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="post-info">
                            <a href="{{ $item->url($lang_id) }}">{{$item->getTitle(40)}}</a>
                            <div class="post-meta">
                                {{$item->created_at->format("M d, Y")}}
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="tab-pane active" id="recentPosts">
            <ul class="simple-post-list">
                @foreach (Helper::getPost([["recent"=>1]]) as $item)    
                    <li>
                        <div class="post-image">
                            <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                <a href="{{ $item->url($lang_id) }}">
                                    <img src="{{ $item->image_url("thumbnail") }}" width="50" height="50" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="post-info">
                            <a href="{{ $item->url($lang_id) }}">{{$item->getTitle(40)}}</a>
                            <div class="post-meta">
                                {{$item->created_at->format("M d, Y")}}
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>