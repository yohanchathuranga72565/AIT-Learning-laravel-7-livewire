  
    <form wire:submit.prevent='validation'>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Link Your Child</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p>Please enter your child email address</p>
            <div class="form-group row">
                <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                <div class="col-md-10">
                    <input  type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"  autocomplete="email" wire:model.lazy='email'>
                    {{-- {{ $error }} --}}
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </form>
    
