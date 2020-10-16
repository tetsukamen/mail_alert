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
          <div class="panel-heading">予定を編集する</div>
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
            <form action="{{ route('alert.edit', ['id'=>$alert->id]) }}" method="post">
              @csrf
              <div class="form-group">
                <label for="name">予定名</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ?? $alert->name }}" />
              </div>
              <div class="form-group">
                <label for="type">予定種別</label>
                <select class="form-control" name="type" id="type">
                  <option value="date" @if($type=='date') selected  @endif>日付</option>
                  <option value="everyday" @if($type=='everyday') selected  @endif>毎日</option>
                  <option value="day_of_week" @if($type=='day_of_week') selected  @endif>曜日</option>
                </select>
              </div>
              <div class="form-group">
                <label for="date">予定日付</label>
                <input type="text" class="form-control" name="date" id="date" value="{{ old('date') ?? $date }}"/>
              </div>
              <div class="form-group">
                <label for="date">曜日</label>
                <div class="d-flex">
                  <label for="week_mon">月</label>
                  {{Form::checkbox('week_mon',1,old('date') ?? $alert->week_mon,['class'=>'form-control','id'=>'week_mon'])}}
                  <label for="week_tue">火</label>
                  {{Form::checkbox('week_tue',1,old('date') ?? $alert->week_tue,['class'=>'form-control','id'=>'week_tue'])}}
                  <label for="week_wed">水</label>
                  {{Form::checkbox('week_wed',1,old('date') ?? $alert->week_wed,['class'=>'form-control','id'=>'week_wed'])}}
                  <label for="week_thu">木</label>
                  {{Form::checkbox('week_thu',1,old('date') ?? $alert->week_thu,['class'=>'form-control','id'=>'week_thu'])}}
                  <label for="week_fri">金</label>
                  {{Form::checkbox('week_fri',1,old('date') ?? $alert->week_fri,['class'=>'form-control','id'=>'week_fri'])}}
                  <label for="week_sat">土</label>
                  {{Form::checkbox('week_sat',1,old('date') ?? $alert->week_sat,['class'=>'form-control','id'=>'week_sat'])}}
                  <label for="week_sun">日</label>
                  {{Form::checkbox('week_sun',1,old('date') ?? $alert->week_sun,['class'=>'form-control','id'=>'week_sun'])}}
                </div>
              </div>
              <div class="form-group">
                <label for="time">予定時刻</label>
                <input type="text" class="form-control" name="time" id="time" value="{{ old('time') ?? $alert->time->format('H:i') }}"/>
              </div>
              <div class="form-group">
                <label for="email_amount">メール数</label>
                <input type="number" class="form-control" name="email_amount" id="email_amount" value="{{ old('email_amount') ?? $alert->email_amount }}"/>
              </div>
              <div class="form-group">
                <label for="first_alert_timing">１回目のメールを送るタイミング</label>
                <input type="text" class="form-control" name="first_alert_timing" id="first_alert_timing" value="{{ old('first_alert_timing') ?? $alert->first_alert_timing->format('H:i') }}"/>
              </div>
              <div class="form-group">
                <label for="second_alert_flag">２回目のメールを送るかどうか</label>
                <div class="d-flex">
                  {{Form::checkbox('second_alert_flag',1,old('second_alert_flag') ?? $alert->second_alert_flag,['id'=>'second_alert_flag'])}}
                  <label for="second_alert_flag">送る</label>
                </div>
              </div>
              <div class="form-group">
                <label for="second_alert_timing">２回目のメールを送るタイミング</label>
                <input type="text" class="form-control" name="second_alert_timing" id="second_alert_timing" value="{{ old('second_alert_timing') ?? $alert->second_alert_timing ? $alert->second_alert_timing->format('H:i'):'' }}"/>
              </div>
              <p>
                <a class="btn btn-outline-secondary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                  <label >鳴らさない日</label>
                </a>
              </p>
              <div class="collapse" id="collapseExample">
                <div class="form-group">
                  <input type="text" class="form-control" name="mute_date_01" id="mute_date_01" value="{{ old('mute_date_01') ?? $alert->mute_date_01 ? $alert->mute_date_01->format('Y/m/d') : '' }}"/>
                  <input type="text" class="form-control" name="mute_date_02" id="mute_date_02" value="{{ old('mute_date_02') ?? $alert->mute_date_02 ? $alert->mute_date_02->format('Y/m/d') : '' }}" />
                  <input type="text" class="form-control" name="mute_date_03" id="mute_date_03" value="{{ old('mute_date_03') ?? $alert->mute_date_03 ? $alert->mute_date_03->format('Y/m/d') : '' }}" />
                  <input type="text" class="form-control" name="mute_date_04" id="mute_date_04" value="{{ old('mute_date_04') ?? $alert->mute_date_04 ? $alert->mute_date_04->format('Y/m/d') : '' }}" />
                  <input type="text" class="form-control" name="mute_date_05" id="mute_date_05" value="{{ old('mute_date_05') ?? $alert->mute_date_05 ? $alert->mute_date_05->format('Y/m/d') : '' }}" />
                  <input type="text" class="form-control" name="mute_date_06" id="mute_date_06" value="{{ old('mute_date_06') ?? $alert->mute_date_06 ? $alert->mute_date_06->format('Y/m/d') : '' }}" />
                  <input type="text" class="form-control" name="mute_date_07" id="mute_date_07" value="{{ old('mute_date_07') ?? $alert->mute_date_07 ? $alert->mute_date_07->format('Y/m/d') : '' }}" />
                  <input type="text" class="form-control" name="mute_date_08" id="mute_date_08" value="{{ old('mute_date_08') ?? $alert->mute_date_08 ? $alert->mute_date_08->format('Y/m/d') : '' }}" />
                  <input type="text" class="form-control" name="mute_date_09" id="mute_date_09" value="{{ old('mute_date_09') ?? $alert->mute_date_09 ? $alert->mute_date_09->format('Y/m/d') : '' }}" />
                  <input type="text" class="form-control" name="mute_date_10" id="mute_date_10" value="{{ old('mute_date_10') ?? $alert->mute_date_10 ? $alert->mute_date_10->format('Y/m/d') : '' }}" />
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