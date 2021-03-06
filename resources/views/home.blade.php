@extends('layouts.app')

@section('content')

@php
    // this gets set later in the page. If true, print the modal to the page, otherwise, dont
    $showModal = false;
@endphp

@push('scripts')
    <script src="{{ asset('js/home.js')}}"></script>
@endpush
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($accountName == null)
                        <div class="alert alert-info" role="info">
                            Connect your Mailchimp account and start growing you email list!
                        </div>
                        <a href="{{ url('/auth/redirect/mailchimp') }}" class="btn btn-primary mb-4"> Connect Mailchimp Account</a>
                        <div class="alert alert-info" role="info">
                            No Mailchimp account? No worries! It's super easy to create an account and get started gathering email addresses for free!
                            Use <a target="_blank" href="https://mailchimp.com/" class="btn btn-info btn-sm"> This Button</a> to create an account.
                            Once you've created an account and have a username and password for Mailchimp, head back here and click the button above to connect!
                        </div>
                    @else
                        <table class="table table-striped table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Impressions</th>
                                    <th scope="col">New Subscribers</th>
                                    <th scope="col">Duplicate Subscribers</th>
                                    <th scope="col">Total Conversions</th>
                                    <th scope="col">Conversion Rate</th>
                                    <th scope="col">Embed Code</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($lists->count() < 1)
                                <tr>
                                    <td colspan="8">
                                        <a href="{{ url('/mailchimp/lists') }}" class="btn btn-primary">Choose Mailchimp Audience</a>
                                        <div class="alert alert-info mt-2" role="info">
                                            No audiences yet? An audience is a list of email addresses that you market your products to.
                                            Head over to <a class="btn btn-info btn-sm" href="http://mailchimp.com" target="_blank">Mailchimp</a>
                                            to create one.
                                        </div>
                                    </td>
                                </tr>
                                @else
                                    @foreach ($lists as $list)
                                        @php
                                            $conversions = 0;
                                            $percent = 0;
                                            $impressions = 0;
                                            $subscribers = 0;
                                            $alreadySubscribers = 0;
                                            if ($list->carrot) {
                                                $impressions = $list->stats->impressions;
                                                $subscribers = $list->stats->subscribers;
                                                $alreadySubscribers = $list->stats->alreadySubscribers;
                                                $conversions = $subscribers + $alreadySubscribers;
                                                if ($impressions != 0) {
                                                    $percent = round(($conversions / $impressions) * 100, 2);
                                                }
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $list->list_name }}</td>
                                            <td>{{ $impressions }}</td>
                                            <td>{{ $subscribers }}</td>
                                            <td>{{ $alreadySubscribers }}</td>
                                            <td>{{ $conversions }}</td>
                                            <td>{{ $percent }}&percnt;</td>
                                            <td>

                                                @if ($list->carrot)
                                                    @php
                                                        $showModal = true;
                                                    @endphp
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#code-modal">
                                                        Copy
                                                    </button>
                                                    <!-- <input disabled class="form-control-sm input-sm" type="text" name="carrot-file" id="carrot-file" value="&lt;script src='{{ $list->carrot->carrot_file }}'&gt;&lt;/script&gt;"> -->
                                                @else
                                                    <a href="{{ url('/carrot/create') }}?listId={{ $list->id }}" class="btn btn-primary btn-sm">Create Carrot!</a>
                                                @endif

                                            </td>
                                            <td>
                                                @if ($list->carrot)
                                                    <a href="{{ url('/carrot/create') }}?listId={{ $list->id }}" class="btn btn-info btn-sm">Edit</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                        
                    @endif
                    
                </div>
            </div>
        </div>
        @if ($showModal == true)
            <div class="modal fade" id="code-modal" tabindex="-1" role="dialog" aria-labelledby="code-modal-label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="code-modal-label">Embed Code</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-info" role="alert">
                                Please copy the following code and paste into the HEAD tag of your website.
                            </div>
                            <p>
                                <pre class="bg-dark text-white"><code>&lt;script src='{{ $list->carrot->carrot_file }}'&gt;&lt;/script&gt;</code></pre>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
