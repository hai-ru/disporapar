@extends("binshopsblog_admin::layouts.adminlte")

@section('styles')
@endsection

@section("content")
    <div class="dropzone" id="myDropzone"></div>
    
    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title">Admin - Configuration video</h3>
        </div>
        <div class="card-body">
            <form id="form_post">
                <div class="form-group">
                    <label>Video link</label>
                    <input class="form-control" name="video_url" value="{{$video_url}}" />
                </div>
                <button class="btn btn-primary btn-block">Save</button>
            </form>
            <h5 class="mt-5">Video preview : </h5>
            <video width="100%" controls>
                <source src="{{ Str::contains('.mp4',$video_url) ? $video_url : $video_url.".mp4" }}" type="video/mp4">
            </video>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        Dropzone.options.myDropzone = {
            url:'{{route("destinations.upload")}}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            accepts:'.mp4',
            success: function (file, response) {
                this.removeFile(file);
            }
        };
        $("#form_post").validate({
            submitHandler:function(form){
                form = $(form)
                const data = getFormData(form)
                const btn = form.find('button')
                const btn_txt = btn.text()
                $.ajax({
                    url:'{{ route("admin.config.update") }}',
                    type:'post',
                    data:data,
                    beforeSend:function(){
                        btn.attr('disabled',true)
                        btn.text('Loading')
                    },
                    complete:function(){
                        btn.removeAttr('disabled')
                        btn.text(btn_txt)

                    },
                    success:function(res){
                        swal('',res.message,res.status)
                    },
                    error:function(e){
                        console.log(e)
                        swal('',res.message,res.status)
                    }
                })
                return false;
            }
        })
      </script>
@endsection
