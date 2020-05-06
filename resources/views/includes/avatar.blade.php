@if( Auth::user()->image )
    <div class="form-group row">
        <label for="image" class="col-md-4 col-form-label text-md-right align-items-center">{{ __('Imagen Actual') }}</label>
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <img src="{{ route('user.avatar', ['filename'=>Auth::user()->image]) }}" alt="" style="max-width: 150px; max-height: 150px;" />
        </div>
    </div>
@endif