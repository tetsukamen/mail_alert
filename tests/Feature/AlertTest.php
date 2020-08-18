<?php

namespace Tests\Feature;

use App\Http\Requests\CreateAlert;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;

class AlertTest extends TestCase
{

    // テストケースごとにデータベースをリフレッシュしてマイグレーションを再実行する
    use RefreshDatabase;


    /**
     * 各テストメソッドの実行前に呼ばれる
     */
    public function setUp() :void
    {
        parent::setUp();

        // テストケース実行前にアラートデータを作成する
        $this->seed('AlertsTableSeeder');
    }

    /**
     * 予定日付が日付ではない場合はバリデーションエラー
     * @test
     */
    public function date_should_be_date()
    {
        $response = $this->post('/alert/create', [
            'title' => 'Sample alert',
            'date' => 123, // 不正なデータ（数値）
            'time' => "15:00",
            'email_amount' => 3,
            'first_alert_timing' => "3:00",
            'second_alert_flag' => false,
        ]);

        $response->assertSessionHasErrors([
            'date' => '予定日付 は入力形式が無効です。',
        ]);
    }

    /**
     * 予定日付が日付ではない場合はバリデーションエラー
     * @test
     */
    public function date_should_not_be_past()
    {
        $response = $this->post('/alert/create', [
            'title' => 'Sample alert',
            'date' => Carbon::yesterday()->format('Y/m/d'), // 不正なデータ（昨日の日付）
            'time' => "15:00",
            'email_amount' => 3,
            'first_alert_timing' => "3:00",
            'second_alert_flag' => false,
        ]);

        $response->assertSessionHasErrors([
            'date' => '予定日付 は今日以降を入力してください',
        ]);
    }

    /**
     * 予定時刻が時間ではない場合はバリデーションエラー
     * @test
     */
    public function time_should_be_time(){
        $response = $this->post('/alert/create', [
            'title' => 'Sample alert',
            'date' => Carbon::today()->format('Y/m/d'),
            'time' => "1500",// 不正データ
            'email_amount' => 3,
            'first_alert_timing' => "3:00",
            'second_alert_flag' => false,
        ]);

        $response->assertSessionHasErrors([
            'time' => '予定時刻 は入力形式が無効です。',
        ]);
    }

    /**
     * メール数が1~10ではない場合はバリデーションエラー
     * @test
     */
    public function mail_amount_should_be_between_1_to_10(){
        $response = $this->post('/alert/create', [
            'title' => 'Sample alert',
            'date' => Carbon::today()->format('Y/m/d'),
            'time' => "15:00",
            'email_amount' => -2,// 不正データ
            'first_alert_timing' => "3:00",
            'second_alert_flag' => false,
        ]);

        $response->assertSessionHasErrors([
            'email_amount' => 'メール数 は1から10までの整数を入力してください。',
        ]);
    }

    /**
     * １回目のメールを送るタイミングが時間ではない場合はバリデーションエラー
     * @test
     */
    public function first_alert_timing_should_be_time(){
        $response = $this->post('/alert/create', [
            'title' => 'Sample alert',
            'date' => Carbon::today()->format('Y/m/d'),
            'time' => "15:00",
            'email_amount' => 3,
            'first_alert_timing' => "300",// 不正データ
            'second_alert_flag' => false,
        ]);

        $response->assertSessionHasErrors([
            'first_alert_timing' => '１回目のメールを送るタイミング は入力形式が無効です。',
        ]);
    }

    /**
     * second_alert_flagがbooleanではない場合はバリデーションエラー
     * @test
     */
    public function second_alert_flag_should_be_boolean(){
        $response = $this->post('/alert/create', [
            'title' => 'Sample alert',
            'date' => Carbon::today()->format('Y/m/d'),
            'time' => "15:00",
            'email_amount' => 3,
            'first_alert_timing' => "3:00",
            'second_alert_flag' => 3,// 不正データ
        ]);

        $response->assertSessionHasErrors([
            'second_alert_flag' => '２回目のメールを送るかどうか は入力形式が無効です。',
        ]);
    }

    /**
     * second_alert_timingがtimeではない場合はバリデーションエラー
     * @test
     */
    public function second_alert_timing_should_be_time(){
        $response = $this->post('/alert/create', [
            'title' => 'Sample alert',
            'date' => Carbon::today()->format('Y/m/d'),
            'time' => "15:00",
            'email_amount' => 3,
            'first_alert_timing' => "3:00",
            'second_alert_flag' => true,
            'second_alert_timing' => '300',// 不正データ
        ]);

        $response->assertSessionHasErrors([
            'second_alert_timing' => '２回目のメールを送るタイミング は入力形式が無効です。',
        ]);
    }
}
