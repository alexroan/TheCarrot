@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Admin - Register New Partner') }}</div>
                <div class="card-body">

                    @if(!empty($message))
                        @if($status == false)
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @else
                            <div class="alert alert-success" role="alert">
                                {{ $message }}
                            </div>
                        @endif
                    @endif

                    <form method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-4 text-md-right">
                                <label for="name" class="col-form-label">{{ __('Name') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input required class="form-control" type="text" name="name" id="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4 text-md-right">
                                <label for="email" class="col-form-label">{{ __('Email') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input required class="form-control" type="email" name="email" id="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4 text-md-right">
                                <label for="companyname" class="col-form-label">{{ __('Company Name') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input required class="form-control" type="text" name="companyname" id="companyname">
                                @error('companyname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-4">
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