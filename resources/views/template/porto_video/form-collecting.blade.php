@extends('template.porto_video.layouts.master')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css" rel="stylesheet" />
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
                    <h1 class="text-dark font-weight-bold text-8">{{ $category->name }}</h1>
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
        @if(!Auth::guest())
        <div class="form-group">
            <label>Kab/Kota</label>
            <select class="form-control" id="wilayah">
                <option value="">-- Semua Kota/Kab --</option>
                @foreach (\App\Models\Wilayah::all() as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <form>
            <input type="hidden" name="category_id" value="{{$category->id}}" />
            <div class="form-group">
                <label>Objek Wisata</label>
                <select required class="form-control" name="attach_to" id="place"></select>
            </div>
            @foreach ($form as $item)
                {!! $item->render() !!}
            @endforeach
            <div class="d-grid mb-5">
                <button class="btn btn-primary btn-fluid">Simpan</button>
            </div>
        </form>
        @endif

        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama Destinasi</th>
                    <th>Alamat</th>
                    @foreach ($form as $item)
                        <th>{{ $item->column_name }}</th>
                    @endforeach
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script>

        const wilayah_dom = $("#wilayah").select2()
        $("#place").select2()

        const form = $("form")
        form.validate({
            submitHandler:function(form){
                const json = getFormData($(form))
                // console.log(json)
                const btn = $(form).find('button');
                const btn_text = btn.html();
                console.log(btn)
                $.ajax({
                    url:"{{route('collecting.store',$id)}}",
                    type:"POST",
                    data:json,
                    beforeSend:function(){
                        btn.attr("disabled",true)
                        btn.html(`Loading ...`)
                    },
                    complete:function(){
                        btn.removeAttr("disabled")
                        btn.html(btn_text)
                    },
                    success:function(res){
                        table.draw(false)
                    },
                    error:function(e){
                        console.log(e)
                    }
                })
                return false;
            }
        });

        $('#wilayah').on("select2:select", function(e) { 
            const id = $(e.currentTarget).val();
            searchPlace({wilayah_id:id})
        });
        
        const searchPlace = (data) => {
            $.ajax({
                url:"{{ route('places.search') }}",
                type:"POST",
                data:data,
                beforeSend:()=>{
                    $("#place").select2({"disabled":true})
                },
                success:(res)=>{
                    $("#place").select2('destroy').empty().select2({"disabled":false,data:res})
                },
                error:(e)=>{
                    console.log(e)
                    $("#place").select2('destroy').empty().select2({"disabled":false,data:[]})
                }
            })
        }

        let temp_data = []

        const table = $('#example').DataTable({
            dom: 'lBfrtip',
            language:{url:"/vendor/id.json"},
            buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
            searching: true,
            ordering: false,
            processing: true,
            serverSide: true,
            responsive: true,
            ajax:{
                "url":"{{route('collecting.data',['id'=>$category->id])}}",
                "dataSrc":function(json){
                    temp_data = json.data;
                    return json.data;
                },
            },
            columns: [                               
                { 
                    "data": "photos",
                    "render": (data,type,row)=>{
                        const cover = row.photos;
                        const image = cover?.length > 0 ? cover[0] : "/storage/foto_google/No_Image_Available.jpeg" ;
                        return `<img class="img-prw" src="${image}" />`;
                    },
                    "className":"text-center"
                },
                { 
                    "data": "name",
                    "render": (data,type,row,index)=>{
                        @if(!Auth::guest())
                            const action = `<br/> <button onclick="edit(${index.row})" class="btn btn-primary btn-xs">Edit</button>`;
                            data = data+action;
                        @endif
                        return data;
                    },
                },
                { 
                    "data": "alamat",
                    "render": (data,type,row)=>{
                        return row.alamat;
                    }
                },
                @foreach ($form as $item)
                { 
                    "data": "id",
                    "render": (data,type,row)=>{
                        return row["{{ $item->column_name }}"];
                    },
                },
                @endforeach

            ]
        });

        const edit = (index) => {
            const data = temp_data[index]
            console.log(data)
            data.form_store.forEach((elm,index)=>{
                form.find(`[name=${elm.colecting_forms_id}]`).val(elm.value);
            })
            $("#place").select2('destroy').empty().select2({"disabled":false,data:[{id:data.id,text:data.name}]})
            $("#place").val(data.id).trigger("change");
            $("#wilayah").val(data.wilayah_id).trigger("change");
        }

    </script>
@endsection