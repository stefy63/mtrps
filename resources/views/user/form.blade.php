<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user?->name) }}" id="name" placeholder="Name">
        </div>
        <div class="form-group mb-2 mb20">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user?->email) }}" id="email" placeholder="Email">
        </div>
        <div class="form-group mb-2 mb20">
            <label for="password" class="form-label">{{ __('Email') }}</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password', $user?->password) }}" id="password" placeholder="Password">
        </div>
        <div class="form-group mb-2 mb20">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Email') }}</label>
            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Confirm Password">
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>