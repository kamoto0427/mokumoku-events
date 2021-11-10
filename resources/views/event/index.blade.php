@extends('layouts.app')

@section('content')
<style>
    #mokumoku-lists {
        filter:drop-shadow(2px 4px 6px #000);
    }
    .contents-filed {
        width: 60%;
    }
</style>

{{-- ナビゲーション --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light container">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('event.index') }}">{{ 'もくもく会' }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mokumoku" aria-controls="mokumoku" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mokumoku">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('event.index') }}">{{ '一覧' }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('event.register') }}">{{ '開催する' }}</a>
            </li>
        </ul>
        </div>
    </div>
</nav>

{{-- もくもく会開催一覧リスト --}}
@foreach ($events as $event)
<div class="card container text-center mb-5" id="mokumoku-lists">
    <div class="card-header font-weight-bold bg-white">
      <a href="">{{ $event->title }}</a>
    </div>
    <div class="card-body">
        <div class="category text-left">
            <label for="category-label"><span class="badge badge-primary p-2">{{ $event->category->category_name }}</span></label>
        </div>
        <div class="entry-fee-wrapper d-flex">
            <label for="entry-fee"><span class="badge badge-success p-2">{{ '参加費' }}</span></label>
            <p class="text-danger font-weight-bold p-1 h5">{{ $event->entry_fee.'円' }}</p>
        </div>
        <div class="contents-wrapper d-flex">
            <div class="contents-filed">
                <p class="card-text text-left">
                    {{ mb_substr($event->contents, 0, 100, 'UTF-8').'...' }}
                </p>
            </div>
            <div class="btn-filed ml-auto">
                <button class="btn btn-primary mr-3">{{ '詳細' }}</button>
                <button class="btn btn-info mr-3">{{ '編集' }}</button>
                <button class="btn btn-danger mr-3">{{ '削除' }}</button>
            </div>
        </div>
    </div>
    @php
        // 指定の日付を△△/××に変換する
        $date = date("m/d" ,strtotime($event->date));
        //指定日の曜日を取得する
        $getWeek = date('w', strtotime($event->date));
        //配列を使用し、要素順に(日:0〜土:6)を設定する
        $week = [
            '日', //0
            '月', //1
            '火', //2
            '水', //3
            '木', //4
            '金', //5
            '土', //6
        ];

        // 開始時間 ex.15:00:00→15:00に変換。秒部分を切り捨て
        $start_time = substr($event->start_time, 0, -3);
        // 終了時間 ex.19:00:00→19:00に変換。秒部分を切り捨て
        $end_time = substr($event->end_time, 0, -3);
    @endphp
    <div class="card-footer text-left font-weight-bold bg-white">
      {{ '開催日時:'.$date.'('.$week[$getWeek].')'. $start_time. '-' .$end_time }}
    </div>
</div>
@endforeach
@endsection