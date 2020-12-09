@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="gender" id="" required>
                                    <option value="" disabled selected>Select Your Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                              
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="omang" class="col-md-4 col-form-label text-md-right">{{ __('Omang') }}</label>

                            <div class="col-md-6">
                                <input id="omang" type="number"min=100010000 max=999929999 class="form-control @error('omang') is-invalid @enderror" name="omang" value="{{ old('Omang') }}" required autocomplete="omang" autofocus>

                                @error('omang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <label for="occupation" class="col-md-4 col-form-label text-md-right">{{ __('Occupation') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="occupation" id="" required>
                                    <option value="" disabled selected>Your Occupation</option>
                                    <option value="student">Student</option>
                                    <option value="self_employed">Self Employed</option>
                                    <option value="employed">Employed</option>
                                    <option value="unemployed">Unemployed</option>
                                </select>
                              
                                @error('occupation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <label for="salary" class="col-md-4 col-form-label text-md-right">{{ __('Annual Salary') }}</label>
                            
                            <div class="col-md-6">
                                <input id="salary" type="number" min=100 class="form-control @error('salary') is-invalid @enderror" name="salary" value="{{ old('salary') }}" autocomplete="salary" autofocus>
                                <small style="color:rgb(121, 121, 0)">*if employed or self-employed</small>
                                @error('salary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <label for="employer" class="col-md-4 col-form-label text-md-right">{{ __('Employer') }}</label>
                            
                            <div class="col-md-6">
                                <input id="employer" type="text" min=100 class="form-control @error('employer') is-invalid @enderror" name="employer" value="{{ old('employer') }}" autocomplete="employer" autofocus>
                                <small style="color:rgb(121, 121, 0)">*if employed or self-employed</small>
                                @error('employer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <label for="employer_email" class="col-md-4 col-form-label text-md-right">{{ __('Employer Email') }}</label>
                            
                            <div class="col-md-6">
                                <input id="employer_email" type="email" min=100 class="form-control @error('employer_email') is-invalid @enderror" name="employer_email" value="{{ old('employer_email') }}" autocomplete="employer_email" autofocus>
                                <small style="color:rgb(121, 121, 0)">*if employed or self-employed</small>
                                @error('employer_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone #') }}</label>
                            
                            <div class="col-md-6">
                                <input id="phone" type="number" min=71000000 max=77999999 class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <label for="residence" class="col-md-4 col-form-label text-md-right">{{ __('Proof of Residence') }}</label>
                            
                            <div class="col-md-6">
                                <input id="residence" type="file"  class="form-control @error('phone') is-invalid @enderror" name="residence"  required>
                                @error('residence')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
