@extends('layouts.app')

@section('content')
    <div class="row ml-5 mt-5">
        <a href="{{ route('assignments',$assignment[0]->teacher->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
    </div>
    <div class = "p-5">
        <div class="row">
            <div class="col-12">
                <form action="{{ route("saveAssignment",$assignment[0]->id) }}" method ="POST" accept-charset="UTF-8" enctype="multipart/form-data" class="dropzone dz-clickable" id="file-upload" >
                    @csrf
                    <div class="dz-default dz-message">
                        <span>
                            <img src="{{asset('adminPanel\dist\img\upload.png')}}" width="20%"  alt="Upload Image"><br/>
                            Drop files here to upload
                        </span>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    
@endsection
@section('script')
<script> 
    Dropzone.options.fileUpload = {
        maxFiles: 1,
      maxFtilesize :20,
      acceptedFiles :'.jpeg,.jpg,.png,.pdf,.zip',
      addRemoveLinks : true,
      removedfile: function (file) {
        var name = file.upload.filename;
        $.ajax({
          headers: {
            'X-CSRF-TOKEN' : $('meta[name = "_token"]').attr('content')
          },
          type: 'POST',
          url: '{{ route("deleteInDropbox",$assignment[0]->id) }}',
          data: {filename: name},
          success: function (data){
            console.log("File has been successfully removed!");
            console.log(name);
          },
          error: function (e){
            console.log(e);
          }
        });
        var fileRef;
        return (fileRef = file.previewElement) != null ?
          fileRef.parentNode.removeChild(file.previewElement) : void 0;
      },
    };
  </script>  
@endsection