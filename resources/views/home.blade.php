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

                    @if ($accountName == null)
                        <div class="alert alert-danger" role="alert">
                            You have not integrated a mailchimp account, please do!
                                    <a href="{{ url('/auth/redirect/mailchimp') }}" class="btn btn-primary"><i class="fa fa-mailchimp"></i> Connect Mailchimp Account</a>

                        </div>
                    @else

                        <div class="alert alert-success" role="alert">
                            Your mailchimp account '{{$accountName}}' is connected
                        </div>

                            <table class="table table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Carrot</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($lists->count() < 1)
                                    <tr>
                                        <td colspan="3">
                                            No lists configured!
                                            <a href="{{ url('/mailchimp/lists') }}" class="btn btn-primary"><i class="fa fa-mailchimp"></i>Select List</a>
                                        </td>
                                    </tr>
                                    @else
                                        @foreach ($lists as $list)
                                            <tr>
                                                <th>{{ $list->list_id }}</th>
                                                <td>{{ $list->list_name }}</td>
                                                <td>

                                                    @if ($list->carrot)
                                                        <input disabled class="form-control-sm input-sm" type="text" name="carrot-file" id="carrot-file" value="&lt;script src='{{ $list->carrot->carrot_file }}'&gt;&lt;/script&gt;">
                                                    @else
                                                        <a href="{{ url('/carrot/create') }}?listId={{ $list->id }}" class="btn btn-primary btn-sm"><i class="fa fa-mailchimp"></i>Create Carrot!</a>
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
    </div>
</div>
@endsection
