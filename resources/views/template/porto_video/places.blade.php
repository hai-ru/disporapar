@extends('template.porto_video.layouts.master')

@section('css')
    <style>
        img.img-preview_iw{
            max-height: 200px;
            width: 100%;
        }
        .star_active{
            color: orange;
        }
        #map {
            height: 500px;
        }
        img.destination_image{
            height: 151px;
            width: 100%;
        }
        .destination_details{
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 5px 10px;
        }
    </style>
@endsection

@section('content')
<div role="main" class="main">
    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-12 mt-4 order-1">
                <div class="owl-carousel owl-theme dots-morphing" data-plugin-options="{'responsive': {'0': {'items': 1}, '479': {'items': 1}, '768': {'items': 1}, '979': {'items': 1}, '1199': {'items': 1}}, 'loop': true, 'autoHeight': true, 'margin': 10}">
                    @foreach (json_decode($place->photos,true) as $item)    
                    {{-- @for ($i = 0; $i < 5; $i++)     --}}
                        <div>
                            <img alt="{{$place->name}}" class="img-fluid rounded" 
                            src="{{$item}}"
                            >
                        </div>
                    {{-- @endfor --}}
                    @endforeach
                </div>
            </div>
            <div class="col-lg-12 order-2">
                
                <div class="blog-posts single-post">

                    <article class="post post-large blog-single-post border-0 m-0 p-0">
                        <h1 class="mb-1">{{$place->name}}</h1>
                        <p class="mb-1"><i class="fa fa-map-marker-alt"></i> {{$place->alamat}}</p>
                        <p class="mb-1">Google Review : 
                            @php($gray = 5 - floor($place->rating))
                            @for ($i = 0; $i < floor($place->rating); $i++)
                                <i class="fa fa-star star_active"></i>
                            @endfor
                            @for ($i = 0; $i < $gray; $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                        </p>
                        @if(!empty($place->phone))<p class="mb-1"><i class="fa fa-phone"></i> {{$place->phone}}</p> @endif
                        <h5 class="mt-5">Highlight</h5>
                        {!! $place->description !!}
                        <div class="post-block mb-5 post-share">
                            <h4 class="mb-3">Share this Post</h4>

                            <!-- Go to www.addthis.com/dashboard to customize your tools -->
                            <div class="addthis_inline_share_toolbox"></div>
                            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-60ba220dbab331b0"></script>

                        </div>
                    </article>

                </div>
            </div>
            <div class="col-lg-6 order-3">
                <div id="map"></div>
            </div>
            <div class="col-lg-6 order-4">
                <div class="tabs">
                    <ul class="nav nav-tabs nav-justified flex-column flex-md-row">
                        <li class="nav-item">
                            <a class="nav-link active" href="#popular10" data-bs-toggle="tab" class="text-center">WISATA TERDEKAT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#recent10" data-bs-toggle="tab" class="text-center">WISATA TERKAIT</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="popular10" class="tab-pane active">
                            @foreach ($nearest as $item)    
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-lg-5">
                                            <a href="/places/{{$item->slug}}">
                                                <img 
                                                    @php($image = json_decode($item->photos))
                                                    src="{{ $image[0] ?? "/storage/foto_google/No_Image_Available.jpeg"  }}" 
                                                    class="rounded-start destination_image" alt="..."
                                                >
                                            </a>
                                        </div>
                                        <div class="col-lg-7">
                                                <div class="card-body destination_details">
                                                    <a href="/places/{{$item->slug}}">
                                                        <h4 class="card-title mb-1 text-4 font-weight-bold">{{$item->name}}</h4>
                                                    </a>
                                                    <button class="btn btn-xs btn-success">{{ number_format($item->distance,2) }} KM</button>
                                                    @if(!empty($place->alamat))<p class="mb-1"><i class="fa fa-map-marker-alt"></i> {{$place->alamat}}</p> @endif
                                                    @if(!empty($place->phone))<p class="mb-1"><i class="fa fa-phone"></i> {{$place->phone}}</p> @endif
                                                    <div>
                                                        @php($gray = 5 - floor($item->rating))
                                                        @for ($i = 0; $i < floor($item->rating); $i++)
                                                            <i class="fa fa-star star_active"></i>
                                                        @endfor
                                                        @for ($i = 0; $i < $gray; $i++)
                                                            <i class="fa fa-star"></i>
                                                        @endfor
                                                    </div>
                                                    <a href="/places/{{$item->slug}}" class="read-more text-color-primary font-weight-semibold text-2">Selengkapnya <i class="fas fa-angle-right position-relative top-1 ms-1"></i></a>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div id="recent10" class="tab-pane">
                            @foreach ($related as $item)    
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-lg-4">
                                            <a href="/places/{{$item->slug}}">
                                                <img 
                                                    @php($image = json_decode($item->photos))
                                                    src="{{ $image[0] ?? "/storage/foto_google/No_Image_Available.jpeg"  }}" 
                                                    class="rounded-start destination_image" alt="..."
                                                >
                                            </a>
                                        </div>
                                        <div class="col-lg-8">
                                                <div class="card-body destination_details">
                                                    <a href="/places/{{$item->slug}}">
                                                        <h4 class="card-title mb-1 text-4 font-weight-bold">{{$item->name}}</h4>
                                                    </a>
                                                    @if(!empty($place->alamat))<p class="mb-1"><i class="fa fa-map-marker-alt"></i> {{$place->alamat}}</p> @endif
                                                    @if(!empty($place->phone))<p class="mb-1"><i class="fa fa-phone"></i> {{$place->phone}}</p> @endif
                                                    <a href="/places/{{$item->slug}}" class="read-more text-color-primary font-weight-semibold text-2">Selengkapnya <i class="fas fa-angle-right position-relative top-1 ms-1"></i></a>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDpoXg_iNv-dAAXEM1mek_sSKqLijSNOI&callback=initMap&v=weekly"
    defer
    ></script>
    <script>
        function initMap() {
            const myLatLng = { 
                    lat:{{$place->latitude}},
                    lng:{{$place->longitude}}
            };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: myLatLng,
            });

            const marker = new google.maps.Marker({
                position: myLatLng,
                map,
            });

            const infoWindow = new google.maps.InfoWindow({
                content: "",
                disableAutoPan: true,
            });

            marker.addListener("click", () => {
                const cover = JSON.parse("{{$place->photos}}".replace(/&quot;/g,'"'));
                const image = cover.length > 0 ? `
                    <img class="img-preview_iw" src="${cover}" />` : "";
                infoWindow.setContent(`
                <div class="row pb-3">
                    <div class="col-md-6">
                        ${image}
                    </div>
                    <div class="col-md-6">
                        <a href="/places/{{$place->slug}}">
                            <h1 class="mb-0 title_destination">{{$place->name}}</h1>
                        </a>
                        @if($place->alamat)<p class="mb-0 pb-0"><i class="fa fa-map-marker-alt"></i> {{$place->alamat}}</p>@endif
                        @if($place->phone)<p class="mb-0 pb-0"><i class="fa fa-phone"></i> {{$place->phone}}</p>@endif
                        <a href="https://www.google.com/maps/place/{{$place->latitude}},{{$place->longitude}}" class="btn btn-primary d-grid mt-2">Lihat Track</a>
                    </div>
                </div>
                `);
                infoWindow.open(map, marker);
            });

            google.maps.event.trigger(marker, 'click')
            
        }

        window.initMap = initMap;
    </script>
@endsection