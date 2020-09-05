<!-- Modal -->
<div class="modal fade" id="edit-profile-image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('teacherProfileUpload')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Your Profile Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-info">Please insert 163px X 163px size images for the qulity propose</p>
                <input type="file" name="image" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
            </div>
        </form>
    </div>
</div>