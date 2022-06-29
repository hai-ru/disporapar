@extends('template.porto_video.layouts.master')

@section('content')
    
<div role="main" class="main">

    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-self-center p-static order-2 text-center">
                    <h1 class="text-dark font-weight-bold text-8">{{$post->title}}</h1>
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
            <div class="col-lg-12 order-lg-1">
                
                <div class="blog-posts single-post">

                    <article class="post post-large blog-single-post border-0 m-0 p-0">

                        @include("binshopsblog::partials.show_errors")

                        <div class="post-content ms-0">

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

</div>
    
@endsection