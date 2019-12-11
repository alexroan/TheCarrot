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
                                            <option value="{{ asset('/popups/images/keyring-black.png') }}">{{__('Black')}}</option>
                                            <option value="{{ asset('/popups/images/keyring-blue.png') }}">{{__('Blue')}}</option>
                                            <option value="{{ asset('/popups/images/keyring-burgundy.png') }}">{{__('Burgundy')}}</option>
                                            <option value="{{ asset('/popups/images/keyring-green.png') }}">{{__('Green')}}</option>
                                            <option value="{{ asset('/popups/images/keyring-orange.png') }}">{{__('Orange')}}</option>
                                            <option value="{{ asset('/popups/images/keyring-pink.png') }}">{{__('Pink')}}</option>
                                            <option value="{{ asset('/popups/images/keyring-purple.png') }}">{{__('Purple')}}</option>
                                            <option value="{{ asset('/popups/images/keyring-red.png') }}">{{__('Red')}}</option>
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