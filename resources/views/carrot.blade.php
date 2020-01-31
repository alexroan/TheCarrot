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

    function onFontChange() {
        //Get the font details
        let select = document.getElementById('font-select');
        let selectedOption = select.options[select.selectedIndex];
        let family = selectedOption.getAttribute('data-family');
        let category = selectedOption.getAttribute('data-category');

        //Add the new font as a link
        let frame = document.getElementById('preview-frame');
        let signupcarrotDiv = frame.contentDocument.getElementById('signupcarrot');
        let newLink = frame.contentDocument.createElement('link');
        newLink.rel = "stylesheet";
        newLink.href = "https://fonts.googleapis.com/css?family=" + family + "&display=swap";
        signupcarrotDiv.appendChild(newLink);

        //Set the font family
        signupcarrotDiv.setAttribute("style", "font-family: '"+family+"', "+category+"!important");
    }

    function iframeLoaded() {
        onTitleChange();
        onSubtitleChange();
        onFontChange();
    }

    function onBlacklistCheckboxChange() {
        let enable = document.getElementById('enable-blacklist').checked;
        let blacklist = document.getElementById('blacklist-urls');
        console.log(enable, blacklist);
        if (enable == true) {
            blacklist.disabled = false;
        }
        else {
            blacklist.disabled = true;
        }
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
                    <div class="alert alert-info" role="info">
                        Please disable any ad blockers for the preview to display properly!
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <form id="create-form" name="create-form" method="POST">
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
                                        <label for="font-select" class="col-form-label">{{__('Font')}}</label>
                                        <select onchange="onFontChange()" class="browser-default custom-select" name="font-select" id="font-select">
                                            @foreach ($fonts as $singleFont)
                                                @php
                                                    $selectedText = "";
                                                    if($singleFont->id == $font->id) {
                                                        $selectedText = "selected";
                                                    }
                                                @endphp
                                                <option {{$selectedText}} data-family="{{$singleFont->family}}" 
                                                    data-category="{{$singleFont->category}}" value="{{ $singleFont->id }}">{{__($singleFont->family)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="keyring-select" class="col-form-label">
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
                                <iframe onload="iframeLoaded()" id="preview-frame" src="{{ config('app.url') }}/popups/preview" frameborder="0">
                                </iframe>
                            </div>
                        </div>

                        <div class="col-md-9 offset-md-3">

                            @php
                                $disabledString = "disabled";
                                $checkedString = "";
                                if($blacklistEnabled) {
                                    $disabledString = "";
                                    $checkedString = "checked";
                                }
                            @endphp

                            <div class="alert alert-info mt-2">
                                If you are inserting your carrot on every page, but wish to hide it on certain pages, enable url blacklisting.
                            </div>

                            <div class="form-check">
                                <input {{ $checkedString }} class="form-check-input" form="create-form" type="checkbox" name="enable-blacklist" id="enable-blacklist" onchange="onBlacklistCheckboxChange();">
                                <label for="enable-blacklist" class="form-check-label">Enable URL Blacklist</label>
                            </div>

                            <label for="blacklist-urls" class="col-form-label">{{__('Blacklisted Urls - (Separate each with new line)')}}</label>

                            <textarea class="form-control" form="create-form" name="blacklist-urls" id="blacklist-urls" cols="30" rows="4" {{ $disabledString }}>{{ $blacklist }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection