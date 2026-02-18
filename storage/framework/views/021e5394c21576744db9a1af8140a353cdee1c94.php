<!-- Calendar Modal -->
<style>
    .fc-toolbar {
        padding-block: 0px !important;
    }

    .fc-center h2 {
        font-size: 1rem !important;
    }

    .fc-day-grid-event .fc-content {
        white-space: normal !important;
    }

    #eventModal {
        z-index: 100000 !important;
    }

    /* Calendar Modal Styling */
    #calendarModal .modal-content {
        border: 1px solid #f4f4f4;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-radius: 0.5rem;
    }

    #calendarModal .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #f4f4f4;
        border-radius: 0.5rem 0.5rem 0 0;
        padding: 1rem 1.25rem;
    }

    #calendarModal .modal-title {
        font-size: 1rem !important;
        font-weight: 600;
        color: #495057;
    }

    #calendarModal .close {
        font-size: 1.5rem;
        font-weight: 300;
        color: #6c757d;
        opacity: 0.7;
        transition: all 0.2s ease;
    }

    #calendarModal .close:hover {
        opacity: 1;
        color: #17a2b8;
    }
</style>
<div id="calendarModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Calendar</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding: 1.25rem;">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

<!-- Event Creation Modal -->
<div id="eventModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Event Details</h4>
                <div>
                    <a id="viewAppointmentBtn" class="btn btn-info" style="display: none;" target="_blank">View Appointment</a>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body">
                <form id="eventForm" action="<?php echo e(route('events.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="eventId" name="id">
                    <div class="form-group">
                        <label for="eventTitle">Title:</label>
                        <input type="text" class="form-control" id="eventTitle" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Procedure:</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="eventStartDate">Start Date:</label>
                                <input type="date" class="form-control" id="eventStartDate" name="start_date"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="eventEndDate">End Date:</label>
                                <input type="date" class="form-control" id="eventEndDate" name="end_date" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="eventStartTime">Start Time:</label>
                                <input type="time" class="form-control" id="eventStartTime" name="start_time"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="eventEndTime">End Time:</label>
                                <input type="time" class="form-control" id="eventEndTime" name="end_time" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="save" class="btn btn-primary">Save Event</button>
                    <button type="button" id="deleteEventButton" class="btn btn-danger" style="display: none;">Delete
                        Event</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#eventForm').parsley();

        function clearForm() {
            $('#eventForm')[0].reset();
            $('#eventId').val('');
            $('#deleteEventButton').hide();
            // Reset save button state
            $('#save').show().prop('disabled', false);
        }


        $('#calendar').fullCalendar({
            selectable: true,
            selectHelper: true,
            displayEventTime: true,
            displayEventEnd: true,
            timeFormat: 'HH:mm',

            select: function(start) {
                clearForm();
                var startDate = moment(start).format('YYYY-MM-DD');
                var startTime = moment(start).format('HH:mm');
                $('#eventStartDate').val(startDate);
                $('#eventStartTime').val(startTime);
                $('#eventEndDate').val(startDate);
                $('#eventEndTime').val(startTime);
                $('#eventModal').modal('toggle');
            },
            header: {
                left: 'month,agendaWeek,agendaDay,list',
                center: 'title',
                right: 'prev,today,next'
            },
            buttonText: {
                today: 'Today',
                month: 'Month',
                week: 'Week',
                day: 'Day',
                list: 'List'
            },
            events: function(start, end, timezone, callback) {
                $.ajax({
                    url: '<?php echo e(route("events.load")); ?>',
                    method: 'GET',
                    data: {
                        start: start.format(),
                        end: end.format()
                    },

                    success: function(data) {
                        var events = data.map(function(event) {

                            var startFull = event.start_date + 'T' + (event.start_time || '00:00:00');
                            var endFull = event.end_date + 'T' + (event.end_time || '23:59:59');

                            return {
                                id: event.id,
                                title: event.title,
                                start: startFull,
                                end: endFull,
                                type: event.eventtype || 'appointment',
                                description: event.description,
                                patient_name: event.patient ? event.patient.name : '',
                                start_time: event.start_time,
                                end_time: event.end_time
                            };
                        });
                        callback(events);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching events:', error);
                    }
                });
            },
            eventRender: function(event, element) {
                var content = '<div class="p-1">';

                // 1. Time
                if (event.start_time) {
                    content += '<div style="font-size: 0.8rem;"><small>' + event.start_time + (event.end_time ? '<strong> - </strong> ' + event.end_time : '') + '</small></div>';
                }

                // 2. Title
                var displayTitle = event.title.replace('Appointment with ', 'Dr. ');
                content += '<div style="font-size: 0.5rem;">' + displayTitle + '</div>';

                // 3. Patient Name
                if (event.patient_name) {
                    content += '<div style="font-size: 0.5rem;"><strong>Patient:</strong> ' + event.patient_name + '</div>';
                }

                // 4. Description
                if (event.description) {
                    content += '<div style="font-size: 0.5rem; font-style: italic; margin-top: 2px;">' + event.description + '</div>';
                }

                content += '</div>';

                element.find('.fc-content').html(content);

                // Set the background color based on the event type
                var color;
                switch (event.type) {
                    case 'appointment':
                        color = 'yellow';
                        break;
                    case 'task':
                        color = '#94ef94';
                        break;
                    default:
                        color = 'lightgray'; // Replace with your default color
                }

                // Apply the background color to the .fc-content class
                element.find('.fc-content').css('background-color', color);
                // Ensure text is black for visibility on light colors
                element.find('.fc-content').css('color', '#000');
            },
            eventClick: function(calEvent) {
                clearForm(); // Clear the form before populating it with event data
                // Fetch event details via AJAX
                $.ajax({
                    url: '<?php echo e(route("events.show", ":id")); ?>'.replace(':id', calEvent.id),
                    method: 'GET',
                    success: function(event) {
                        // Populate the modal with fetched event data
                        $('#eventId').val(event.id);
                        $('#eventTitle').val(event.title);
                        $('#description').val(event.description);
                        $('#eventStartDate').val(event.start_date);
                        $('#eventStartTime').val(event.start_time);
                        $('#eventEndDate').val(event.end_date);
                        $('#eventEndTime').val(event.end_time);

                        // Show the modal for event editing
                        $('#eventModal').modal();
                        // $('#deleteEventButton').show(); // Show the delete button when editing an existing event
                        switch (event.eventtype) {
                            case 'appointment':
                                $('#deleteEventButton').hide();
                                $('#save').hide();
                                $('#viewAppointmentBtn').attr('href', '<?php echo e(url("patient-appointments")); ?>/' + event.id).show();
                                break;
                            case 'task':
                                $('#deleteEventButton').hide();
                                $('#save').hide();
                                $('#viewAppointmentBtn').hide();
                                break;
                            default:
                                $('#deleteEventButton').show();
                                $('#viewAppointmentBtn').hide();
                                $('#save').show().prop('disabled', false);
                                break;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching event details:', error);
                    }
                });
            }
        });

        // Show calendar modal and go to today's date
        $('#calendarModal').on('shown.bs.modal', function() {
            $('#calendar').fullCalendar('gotoDate', new Date());
        });

        // Add form submission handler
        $('#eventForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            // Custom validation for start date/time and end date/time
            var startDate = $('#eventStartDate').val();
            var startTime = $('#eventStartTime').val();
            var endDate = $('#eventEndDate').val();
            var endTime = $('#eventEndTime').val();

            var startDateTime = moment(startDate + ' ' + startTime);
            var endDateTime = moment(endDate + ' ' + endTime);

            if (startDateTime.isAfter(endDateTime)) {
                alert('Start date and time must be before end date and time.');
                return;
            }

            var formData = $(this).serialize(); // Serialize form data
            var url = $('#eventId').val() ? '<?php echo e(route("events.update", ":id")); ?>'.replace(':id', $(
                '#eventId').val()) : '<?php echo e(route("events.store")); ?>';
            var method = $('#eventId').val() ? 'PUT' : 'POST'; // Determine if it's PUT or POST

            $.ajax({
                url: url,
                method: method,
                data: formData,
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    // Refresh calendar
                    $('#calendar').fullCalendar('refetchEvents');
                    // Clear form inputs
                    clearForm();
                    // Close modal
                    $('#eventModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error('Error:', error);
                }
            });
        });

        // Add event deletion handler
        $('#deleteEventButton').click(function() {
            var eventId = $('#eventId').val();
            if (eventId) {
                if (confirm('Are you sure you want to delete this event?')) {
                    $.ajax({
                        url: '<?php echo e(route("events.destroy", ":id")); ?>'.replace(':id', eventId),
                        method: 'DELETE',
                        success: function(response) {
                            // Handle success response
                            console.log(response);
                            // Refresh calendar
                            $('#calendar').fullCalendar('refetchEvents');
                            // Clear form inputs
                            clearForm();
                            // Close modal
                            $('#eventModal').modal('hide');
                        },
                        error: function(xhr, status, error) {
                            // Handle error
                            console.error('Error:', error);
                        }
                    });
                }
            }
        });
    });
</script><?php /**PATH E:\dental\dental-main - 05-Feb-2026\resources\views/includes/calendar-modal.blade.php ENDPATH**/ ?>