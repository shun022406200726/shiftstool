@extends('layouts.base')

@section('title', '従業員ダッシュボード')
@section('scripts')
    @vite('resources/js/calendar.js')
@endsection
@section('content')
    <div class="header">
        <div>{{ $storeName }}</div>
        <div>氏名:{{ $employeeName }}</div>
    </div>

    <div id="buttonContainer">
        <button id="submitShiftButton" class="button">シフト提出</button>
        <button class="button" id="checkPayment">給与確認</button>
    </div>
    <div id="calendar"></div>
    <!-- 日次スタッフモーダル -->
    <div class="modal fade" id="dailyStaffModal" tabindex="-1" role="dialog" aria-labelledby="dailyStaffModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dailyStaffModalLabel">日次出勤メンバー</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ここに動的にスタッフリストが挿入されます -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>
@endsection


