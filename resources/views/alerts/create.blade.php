<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mail Alert</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<header>
  <nav class="my-navbar">
    <a class="my-navbar-brand" href="/">Mail Alert</a>
  </nav>
</header>
<main>
  <div class="container">
    <div class="row">
      <div class="col col-12">
        <nav class="panel panel-default">
          <div class="panel-heading">予定を追加する</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach($errors->all() as $message)
                    <li>{{ $message }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form action="{{ route('alert.create') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="name">予定名</label>
                <input type="text" class="form-control" name="name" id="name" />
              </div>
              <div class="form-group">
                <label for="type">予定種別</label>
                <select class="form-control" name="type" id="type">
                  <option value="date">日付</option>
                  <option value="everyday">毎日</option>
                  <option value="day_of_week">曜日</option>
                </select>
              </div>
              <div class="form-group">
                <label for="date">予定日付</label>
                <input type="text" class="form-control" name="date" id="date" />
              </div>
              <div class="form-group">
                <label for="date">曜日</label>
                <div class="d-flex">
                  <label for="week_mon">月</label>
                  <input type="checkbox" class="form-control" name="week_mon" id="week_mon" value="1" />
                  <label for="week_tue">火</label>
                  <input type="checkbox" class="form-control" name="week_tue" id="week_tue" value="1" />
                  <label for="week_wed">水</label>
                  <input type="checkbox" class="form-control" name="week_wed" id="week_wed" value="1" />
                  <label for="week_thu">木</label>
                  <input type="checkbox" class="form-control" name="week_thu" id="week_thu" value="1" />
                  <label for="week_fri">金</label>
                  <input type="checkbox" class="form-control" name="week_fri" id="week_fri" value="1" />
                  <label for="week_sat">土</label>
                  <input type="checkbox" class="form-control" name="week_sat" id="week_sat" value="1" />
                  <label for="week_sun">日</label>
                  <input type="checkbox" class="form-control" name="week_sun" id="week_sun" value="1" />
                </div>
              </div>
              <div class="form-group">
                <label for="time">予定時刻</label>
                <input type="text" class="form-control" name="time" id="time" />
              </div>
              <div class="form-group">
                <label for="email_amount">メール数</label>
                <input type="number" class="form-control" name="email_amount" id="email_amount" />
              </div>
              <div class="form-group">
                <label for="first_alert_timing">１回目のメールを送るタイミング</label>
                <input type="text" class="form-control" name="first_alert_timing" id="first_alert_timing" />
              </div>
              <div class="form-group">
                <label for="second_alert_flag">２回目のメールを送るかどうか</label>
                <div class="d-flex">
                  <input type="checkbox" class="" name="second_alert_flag" id="second_alert_flag" value="1" />
                  <label for="second_alert_flag">送る</label>
                </div>
              </div>
              <div class="form-group">
                <label for="second_alert_timing">２回目のメールを送るタイミング</label>
                <input type="text" class="form-control" name="second_alert_timing" id="second_alert_timing" />
              </div>
              <p>
                <a class="btn btn-outline-secondary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                  <label >鳴らさない日</label>
                </a>
              </p>
              <div class="collapse" id="collapseExample">
                <div class="form-group">
                  <input type="text" class="form-control" name="mute_date_01" id="mute_date_01" />
                  <input type="text" class="form-control" name="mute_date_02" id="mute_date_02" />
                  <input type="text" class="form-control" name="mute_date_03" id="mute_date_03" />
                  <input type="text" class="form-control" name="mute_date_04" id="mute_date_04" />
                  <input type="text" class="form-control" name="mute_date_05" id="mute_date_05" />
                  <input type="text" class="form-control" name="mute_date_06" id="mute_date_06" />
                  <input type="text" class="form-control" name="mute_date_07" id="mute_date_07" />
                  <input type="text" class="form-control" name="mute_date_08" id="mute_date_08" />
                  <input type="text" class="form-control" name="mute_date_09" id="mute_date_09" />
                  <input type="text" class="form-control" name="mute_date_10" id="mute_date_10" />
                </div>
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">送信</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
</main>

<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
<script>
  flatpickr(document.getElementById('date'), {
    locale: 'ja',
    dateFormat: "Y/m/d",
    minDate: new Date()
  });
  // flatpickr.localize(flatpickr.l10ns.ja);
  flatpickr(document.getElementById('time'), {
      noCalendar: true,
      enableTime: true,
      dateFormat: "H:i",
      time_24hr: false, // trueで24時間表示、falseでAM、PM表示
      defaultHour: 9, // 初期設定の時間（hour）
      defaultMinute: 0, // 初期設定の時間（min）
      minDate: "8:00", // 時間の下限
      maxDate: "17:30" // 時間の上限
  });
  flatpickr(document.getElementById('first_alert_timing'), {
      noCalendar: true,
      enableTime: true,
      dateFormat: "H:i",
      time_24hr: true, // trueで24時間表示、falseでAM、PM表示
      defaultHour: 3, // 初期設定の時間（hour）
      defaultMinute: 0, // 初期設定の時間（min）
      minDate: "0:00", // 時間の下限
      maxDate: "23:59" // 時間の上限
  });
  flatpickr(document.getElementById('second_alert_timing'), {
      noCalendar: true,
      enableTime: true,
      dateFormat: "H:i",
      time_24hr: true, // trueで24時間表示、falseでAM、PM表示
      defaultHour: 1, // 初期設定の時間（hour）
      defaultMinute: 30, // 初期設定の時間（min）
      minDate: "0:00", // 時間の下限
      maxDate: "23:59" // 時間の上限
  });
  flatpickr(document.getElementById('mute_date_01'), {
    locale: 'ja',
    dateFormat: "Y/m/d",
    minDate: new Date()
  });
  flatpickr(document.getElementById('mute_date_02'), {
    locale: 'ja',
    dateFormat: "Y/m/d",
    minDate: new Date()
  });
  flatpickr(document.getElementById('mute_date_03'), {
    locale: 'ja',
    dateFormat: "Y/m/d",
    minDate: new Date()
  });
  flatpickr(document.getElementById('mute_date_04'), {
    locale: 'ja',
    dateFormat: "Y/m/d",
    minDate: new Date()
  });
  flatpickr(document.getElementById('mute_date_05'), {
    locale: 'ja',
    dateFormat: "Y/m/d",
    minDate: new Date()
  });
  flatpickr(document.getElementById('mute_date_06'), {
    locale: 'ja',
    dateFormat: "Y/m/d",
    minDate: new Date()
  });
  flatpickr(document.getElementById('mute_date_07'), {
    locale: 'ja',
    dateFormat: "Y/m/d",
    minDate: new Date()
  });
  flatpickr(document.getElementById('mute_date_08'), {
    locale: 'ja',
    dateFormat: "Y/m/d",
    minDate: new Date()
  });
  flatpickr(document.getElementById('mute_date_09'), {
    locale: 'ja',
    dateFormat: "Y/m/d",
    minDate: new Date()
  });
  flatpickr(document.getElementById('mute_date_10'), {
    locale: 'ja',
    dateFormat: "Y/m/d",
    minDate: new Date()
  });
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>