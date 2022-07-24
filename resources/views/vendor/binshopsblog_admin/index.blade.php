@extends("binshopsblog_admin::layouts.adminlte")

@section('styles')
    
@endsection

@section("content")

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Admin - Manage Blog Posts</h3>
        </div>
        <div class="card-body">
            <table id="example" class="table table-hover">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Judul</th>
                        <th>Meta</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
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
                "url":"{{route('admin.pages.data',['type'=>0])}}",
                "dataSrc":function(json){
                    temp_data = json.data;
                    return json.data;
                },
            },
            columns: [
                { 
                    "data": "photos",
                    "render": (data,type,row)=>{
                        return `<img class="img-prw" src="${data}" />`;
                    },
                    "className":"text-center"
                },
                {
                    "data": "title",
                    "render": (data,type,row)=>{
                        // console.log(row)
                        return data+`
                            <div>
                                <a href="/id/blog/${row.slug}" target="_blank" class="card-link btn btn-outline-secondary btn-xs"><i class="fa fa-file-text-o" aria-hidden="true"></i> View Post</a>
                                <a href="/admin/edit_post/${row.post_id}" class="card-link btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Post</a>
                            </div>`
                    },
                },
                {"data": "id"}
            ]
        })
    </script>
@endsection