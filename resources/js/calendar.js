import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialView: 'dayGridMonth',
        navLinks: true,
        selectable: true,
        selectMirror: true,
        editable: true,
        dayMaxEvents: true,
        locale: 'ja',
        events: '/shifts/data',
        dateClick: function(info) {
            fetchDailyStaff(info.date);

        },
        eventClick: function(info) {
            alert('シフト: ' + info.event.title);
        }
    });

    calendar.render();
});

function fetchDailyStaff(date) {
    // console.log(date.toISOString()); // デバッグ用
    // console.log(date.toISOString().split('T')[0]); // デバッグ用
    fetch('/daily-staff?date=' + date.toISOString().split('T')[0])
        .then(response => response.json())
        .then(data => {
            displayDailyStaff(data, date);
        })
        .catch(error => {
            console.error('Error fetching daily staff:', error);
        });
}

function displayDailyStaff(staffList, date) {
    let staffHtml = '<h3>' + formatDate(date) + 'の出勤メンバー</h3><ul>';
    staffList.forEach(function(staff) {
        staffHtml += '<li>' + staff.name + ' (' + staff.shift_time + ')</li>';
    });
    staffHtml += '</ul>';

    document.querySelector('#dailyStaffModal .modal-body').innerHTML = staffHtml;

    var modal = new bootstrap.Modal(document.getElementById('dailyStaffModal'));
    modal.show();
}

function formatDate(date) {
    return date.getFullYear() + '年' +
           (date.getMonth() + 1).toString().padStart(2, '0') + '月' +
           date.getDate().toString().padStart(2, '0') + '日';
}
