import {getTodayDate} from './helpers/timeAndDate.js';


let submit = document.getElementById('markAttendance');
submit.addEventListener("click", log, false);

function log(){
    const today = getTodayDate();
    document.ready(updateSystemLog(today));
}

function updateSystemLog(today) {
    $.ajax({
        type: 'POST',
        data: {
            date: today
        },
        url: "http://localhost/PostOffice/SystemController/updateLog",

        success: function (data) {
            console.log(data);
        }
    });
}