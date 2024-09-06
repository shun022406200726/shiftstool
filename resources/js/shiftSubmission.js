export function initShiftSubmission(calendar){
    const submitButton = document.getElementById('submitShiftButton');
    const buttonContainer = document.getElementById('buttonContainer');

    if(submitButton){
        submitButton.addEventListener('click', function() {
            showNextMonthCalendar(calendar);
            changeButtons();
        });
    }


}

function showNextMonthCalendar(calendar) {
    const currentDate = calendar.getDate();
    const nextMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 1);
    calendar.gotoDate(nextMonth);
    alert(nextMonth.getFullYear() + '年' + (nextMonth.getMonth() + 1) + '月のカレンダーを表示しました。');
}

function changeButtons() {
    const buttonContainer = document.getElementById('buttonContainer');
    if (buttonContainer) {
        buttonContainer.innerHTML = `
            <button id="confirmButton" class="button">確定</button>
            <button id="backButton" class="button">戻る</button>
        `;

        document.getElementById('confirmButton').addEventListener('click', function() {
            submitShifts(calendar);
        });

        document.getElementById('backButton').addEventListener('click', function() {
            location.reload();
        });
    }
}

function submitShifts(calendar) {
    const events = calendar.getEvents();
    const shiftDates = events
        .filter(event => event.title === 'シフト希望')
        .map(event => event.start.toISOString().split('T')[0]); // YYYY-MM-DD 形式に変換

    fetch('/api/shifts/submit', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ shifts: shiftDates })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('シフトが正常に登録されました。');
            location.reload(); // ページをリロード
        } else {
            alert('シフトの登録に失敗しました。');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('エラーが発生しました。');
    });
}


