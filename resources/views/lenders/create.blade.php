@extends('layouts.app')

@section('content')
<div class="container">
   
        <form method="POST" action="/lenders" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>

                <div class="col-md-6">
                    <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}" required autofocus>

                    @error('company_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                <div class="col-md-6">
                    <select class="form-control" name="category" id="" required>
                        <option value="" disabled selected>Your Target Audience</option>
                        <option value="student">Students</option>
                        <option value="employed">Working Individuals</option>
                        <option value="unemployed">Non Working Individuals</option>
                    </select>
                  
                    @error('category')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

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
                
                <label for="bio" class="col-md-4 col-form-label text-md-right">{{ __('Company Bio') }}</label>
                
                <div class="col-md-6">
                    <textarea class="form-control" name="description" id="" cols="30" rows="10"></textarea>
                  
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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
@endsection
