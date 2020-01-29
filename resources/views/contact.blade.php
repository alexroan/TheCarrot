@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Contact Us</div>
                <div class="card-body">
                    <p>Please contact us with suggestions, issues, or just say hi.</p>
                    <form method="POST">
                        @csrf
        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
        
                        <div class="form-group row">
                            <label for="title" class="col-md-12 col-form-label">Title</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="" required>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label for="message" class="col-md-12 col-form-label">Message</label>
                            <div class="col-md-12">
                                <textarea name="message" id="message" cols="30" rows="8" class="form-control @error('message') is-invalid @enderror" required></textarea>
                                @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send') }}
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