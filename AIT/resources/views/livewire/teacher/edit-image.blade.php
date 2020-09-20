<form wire:submit.prevent='profileUpload'>
    <div class="modal-content"> 
    <div class="modal-header"> 
        <h5 class="modal-title" id="exampleModalLabel">Edit Your Profile Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body text-center">
        {{-- error --}}
        @error('image')
            <span class="error text-danger">
                <p>{{ $message }}</p>
            </span>
        @enderror
        @if ($image)
            <img src="{{ $image->temporaryUrl() }}" class="mb-1" width="200">
        @endif
        <div wire:loading wire:target="image"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></div>
        <br/>
        <button class="btn btn-sm btn-primary" onclick="document.getElementById('image').click(); return false;">Select Image</button>
        <input type="file" id="image"  class = "d-none @error('image') is-invalid @enderror"  wire:model.debounce.500ms="image">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Upload</button>
    </div>
    </div>
</form>

