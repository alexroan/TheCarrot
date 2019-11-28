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

                    @if ($numberOfIntegrations == 0)
                        <div class="alert alert-warning" role="alert">
                            You have not integrated mailchimp, please do!
                                    <a href="{{ url('/auth/redirect/mailchimp') }}" class="btn btn-primary"><i class="fa fa-mailchimp"></i> Integrate Mailchimp</a>

                        </div>
                    @else
                        <div class="alert alert-success" role="alert">
                            You have {{$numberOfIntegrations}} mailchimp integrations
                        </div>
                    @endif
                    
                </div>

                

                
            </div>
        </div>
    </div>
</div>
@endsection
