@extends('layouts.layout')

@section('one_page_css')
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">
@endsection
@section('one_page_js')
    <!-- ChartJS -->
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
@endsection
@section('content')
    <style>
        /* Dashboard Specific Styles */
        .dashboard-stat-card {
            background: #fff;
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            transition: all var(--transition-base);
            padding: 12px 15px;
            /* Reduced vertical padding */
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .dashboard-stat-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        .stat-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            /* Reduced margin */
        }

        .info-box-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-secondary);
            font-weight: 700;
        }

        .info-box-today {
            font-size: 10px;
            /* Smaller font */
            color: var(--text-muted);
            font-weight: 500;
            background: rgba(0, 0, 0, 0.04);
            padding: 2px 6px;
            /* Reduced padding */
            border-radius: 4px;
        }

        .stat-card-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            /* Reduced margin */
        }

        .info-box-icon {
            font-size: 1.5rem;
            /* Smaller icon */
            width: 38px;
            /* Smaller container */
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.03);
        }

        .info-box-number {
            font-size: 1.8rem;
            /* Slightly smaller number */
            font-weight: 700;
            line-height: 1;
            color: var(--text-title);
        }

        .card-actions {
            border-top: 1px solid var(--border-color);
            padding-top: 10px;
            /* Reduced padding */
            margin-top: auto;
            display: flex;
            gap: 12px;
            align-items: center;
            justify-content: space-between;
        }

        .card-actions a {
            font-size: 11px;
            /* Smaller action text */
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.2s;
            font-weight: 600;
            padding:5px;
            border:1px solid #9b9b9b;
            border-radius: 5px;
            background:#ebebeb;
        }

        .card-actions a:hover {
            color: #000;
        }

        .action-divider {
            color: var(--border-color);
            font-size: 10px;
        }

        .dashboard-cards-section {
            margin-bottom: var(--spacing-xl);
        }

        .dashboard-charts-section {
            margin-top: var(--spacing-lg);
        }

        .dashboard-charts-section .card {
            margin-bottom: var(--spacing-lg);
        }

        .chart-card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            color: white;
            border-radius: var(--radius-lg) var(--radius-lg) 0 0;
        }

        .chart-card-header h3 {
            color: white !important;
            font-size: var(--font-lg);
            font-weight: var(--font-semibold);
            margin: 0;
        }

        .dashboard-stat-card,
        .dashboard-charts-section>div>div.card,
        .dahsboard-status-cards>div>div.card {
            border: 1px solid #b9b9b9 !important;
        }
    </style>

    <!-- Dashboard Cards Section -->
    <div class="row dashboard-cards-section">
        <!-- Patients -->
        <div class="col-md-4 col-sm-6 col-12 col-lg-3 mt-3">
            <div class="dashboard-stat-card">
                <div class="stat-card-header">
                    <div class="info-box-label">@lang('Patients')</div>
                    <div class="info-box-today">@lang('Today'):
                        {{ number_format($dashboardCounts['today_patients'] ?? 0) }}</div>
                </div>
                <div class="stat-card-body">
                    <div class="info-box-icon text-dark">
                        <i class="fas fa-user-injured"></i>
                    </div>
                    <div class="info-box-number">{{ number_format($dashboardCounts['patients']) }}</div>
                </div>
                <div class="card-actions">
                    <a href='{{ route('patient-details.index') }}'>View Details</a>
                    <span class="action-divider">|</span>
                    <a href='{{ route('patient-details.create') }}'>Add Patient</a>
                </div>
            </div>
        </div>

        <!-- Appointments -->
        <div class="col-md-4 col-sm-6 col-12 col-lg-3 mt-3">
            <div class="dashboard-stat-card">
                <div class="stat-card-header">
                    <div class="info-box-label">@lang('Appointments')</div>
                    <div class="info-box-today">@lang('Today'):
                        {{ number_format($dashboardCounts['today_appointments'] ?? 0) }}</div>
                </div>
                <div class="stat-card-body">
                    <div class="info-box-icon text-dark">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="info-box-number">{{ number_format($dashboardCounts['appointments']) }}</div>
                </div>
                <div class="card-actions">
                    <a href='{{ route('patient-appointments.index') }}'>View All</a>
                    <span class="action-divider">|</span>
                    <a href='{{ route('patient-appointments.create') }}'>Book New</a>
                </div>
            </div>
        </div>

        <!-- Doctors -->
        {{-- <div class="col-md-4 col-sm-6 col-12 col-lg-3 mt-3">
        <div class="dashboard-stat-card">
            <div class="stat-card-header">
                <div class="info-box-label">@lang('Doctors')</div>
                <div class="info-box-today">@lang('Active'): {{ $dashboardCounts['active_doctors'] ?? 0 }}</div>
            </div>
            <div class="stat-card-body">
                <div class="info-box-icon text-success">
                    <i class="fas fa-user-md"></i>
                </div>
                <div class="info-box-number">{{ number_format($dashboardCounts['doctors']) }}</div>
            </div>
            <div class="card-actions">
                <a href='{{ route('doctor-details.index') }}'>View List</a>
                <span class="action-divider">|</span>
                <a href='{{ route('doctor-details.create') }}'>Add Doctor</a>
            </div>
        </div>
    </div> --}}

        <!-- Exam & Investigations -->
        <div class="col-md-4 col-sm-6 col-12 col-lg-3 mt-3">
            <div class="dashboard-stat-card">
                <div class="stat-card-header">
                    <div class="info-box-label">@lang('Exam & Diagnosis.')</div>
                    <div class="info-box-today">@lang('Today'):
                        {{ number_format($dashboardCounts['today_exam_investigation'] ?? 0) }}</div>
                </div>
                <div class="stat-card-body">
                    <div class="info-box-icon text-dark">
                        <i class="fas fa-bezier-curve"></i>
                    </div>
                    <div class="info-box-number">{{ number_format($dashboardCounts['exam_investigation']) }}</div>
                </div>
                <div class="card-actions">
                    <a href='{{ route('exam-investigations.index') }}'>View Records</a>
                    <span class="action-divider">|</span>
                    <a href='{{ route('exam-investigations.create') }}'>New Exam</a>
                </div>
            </div>
        </div>

        <!-- Treatment Plans -->
        <div class="col-md-4 col-sm-6 col-12 col-lg-3 mt-3">
            <div class="dashboard-stat-card">
                <div class="stat-card-header">
                    <div class="info-box-label">@lang('Treatments')</div>
                    <div class="info-box-today">@lang('Today'):
                        {{ number_format($dashboardCounts['today_treatment_plans'] ?? 0) }}</div>
                </div>
                <div class="stat-card-body">
                    <div class="info-box-icon text-dark">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="info-box-number">{{ number_format($dashboardCounts['treatment_plans']) }}</div>
                </div>
                <div class="card-actions">
                    <a href='{{ route('patient-treatment-plans.index') }}'>View Plans</a>
                    <span class="action-divider">|</span>
                    <a href='{{ route('patient-treatment-plans.create') }}'>New Plan</a>
                </div>
            </div>
        </div>

        <!-- Prescriptions -->
        <div class="col-md-4 col-sm-6 col-12 col-lg-3 mt-3">
            <div class="dashboard-stat-card">
                <div class="stat-card-header">
                    <div class="info-box-label">@lang('Prescriptions')</div>
                    <div class="info-box-today">@lang('Today'):
                        {{ number_format($dashboardCounts['today_prescriptions'] ?? 0) }}</div>
                </div>
                <div class="stat-card-body">
                    <div class="info-box-icon text-dark">
                        <i class="fas fa-pills"></i>
                    </div>
                    <div class="info-box-number">{{ number_format($dashboardCounts['prescriptions']) }}</div>
                </div>
                <div class="card-actions">
                    <a href='{{ route('prescriptions.index') }}'>View All</a>
                    <span class="action-divider">|</span>
                    <a href='{{ route('prescriptions.create') }}'>Add New</a>
                </div>
            </div>
        </div>

        <!-- Invoices -->
        <div class="col-md-4 col-sm-6 col-12 col-lg-3 mt-3">
            <div class="dashboard-stat-card">
                <div class="stat-card-header">
                    <div class="info-box-label">@lang('Invoices')</div>
                    <div class="info-box-today">@lang('Unpaid'):
                        {{ number_format($dashboardCounts['unpaid_invoices'] ?? 0) }}</div>
                </div>
                <div class="stat-card-body">
                    <div class="info-box-icon text-dark">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <div class="info-box-number">{{ number_format($dashboardCounts['invoices']) }}</div>
                </div>
                <div class="card-actions">
                    <a href='{{ route('invoices.index') }}'>View All</a>
                    <span class="action-divider">|</span>
                    <a href='{{ route('invoices.create') }}'>Create Invoice</a>
                </div>
            </div>
        </div>

        <!-- Expenses -->
        <div class="col-md-4 col-sm-6 col-12 col-lg-3 mt-3">
            <div class="dashboard-stat-card">
                <div class="stat-card-header">
                    <div class="info-box-label">@lang('Expenses')</div>
                    <div class="info-box-today">@lang('Today'):
                        {{ number_format($dashboardCounts['today_payments'] ?? 0) }}</div>
                </div>
                <div class="stat-card-body">
                    <div class="info-box-icon text-dark">
                        <i class="fas fa-money-check"></i>
                    </div>
                    <div class="info-box-number">{{ number_format($dashboardCounts['payments']) }}</div>
                </div>
                <div class="card-actions">
                    <a href='{{ route('payments.index') }}'>View All</a>
                    <span class="action-divider">|</span>
                    <a href='{{ route('payments.create') }}'>Add Expense</a>
                </div>
            </div>
        </div>

        <!-- Lab Reports -->
        <div class="col-md-4 col-sm-6 col-12 col-lg-3 mt-3">
            <div class="dashboard-stat-card">
                <div class="stat-card-header">
                    <div class="info-box-label">@lang('Lab Reports')</div>
                    <div class="info-box-today">@lang('Today'):
                        {{ number_format($dashboardCounts['today_labReports'] ?? 0) }}</div>
                </div>
                <div class="stat-card-body">
                    <div class="info-box-icon text-dark">
                        <i class="fas fa-money-check"></i>
                    </div>
                    <div class="info-box-number">{{ number_format($dashboardCounts['labReports']) }}</div>
                </div>
                <div class="card-actions">
                    <a href='{{ route('dental_lab_orders.index') }}'>View All</a>
                    <span class="action-divider">|</span>
                    <a href='{{ route('dental_lab_orders.create') }}'>New Order</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Dashboard Cards Section -->

    <!-- Statistics Charts Section -->
    <div class="row dashboard-charts-section">
        <!-- Main Statistics Overview -->
        <div class="col-md-12 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <h3 class="card-title font-weight-bold text-dark mb-0">
                        <i class="fas fa-chart-bar mr-2 text-primary"></i>@lang('Dashboard Statistics Overview')
                    </h3>
                </div>
                <div class="card-body pt-0">
                    <div class="chart" style="position: relative; height: 350px;">
                        <canvas id="statisticsBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row dahsboard-status-cards">
        <!-- Doctors Status -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0">
                    <h3 class="card-title font-weight-bold text-dark" style="font-size: 1rem;">@lang('Doctors Status')</h3>
                </div>
                <div class="card-body pt-0 px-2 pb-2">
                    <div class="chart" style="position: relative; height: 200px;">
                        <canvas id="doctorsStatusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Patients Status -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0">
                    <h3 class="card-title font-weight-bold text-dark" style="font-size: 1rem;">@lang('Patients Status')</h3>
                </div>
                <div class="card-body pt-0 px-2 pb-2">
                    <div class="chart" style="position: relative; height: 200px;">
                        <canvas id="patientsStatusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointments Status -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0">
                    <h3 class="card-title font-weight-bold text-dark" style="font-size: 1rem;">@lang('Appointments Status')</h3>
                </div>
                <div class="card-body pt-0 px-2 pb-2">
                    <div class="chart" style="position: relative; height: 200px;">
                        <canvas id="appointmentsStatusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Financial Overview -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0">
                    <h3 class="card-title font-weight-bold text-dark" style="font-size: 1rem;">@lang('Financial Overview')</h3>
                </div>
                <div class="card-body pt-0 px-2 pb-2">
                    <div class="chart" style="position: relative; height: 200px;">
                        <canvas id="financialChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Statistics Charts Section -->

    {{-- <div class="row">
        <div class="col-md-12">
            <!-- BAR CHART -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title custom-color-white">@lang('Monthly Debit/Credit')</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="barChart" class="custom-dashbord-mix"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div> --}}

    {{-- <div class="row">
        <div class="col-md-6">
            <!-- BAR CHART -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title custom-color-white">{{ date('Y') }} @lang('Debit/Credit') </h3>
</div>
<div class="card-body">
    <div class="chart">
        <canvas id="donutChart1" class="custom-dashbord-mix"></canvas>
    </div>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<div class="col-md-6">
    <!-- BAR CHART -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title custom-color-white">@lang('Overall Debit/Credit')</h3>
        </div>
        <div class="card-body">
            <div class="chart">
                <canvas id="donutChart2" class="custom-dashbord-mix"></canvas>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
</div> --}}
@endsection

@push('footer')
    <script src="{{ asset('assets/js/custom/dashboard/view.js') }}"></script>
    <script>
        $(document).ready(function() {
            "use strict";

            // Design System Colors
            const colors = {
                primary: '#17a2b8',
                primaryLight: '#e3f2fd',
                success: '#28a745',
                successLight: '#d4edda',
                warning: '#ffc107',
                danger: '#dc3545',
                info: '#17a2b8',
                secondary: '#6c757d',
                text: '#495057',
                border: '#e9ecef'
            };

            // Common Chart Options
            const commonOptions = {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels: {
                        fontColor: colors.text,
                        usePointStyle: true,
                        padding: 20
                    }
                },
                tooltips: {
                    backgroundColor: 'rgba(52, 58, 64, 0.9)',
                    titleFontColor: '#fff',
                    bodyFontColor: '#fff',
                    borderColor: 'rgba(0,0,0,0.1)',
                    borderWidth: 1,
                    cornerRadius: 4,
                    displayColors: true,
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.datasets[tooltipItem.datasetIndex].label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += tooltipItem.yLabel || data.datasets[tooltipItem.datasetIndex].data[
                                tooltipItem.index];
                            return label;
                        }
                    }
                }
            };

            // Dashboard statistics data
            var dashboardCounts = @json($dashboardCounts);

            // Main Statistics Bar Chart
            var statisticsCtx = document.getElementById('statisticsBarChart').getContext('2d');
            new Chart(statisticsCtx, {
                type: 'bar',
                data: {
                    labels: [
                        '@lang('Patients')',
                        '@lang('Doctors')',
                        '@lang('Appointments')',
                        '@lang('Invoices')',
                        '@lang('Prescriptions')',
                        '@lang('Treatment Plans')',
                        '@lang('Lab Reports')',
                        '@lang('Exam & Inv.')',
                        '@lang('Expenses')'
                    ],
                    datasets: [{
                        label: '@lang('Count')',
                        data: [
                            dashboardCounts.patients,
                            dashboardCounts.doctors,
                            dashboardCounts.appointments,
                            dashboardCounts.invoices,
                            dashboardCounts.prescriptions,
                            dashboardCounts.treatment_plans,
                            dashboardCounts.labReports,
                            dashboardCounts.exam_investigation,
                            dashboardCounts.payments
                        ],
                        backgroundColor: [
                            colors.warning,
                            colors.success,
                            colors.danger,
                            colors.danger, // Invoices
                            colors.info,
                            colors.success, // Treatment Plans
                            colors.info, // Lab
                            colors.secondary,
                            colors.info, // Exam
                            colors.warning
                        ],
                        borderWidth: 0,
                        barPercentage: 0.6,
                        categoryPercentage: 0.8
                    }]
                },
                options: {
                    ...commonOptions,
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                color: colors.border,
                                drawBorder: false
                            },
                            ticks: {
                                beginAtZero: true,
                                fontColor: colors.text
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                fontColor: colors.text
                            }
                        }]
                    }
                }
            });

            // Helper function for Doughnut Charts
            function createDoughnutChart(canvasId, labels, data, bgColors) {
                var ctx = document.getElementById(canvasId).getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: bgColors,
                            borderWidth: 0
                        }]
                    },
                    options: {
                        ...commonOptions,
                        cutoutPercentage: 70
                    }
                });
            }

            // Doctors Status Pie Chart
            createDoughnutChart(
                'doctorsStatusChart',
                ['@lang('Active')', '@lang('Inactive')'],
                [dashboardCounts.active_doctors, dashboardCounts.nonactive_doctors],
                [colors.success, colors.secondary]
            );

            // Patients Status Pie Chart
            createDoughnutChart(
                'patientsStatusChart',
                ['@lang('Active')', '@lang('Inactive')'],
                [dashboardCounts.active_patients, dashboardCounts.nonactive_patients],
                [colors.success, colors.secondary]
            );

            // Appointments Status Pie Chart
            createDoughnutChart(
                'appointmentsStatusChart',
                ['@lang('Total')', '@lang('Processed')', '@lang('Cancelled')'],
                [dashboardCounts.appointments, dashboardCounts.processed, dashboardCounts.cancel],
                [colors.info, colors.success, colors.secondary]
            );

            // Financial Overview Bar Chart
            var financialCtx = document.getElementById('financialChart').getContext('2d');
            new Chart(financialCtx, {
                type: 'bar',
                data: {
                    labels: [
                        '@lang('Invoices')',
                        '@lang('Total')',
                        '@lang('Paid')',
                        '@lang('Payments')'
                    ],
                    datasets: [{
                        label: '@lang('Amount')',
                        data: [
                            dashboardCounts
                            .invoices, // Using count for visual demo, ideally should be amount if available in different context
                            dashboardCounts.total || 0,
                            dashboardCounts.paid || 0,
                            dashboardCounts.totalAmount || 0
                        ],
                        backgroundColor: [
                            colors.danger,
                            colors.primary,
                            colors.success,
                            colors.warning
                        ],
                        borderWidth: 0,
                        barPercentage: 0.6
                    }]
                },
                options: {
                    ...commonOptions,
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                color: colors.border,
                                drawBorder: false
                            },
                            ticks: {
                                beginAtZero: true,
                                fontColor: colors.text,
                                callback: function(value) {
                                    if (value >= 1000) return (value / 1000) + 'k';
                                    return value;
                                }
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                fontColor: colors.text
                            }
                        }]
                    },
                    tooltips: {
                        ...commonOptions.tooltips,
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return tooltipItem.yLabel.toLocaleString();
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
