@include('includes.calendar-modal')

{{-- <style>
    .taskNotificationListHeader a{
        font-size:12px;
        padding-left:3px;
        text-wrap: wrap;
    }
    .taskNotificationListHeader a:hover{
        background-color:#0066CC;
        color:#ffffff !important;
    }
    .taskNotificationListHeader a:active{
        background-color:#ffffff;
        color:#0066CC !important;
    }
    .taskNotificationListHeader ~a:hover {
        background-color:#ffffff;
        color:#0066CC !important;
    }
</style> --}}

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    /* Unified Header Styling */
    .main-header .navbar-nav .nav-link {
        transition: all 0.2s ease;
    }

    .main-header .navbar-nav .nav-link:hover i {
        color: #17a2b8 !important;
        transform: scale(1.1);
    }

    /* Unified dropdown styling */
    .dropdown-menu {
        border: 1px solid #f4f4f4 !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
        border-radius: 0.5rem !important;
    }

    .dropdown-item {
        font-size: 0.9rem !important;
        padding: 0.6rem 1rem !important;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa !important;
        color: #17a2b8 !important;
        padding-left: 1.2rem !important;
    }

    .dropdown-header {
        font-size: 0.95rem !important;
        font-weight: 600 !important;
        color: #495057 !important;
    }

    .dropdown-divider {
        margin: 0.25rem 0 !important;
        border-color: #f4f4f4 !important;
    }
</style>

<nav class="main-header navbar navbar-expand navbar-white navbar-light sticky-top"
    style="position: sticky; top: 0; z-index: 1020; border-bottom: 1px solid #f4f4f4; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" style="cursor: pointer;"><i
                    class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('patient-appointments.create') }}"
                class="btn btn-outline-primary btn-sm mt-1 mr-2 shadow-sm">
                <i class="fas fa-calendar-plus"></i> <span class="d-none d-md-inline">@lang('Book Appointment')</span>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('invoices.create') }}" class="btn btn-outline-success btn-sm mt-1 mr-2 shadow-sm">
                <i class="fas fa-file-invoice-dollar"></i> <span class="d-none d-md-inline">@lang('Create Invoice')</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Calendar" data-toggle="modal"
                data-target="#calendarModal" style="cursor: pointer;">
                <i class="fa fa-calendar" style="font-size: 20px; color: #6c757d;"></i>
            </a>
        </li>


        <li class="nav-item">
            <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Notifications" class="nav-link"
                href="{{ route('notifications.index') }}" style="position: relative; cursor: pointer;">
                <i class="fa fa-bell" style="font-size: 20px; color: #6c757d;"></i>
                @php $unreadCount = \App\Models\Notification::where('notification_to', Auth::id())->where('status', 'new')->count(); @endphp
                @if ($unreadCount > 0)
                    <span style="position: absolute; top: 8px; right: 8px; font-size: 0.65rem;"
                        class="badge badge-pill badge-danger" id="notificationCount">{{ $unreadCount }}</span>
                @endif
            </a>
        </li>


        {{-- <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="taskNotificationDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-tasks"></i>
                <span class="badge badge-danger" id="taskNotificationCount">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="taskNotificationDropdown" style="top:80%;">
                <h6 class="dropdown-header" style="padding-left:3px; text-align:left; font-weight:bold;">Tasks</h6>
                <div id="taskNotificationList" class="taskNotificationListHeader">
                </div>
                <div class="dropdown-divider"></div>
                <a style="font-size:12px;" class="dropdown-item text-center " href="{{ route('tasks.index') }}">View All Tasks</a>
        </div>
        </li> --}}


        <li class="nav-item dropdown">
            @php
                if (Auth::user()->photo == null) {
                    $photo = 'assets/images/profile/male.png';
                } else {
                    $photo = Auth::user()->photo;
                }
            @endphp
            <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#"
                style="cursor: pointer;">
                <img src="{{ asset($photo) }}" alt="user-img" width="32" height="32" class="rounded-circle"
                    style="object-fit: cover; border: 2px solid #f4f4f4;">
                <span class="ml-2 d-none d-md-inline" style="font-size: 0.9rem; color: #495057;">
                    {{ strtok(Auth::user()->name, ' ') }}
                </span>
                <i class="fas fa-chevron-down ml-2 d-none d-md-inline" style="font-size: 0.7rem; color: #6c757d;"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" style="min-width: 280px; padding: 0;">
                <div class="px-3 py-3 border-bottom" style="background-color:white;">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($photo) }}" alt="user" width="48" height="48"
                            class="rounded-circle" style="object-fit: cover; border: 2px solid #fff;">
                        <div class="ml-3">
                            <h6 class="mb-0" style="font-size: 0.95rem; font-weight: 600;">{{ Auth::user()->name }}
                            </h6>
                            <p class="mb-0 text-muted" style="font-size: 0.8rem;">
                                {{ \Illuminate\Support\Str::limit(Auth::user()->email, 25) }}
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('profile.view') }}" class="btn btn-sm btn-info btn-block mt-2"
                        style="font-size: 0.85rem;">{{ __('View Profile') }}</a>
                </div>

                <a href="{{ route('profile.view') }}" class="dropdown-item">
                    <i class="fas fa-user mr-2" style="width: 20px; text-align: center;"></i> {{ __('My Profile') }}
                </a>
                <a href="{{ route('profile.setting') }}" class="dropdown-item">
                    <i class="fas fa-cogs mr-2" style="width: 20px; text-align: center;"></i>
                    {{ __('Account Setting') }}
                </a>
                <a href="{{ route('profile.password') }}" class="dropdown-item">
                    <i class="fa fa-key mr-2" style="width: 20px; text-align: center;"></i> {{ __('Change Password') }}
                </a>

                <div class="dropdown-divider"></div>

                <a id="header-logout" href="{{ route('logout') }}" class="dropdown-item text-danger">
                    <i class="fa fa-power-off mr-2" style="width: 20px; text-align: center;"></i> {{ __('Logout') }}
                </a>
                <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
