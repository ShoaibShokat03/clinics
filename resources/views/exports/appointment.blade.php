<table>
    <thead>
        <tr>
            <th>Appointment ID</th>
            <th>Patient Name</th>
            <th>Doctor Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($appointments as $appointment)
            <tr>
                <td>{{ $appointment->id }}</td>
                <td>{{ $appointment->patient->name ?? 'N/A' }}</td>
                <td>{{ $appointment->doctor->name ?? 'N/A' }}</td>
                <td>{{ $appointment->appointment_date ?? '-' }}</td>
                {{-- <td>{{ $appointment->start_time . " " . $appointment->end_time ?? '-' }}</td> --}}
                <td>
                    @php
                        $start = $appointment->start_time ? \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') : '-';
                        $end = $appointment->end_time ? \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') : '-';
                    @endphp
                    {{ $start }} - {{ $end }}
                </td>
                <td>{{ $appointment->created_at->format('d M Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>