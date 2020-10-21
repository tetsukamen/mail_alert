{{ $alert->name }}　{{ $alert->first_alert_timing->format('G時i分前') }}になりました。

{{ $alert->date_or_type }} {{ $alert->time->format('G:i') }}から{{ $alert->name }}です。

{{ $first_alert_timing }}