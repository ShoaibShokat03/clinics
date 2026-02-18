<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-header">

</section>

<style>
    .appointment-card {
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 30px;
        margin: 20px 0;
        background: #ffffff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e5e5e5;
    }

    .company-info h4 {
        display: flex;
        text-align: left;
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
    }

    .company-info img {
        width: 40px;
        height: 40px;
        margin-right: 12px;
        object-fit: contain;
    }

    .company-details {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
    }

    .appointment-title {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        top: 15px;
        font-size: 22px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .patient-info-header {
        text-align: right;
        font-size: 14px;
        color: #666;
        line-height: 1.6;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin: 30px 0;
        padding: 30px 0;
        border-top: 1px solid #e5e5e5;
        border-bottom: 1px solid #e5e5e5;
    }

    .info-item {
        display: flex;
        text-align: left;
        gap: 15px;
    }

    .info-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #f0f0f0;
        flex-shrink: 0;
    }

    .info-content h6 {
        font-size: 12px;
        font-weight: 500;
        color: #888;
        margin: 0 0 5px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-content p {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .appointment-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 25px;
        margin: 30px 0;
    }

    .detail-item h6 {
        font-size: 12px;
        font-weight: 500;
        color: #888;
        margin: 0 0 8px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .detail-item p {
        font-size: 15px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .problem-section {
        margin: 30px 0;
    }

    .problem-section h6 {
        font-size: 12px;
        font-weight: 500;
        color: #888;
        margin: 0 0 12px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .problem-section p {
        font-size: 15px;
        color: #333;
        line-height: 1.6;
        margin: 0;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid #007bff;
    }

    .bottom-controls {
        display: flex;
        justify-content: space-between;
        text-align: left;
        margin-top: 40px;
        gap: 20px;
    }

    .status-control {
        flex: 0 0 200px;
    }

    .status-control label {
        font-size: 12px;
        font-weight: 500;
        color: #888;
        margin: 0 0 8px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: block;
    }

    .status-control select {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        background: white;
        color: #333;
    }

    .print-btn {
        padding: 12px 24px;
        background: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        color: #666;
        display: flex;
        text-align: left;
        gap: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .print-btn:hover {
        background: #e9ecef;
        color: #333;
    }

    /* Status badge styling */
    .status-new {
        display: inline-block;
        background: #e3f2fd;
        color: #1976d2;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
    }

    html,
    body {
        overflow-x: hidden;
    }

    /* ✅ Ensure all main containers fit inside viewport */
    .appointment-card {
        max-width: 100%;
        box-sizing: border-box;
    }

    /* ✅ Prevent absolute title from causing overflow */
    .appointment-title {
        white-space: normal;
        max-width: 90%;
        text-align: left !important;
    }

    /* ✅ Ensure grids never exceed width */
    .info-grid,
    .appointment-details {
        width: 100%;
    }


    @media (max-width: 992px) {
        .header-section {
            flex-direction: column;
            gap: 15px;
            text-align: left;
            text-align: left !important;
        }

        .appointment-title {
            position: relative;
            left: auto;
            transform: none;
            top: auto;
            margin-top: 10px;
        }

        .patient-info-header {
            text-align: left !important;
        }

        .info-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px 0;
        }

        .appointment-details {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }

        .info-item {
            flex-direction: column;
            text-align: left;
            text-align: left !important;
        }

        .info-avatar {
            margin-bottom: 8px;
        }
    }

    /* Mobile phones */
    @media (max-width: 576px) {
        .company-info h4 {
            font-size: 18px;
            flex-direction: column;
            gap: 8px;
            text-align: left !important;
        }

        .company-info img {
            width: 35px;
            height: 35px;
        }

        .appointment-title {
            font-size: 18px;
            margin-bottom: 8px;
        }

        .info-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .appointment-details {
            grid-template-columns: 1fr;
        }

        .bottom-controls {
            flex-direction: column;
            gap: 15px;
        }

        .status-control,
        .print-btn {
            width: 100%;
        }

        .print-btn {
            justify-content: center;
        }
    }

    /* Extra small devices */
    @media (max-width: 400px) {
        .company-details {
            font-size: 12px;
        }

        .info-content p {
            font-size: 14px;
        }

        .detail-item p {
            font-size: 14px;
        }
    }

    .header-section {
        margin-bottom: 20px;
        /* 40px → 20px */
        padding-bottom: 10px;
        /* 20px → 10px */
    }

    .info-grid {
        margin: 15px 0;
        /* 30px → 15px */
        padding: 15px 0;
        /* 30px → 15px */
    }

    .appointment-details {
        margin: 15px 0;
        /* 30px → 15px */
    }

    .bottom-controls {
        margin-top: 20px;
        /* 40px → 20px */
    }
</style>

<div class="col-12">
    <div class="card">
        <div class="card-body" id="print-area">
            <div class="appointment-card">
                <!-- Header Section -->
                <div class="header-section">
                    <div class="company-info">
                        <h4>
                            <img src="{{ asset('public/' . $ApplicationSetting->logo) }}"
                                alt="{{ $ApplicationSetting->item_name }}" class="brand-image">
                            {{ $ApplicationSetting->item_name }}
                        </h4>
                        <div class="company-details">
                            <div>{{ $ApplicationSetting->company_name }}</div>
                            <div>Email: {{ $ApplicationSetting->company_email }}</div>
                            <div>Phone: {{ $ApplicationSetting->contact }}</div>
                        </div>
                    </div>

                    <h4 class="appointment-title">Appointment Info</h4>

                    <div class="patient-info-header">
                        <div>Patient: {{ $patientAppointment->patient->name ?? '-' }}</div>
                        <div>Gender: {{ $patientAppointment->patient->gender ?? '-' }}</div>
                        {{-- <div>Phone: {{ $patientAppointment->patient->phone ?? '-' }}
                    </div> --}}
                    </div>
                </div>

                <!-- Patient and Doctor Info Grid -->
                <div class="info-grid">
                    <div class="info-item">
                        @if ($profilePicture)
                            <img class="info-avatar" src="{{ asset('storage/' . $profilePicture) }}"
                                alt="Profile Picture" />
                        @else
                            <img class="info-avatar" src="{{ asset('assets/images/profile/male.png') }}"
                                alt="Default Profile Picture" />
                        @endif
                        <div class="info-content">
                            <h6>@lang('Patient Name')</h6>
                            <p>{{ $patientAppointment->patient->name ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-content">
                            <h6>@lang('MRN Number')</h6>
                            <p>{{ $patientAppointment->patient->patientdetails->mrn_number ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- <div class="info-item">
                        <div class="info-content">
                            <h6>@lang('Contact Number')</h6>
                            <p>{{ $patientAppointment->patient->phone ?? '-' }}</p>
        </div>
    </div> --}}

                    <div class="info-item">
                        <!-- @if (isset($patientAppointment->doctor->photo_url))
<img class="info-avatar" src="{{ $patientAppointment->doctor->photo_url }}"
                                alt="Doctor Photo" />
@else
<img class="info-avatar" src="{{ asset('assets/images/profile/male.png') }}"
                                alt="Default Profile Picture" />
@endif -->
                        <div class="info-content">
                            <h6>@lang('Doctor Name')</h6>
                            <p>{{ $patientAppointment->doctor->name ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Appointment Details -->
                <div class="appointment-details">
                    <div class="detail-item">
                        <h6>@lang('Appointment Number')</h6>
                        <p>{{ $patientAppointment->appointment_number ?? '-' }}</p>
                    </div>

                    <div class="detail-item">
                        <h6>@lang('Appointment Date')</h6>
                        <p>{{ \Carbon\Carbon::parse($patientAppointment->appointment_date)->format('d F Y') }}</p>
                    </div>

                    <div class="detail-item">
                        <h6>@lang('Appointment Time')</h6>
                        <p>{{ \Carbon\Carbon::parse($patientAppointment->start_time)->format('h:i A') . ' - ' . \Carbon\Carbon::parse($patientAppointment->end_time)->format('h:i A') }}
                        </p>
                    </div>

                    <div class="detail-item">
                        <h6>@lang('Status')</h6>
                        <p><span class="status-new">{{ $patientAppointment->appointmentstatus->name ?? '-' }}</span>
                        </p>
                    </div>
                </div>

                <!-- Problem/Description -->
                <div class="problem-section">
                    <h6>@lang('Problem/Description')</h6>
                    <p>{{ $patientAppointment->problem }}</p>
                </div>

                <!-- Bottom Controls -->
                {{-- <div class="bottom-controls">
                    <div class="status-control no-print">
                        <label for="status">@lang('Status')</label>
                        @php
                        $currentDate = \Carbon\Carbon::now()->format('Y-m-d');
                        $currentStatus = $statuses->firstWhere('id', $patientAppointment->appointment_status_id);
                        $isDisabled = isset($currentStatus) &&
                        ($currentStatus->name == 'Processed' ||
                        ($currentStatus->name == 'Cancelled' && $patientAppointment->appointment_status_id !==
                        old('status')) ||
                        $patientAppointment->appointment_date < $currentDate); @endphp --}} {{-- <select id="status"
                            name="status" class="form-control" @if ($isDisabled) disabled @endif>
                            @foreach ($statuses as $status)
                            <option value="{{ $status->id }}" @if (old('status', $patientAppointment->appointment_status_id) == $status->id) selected @endif>
{{ $status->name }}
</option>
@endforeach
</select>
</div> --}}

                {{-- <button id="doPrint" class="print-btn">
                        <i class="fas fa-print"></i>
                        Print
                    </button> --}}
            </div>
        </div>
    </div>
</div>
</div>

{{--
<?php if ($logs): ?>
<div class="container mt-2 no-print">
    @canany(['userlog-read'])
    <div class="card">
        <div class="card-header bg-info">
            <h3 class="card-title">User Logs</h3>
        </div>
    </div>
    @endcanany
</div>
<?php endif; ?> --}}

<script>
    $(document).ready(function() {
        document.querySelector('.wrapper').remove();

        var statusId;
        var $statusSelect = $('#status');
        var previousStatus = $statusSelect.val();

        $statusSelect.on('change', function() {
            var $this = $(this);
            var statusId = $this.val();
            var appointmentId = @json($patientAppointment->id);

            // Blur to prevent conflicts
            $this.blur();

            if (statusId == '1' || statusId == '2') {
                updateStatus(statusId, appointmentId, function() {
                    previousStatus = statusId;
                });
            } else if (statusId == '4' || statusId == '3') {
                var confirmationMessage = statusId == '4' ?
                    "@lang('Are you sure you want to Cancel the appointment?')" :
                    "@lang('Are you sure you want to Process the appointment?')";

                Swal.fire({
                    title: "@lang('Confirm Status Change')",
                    text: confirmationMessage,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "@lang('Yes, change it!')",
                    cancelButtonText: "@lang('No, keep it')",
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        updateStatus(statusId, appointmentId, function() {
                            previousStatus = statusId;
                        });
                    } else {
                        $this.val(previousStatus);
                    }
                });
            }
        });

        function updateStatus(statusId, appointmentId, successCallback) {
            var $statusSelect = $('#status');
            $statusSelect.prop('disabled', true);

            toastr.info("@lang('Updating status...')", "@lang('Processing')", {
                timeOut: 2000,
                progressBar: true
            });

            $.ajax({
                url: "{{ route('change.status') }}",
                type: 'POST',
                data: {
                    statusId: statusId,
                    appointmentId: appointmentId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (successCallback) successCallback();
                    toastr.success("@lang('Status updated successfully')", "@lang('Success')");
                    setTimeout(function() {
                        window.location.reload();
                    }, 500);
                },
                error: function(xhr, status, error) {
                    $statusSelect.prop('disabled', false);
                    $statusSelect.val(previousStatus);
                    console.error('Error:', error);
                    toastr.error("@lang('Error updating status')", "@lang('Error')");
                }
            });
        }
    });
</script>
