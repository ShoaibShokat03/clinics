<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .email-header {
        background-color: #0066CC;
        color: white;
        padding: 20px;
        text-align: center;
    }

    .email-body {
        background-color: white;
        color: #333;
        padding: 20px;
    }

    .email-footer {
        background-color: #0066CC;
        color: white;
        text-align: center;
        padding: 10px;
    }

    .button {
        background-color: #0066CC;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        display: inline-block;
    }

    .button:hover {
        background-color: #138496;
        color: white;
    }
</style>
</head>
<body>
<section>
    <div class="email-header">
        <h1>{{ $ApplicationSetting->item_name }} Clinic</h1>
    </div>

    <div class="email-body">
        {{-- Greeting --}}
        @if (! empty($greeting))
        <h2 style="text-align: center; color: #0066CC;">{{ $greeting }}</h2>
        @else
            @if ($level === 'error')
            <h2 style="text-align: center; color: #dc3545;">Whoops!</h2>
            @else
            <h2 style="text-align: center; color: #0066CC;">Hello!</h2>
            @endif
        @endif

        {{-- Intro Lines --}}
        @foreach ($introLines as $line)
        <p>{{ $line }}</p>
        @endforeach

        {{-- Action Button --}}
        @isset($actionText)
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $actionUrl }}" class="button">{{ $actionText }}</a>
        </div>
        @endisset

        {{-- Outro Lines --}}
        @foreach ($outroLines as $line)
        <p>{{ $line }}</p>
        @endforeach

        {{-- Salutation --}}
        <p style="text-align: center;">
            Regards,<br>
            {{ $ApplicationSetting->item_name }} Team
        </p>

        {{-- Subcopy --}}
        @isset($actionText)
        <div style="border-top: 1px solid #e8e5ef; margin-top: 25px; padding-top: 25px;">
            <p style="font-size: 14px; color: #666;">
                If you're having trouble clicking the "{{ $actionText }}" button,
                copy and paste the URL below into your web browser:
                <br>
                <span style="color: #0066CC; word-break: break-all;">{{ $actionUrl }}</span>
            </p>
        </div>
        @endisset
    </div>

    <div class="email-footer">
        <p>© {{ date('Y') }} {{ $ApplicationSetting->item_name }}. All rights reserved.</p>
    </div>
</section>
</body>
</html>
