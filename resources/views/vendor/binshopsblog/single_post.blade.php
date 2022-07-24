{{-- @extends("layouts.app",['title'=>$post->gen_seo_title()]) --}}
@extends('template.porto_video.layouts.master')

@section('content')

@section('blog-custom-css')
    <link type="text/css" href="{{ asset('binshops-blog.css') }}" rel="stylesheet">
@endsection

@section("content")
    
<div role="main" class="main">

    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-self-center p-static order-2 text-center">
                    <h1 class="text-dark font-weight-bold text-8">{{$post->title}}</h1>
                    <span class="sub-title text-dark">{{$post->subtitle}}</span>
                </div>
                <div class="col-md-12 align-self-center order-1">
                    <ul class="breadcrumb d-block text-center">
                        <li><a href="{{ route("/") }}">BERANDA</a></li>
                        <li href="#" class="active">BERITA</li>
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
                @if(\Auth::check() && \Auth::user()->canManageBinshopsBlogPosts())
                    <a href="{{$post->edit_url()}}" class="mb-2 btn btn-outline-secondary btn-sm pull-right float-right">Edit
                        Post</a>
                @endif
                <div class="blog-posts single-post">

                    <article class="post post-large blog-single-post border-0 m-0 p-0">

                        @include("binshopsblog::partials.show_errors")

                        <div class="post-date ms-0">
                            <span class="month">{{$post->post->posted_at->format("Y")}}</span>
                            <span class="day">{{$post->post->posted_at->format("d")}}</span>
                            <span class="month">{{$post->post->posted_at->format("M")}}</span>
                        </div>

                        <div class="post-content ms-0">

                            <h2 class="font-weight-semi-bold">
                                {{$post->title}}
                            </h2>

                            <div class="post-meta">
                                <span><i class="far fa-user"></i> By <a href="#">{{$post->post->author_string()}}</a> </span>
                                <span><i class="far fa-folder"></i> 
                                    @foreach($categories as $category)
                                    <a href="{{$category->categoryTranslations[0]->url($locale)}}">
                                        {{$category->categoryTranslations[0]->category_name}}
                                    </a>
                                    @endforeach
                                </span>
                                {{-- <span><i class="far fa-comments"></i> <a href="#">12 Comments</a></span> --}}
                            </div>

                            <div class="post-image ms-0">
                                @if(!empty($post->video))
                                <div class="position-relative">
                                    <div class="ratio ratio-4x3">
                                        <video controls id="video" class="float-start" width="100%" height="100%" muted loop preload="metadata" poster="{{$post->image_url('large')}}">
                                            <source src="/storage{{$post->video}}" type="video/mp4">
                                        </video>
                                        <a href="#" class="position-absolute top-50pct left-50pct transform3dxy-n50 bg-light rounded-circle d-flex align-items-center justify-content-center text-decoration-none bg-color-hover-primary text-color-hover-light play-button-lg pulseAnim pulseAnimAnimated" data-trigger-play-video="#video" data-trigger-play-video-remove="yes">
                                            <i class="fas fa-play text-5"></i>
                                        </a>
                                    </div>
                                </div>
                                @else 
                                    {!! $post->image_tag("large", false, 'd-block mx-auto img-fluid img-thumbnail img-thumbnail-no-borders rounded-0') !!}
                                @endif
                            </div>

                            {!! $post->post_body_output() !!}

                            <div class="post-block mt-5 post-share">
                                <h4 class="mb-3">Share this Post</h4>

                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                <div class="addthis_inline_share_toolbox"></div>
                                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-60ba220dbab331b0"></script>

                            </div>

                        </div>
                    </article>

                </div>
            </div>
        </div>

    </div>

@endsection

@section('blog-custom-js')
    <script src="{{asset('binshops-blog.js')}}"></script>
@endsection