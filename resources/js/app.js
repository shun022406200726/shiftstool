import './bootstrap';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import { initShiftSubmission } from './shiftSubmission';


document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        navLinks: true,
        selectable: true,
        selectMirror: true,
        editable: true,
        dayMaxEvents: true,
        locale: 'ja',
        events: '/shifts/data',
        dateClick: function(info) {
            toggleDateSelection(info, calendar);
        }
    });
    calendar.render();

    initShiftSubmission(calendar);
});

function toggleDateSelection(info, calendar) {
    const clickedDate = info.date;
    const events = calendar.getEvents();
    const existingEvent = events.find(event =>
        event.start.getTime() === clickedDate.getTime() && event.title === 'シフト希望'
    );
    if (existingEvent) {
        // すでに選択されている場合は、イベントを削除
        existingEvent.remove();
    } else {
        // 選択されていない場合は、新しいイベントを追加
        calendar.addEvent({
            title: 'シフト希望',
            start: clickedDate,
            allDay: true,
            color: '#3788d8' // イベントの背景色
        });
    }
}




// ... 他の関数は変更なし ...

document.getElementById('checkPayment').addEventListener('click', function() {
    console.log('給与確認');
});
