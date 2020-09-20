<div class="form-group row">
    <label for="grade" class="col-md-4 col-form-label text-md-right">{{ __('Grade') }}</label>

    <div class="col-md-6">
        <select id="grade" type="text" class="form-control @error('grade') is-invalid @enderror" name="grade" value="{{ old('grade') }}" required autocomplete="grade">
            <option selected>Choose...</option>
            @foreach ($grades as $grade)
                <option value="{{ $grade->id }}">{{ $grade->grade }}</option>
            @endforeach
        </select>
        @error('grade')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
