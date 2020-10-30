<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mail Alert</title>
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<header>
  <nav class="my-navbar">
    <a class="my-navbar-brand" href="{{ route('alert.index') }}">Mail Alert</a>
  </nav>
</header>
<main>
  <div class="container">
    <nav class="panel panel-default">
      <div class="panel-heading">予定</div>
      <div class="panel-body">
        <a href="{{route('alert.create')}}" class="btn btn-default btn-block">
          予定を追加する
        </a>
      </div>
      <div class="table-wrapper">
        <table class="table table-inner">
          <thead>
            <th>予定名</th>
            <th>日付</th>
            <th>時刻</th>
            <th>1回目のメールを送るタイミング</th>
            <th>2回目のメールを送るかどうか</th>
            <th>2回目のメールを送るタイミング</th>
            <th>一回に送るメールの数</th>
            <th>鳴らさない日</th>
            <th></th>
            <th></th>
            <th></th>
          </thead>
          <tbody>
            @foreach($alerts as $alert)
            <tr>
              <td>{{ $alert->name }}</td>
              <td>{{ $alert->date_or_type }}</td>
              <td>{{ $alert->time->format('G:i') }}</td>
              <td>{{ $alert->first_alert_timing->format('G時i分前') }}</td>
              <td>{{ $alert->second_alert_flag ? "はい":"いいえ" }}</td>
              <td>{{ $alert->second_alert_timing ? $alert->second_alert_timing->format('G時i分前'):"" }}</td>
              <td>{{ $alert->email_amount }}回</td>
              <td>
              @foreach($alert->mute_dates()->get() as $mute_date)
                {{ $mute_date->mute_date->format('Y年m月d日') }}<br>
              @endforeach
              </td>
              <td><a href="{{ route('alert.edit', ['id'=>$alert->id]) }}">編集</a></td>
              <td><a href="{{ route('alert.delete', ['id'=>$alert->id]) }}">削除</a></td>
              <td><a href="{{ route('alert.sendMail', ['id'=>$alert->id]) }}">メール送信</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </nav>
  </div>
</main>
</body>
</html>