@php
    $c = Request::segment(1);
    $m = Request::segment(2);
    if (function_exists('getCurrentProject') && getCurrentProject()) {
        $c = Request::segment(2);
        $m = Request::segment(3);
    }
    $roleName = Auth::user()->getRoleNames();
@endphp

<aside class="main-sidebar sidebar-light-primary" style="box-shadow:2px 0px 13px 4px #ccc !important;">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('public/' . $ApplicationSetting->logo) }}" alt="{{ $ApplicationSetting->item_name }}"
            id="custom-opacity-sidebar" class="brand-image" style="opacity: .8; max-height: 33px;">
        <span class="brand-text font-weight-light" style="font-size:12px;">{{ $ApplicationSetting->item_name }}</span>
    </a>
    <style>
        /* Sidebar child items styling */
        .nav-treeview .nav-item .nav-link {
            font-size: 0.85rem !important;
            padding-left: 1rem !important;
            color: #6c757d !important;
            transition: all 0.2s ease;
        }

        .nav-treeview .nav-item .nav-link:hover {
            background-color: #ededed !important;
            color: #000 !important;
            padding-left: 1.2rem !important;
        }

        .nav-treeview .nav-item .nav-link.active {
            background-color: #ededed !important;
            color: #000 !important;
            font-weight: 500 !important;
        }

        .nav-treeview .nav-item .nav-link .nav-icon {
            font-size: 0.75rem !important;
            margin-right: 0.5rem;
        }

        /* Main nav items - keep normal size */
        .nav-sidebar>.nav-item>.nav-link {
            font-size: 0.95rem !important;
        }

        /* Main nav items hover/active */
        .nav-sidebar>.nav-item>.nav-link:hover,
        .nav-sidebar>.nav-item>.nav-link.active {
            background-color: #d7d7d7 !important;
            color: #000 !important;
        }

        /* Nav Icon hover/active color */
        .nav-sidebar>.nav-item>.nav-link:hover .nav-icon,
        .nav-sidebar>.nav-item>.nav-link.active .nav-icon,
        .nav-treeview .nav-item .nav-link:hover .nav-icon,
        .nav-treeview .nav-item .nav-link.active .nav-icon {
            color: #000 !important;
        }
    </style>
    <div class="sidebar">
        <?php
        if (Auth::user()->photo == null) {
            $photo = 'assets/images/profile/male.png';
        } else {
            $photo = 'public/' . Auth::user()->photo;
        }
        ?>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @canany(['dashboard-read'])
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link @if ($c == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>{{ __('Dashboard') }}</p>
                        </a>
                    </li>
                @endcanany


                @canany(['doctor-detail-read', 'doctor-detail-create', 'doctor-detail-update', 'doctor-detail-delete'])
                    <li class="nav-item">
                        <a href="{{ route('doctor-details.index') }}"
                            class="nav-link @if ($c == 'doctor-details') active @endif">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>@lang('Doctors')</p>
                        </a>
                    </li>
                @endcanany

                @canany(['doctor-schedule-read', 'doctor-schedule-create', 'doctor-schedule-update',
                    'doctor-schedule-delete'])
                    <li class="nav-item">
                        <a href="{{ route('doctor-schedules.index') }}"
                            class="nav-link @if ($c == 'doctor-schedules') active @endif">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>@lang('Doctor Schedules')</p>
                        </a>
                    </li>
                @endcanany
                @canany(['patient-detail-read', 'patient-detail-create', 'patient-detail-update',
                    'patient-detail-delete'])
                    <li class="nav-item has-treeview @if (
                        $c == 'patient-case-studies' ||
                            $c == 'patient-details' ||
                            $c == 'exam-investigations' ||
                            $c == 'patient-medical-histories' ||
                            $c == 'patient-dental-histories' ||
                            $c == 'patient-drug-histories' ||
                            $c == 'patient-social-histories' ||
                            $c == 'patient-treatment-plans' ||
                            $c == 'test-files') menu-open @endif">
                        <a href="javascript:void(0)" class="nav-link @if (
                            $c == 'patient-case-studies' ||
                                $c == 'patient-details' ||
                                $c == 'exam-investigations' ||
                                $c == 'patient-medical-histories' ||
                                $c == 'patient-dental-histories' ||
                                $c == 'patient-drug-histories' ||
                                $c == 'patient-social-histories' ||
                                $c == 'patient-treatment-plans' ||
                                $c == 'test-files') active @endif">
                            <i class="nav-icon fas fa-user-injured"></i>
                            <p>
                                @lang('Patients')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            @canany(['patient-detail-read', 'patient-detail-create', 'patient-detail-update',
                                'patient-detail-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('patient-details.index') }}"
                                        class="nav-link @if ($c == 'patient-details') active @endif">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>@lang('View All Patients')</p>
                                    </a>
                                </li>
                            @endcanany

                            {{-- @canany(['patient-case-studies-read', 'patient-case-studies-create', 'patient-case-studies-update', 'patient-case-studies-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('patient-case-studies.index') }}"
                        class="nav-link @if ($c == 'patient-case-studies') active @endif">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>@lang('Patient Case Studies')</p>
                        </a>
                </li>
                @endcanany --}}

                            @canany(['patient-medical-histories-read', 'patient-medical-histories-create',
                                'patient-medical-histories-update', 'patient-medical-histories-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('patient-medical-histories.index') }}"
                                        class="nav-link @if ($c == 'patient-medical-histories') active @endif">
                                        <i class="nav-icon fas fa-book-medical"></i>
                                        <p>@lang('Medical History')</p>
                                    </a>
                                </li>
                            @endcanany

                            @canany(['patient-dental-histories-read', 'patient-dental-histories-create',
                                'patient-dental-histories-update', 'patient-dental-histories-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('patient-dental-histories.index') }}"
                                        class="nav-link @if ($c == 'patient-dental-histories') active @endif">
                                        <i class="nav-icon fas fa-tooth"></i>
                                        <p>@lang('Dental History')</p>
                                    </a>
                                </li>
                            @endcanany

                            @canany(['patient-drug-histories-read', 'patient-drug-histories-create',
                                'patient-drug-histories-update', 'patient-drug-histories-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('patient-drug-histories.index') }}"
                                        class="nav-link @if ($c == 'patient-drug-histories') active @endif">
                                        <i class="nav-icon fas fa-pills"></i>
                                        <p>@lang('Drug History')</p>
                                    </a>
                                </li>
                            @endcanany

                            @canany(['patient-social-histories-read', 'patient-social-histories-create',
                                'patient-social-histories-update', 'patient-social-histories-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('patient-social-histories.index') }}"
                                        class="nav-link @if ($c == 'patient-social-histories') active @endif">
                                        <i class="nav-icon fas fa-user-friends"></i>
                                        <p>@lang('Social History')</p>
                                    </a>
                                </li>
                            @endcanany

                            @canany(['exam-investigations-read', 'exam-investigations-create', 'exam-investigations-update',
                                'exam-investigations-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('exam-investigations.index') }}"
                                        class="nav-link @if ($c == 'exam-investigations') active @endif">
                                        <i class="nav-icon fas fa-tooth"></i>
                                        <p>@lang('Exam & Diagnosis')</p>
                                    </a>
                                </li>
                            @endcanany

                            @canany(['patient-treatment-plans-read', 'patient-treatment-plans-create',
                                'patient-treatment-plans-update', 'patient-treatment-plans-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('patient-treatment-plans.index') }}"
                                        class="nav-link @if ($c == 'patient-treatment-plans') active @endif">
                                        <i class="nav-icon fas fa-notes-medical"></i>
                                        <p>@lang('Treatment Plans')</p>
                                    </a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany

                @canany(['patient-appointment-read', 'patient-appointment-create', 'patient-appointment-update',
                    'patient-appointment-delete'])
                    <li class="nav-item">
                        <a href="{{ route('patient-appointments.index') }}"
                            class="nav-link @if ($c == 'patient-appointments') active @endif">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>@lang('Patient Appointments')</p>
                        </a>
                    </li>
                @endcanany

                @canany(['prescription-read', 'prescription-create', 'prescription-update', 'prescription-delete'])
                    <li class="nav-item">
                        <a href="{{ route('prescriptions.index') }}"
                            class="nav-link @if ($c == 'prescriptions') active @endif">
                            <i class="nav-icon fas fa-file-prescription"></i>
                            <p>@lang('Prescription')</p>
                        </a>
                    </li>
                @endcanany

                @canany(['task-read', 'task-create', 'task-update', 'task-delete'])
                    <!-- <li class="nav-item has-treeview @if ($c == 'tasks') menu-open @endif">
                                        <a href="javascript:void(0)" class="nav-link @if ($c == 'tasks') active @endif">
                                            <i class="nav-icon fas fa-notes-medical"></i>
                                            <p>
                                                @lang('Tasks')
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="{{ route('tasks.index') }}" class="nav-link @if ($c == 'tasks' && !request()->routeIs('tasks.assigned')) active @endif">
                                                    <i class="nav-icon fas fa-tasks"></i>
                                                    <p>@lang('My Tasks')</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('tasks.assigned') }}" class="nav-link @if (request()->routeIs('tasks.assigned')) active @endif">
                                                    <i class="nav-icon fas fa-paper-plane"></i>
                                                    <p>@lang('Assigned Tasks')</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li> -->
                @endcanany

                @canany(['inventory-read', 'inventory-create', 'inventory-update', 'inventory-delete'])
                    <li class="nav-item">
                        <a href="{{ route('inventories.index') }}"
                            class="nav-link {{ $c == 'inventories' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-box"></i>
                            <p>@lang('Inventory')</p>
                        </a>
                    </li>
                @endcanany

                <!-- @canany(['insurance-providers-read', 'insurance-providers-create', 'insurance-providers-update', 'insurance-providers-delete'])
    <li class="nav-item">
                                                <a href="{{ route('insurance-providers.index') }}"
                                                    class="nav-link {{ $c == 'insurance-providers' ? 'active' : '' }}">
                                                    <i class="nav-icon fas fa-box"></i>
                                                    <p>@lang('Insurance Providers')</p>
                                                </a>
                                            </li>
@endcanany -->


                {{-- @canany(['insurance-providers-delete'])
                    <li class="nav-item">
                        <a href="{{ route('insurance-providers.index') }}"
            class="nav-link @if ($c == 'insurance-providers') active @endif">
            <i class="nav-icon fas fa-file-invoice-dollar"></i>
            <p>@lang('Insurance Providers')</p>
            </a>
            </li>
            @endcanany --}}


                @canany(['dropdown-read', 'dropdown-create', 'dropdown-update', 'dropdown-delete'])
                    <li class="nav-item has-treeview @if (
                        $c == 'dd-blood-groups' ||
                            $c == 'dd-procedures' ||
                            $c == 'dd-medicine' ||
                            $c == 'subcategories' ||
                            $c == 'items' ||
                            $c == 'categories' ||
                            $c == 'dd-social-history' ||
                            $c == 'dd-medical-history' ||
                            $c == 'dd-procedure-categories' ||
                            $c == 'dd-dental-history' ||
                            $c == 'marital-statuses' ||
                            $c == 'dd-drug-history' ||
                            $c == 'appointment-statuses' ||
                            $c == 'dd-investigations' ||
                            $c == 'dd-treatment-plans' ||
                            $c == 'dd-examinations' ||
                            $c == 'dd-diagnoses' ||
                            $c == 'dd-task-action' ||
                            $c == 'dd-task-status' ||
                            $c == 'dd-task-type' ||
                            $c == 'dd-task-priority' ||
                            $c == 'dd-medicine-types' ||
                            $c == 'chief-complaints' ||
                            $c == 'extra-orals' ||
                            $c == 'intra-orals' ||
                            $c == 'soft-tissues' ||
                            $c == 'hard-tissues' ||
                            $c == 'dd-findings') menu-open @endif">
                        <a href="javascript:void(0)" class="nav-link @if (
                            $c == 'chief-complaints' ||
                                $c == 'dd-blood-groups' ||
                                $c == 'dd-procedures' ||
                                $c == 'dd-medicine' ||
                                $c == 'dd-diagnosis' ||
                                $c == 'subcategories' ||
                                $c == 'items' ||
                                $c == 'categories' ||
                                $c == 'dd-social-history' ||
                                $c == 'dd-procedure-categories' ||
                                $c == 'dd-dental-history' ||
                                $c == 'dd-medical-history' ||
                                $c == 'dd-examinations' ||
                                $c == 'appointment-statuses' ||
                                $c == 'dd-investigations' ||
                                $c == 'dd-drug-history' ||
                                $c == 'dd-treatment-plans' ||
                                $c == 'marital-statuses' ||
                                $c == 'dd-diagnoses' ||
                                $c == 'dd-task-priority' ||
                                $c == 'dd-task-action' ||
                                $c == 'dd-task-status' ||
                                $c == 'dd-task-type' ||
                                $c == 'extra-orals' ||
                                $c == 'soft-tissues' ||
                                $c == 'hard-tissues' ||
                                $c == 'dd-medicine-types' ||
                                $c == 'intra-orals' ||
                                $c == 'dd-findings') active @endif">
                            <i class="nav-icon fas fa-list"></i>
                            <p>
                                @lang('Dropdowns Settings')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('soft-tissues.index') }}"
                                    class="nav-link @if ($c == 'soft-tissues') active @endif">
                                    <i class="nav-icon fas fa-venus-double"></i>
                                    <!-- Venus double icon for Soft Tissues -->
                                    <p>@lang('Settings Intra Oral (Soft Tissues)')</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('extra-orals.index') }}"
                                    class="nav-link @if ($c == 'extra-orals') active @endif">
                                    <i class="nav-icon fas fa-user-md"></i> <!-- User doctor icon for Extra Orals -->
                                    <p>@lang('Settings Extra Orals')</p>
                                </a>
                            </li>






                            <li class="nav-item">
                                <a href="{{ route('appointment-statuses.index') }}"
                                    class="nav-link @if ($c == 'appointment-statuses') active @endif">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>@lang('Settings Appointment Status')</p>
                                </a>
                            </li>






                            <li class="nav-item">
                                <a href="{{ route('categories.index') }}"
                                    class="nav-link @if ($c == 'categories') active @endif">
                                    <i class="nav-icon fas fa-tags"></i>
                                    <p>@lang('Settings Inventory Category')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('subcategories.index') }}"
                                    class="nav-link @if ($c == 'subcategories') active @endif">
                                    <i class="nav-icon fas fa-tag"></i>
                                    <p>@lang('Settings Inventory Sub Categories')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('items.index') }}"
                                    class="nav-link @if ($c == 'items') active @endif">
                                    <i class="nav-icon fas fa-boxes"></i>
                                    <p>@lang('Settings Inventory Items')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dd-medical-history.index') }}"
                                    class="nav-link @if ($c == 'dd-medical-history') active @endif">
                                    <i class="nav-icon fas fa-notes-medical"></i>
                                    <p>@lang('Settings Medical History')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dd-social-history.index') }}"
                                    class="nav-link @if ($c == 'dd-social-history') active @endif ">
                                    <i class="nav-icon fas fa-user-friends"></i>
                                    <p>@lang('Settings Social History')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dd-drug-history.index') }}"
                                    class="nav-link @if ($c == 'dd-drug-history') active @endif ">
                                    <i class="nav-icon fas fa-capsules"></i>
                                    <p>@lang('Settings Drug History')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dd-dental-history.index') }}"
                                    class="nav-link @if ($c == 'dd-dental-history') active @endif ">
                                    <i class="nav-icon fas fa-tooth"></i>
                                    <p>@lang('Settings Dental History')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dd-procedure-categories.index') }}"
                                    class="nav-link @if ($c == 'dd-procedure-categories') active @endif ">
                                    <i class="nav-icon fas fa-folder-plus"></i>
                                    <p>@lang('Settings Procedure Category')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dd-procedures.index') }}"
                                    class="nav-link @if ($c == 'dd-procedures') active @endif ">
                                    <i class="nav-icon fas fa-tools"></i>
                                    <p>@lang('Settings Procedures')</p>
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dd-medicine-types.index') }}"
                                    class="nav-link @if ($c == 'dd-medicine-types') active @endif">
                                    <i class="nav-icon fas fa-pills"></i>
                                    <p>@lang('Settings Prescription Medicine Types')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dd-medicine.index') }}"
                                    class="nav-link @if ($c == 'dd-medicine') active @endif ">
                                    <i class="nav-icon fas fa-prescription-bottle-alt"></i>
                                    <p>@lang('Settings Prescription Medicine')</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('dd-diagnoses.index') }}"
                                    class="nav-link @if ($c == 'dd-diagnoses') active @endif ">
                                    <i class="nav-icon fas fa-diagnoses"></i>
                                    <p>@lang('Settings Diagnosis')</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('dd-findings.index') }}"
                                    class="nav-link @if ($c == 'dd-findings') active @endif ">
                                    <i class="nav-icon fas fa-microscope"></i>
                                    <p>@lang('Settings Findings')</p>
                                </a>
                            </li>

                            {{-- <li class="nav-item">
                                <a href="{{ route('insurance-providers.index') }}"
                    class="nav-link @if ($c == 'insurance-providers') active @endif ">
                    <i class="nav-icon fas fa-flag"></i>
                    <p>@lang('Insurance Providers')</p>
                    </a>
            </li> --}}


                        </ul>


                    </li>
                @endcanany

                @canany(['lab-report-read', 'lab-report-create', 'lab-report-update', 'lab-report-delete',
                    'lab-report-template-read', 'lab-report-template-create', 'lab-report-template-update',
                    'lab-report-template-delete'])
                    <li class="nav-item has-treeview @if ($c == 'labs' || $c == 'lab-reports' || $c == 'lab-report-templates') menu-open @endif">
                        <a href="javascript:void(0)" class="nav-link @if ($c == 'labs' || $c == 'lab-reports' || $c == 'lab-report-templates') active @endif">
                            <i class="nav-icon fas fa-vial"></i>
                            <p>
                                @lang('Lab')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @canany(['labs-read', 'labs-create', 'labs-update', 'labs-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('labs.index') }}"
                                        class="nav-link @if ($c == 'labs') active @endif">
                                        <i class="nav-icon fa fa-medkit"></i>
                                        <p>@lang('Labs List')</p>
                                    </a>
                                </li>
                            @endcanany

                            @canany(['lab-report-read', 'lab-report-create', 'lab-report-update', 'lab-report-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('dental_lab_orders.index') }}"
                                        class="nav-link @if ($c == 'lab-reports') active @endif">
                                        <i class="nav-icon fas fa-vial"></i>
                                        <p>@lang('Lab Order')</p>
                                    </a>
                                </li>
                            @endcanany
                            {{-- @canany(['lab-report-template-read', 'lab-report-template-create', 'lab-report-template-update', 'lab-report-template-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('lab-report-templates.index') }}"
                    class="nav-link @if ($c == 'lab-report-templates') active @endif">
                    <i class="nav-icon fas fa-crop-alt"></i>
                    <p>@lang('Lab Report Templates')</p>
                    </a>
            </li>
            @endcanany --}}
                        </ul>
                    </li>
                @endcanany

                @canany(['account-header-read', 'account-header-create', 'account-header-update',
                    'account-header-delete', 'payment-read', 'payment-create', 'payment-update', 'payment-delete',
                    'invoice-read', 'invoice-create', 'invoice-update', 'invoice-delete', 'financial-report-read'])
                    <li class="nav-item has-treeview @if ($c == 'account-headers' || $c == 'invoices' || $c == 'payments' || $c == 'financial-reports' || $c == 'new-reports') menu-open @endif">
                        <a href="javascript:void(0)" class="nav-link @if ($c == 'account-headers' || $c == 'invoices' || $c == 'payments' || $c == 'financial-reports' || $c == 'new-reports') active @endif">
                            <i class="nav-icon fas fa-hand-holding-usd"></i>
                            <p>
                                @lang('Financial Activities')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @canany(['account-header-read', 'account-header-create', 'account-header-update',
                                'account-header-delete'])
                                <!-- <li class="nav-item">
                                                                        <a href="{{ route('account-headers.index') }}"
                                                                            class="nav-link @if ($c == 'account-headers') active @endif ">
                                                                            <i class="fas fa-comment-dollar"></i>
                                                                            <p>@lang('Account Header')</p>
                                                                        </a>
                                                                    </li> -->
                            @endcanany
                            @canany(['invoice-read', 'invoice-create', 'invoice-update', 'invoice-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('invoices.index') }}"
                                        class="nav-link @if ($c == 'invoices') active @endif ">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                        <p>@lang('Invoice')</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('invoice-payments.index') }}"
                                        class="nav-link @if ($c == 'invoice-payments') active @endif ">
                                        <i class="fas fa-money-bill-wave"></i>
                                        <p>@lang('Invoice Payments')</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['payment-read', 'payment-create', 'payment-update', 'payment-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('payments.index') }}"
                                        class="nav-link @if ($c == 'payments') active @endif ">
                                        <i class="fas fa-money-check"></i>
                                        <p>@lang('Expense')</p>
                                    </a>
                                </li>
                            @endcanany
                            {{-- @canany(['financial-report-read'])
                                <li class="nav-item">
                                    <a href="{{ route('financial-reports.index') }}"
                    class="nav-link @if ($c == 'financial-reports') active @endif ">
                    <i class="fas fa-folder-open"></i>
                    <p>@lang('Report')</p>
                    </a>
            </li>
            @endcanany --}}
                            {{-- @canany(['lab-report-read', 'lab-report-create', 'lab-report-update', 'lab-report-delete']) --}}
                            <li class="nav-item">
                                <a href="{{ route('new-reports.index') }}"
                                    class="nav-link @if ($c == 'new-reports') active @endif">
                                    <i class="fas fa-folder-open"></i>
                                    <p>@lang('Report')</p>
                                </a>
                            </li>
                            {{-- @endcanany --}}
                        </ul>
                    </li>
                @endcanany




                @canany(['role-read', 'role-create', 'role-update', 'role-delete', 'user-read', 'user-create',
                    'user-update', 'user-delete', 'smtp-read', 'smtp-create', 'smtp-update', 'smtp-delete', 'company-read',
                    'company-create', 'company-update', 'company-delete', 'currencies-read', 'currencies-create',
                    'currencies-update', 'currencies-delete', 'tax-rate-read', 'tax-rate-create', 'tax-rate-update',
                    'tax-rate-delete'])
                    <li class="nav-item has-treeview @if (
                        $c == 'roles' ||
                            $c == 'users' ||
                            $c == 'apsetting' ||
                            $c == 'smtp-configurations' ||
                            $c == 'general' ||
                            $c == 'currency' ||
                            $c == 'tax') menu-open @endif">
                        <a href="javascript:void(0)" class="nav-link @if (
                            $c == 'roles' ||
                                $c == 'users' ||
                                $c == 'apsetting' ||
                                $c == 'smtp-configurations' ||
                                $c == 'general' ||
                                $c == 'currency' ||
                                $c == 'tax') active @endif">
                            <i class="nav-icon fa fa-cogs"></i>
                            <p>
                                @lang('Settings')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @canany(['role-read', 'role-create', 'role-update', 'role-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}"
                                        class="nav-link @if ($c == 'roles') active @endif ">
                                        <i class="fas fa-cube nav-icon"></i>
                                        <p>@lang('Role Management')</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['user-read', 'user-create', 'user-update', 'user-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}"
                                        class="nav-link @if ($c == 'users') active @endif ">
                                        <i class="fa fa-users nav-icon"></i>
                                        <p>@lang('User Management')</p>
                                    </a>
                                </li>
                            @endcanany
                            @if ($roleName['0'] = 'Super Admin')
                                @canany(['apsetting-read', 'apsetting-create', 'apsetting-update', 'apsetting-delete'])
                                    <li class="nav-item">
                                        <a href="{{ route('apsetting') }}"
                                            class="nav-link @if ($c == 'apsetting' && $m == null) active @endif ">
                                            <i class="fa fa-globe nav-icon"></i>
                                            <p>@lang('Application Settings')</p>
                                        </a>
                                    </li>
                                @endcanany
                            @endif

                            @canany(['company-read', 'company-create', 'company-update', 'company-delete'])
                                {{-- <li class="nav-item">
                        <a href="{{ route('general') }}"
                            class="nav-link @if ($c == 'general') active @endif ">
                            <i class="fas fa-align-left nav-icon"></i>
                            <p>@lang('General Settings')</p>
                        </a>
                    </li> --}}
                            @endcanany
                        </ul>
                    </li>
                @endcanany
            </ul>
        </nav>
    </div>
</aside>
