@extends('layouts.app')
@if(Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ Session::get('message') }}</strong> You should check in on some of those fields below.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif


@section('content')
<div class="container">

  @if(Auth::user()->lenders)
  @if(!Auth::user()->lenders->verified)
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Please verify your business to enhance credibility!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
  @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                
                <div class="card-body">
                    @if(Auth::user()->lenders)
                    <a href="#" class="btn btn-warning">View Profile</a>
                    @else
                    <a href="lenders/create" class="btn btn-info">Become Lender</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

   
<br><br>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><input type="search" class="form-control" placeholder="search"></div>
            
            <div class="card-body">
                <div class="row">
        
                    @foreach($ld as $a) 
                    
                    @if($a->category == Auth::user()->occupation)
                        <div class="col-sm-4">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">{{$a->company_name}}</h5>
                              <p class="card-text">{{$a->category}}.</p>
                              
                              <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{str_replace(' ', '', $a->company_name)}}">
                                   Apply
                                </button>
                                
                              
                            </div>
                          </div>
                        </div>
                          <!-- Modal -->
                          <div class="modal fade" id="{{str_replace(' ', '', $a->company_name)}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{$a->company_name}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="/applications" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                    
                                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>
                                            
                                            <div class="col-md-6">
                                                <input id="amount" type="number" min=100 max=10000 class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required>
                                                @error('amount')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        <div class="form-group row">
                                            <label for="plan" class="col-md-4 col-form-label text-md-right">{{ __('Plan') }}</label>
                                    
                                            <div class="col-md-6">
                                                <select class="form-control" name="plan" id="" required>
                                                    <option value="" disabled selected>Payment Plan</option>
                                                    <option value="1 month">1 month</option>
                                                    <option value="2 months">2 months</option>
                                                    <option value="3 months">3 months</option>
                                                </select>
                                              
                                                @error('plan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        <input type="hidden" name="lender_id" value="{{$a->id}}">
                                        <input type="submit" value="Apply" class="btn btn-success">
                                      </form>
                                </div>
                                
                            </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                      </div>


            </div>
        </div>
    </div>
</div>

<br><br>
@if(Auth::user()->lenders != null)
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Applications') }}</div>
            
            <div class="card-body">
                @foreach($loanapps as $apps)
                @if($apps->isPending) 
                <div class="col-sm-4">
                    <div class="card">
                      <div class="card-body">
                        <small>{{$apps->created_at->diffForHumans()}}</small>
                        <h5 class="card-title">Pending </h5>
                      <p class="card-text">Amount: {{$apps->amount}} <br> Plan: {{$apps->plan}} <br> {{$apps->user->name}} <br>  <form method="post" action="/applications/{{$apps->id}}">@method('PATCH')
                        @csrf<input type="submit" value="approve" class="btn btn-success"></form></p>
                        
                       
                          
                        
                      </div>
                    </div>
                  </div>
                  @endif
                @endforeach

            </div>
        </div>
    </div>
</div>
@endif
  
<br><br>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Application History') }}</div>
            
            <div class="card-body">
                @foreach($applications as $app)
                @if($app->isPending) 
                <div class="col-sm-4">
                    <div class="card">
                      <div class="card-body" style="background: rgba(255, 255, 0, 0.589)">
                        <h5 class="card-title">Pending</h5>
                        <p class="card-text">Amount: {{$app->amount}} <br> Plan: {{$app->plan}} <br> {{$app->lender->company_name}} <br>{{$app->created_at->diffForHumans()}}</p>
                      </div>
                    </div>
                  </div>
                  @else
                  <div class="col-sm-4">
                    <div class="card">
                      <div class="card-body" style="background: rgba(0, 255, 42, 0.589)">
                        <small>{{$app->created_at->diffForHumans()}}</small>
                        <h5 class="card-title">Approved</h5>
                        <p class="card-text">Amount: {{$app->amount}} <br> To be paid in: {{$app->plan}} <br> {{$app->lender->company_name}} <br> {{$app->message}}</p>
                      </div>
                    </div>
                  </div>
                  @endif
                @endforeach

            </div>
        </div>
    </div>
</div>

</div>
@endsection