<script src="{{ asset('assets/js/custom/layouts/header.js') }}"></script>
<script>
    const markAllNotificationsAsReadUrl = "{{ route('notifications.readAll') }}";
    document.addEventListener('DOMContentLoaded', () => {
        // Notification dropdown listeners removed
    });

    async function loadNotifications() {
        // Dropdown removed, no longer need to load them here
    }

    function attachNotificationClickEvents() {
        document.querySelectorAll('.notification-link').forEach(link => {
            link.addEventListener('click', async (event) => {
                event.preventDefault();
                const notificationId = event.currentTarget.getAttribute('data-id');
                const url = event.currentTarget.getAttribute('href');
                await markNotificationAsRead(notificationId);
                window.location.href = url;
            });
        });
    }

    async function markNotificationAsRead(notificationId) {
        try {
            const response = await fetch('{{ route('notifications.markAsRead') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    id: notificationId
                })
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const result = await response.json();
            if (result.success) {
                const notificationElement = document.querySelector(
                    `.notification-link[data-id="${notificationId}"] .notification-item`);
                notificationElement.classList.remove('its-new');
                notificationElement.classList.add('its-read');
            }
        } catch (error) {
            console.error('Error marking notification as read:', error);
        }
    }

    async function markAllNotificationsAsRead() {
        try {
            const response = await fetch(markAllNotificationsAsReadUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                }
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const result = await response.json();
            if (result.success) {
                document.querySelectorAll('.notification-link .notification-item').forEach(notificationElement => {
                    notificationElement.classList.remove('its-new');
                    notificationElement.classList.add('its-read');
                });

                document.getElementById('notificationCount').textContent = 0;
            }
        } catch (error) {
            console.error('Error marking all notifications as read:', error);
        }
    }

    // No longer need manual handleDocumentClick if using Bootstrap's default behavior
</script>
{{-- <script>
    $(document).ready(function() {
        // Function to fetch task notifications
       function fetchTaskNotifications() {
    $.ajax({
        url: '{{ route('taskNotifications.fetch') }}',
type: 'GET',
success: function(data) {
let notifications = data.notifications;
// Sort notifications by date in descending order
notifications.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
let notificationCount = data.countTaskNotification;
$('#taskNotificationCount').text(notificationCount);
let notificationList = '';
notifications.forEach(notification => {
let notificationClass = notification.status === 'new' ?
'font-weight-bold' : 'text-muted';
notificationList += `
<a class="dropdown-item ${notificationClass}" id="notification-${notification.id}" href="${notification.url}" onclick="handleNotificationClick(event, ${notification.id})">
    ${notification.text}
</a>`;
});
$('#taskNotificationList').html(notificationList);
},
error: function(xhr, status, error) {
console.error('Error fetching notifications:', error);
}
});
}


// Function to mark task notification as read
window.markTaskNotificationAsRead = function(notificationId) {
$.ajax({
url: '{{ route('taskNotifications.markAsRead') }}',
type: 'POST',
data: {
_token: '{{ csrf_token() }}',
notificationId: notificationId
},
success: function() {
// Change the appearance of the read notification
$('#notification-' + notificationId).removeClass('font-weight-bold')
.addClass('text-muted');
// Update the notification count
updateNotificationCount();
},
error: function(xhr, status, error) {
console.error('Error marking notification as read:', error);
}
});
};

// Function to update the notification count
function updateNotificationCount() {
let currentCount = parseInt($('#taskNotificationCount').text());
if (!isNaN(currentCount) && currentCount > 0) {
$('#taskNotificationCount').text(currentCount - 1);
}
}

// Function to handle notification click
window.handleNotificationClick = function(event, notificationId) {
event.preventDefault(); // Prevent the default link behavior
// Redirect to the notification URL
window.location.href = $(`#notification-${notificationId}`).attr('href');
// Mark the notification as read
markTaskNotificationAsRead(notificationId);
};


fetchTaskNotifications();
});
</script> --}}
