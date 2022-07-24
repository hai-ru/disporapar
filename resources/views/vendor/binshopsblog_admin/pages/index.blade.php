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
                "url":"{{route('admin.pages.data',['type'=>1])}}",
                "dataSrc":function(json){
                    temp_data = json.data;
                    return json.data;
                },
            },
            columns: [
                {"data": "title"},
                {"data": "id"}
            ]
        })
    </script>
@endsection