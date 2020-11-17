@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col col-12">
        <nav class="panel panel-default">
          <div class="panel-heading">この予定を削除しますか？</div>
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
                </thead>
                <tbody>
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
                  </tr>
                </tbody>
              </table>
            </div>
            <form action="{{ route('alert.delete', ['id'=>$alert->id]) }}" method="post">
              @csrf
              <div class="text-right">
                <a class="btn btn-secondary" href="{{route('alert.index')}}">戻る</a>
                <button type="submit" class="btn btn-primary">削除する</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@endsection