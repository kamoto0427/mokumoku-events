<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // 追加

class EventController extends Controller
{
    public function __construct()
    {
        $this->event = new Event();
        $this->category = new Category();
    }

    /**
     * イベント一覧画面
     */
    public function index()
    {
        // Eloquentでeventsテーブルにあるデータを全て取得
        $events = $this->event->allEventsData();

        return view('event.index', compact('events'));
    }

    /**
     * もくもく会登録画面
     */
    public function register()
    {
        $categories = $this->category->allCategoriesData();
        return view('event.register', compact('categories'));
    }

    /**
     * もくもく会登録処理
     */
    public function create(Request $request)
    {
        try {
            // トランザクション開始
            DB::beginTransaction();
            // リクエストされたデータをもとにeventsテーブルにデータをinsert
            $insertEvent = $this->event->insertEventData($request);
            // 処理に成功したらコミット
            DB::commit();
        } catch (\Throwable $e) {
            // 処理に失敗したらロールバック
            DB::rollback();
            // エラーログ
            \Log::error($e);
            // 登録処理失敗時にリダイレクト
            return redirect()->route('event.index')->with('error', 'もくもく会の登録に失敗しました。');
        }

        return redirect()->route('event.index')->with('success', 'もくもく会の登録に成功しました。');
    }
}
