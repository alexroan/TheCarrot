@extends('layouts.app')

@section('content')

<script type="application/javascript" >

    function onTitleChange() {
        let content = document.getElementById('title-text').value;
        let frame = document.getElementById('preview-frame');
        let signupcarrotTitle = frame.contentDocument.getElementById('signupcarrot-title');
        signupcarrotTitle.innerHTML = content;
    }

    function onSubtitleChange() {
        let content = document.getElementById('subtitle-text').value;
        let frame = document.getElementById('preview-frame');
        let signupcarrotTitle = frame.contentDocument.getElementById('signupcarrot-subtitle');
        signupcarrotTitle.innerHTML = content;
    }

    function iframeLoaded() {
        onTitleChange();
        onSubtitleChange();
    }

</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{__('Create Your Carrot')}}
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-3">
                            <form method="POST">
                                @csrf
                                <input type="hidden" name="list-id" id="list-id" value="{{ $listId }}">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="title-text" class="col-form-label">{{__('Title')}}</label>
                                        <input type="text" class="form-control" name="title-text" id="title-text" value="{{ $carrotTitle }}" onkeyup="onTitleChange();" onpaste="onTitleChange();" oninput="onTitleChange();" />
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="subtitle-text" class="col-form-label">{{__('Subtitle')}}</label>
                                        <input type="text" class="form-control" name="subtitle-text" id="subtitle-text" value="{{ $carrotSubtitle }}" onkeyup="onSubtitleChange();" onpaste="onSubtitleChange();" oninput="onSubtitleChange();" />
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="keyring-select" class="col-form-label text-md-right">
                                            {{__('Product Offering')}}
                                        </label>
                                        <select class="browser-default custom-select" name="keyring-select" id="keyring-select">
                                            @foreach ($products as $product)
                                                @php
                                                    $id = $product->id;
                                                    $image = asset($product->image);
                                                @endphp
                                                <option data-image="{{ $image }}" value="{{ $id }}">{{__($product->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <br>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="col-md-9">
                            <div class="preview-frame-wrap">
                                <iframe onload="iframeLoaded()" id="preview-frame" src="http://thecarrot.local/popups/preview" frameborder="0">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection