@extends('layouts.app')
@section('title', 'Edit Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4">
            <form action="{{ route('profiles.update', $user) }}" method="POST">
                @csrf
                @method('put')
                <div class="card">
                    <div class="card-header text-md-center">{{ __('Profile') }}</div>
                    <div class="card-body">

                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">

                        <div class="row mb-3">
                            <label for="name" class="col-md-12 col-form-label text-md-start">{{ __('Name') }}</label>

                            <div class="col-md-12">
                                <input id="name" type="name" class="form-control" name="name"
                                    value="{{ Auth::user()->name }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-12 col-form-label text-md-start">{{ __('Email') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ Auth::user()->email }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gender" class="col-md-12 col-form-label text-md-start">{{ __('Gender') }}</label>

                            <div class="col-md-12">
                                <div>
                                    <input type="radio" class="form-check-input @error('gender') is-invalid @enderror"
                                        id="male" name="gender" value="Male"
                                        {{ Auth::user()->gender == 'Male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>

                                <div>
                                    <input type="radio" class="form-check-input @error('gender') is-invalid @enderror"
                                        id="female" name="gender" value="Female"
                                        {{ Auth::user()->gender == 'Female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label for=dateofbirth"
                                class="col-md-12 col-form-label text-md-start">{{ __('Date of Birth') }}</label>

                            <div class="col-md-12">
                                <input type="date" name="dateofbirth" id="dateofbirth"
                                    class="form-control @error('dateofbirth') is-invalid @enderror" required
                                    autocomplete="dateofbirth" value="{{ Auth::user()->dateofbirth }}">

                                @error('dateofbirth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="country"
                                class="col-md-12 col-form-label text-md-start">{{ __('Country') }}</label>

                            <div class="col-md-12">
                                <select name="country" id="country"
                                    class="form-control form-select @error('country') is-invalid @enderror" required>
                                    <option selected disabled>Choose a Country </option>
                                    @foreach ($countries as $countryId => $countryValue)
                                        <option value={{ $countryValue }}
                                            {{ Auth::user()->country == $countryValue ? 'selected' : '' }}>
                                            {{ $countryValue }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row mt-3 justify-content-center">
                    <div class="col-md-10 text-center">
                        <button class="btn btn-primary btn-lg" type="submit">Save</button>
                    </div>
            </form>
        </div>
    </div>
    </div>
@endsection
