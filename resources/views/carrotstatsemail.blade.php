<html>
    <body>
        <h1>Carrot Stats</h1>
        <table>
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Impressions</th>
                    <th scope="col">New Subs</th>
                    <th scope="col">Total Conversions</th>
                    <th scope="col">Conversion Rate</th>
                </tr>
            </thead>
            <tbody>
                @if ($data->count() > 0)
                    @foreach ($data as $carrot)
                        @php
                            $percent = 0;
                            $impressions = $carrot->stats->impressions;
                            $subscribers = $carrot->stats->subscribers;
                            $conversions = $subscribers + $carrot->stats->alreadySubscribers;
                            if ($impressions > 0) {
                                $percent = ($conversions / $impressions) * 100;
                            }
                        @endphp
                        <tr>
                            <td>{{ $carrot->id }}</td>
                            <td>{{ $impressions }}</td>
                            <td>{{ $subscribers }}</td>
                            <td>{{ $conversions }}</td>
                            <td>{{ $percent }}&percnt;</td>
                        </tr>
                        
                    @endforeach
                @endif
            </tbody>
        </table>
    </body>
</html>