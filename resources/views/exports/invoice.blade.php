<table>
    <thead>
        <tr>
            <th>id</th>
            <th>Invoice No</th>
            <th>Patient Name</th>
            <th>Doctor Name</th>
            <th>Total Amount</th>
            <th>Total Discount</th>
            <th>After Discont</th>
            <th>Paid</th>
            <th>Due</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $invoice)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $invoice->id }}</td>
                <td>{{ $invoice->user->name ?? 'N/A' }}</td>
                <td>{{ $invoice->doctor->name ?? 'N/A' }}</td>
                <td>{{ $invoice->total ?? '-' }}</td>
                <td>{{ $invoice->total_discount ?? '-' }}</td>
                <td>{{ $invoice->grand_total ?? '-' }}</td>
                <td>{{ $invoice->paid ?? '-' }}</td>
                <td>{{ $invoice->due ?? '-' }}</td>
                <td>{{ $invoice->invoice_date}}</td>
            </tr>
        @endforeach
    </tbody>
</table>