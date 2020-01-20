@extends('layouts.app')

@section('content')
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
                        <div class="alert alert-danger" role="alert">
                            <a href="{{ url('/auth/redirect/mailchimp') }}" class="btn btn-primary"><i class="fa fa-mailchimp"></i> Connect Mailchimp Account</a>
                        </div>
                    @else

                        <div class="alert alert-success" role="alert">
                            Your mailchimp account '{{$accountName}}' is connected
                        </div>

                            <table class="table table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Impressions</th>
                                        <th scope="col">New Subs</th>
                                        <th scope="col">Total Conversions</th>
                                        <th scope="col">Conversion Rate</th>
                                        <th scope="col">Carrot</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($lists->count() < 1)
                                    <tr>
                                        <td colspan="6">
                                            <a href="{{ url('/mailchimp/lists') }}" class="btn btn-primary"><i class="fa fa-mailchimp"></i>Choose Mailchimp Audience</a>
                                        </td>
                                    </tr>
                                    @else
                                        @foreach ($lists as $list)
                                            @php
                                                $conversions = 0;
                                                $percent = 0;
                                                $impressions = 0;
                                                $subscribers = 0;
                                                if ($list->carrot) {
                                                    $impressions = $list->stats->impressions;
                                                    $subscribers = $list->stats->subscribers;
                                                    $conversions = $subscribers + $list->stats->alreadySubscribers;
                                                    if ($impressions != 0) {
                                                        $percent = round(($conversions / $impressions) * 100, 2);
                                                    }
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $list->list_name }}</td>
                                                <td>{{ $impressions }}</td>
                                                <td>{{ $subscribers }}</td>
                                                <td>{{ $conversions }}</td>
                                                <td>{{ $percent }}&percnt;</td>
                                                <td>

                                                    @if ($list->carrot)
                                                        <input disabled class="form-control-sm input-sm" type="text" name="carrot-file" id="carrot-file" value="&lt;script src='{{ $list->carrot->carrot_file }}'&gt;&lt;/script&gt;">
                                                    @else
                                                        <a href="{{ url('/carrot/create') }}?listId={{ $list->id }}" class="btn btn-primary btn-sm"><i class="fa fa-mailchimp"></i>Create Carrot!</a>
                                                    @endif

                                                </td>
                                                <td><a href="{{ url('/carrot/create') }}?listId={{ $list->id }}" class="btn btn-primary btn-sm"><i class="fa fa-mailchimp"></i>Edit</a></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                        
                    @endif
                    
                </div>

                

                
            </div>
        </div>
    </div>
</div>
@endsection
