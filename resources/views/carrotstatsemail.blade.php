<html>
    <body>
        <h1>Carrot Stats</h1>
        <table>
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Impressions</th>
                    <th scope="col">New Subs</th>
                    <th scope="col">Already Subs</th>
                    <th scope="col">Total Conversions</th>
                    <th scope="col">Proceed to Checkout</th>
                    <th scope="col">Conversion Rate</th>
                    <th scope="col">Impressions to Checkout Rate</th>
                    <th scope="col">Conversions to Checkout Rate</th>
                </tr>
            </thead>
            <tbody>
                @if ($data->count() > 0)
                    @foreach ($data as $carrot)
                        @php
                            $emailPercent = 0;
                            $impressionsToCheckout = 0;
                            $subscribersToCheckout = 0;
                            $impressions = $carrot->stats->impressions;
                            $subscribers = $carrot->stats->subscribers;
                            $alreadySubscribers = $carrot->stats->alreadySubscribers;
                            $proceedToCheckout = $carrot->stats->proceedToCheckout;
                            $conversions = $subscribers + $alreadySubscribers;
                            if ($impressions > 0) {
                                $emailPercent = round(($conversions / $impressions) * 100, 2);
                                $impressionsToCheckout = round(($proceedToCheckout / $impressions) * 100, 2);
                            }
                            if ($conversions > 0) {
                                $subscribersToCheckout = round(($proceedToCheckout / $conversions) * 100, 2);
                            }
                        @endphp
                        <tr>
                            <td>{{ $carrot->id }}</td>
                            <td>{{ $impressions }}</td>
                            <td>{{ $subscribers }}</td>
                            <td>{{ $alreadySubscribers }}</td>
                            <td>{{ $conversions }}</td>
                            <td>{{ $proceedToCheckout }}</td>
                            <td>{{ $emailPercent }}&percnt;</td>
                            <td>{{ $impressionsToCheckout }}&percnt;</td>
                            <td>{{ $subscribersToCheckout }}&percnt;</td>
                        </tr>
                        
                    @endforeach
                @endif
            </tbody>
        </table>
    </body>
</html>