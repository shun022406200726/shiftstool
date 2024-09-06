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
            console.log('シフトが確定されました');
            // 確定処理の実装
        });

        document.getElementById('backButton').addEventListener('click', function() {
            location.reload();
        });
    }
}


