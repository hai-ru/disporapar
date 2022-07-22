{{--Used on the index page (so shows a small summary--}}
{{--See the guide on binshops.binshops.com for how to copy these files to your /resources/views/ directory--}}
{{--https://binshops.binshops.com/laravel-blog-package--}}
<div class="col-sm-6">

    <article class="card pb-0 card-border card-border-bottom card-border-hover bg-color-light box-shadow-6 box-shadow-hover anim-hover-translate-top-10px transition-3ms">
        <a href="{{$post->url($locale)}}">
            <img 
                src="{{ $post->image_url("large") }}" 
                class="card-img-top img-thumbnail img-thumbnail-no-borders rounded-0" 
                alt="{{$post->title}}" 
            />
        </a>

        <div class="card-body">

            <h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a href="{{$post->url($locale)}}">{{$post->title}}</a></h2>
            <p>{!! mb_strimwidth($post->post_body_output(), 0, 200, "...") !!}</p>

            <div class="post-meta">
                <span><i class="far fa-calendar"></i> <a href="#">{{date('d M Y ', strtotime($post->post->posted_at))}}</a></span>
                <span>
                    <i class="far fa-folder"></i> 
                    @foreach($categories as $category)
                    <a href="{{$category->categoryTranslations[0]->url($locale)}}">
                        {{$category->categoryTranslations[0]->category_name}}
                    </a>
                    @endforeach
                </span> <br />
            </div>
            
        </div>

        <div class="card-footer text-uppercase">
            <a href="{{$post->url($locale)}}" class="read-more text-color-primary font-weight-semibold text-2">BACA SELENGKAPNYA <i class="fas fa-angle-right position-relative top-1 ms-1"></i></a>
        </div>
    </article>
</div>