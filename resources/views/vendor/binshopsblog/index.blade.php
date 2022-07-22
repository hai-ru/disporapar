{{-- @extends("layouts.app",['title'=>$title]) --}}
@extends('template.porto_video.layouts.master')

@section('css')
    <style>
        .post-meta span {
            margin-right: 10px;
        }
        nav[aria-label="Pagination Navigation"] {
            text-align:center;
        }
        nav[aria-label="Pagination Navigation"] 
        p{
            margin: 10px auto;
        }
        nav[aria-label="Pagination Navigation"] 
        svg{
            max-width:20px;
            max-height:20px;
        }
    </style>
@endsection

@section("content")
  
<div role="main" class="main">

    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-self-center p-static order-2 text-center">
                    <h1 class="text-dark font-weight-bold text-8">Semua Berita Terkini</h1>
                    @if(\Auth::check() && \Auth::user()->canManageBinshopsBlogPosts())
                        <div class="text-center">
                            <p class='mb-1'>You are logged in as a blog admin user.
                                <br>
                                <a href='{{route("binshopsblog.admin.index")}}'
                                class='btn border  btn-outline-primary btn-sm '>
                                    <i class="fa fa-cogs" aria-hidden="true"></i>
                                    Go To Blog Admin Panel</a>
                            </p>
                        </div>
                    @endif
                </div>
                <div class="col-md-12 align-self-center order-1">
                    <ul class="breadcrumb d-block text-center">
                        <li><a href="{{ route("/") }}">BERANDA</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-4">

        <div class="row">
            <div class="col-lg-3 order-lg-2">
                <aside class="sidebar">
                    @include("template.porto_video.partials.search_forms")
                    @include("template.porto_video.partials.category_list")
                    @include("template.porto_video.partials.recent_populer")
                </aside>
            </div>
            <div class="col-lg-9 order-lg-1">

                @if($category_chain)
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                @forelse($category_chain as $cat)
                                    / <a href="{{$cat->categoryTranslations[0]->url($locale)}}">
                                        <span class="cat1">{{$cat->categoryTranslations[0]['category_name']}}</span>
                                    </a>
                                @empty @endforelse
                            </div>
                        </div>
                    </div>
                @endif

                @if(isset($binshopsblog_category) && $binshopsblog_category)
                    <h2 class='text-center'> {{$binshopsblog_category->category_name}}</h2>

                    @if($binshopsblog_category->category_description)
                        <p class='text-center'>{{$binshopsblog_category->category_description}}</p>
                    @endif

                @endif

                <div class="blog-posts">

                    <div class="row px-3">

                        @forelse($posts as $post)

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
                        

                        @empty
                            <div class="col-md-12">
                                <div class='alert alert-danger'>No posts!</div>
                            </div>
                        @endforelse

                    </div>

                </div>
                {!! $posts->links() !!}
            </div>
        </div>

    </div>
    
</div>

@endsection
