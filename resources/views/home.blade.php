@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($accountsCount == 0)
                        <div class="alert alert-danger" role="alert">
                            You have not integrated a mailchimp account, please do!
                                    <a href="{{ url('/auth/redirect/mailchimp') }}" class="btn btn-primary"><i class="fa fa-mailchimp"></i> Connect Mailchimp Account</a>

                        </div>
                    @else
                        @foreach ($accounts as $account)

                            

                        @endforeach
                        <div class="alert alert-success" role="alert">
                            You have {{$accountsCount}} connected mailchimp accounts
                        </div>
                    @endif
                    
                </div>

                

                
            </div>
        </div>
    </div>
</div>
@endsection
