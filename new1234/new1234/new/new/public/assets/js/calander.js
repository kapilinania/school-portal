// $(document).ready(function () { $("#calendar-doctor").simpleCalendar({ fixedStartDay: 0, disableEmptyDetails: true, events: [{ startDate: new Date(new Date().setHours(new Date().getHours() + 24)).toDateString(), endDate: new Date(new Date().setHours(new Date().getHours() + 25)).toISOString(), summary: 'Conference with teachers' }, { startDate: new Date(new Date().setHours(new Date().getHours() - new Date().getHours() - 12, 0)).toISOString(), endDate: new Date(new Date().setHours(new Date().getHours() - new Date().getHours() - 11)).getTime(), summary: 'Old classes' }, { startDate: new Date(new Date().setHours(new Date().getHours() - 48)).toISOString(), endDate: new Date(new Date().setHours(new Date().getHours() - 24)).getTime(), summary: 'Old Lessons' }], }); });

$(document).ready(function () {
    // Use the exams data passed from the Blade view
    var examEvents = [];

    // Loop through the exams array and create calendar events
    exams.forEach(function(exam) {
        var examEvent = {
            startDate: new Date(exam.exam_date).toISOString(), // Assuming exam_date is in 'Y-m-d' format
            endDate: new Date(new Date(exam.exam_date).setHours(new Date().getHours() + 2)).toISOString(), 
            summary: exam.exam_name + ' for Class :  ' + exam.section // Customize the event summary
        };
        examEvents.push(examEvent);
    });

    // Initialize the calendar with the dynamic events
    $("#calendar-doctor").simpleCalendar({
        fixedStartDay: 0,
        disableEmptyDetails: true,
        events: examEvents
    });
});
