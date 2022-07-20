@extends('template.porto_video.layouts.master')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .star_active{
            color: orange;
        }
        .category_list {
            display: flex;
            align-items: center;
            justify-content: space-around;
            list-style-type: none;
            white-space: nowrap;
            position: relative;
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
            padding: 0px 10px;
            padding-left: 120px;
        }
        img.icon {
            height: 50px;
            width: 50px;
            background: #f6f6f6;
            border-radius: 100px;
            padding: 4px;
            margin-right: 10px;
        }
        .category_list li.active a{
            color: white;
        }
        .category_list li.active{
            background-color: #007dc5;
            color: white;
        }
        .category_list li:hover a{
            color: white;
        }
        .category_list li:hover{
            background-color: #007dc5;
            color: white;
        }
        .category_list li {
            border-color: #007dc5;
            background: #FFF;
            border-width: 1px;
            border-style: solid;
            border-radius: 5px;
            padding: 5px 20px;
            cursor: pointer;
            margin: 0px 5px;
        }
        .category_places{
            background: #f6f6f6;
            padding: 20px;
        }
        .destination_image{
            height: 100%;
            width: 100%;
            background-size: cover;
            background-position: center center;
        }
        .destination_details{
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 5px 10px;
        }
        .list_places{
            height: 700px;
            overflow-y: auto;
            padding-left: 10px;
            padding-right: 10px;
        }
        #map {
            height: 100%;
        }
        .list_container{
            padding-right: 0px;
        }
        .map_container{
            padding-left: 0px;
        }
        .head_search{
            padding: 10px;
            padding-bottom: 0px;
        }
        img.img-preview_iw{
            max-height: 200px;
            width: 100%;
        }
        .title_destination{
            color:#007dc5;
        }
        .select2-selection__rendered {
            line-height: 40px !important;
        }
        .select2-container .select2-selection--single {
            height: 40px !important;
        }
        .select2-selection__arrow {
            height: 40px !important;
        }
        @media (max-width: 768px) {
            .destination_image{
                height: 20vh;
            }
        }
    </style>
@endsection

