@extends('template.porto_video.layouts.master')

@section('content')
    
<section class="section border-0 video overlay overlay-show overlay-op-8 m-0" 
    data-video-path="{{Helper::getThemeAssets()}}video/disporapar" 
    data-plugin-video-background 
    data-plugin-options="{'posterType': 'jpg', 'position': '50% 50%'}" 
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
                        class="text-color-light font-weight-extra-bold text-12 line-height-1 mb-2 appear-animation" 
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
    
@endsection