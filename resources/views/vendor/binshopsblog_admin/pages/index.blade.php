@extends("binshopsblog_admin::layouts.adminlte")

@section('styles')
    
@endsection

@section("content")

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Admin - Manage Blog Posts</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('binshopsblog.admin.create_post',['type'=>1]) }}" class="btn btn-primary float-right mb-2"><i class="fa fa-plus"></i> Tambah Halaman</a>
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
                {
                    "data": "title",
                    "render": (data,type,row)=>{
                        return data+`
                            <div>
                                <a href="/pages/${row.slug}" target="_blank" class="card-link btn btn-outline-secondary btn-xs"><i class="fa fa-file-text-o" aria-hidden="true"></i> View Post</a>
                                <a href="/admin/edit_post/${row.post_id}?type=1" class="card-link btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Post</a>
                                <button onclick="deleteData(${row.post_id})" class="card-link btn btn-danger btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Delete</button>
                            </div>`
                    },
                },
                {
                    "data": "id",
                    "render": (data,type,row)=>{
                        const dating = new Date(row.post.posted_at)
                        const datetime = dating.toLocaleDateString()+" "+dating.toLocaleTimeString()
                        const update = new Date(row.updated_at)
                        const updated = update.toLocaleDateString()+" "+update.toLocaleTimeString()
                       return `
                        <p>Dipublis : ${datetime}</p>
                        <p>Dilihat : ${row.views}</p>
                        <p>Penulis : ${row.author}</p>
                        <p>Diubah : ${updated}</p>
                       `
                    },
                }
            ]
        })

        const deleteData = (id) => {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (!willDelete) return null;
                $.ajax({
                    url:'/admin/delete_post/'+id,
                    type:'post',
                    data:{_method:'delete'},
                    success:function(res){
                        console.log(res)
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    },
                    error:function(e){

                    }
                })                
            });
           
        }
    </script>
@endsection