@section('content')
    <div role="main" class="main">

        <section class="category_places">
            <h3 class="text-center">Kategori Destinasi</h3>
            <ul class="category_list">
                @foreach ($category as $item)    
                    <li class="{{ $category_place === $item->slug ? "active" : "" }}">
                        <a href="{{ route("destinations",$item->slug) }}">
                            <img 
                                src="{{ $item->icon }}" 
                                class="icon"
                            /> 
                            {{ $item->name }}
                        </a>
                    </li>
                @endforeach
                </ul>
        </section>

        <div class="row">
            <div class="col-md-4 list_container">
                <div class="head_search">
                    <h5>Daftar destinasi</h5>
                    <form class="row" id="search_form">
                        <div class="form-group col-md-6">
                            <input class="form-control" name="search" placeholder="Pencarian destinasi..." />
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <select id="wilayah" class="form-control" name="wilayah">
                                    <option value="">-- Semua Kota/Kab --</option>
                                    @foreach ($wilayah as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary" id="search_btn"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <section class="list_places" id="list"></section>
            </div>
            <div class="col-md-8 map_container">
                <div id="map"></div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDpoXg_iNv-dAAXEM1mek_sSKqLijSNOI&callback=initMap&v=weekly"
      defer
    ></script>
    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
    <script>
        const category = "{{ $category_place_id }}";
        let map;
        let markers = [];
        let clusterer;

        let list;

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 8,
                center: { lat: -0.3192801, lng: 109.3693163 },
            });
            clusterer = new markerClusterer.MarkerClusterer({ map });
        }

        const loadList = () => {
            const elm = $("#list");
            elm.empty();
            list.map( item => {
                console.lo
                try {
                    item.cover = item.photos;
                } catch (error) {
                    item.cover = [];
                }
                const image = item.cover?.length > 0 ? item.cover[0]: "/storage/foto_google/No_Image_Available.jpeg";
                // const image = ""
                const alamat = item.alamat === null ? "" :
                `<p class="mb-0 pb-0"><i class="fa fa-map-marker-alt"></i> ${item.alamat}</p>`
                const phone = item.phone === null ? "" :
                `<p class="mb-0 pb-0"><i class="fa fa-phone"></i> ${item.phone}</p>`
                let star = "";
                for (let index = 0; index < Math.floor(item.rating); index++) {
                    star += '<i class="fa fa-star star_active"></i>';
                    
                }
                for (let index = 0; index < 5 - Math.floor(item.rating); index++) {
                    star += '<i class="fa fa-star "></i>';
                    
                }
                let control_btn = ""
                @if(!Auth::guest())
                    control_btn = `<button onclick="delete_destinasi('${item.slug}',this)" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>`;
                @endif
                elm.append(`
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-sm-4">
                                <a href="/places/${item.slug}">
                                    <div class="rounded-start destination_image" style="background-image:url('${image}')"></div>
                                </a>
                            </div>
                            <div class="col-sm-8">
                                    <div class="card-body destination_details">
                                        ${control_btn}
                                        <a href="/places/${item.slug}">
                                            <h4 class="card-title mb-1 text-4 font-weight-bold">${item.name}</h4>
                                        </a>
                                        ${alamat}
                                        ${item.category_place?.name}
                                        ${phone}
                                        <div>${star}</div>
                                        <a href="/places/${item.slug}" class="read-more text-color-primary font-weight-semibold text-2">Selengkapnya <i class="fas fa-angle-right position-relative top-1 ms-1"></i></a>
                                    </div>
                            </div>
                        </div>
                    </div>
                `);
            })
        }

        const delete_destinasi = (slug,btn) => {
            btn = $(btn)
            btn_html = btn.html();
            $.ajax({
                url:"{{route('admin.destination')}}",
                type:"POST",
                data:{slug:slug},
                beforeSend:function(){
                    btn.html('<i class="fas fa-sync fa-spin"></i>')
                    btn.attr('disabled',true)
                },
                complete:function(){
                    btn.html(btn_html)
                    btn.removeAttr('disabled')
                },
                success: res => {

                    if(!res.status) return console.log(res.message);
                    
                    loadData({
                        "category_place":category
                    })

                },
                error: e => {
                    console.log(e)
                }
            })
        }

        const loadData = (body) => {
            body = body ?? {}
            $.ajax({
                url:"{{route('load_markers')}}",
                type:"POST",
                data:body,
                beforeSend:function(){
                    $("#search_btn").html('<i class="fas fa-sync fa-spin"></i>')
                    $("#search_btn").attr('disabled',true)
                },
                complete:function(){
                    $("#search_btn").html('<i class="fas fa-search"></i>')
                    $("#search_btn").removeAttr('disabled')
                },
                success: res => {

                    if(!res.status) return console.log(res.message);

                    list = res.data;
                    loadList();

                    loadMarkers();

                    if(body !== {} && list.length > 0){
                        const data = list.find(elm => elm.latitude !== null);
                        // console.log(data)
                        map.setCenter({lat:data.latitude,lng:data.longitude})
                    }

                },
                error: e => {
                    console.log(e)
                }
            })
        }

        const loadMarkers = () => {
            const infoWindow = new google.maps.InfoWindow({
                content: "",
                disableAutoPan: true,
            });

            clearMarkers();
            
            let markers = [];
            // Add some markers to the map.
            // markers = list.map((item, i) => {
            list.forEach((item, i) => {
                if(item.latitude === null) return null;
                const position =  { lat: item.latitude, lng: item.longitude };
                const marker = new google.maps.Marker({
                    position:position,
                    draggable:true
                });

                // markers can only be keyboard focusable when they have click listeners
                // open info window when marker is clicked
                marker.addListener("click", () => {
                    try {
                        item.cover = item.photos;
                    } catch (error) {
                        item.cover = []
                    }
                    const image = item.cover.length > 0 ? item.cover : "/storage/foto_google/No_Image_Available.jpeg";
                    const alamat = item.alamat === null ? "" :
                    `<p class="mb-0 pb-0"><i class="fa fa-map-marker-alt"></i> ${item.alamat}</p>`
                    const phone = item.phone === null ? "" :
                    `<p> class="mb-0 pb-0"><i class="fa fa-phone"></i> ${item.phone}</p>`
                    infoWindow.setContent(`
                    <div class="row pb-3">
                        <div class="col-md-6">
                            <a href="/places/${item.slug}">
                                <img class="img-preview_iw" src="${image}" />
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="/places/${item.slug}">
                                <h1 class="mb-0 title_destination">${item.name}</h1>
                            </a>
                            ${alamat}
                            ${phone}
                            <a href="/places/${item.slug}" class="btn btn-primary d-grid mt-2">Selengkapnya</a>
                            <a href="https://www.google.com/maps/place/${item.latitude},${item.longitude}" class="btn btn-primary d-grid mt-2">Lihat Track</a>
                        </div>
                    </div>
                    `);
                    infoWindow.open(map, marker);
                });
                // return marker;
                markers.push(marker);
            });

            // Add a marker clusterer to manage the markers.
            // new MarkerClusterer({ markers, map });
            clusterer.addMarkers(markers);
        }

        const clearMarkers = () => {
            for (var i = 0; i < markers.length; i++ ) {
                markers[i].setMap(null);
            }
            clusterer.clearMarkers();
            markers = []
        }


        $(document).ready(()=>{
            loadData({
                "category_place":category
            })
            $("#wilayah").select2()
        })

        $("#search_form").submit(()=>{
            const elm = $("#search_form");
            const search = elm.find("input[name=search]").val()
            const wilayah = elm.find("select[name=wilayah]").val()
            loadData({
                "wilayah_id":wilayah,
                "name":search,
                "category_place":category
            })
            return false;
        })

        window.initMap = initMap;
    </script>
@endsection