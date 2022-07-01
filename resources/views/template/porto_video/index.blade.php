@extends('template.porto_video.layouts.master')

@section('css')
    <style>
        .terkait_image{
            width:177px;
            height:103px;
            background-size: contain !important;
            background-position: center center !important;
        }
        .berita_image{
            width: 100%;
            height: 250px;
        }
        .keterangan_destinasi{
            position: absolute;
            bottom: 10px;
        }
        .star_active{
            color: orange;
        }
        .detail_destinasi_container{
            position: absolute;
            z-index: 1;
            color: white;
            height: 100%;
            width: 100%;
            padding: 20px 10px;
        }
        img.destinasi_image{
            object-fit: contain;
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
        }
        .destinasi_image_container{
            height: 400px;
            width: 100%;
        }
        .title_destinasi{
            background: rgba(0, 0, 0, 0.347);
            padding: 5px;
            border-radius: 5px;
        }
    </style>
@endsection
@section('content')
    
<section class="section border-0 video overlay overlay-show overlay-op-8 m-0" 
    data-video-path="{{Helper::getThemeAssets()}}video/disporapar" 
    data-plugin-video-background 
    data-plugin-options="{'posterType': 'webp', 'position': '50% 50%'}" 
    style="height: 100vh;"
>
    <div class="container position-relative z-index-3 h-100">
        <div class="row align-items-center h-100">
            <div class="col">
                <div class="d-flex flex-column align-items-center justify-content-center h-100">
                    <h1 class="position-relative text-color-light text-5 line-height-5 font-weight-medium px-4 mb-2 appear-animation" data-appear-animation="fadeInDownShorterPlus" data-plugin-options="{'minWindowWidth': 0}">
                        Selamat datang di website resmi
                    </h1>
                    <h1 
                        class="text-center text-color-light font-weight-extra-bold text-12 line-height-1 mb-2 appear-animation" 
                        data-appear-animation="blurIn" 
                        data-appear-animation-delay="1000" 
                        data-plugin-options="{'minWindowWidth': 0}"
                    >
                        DISPORAPAR KALBAR
                    </h1>
                    <a 
                        class="btn btn-primary btn-rounded btn-with-arrow-solid mt-5" 
                        href="#"
                        data-appear-animation="blurIn" 
                        data-appear-animation-delay="1000" 
                    >EXPLORE KALBAR<span><i class="fas fa-chevron-right"></i></span></a>
                </div>
            </div>
        </div>
        <a href="#main" class="slider-scroll-button position-absolute bottom-10 left-50pct transform3dx-n50" data-hash data-hash-offset="0" data-hash-offset-lg="80">Sroll To Bottom</a>
    </div>
</section>
<div role="main" class="main pb-5">
    <div class="container">
        <section id="featured_places">
            <h2 class="mb-0 mt-4 p word-rotator font-weight-semi-bold letters scale text-center appear-animation" data-appear-animation="fadeInDownShorterPlus">
                Xperiences
                <span> Wisata Kalbar</span>
            </h2>
            <p class="text-center">Hutan, rimba dan budaya</p>
            <div class="owl-carousel owl-theme full-width dots-morphing" data-plugin-options="{'items': 4, 'loop': false, 'nav': false, 'dots': true,'autoplay':true}">
                @foreach ($destinations as $item)    
                    <div>
                        <a href="{{ route("places",$item->slug) }}">
                            <span class="thumb-info thumb-info-centered-info thumb-info-no-borders">
                                <span class="thumb-info-wrapper">
                                    <div class="detail_destinasi_container">
                                        <p class="fs-3 mb-0 text-light title_destinasi">{{$item->name}}</p>
                                        <div class="keterangan_destinasi">
                                            <p class="mb-0 text-light">{{ $item->wilayah->name }}</p>
                                            <div>
                                                @for ($i = 0; $i < floor($item->rating); $i++)
                                                    <i class="fa fa-star star_active"></i>
                                                @endfor
                                                @for ($i = 0; $i < (5 - floor($item->rating)); $i++)
                                                    <i class="fa fa-star"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $image = json_decode($item->photos,true);
                                        $image = count($image) > 0 ? $image[0] : "/storage/foto_google/No_Image_Available.jpeg"; 
                                    @endphp
                                    <div class="destinasi_image_container" style="
                                        background: url({{$image}}) no-repeat;
                                        background-size: cover;
                                        background-position: center center;
                                    ">
                                        {{-- <img src="{{$image}}" class="destinasi_image" alt="{{$item->name}}"> --}}
                                    </div>
                                    <span class="thumb-info-title">
                                        {{-- <span class="thumb-info-inner">Project Title</span> --}}
                                        <span class="thumb-info-type">Selengkapnya</span>
                                    </span>
                                    {{-- <span class="thumb-info-action">
                                        <span class="thumb-info-action-icon"><i class="fas fa-plus"></i></span>
                                    </span> --}}
                                </span>
                            </span>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

        <section id="news">
            <h2 class="mb-0 mt-4 p word-rotator font-weight-semi-bold letters scale text-center appear-animation" data-appear-animation="fadeInDownShorterPlus">
                Berita Terbaru
            </h2>
            <div class="row mt-4">
                @foreach ($news as $item)    
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-lg-5">
                                <a href="{{ $item->url(app()->getLocale()) }}">
                                    <img 
                                        src="{{$item->image_url("medium")}}"
                                        class="rounded-start berita_image" alt="{{$item->title}}"
                                    >
                                </a>
                            </div>
                            <div class="col-lg-7">
                                    <div class="card-body destination_details">
                                        <a href="{{ $item->url(app()->getLocale()) }}">
                                            <h4 class="card-title mb-1 text-4 font-weight-bold">{{$item->title}}</h4>
                                        </a>
                                        <p>{!! mb_strimwidth($item->post_body_output(), 0, 100, "...") !!}</p>
                                        <a href="{{ $item->url(app()->getLocale()) }}" class="read-more text-color-primary font-weight-semibold text-2">Selengkapnya <i class="fas fa-angle-right position-relative top-1 ms-1"></i></a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <section id="services">
            <h2 class="mb-0 mt-4 p word-rotator font-weight-semi-bold letters scale text-center appear-animation" data-appear-animation="fadeInDownShorterPlus">
                Layanan & Link Terkait
            </h2>
            <div class="row mt-4">
                <div class="owl-carousel owl-theme show-nav-hover" data-plugin-options="{'items': 4, 'margin': 10, 'loop': false, 'nav': true, 'dots': false}">
                    @foreach ($link_terkait as $item)    
                        {{-- @for ($i = 0; $i < 10; $i++)     --}}
                            <a href="{{ $item->target }}">
                                <div
                                    class="terkait_image"
                                    style="background: url({{$item->image}}) no-repeat;"
                                ></div>
                                {{-- <img 
                                    alt="{{ $item->name }}" class="img-fluid rounded" 
                                    src="{{ $item->image }}"> --}}
                            </a>
                        {{-- @endfor --}}
                    @endforeach
                </div>
            </div>
        </section>

    </div>
</div>
    
@endsection