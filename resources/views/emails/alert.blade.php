{{ $alert->name }} <br><br>

予定の{{ $alert->first_alert_timing->format('G時間i分前') }}になりました。<br><br>

{{ $start_date }} {{ $alert->time->format('G:i') }}から{{ $alert->name }}の予定があります。<br><br>