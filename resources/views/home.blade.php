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
  @if(Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>You have an unresolved loan with this company. </strong>.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                
                <div class="card-body">
                    @if(Auth::user()->lenders)
                <h2>{{Auth::user()->lenders->company_name}}</h2>
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
            <div class="card-header"><form action="/home" method="get"><input type="search" name="search" class="form-control" placeholder="search"></form></div>
            
            <div class="card-body">
                <div class="row">
        
                    @foreach($ld as $a) 
                    
                    @if($a->category == Auth::user()->occupation)
                        <div class="col-sm-4">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">{{$a->company_name}}</h5>
                              <p class="card-text">{{$a->category}}.</p>
                              
                              @if(Auth::user()->lenders != null)
                                @if(Auth::user()->lenders->company_name == $a->company_name)
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-warning" disabled>
                                    Edit
                                </button>
                                @else
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{str_replace(' ', '', $a->company_name)}}">
                                        Apply
                                    </button>
                                @endif
                              @else
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{str_replace(' ', '', $a->company_name)}}">
                                    Apply
                                </button>
                              @endif
                             
                                
                              
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
                        @csrf<input type="submit" value="approve" class="btn btn-success"></form>  <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{str_replace(' ', '', $apps->user->name)}}">
                           view
                        </button></p>
                        
                       
                          
                        
                      </div>
                    </div>
                  </div>
                  <div class="modal fade" id="{{str_replace(' ', '', $apps->user->name)}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Applicant Profile</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <strong>Names: </strong>{{$apps->user->name}}
                            {{$apps->user->surname}}
                            <br><strong>ID: </strong>{{$apps->user->omang}}
                            <br><strong>Occupation: </strong>{{$apps->user->occupation}}
                            <br><strong>Salary: </strong>BWP{{$apps->user->salary}}/Yr
                            <hr>
                            <br><strong>Gender: </strong>{{$apps->user->gender}}
                            <br><strong>Address: </strong>{{$apps->user->address}}
                        <br><strong>Proof of Residence: </strong><img width="150" src="/storage/residences/{{$apps->user->residence}}" alt="">
                        <br><strong>Phone: </strong>{{$apps->user->phone}}

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  @else
                  <div class="col-sm-4">
                    <div class="card">
                      <div class="card-body">
                        <small>{{$apps->created_at->diffForHumans()}}</small>
                        <h5 class="card-title">Approved</h5>
                      <p class="card-text">Amount: {{$apps->amount}} <br> Plan: {{$apps->plan}} <br> by: {{$apps->user->name}} <br> Omang: {{$apps->user->omang}} </p>
                        
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
