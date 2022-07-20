@extends('template.porto_video.layouts.master')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css" rel="stylesheet" />
    <style>
        .star_active{
            color: orange;
        }
        .img-prw{
            max-width: 200px;
            max-height: 150px;
            border-radius: 5px;
            margin: 0 auto;
        }
        .dataTables_length {
            float:left;
        }
        .dataTables_wrapper .dt-buttons {
            float:right;
        }
        #example_filter label {
            margin-right: 10px;
            margin-top: 5px;
        }
        @media (max-width: 768px) {
            /* #example_filter label {
                float: right;
            } */
            .destination_image{
                height: 20vh;
            }
            .dt-buttons{
                margin-top: 20px;
            }
        }
    </style>
@endsection

@section('content')
        
    <div role="main" class="main">

        <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 align-self-center p-static order-2 text-center">
                        <h1 class="text-dark font-weight-bold text-8">REKAPITULASI</h1>
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
                <div class="col-lg-12 order-lg-1 table-responsive">
                    
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Rating</th>
                                <th>Alamat</th>
                                <th>Kab/Kota</th>
                                <th>Telp</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
    
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                dom: 'lBfrtip',
                language:{url:"/vendor/id.json"},
                buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
                searching: true,
                processing: true,
                serverSide: true,
                ajax:"{{route('recap.data')}}",
                columns: [                               
                    { 
                        "data": "photos",
                        "render": (data,type,row)=>{
                            // console.log(row)
                            // const cover = JSON.parse(row.photos.replace(/&quot;/g,'"'));
                            const cover = row.photos;
                            if(cover !== null) console.log(cover)
                            const image = cover?.length > 0 ? cover[0] : "/storage/foto_google/No_Image_Available.jpeg" ;
                            return `<img class="img-prw" src="${image}" />`;
                        },
                        "className":"text-center"
                    },
                    { "data": "name"},
                    { 
                        "data": "rating",
                        "render": (data,type)=>{
                            return `<i class="fa fa-star star_active"></i>(${data})`;
                        }
                    },
                    { "data": "alamat"},
                    { 
                        "data": "wilayah.name"
                    },
                    { "data": "phone"},
                ]
            });
        });
    </script>
@endsection