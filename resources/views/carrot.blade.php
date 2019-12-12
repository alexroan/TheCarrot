@extends('layouts.app')

@section('content')

<script type="application/javascript" >
    function setKeyringImage() {
        var x = document.getElementById("keyring-select").value;
        document.getElementById("keyring-image").setAttribute('src', x);
    }

</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{__('Create Your Carrot')}}
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-8">
                            <form method="POST">
                                @csrf

                                <input type="hidden" name="list-id" id="list-id" value="{{ $listId }}">
        
                                <div class="form-group row">
                                    <div class="col-md-6 text-md-right">
                                        <label for="title-text" class="col-form-label">{{__('Title your Carrot')}}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="title-text" id="title-text" />
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <div class="col-md-6 text-md-right">
                                        <label for="subtitle-text" class="col-form-label">{{__('Subtitle on your Carrot')}}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="subtitle-text" id="subtitle-text" />
                                    </div>
                                </div>
        
                                <div class="form-group row">
        
                                    <label for="keyring-select" class="col-md-6 col-form-label text-md-right">
                                        {{__('Choose your keyring colour')}}
                                    </label>
                                    <div class="col-md-6">
                                        <select onChange="setKeyringImage()" class="browser-default custom-select" name="keyring-select" id="keyring-select">
                                            @foreach ($products as $product)
                                                @php
                                                    $image = asset($product->image);
                                                @endphp
                                                <option value="{{ $image }}">{{__($product->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <img id="keyring-image" width="100%" src="{{ asset('/popups/images/keyring-black.png') }}" alt="black keyring">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection