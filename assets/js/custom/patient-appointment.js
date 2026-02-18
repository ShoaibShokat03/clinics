$(document).ready(function () {
    "use strict";
    $(document).on('change', '#doctor_id, #appointment_date', function () {
        if ($('#doctor_id').data('is_internal_change') === true) {
            return;
        }
        let userId = $('#doctor_id').val();
        let appointmentDate = $('#appointment_date').val();
        let siteUrl = $('meta[name="site-url"]').attr('content');
        let url = siteUrl + '/patient-appointments/get-schedule/doctorwise';
        let submitButton = $('#scheduleForm button[type="submit"]');

        // Reset disabled options
        $("#doctor_id option").prop('disabled', false);

        if (userId && appointmentDate) {
            $.get(url, { userId, appointmentDate }, function (response) {
                displayFlashMessage(response.message);
                console.log(response.message);

                // Hide submit button if doctor is not available
                if (response.status === 0) {
                    $('#doctor_availability').html('<div class="alert alert-danger">' + response.message + '</div>');
                    submitButton.hide();
                    $("#doctor_id option[value='" + userId + "']").prop('disabled', true);
                    // set first option empty 
                    $('#doctor_id').data('is_internal_change', true);
                    $("#doctor_id").val('').trigger('change');
                    $('#doctor_id').data('is_internal_change', false);

                    // Clear start and end time
                    $('#start_time').val('').trigger('change');
                    $('#end_time').val('').trigger('change');
                } else {
                    $('#doctor_availability').empty();
                    submitButton.prop('disabled', false);
                    submitButton.show();
                    // Option is already enabled by reset above

                    if (response.start_time && response.end_time) {
                        filterDoctorTimes(response.start_time, response.end_time);
                    }
                }
            });
        } else {
            submitButton.show();
            $('#doctor_availability').empty();
        }
    });

    function filterDoctorTimes(startTimeStr, endTimeStr) {
        let startMin = convertToMinutes(startTimeStr);
        let endMin = convertToMinutes(endTimeStr);

        let selectedDateVal = $('#appointment_date').val();
        let isToday = false;
        let currentMinutes = -1;

        if (selectedDateVal) {
            let selectedDate = new Date(selectedDateVal).toISOString().split('T')[0];
            let today = new Date().toISOString().split('T')[0];
            if (selectedDate === today) {
                isToday = true;
                let now = new Date();
                currentMinutes = now.getHours() * 60 + now.getMinutes();
            }
        }

        $('#start_time option, #end_time option').each(function () {
            let val = $(this).val();
            if (!val) return;

            let time = convertToMinutes(val);
            let disabled = false;

            // Check doctor schedule
            if (time < startMin || time > endMin) {
                disabled = true;
            }

            // Check "Today" constraint
            if (!disabled && isToday && time < currentMinutes) {
                disabled = true;
            }

            if (disabled) {
                $(this).prop('disabled', true).hide();
            } else {
                $(this).prop('disabled', false).show();
            }
        });

        // Reset selected value if it's now disabled
        $('#start_time, #end_time').each(function () {
            let val = $(this).val();
            if (val) {
                let opt = $(this).find('option[value="' + val + '"]');
                if (opt.prop('disabled')) {
                    $(this).val('');
                }
            }
        });
    }

    function convertToMinutes(timeStr) {
        if (!timeStr) return 0;
        let parts = timeStr.split(':');
        return parseInt(parts[0]) * 60 + parseInt(parts[1]);
    }

    function displayFlashMessage(message) {
        console.log("Displaying message:", message);  // Log the message
        $('.custom-flash-message').remove();

        let flashMessage = $('<div class="custom-flash-message"></div>').html(message).hide();
        $('body').prepend(flashMessage);
        flashMessage.fadeIn('slow');

        setTimeout(function () {
            flashMessage.fadeOut('slow', function () {
                $(this).remove();
            });
        }, 3000);
    }
});
