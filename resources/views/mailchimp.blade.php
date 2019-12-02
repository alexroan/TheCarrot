@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Select List') }}</div>
                
                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="list-select" class="col-md-4 col-form-label text-md-right">{{ __('Select your list') }}</label>
                            <div class="col-md-4">
                                <select id="list-select" name="list-select" class="browser-default custom-select">
                                    @foreach ($lists as $list)
                                        <option value="{{ $list->id }}">{{ $list->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Select') }}
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
