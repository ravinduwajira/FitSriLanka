$(function() {
  var calendarEl = document.getElementById('fullcalendar');
  
  // Initialize the calendar
  var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
      left: "prev,today,next",
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
    },
    editable: true,
    droppable: true, // Allows dragging external events
    initialView: 'dayGridMonth',
    timeZone: 'UTC',
    dayMaxEvents: 2,
    
    // Fetch events dynamically from backend
    events: '/user/events', // Ensure the route returns events in the correct format

    eventClick: function(info) {
      var eventObj = info.event;
      $('#modalTitle1').html(eventObj.title);
      $('#modalBody1').html(eventObj.extendedProps.description);
      $('#fullCalModal').modal("show");
    },

    dateClick: function(info) {
      // Open the modal for adding a new event
      $("#createEventModal").modal("show");
      $('#eventStart').val(info.dateStr); // Prefill date field with clicked date
    }
  });

  calendar.render();

  // Add new event - Event Form Submission
  $('#saveEvent').on('click', function() {
    var eventTitle = $('#eventTitle').val();
    var eventDescription = $('#eventDescription').val();
    var eventStart = $('#eventStart').val();
    var eventEnd = $('#eventEnd').val();

    // Send new event data to server
    $.ajax({
      url: '/user/events/store', // Laravel route to store event
      method: 'POST',
      data: {
        title: eventTitle,
        description: eventDescription,
        start: eventStart,
        end: eventEnd,
        _token: $('meta[name="csrf-token"]').attr('content') // Ensure CSRF token is included
      },
      success: function(response) {
        // On successful event creation, add event to calendar
        calendar.addEvent({
          id: response.id, // Assuming the server responds with the event ID
          title: eventTitle,
          start: eventStart,
          end: eventEnd,
          description: eventDescription
        });
        
        // Close the modal
        $("#createEventModal").modal("hide");

        // Clear form fields
        $('#eventTitle').val('');
        $('#eventDescription').val('');
        $('#eventStart').val('');
        $('#eventEnd').val('');
      },
      error: function(error) {
        console.log('Error adding event:', error);
      }
    });
  });
});
