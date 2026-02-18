<?php
    $c = Request::segment(1);
    $m = Request::segment(2);
    if (function_exists('getCurrentProject') && getCurrentProject()) {
        $c = Request::segment(2);
        $m = Request::segment(3);
    }
    $roleName = Auth::user()->getRoleNames();
?>

<aside class="main-sidebar sidebar-light-primary" style="box-shadow:2px 0px 13px 4px #ccc !important;">
    <a href="<?php echo e(route('dashboard')); ?>" class="brand-link">
        <img src="<?php echo e(asset('public/' . $ApplicationSetting->logo)); ?>" alt="<?php echo e($ApplicationSetting->item_name); ?>"
            id="custom-opacity-sidebar" class="brand-image" style="opacity: .8; max-height: 33px;">
        <span class="brand-text font-weight-light" style="font-size:12px;"><?php echo e($ApplicationSetting->item_name); ?></span>
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
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['dashboard-read'])): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('dashboard')); ?>" class="nav-link <?php if($c == 'dashboard'): ?> active <?php endif; ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p><?php echo e(__('Dashboard')); ?></p>
                        </a>
                    </li>
                <?php endif; ?>


                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['doctor-detail-read', 'doctor-detail-create', 'doctor-detail-update', 'doctor-detail-delete'])): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('doctor-details.index')); ?>"
                            class="nav-link <?php if($c == 'doctor-details'): ?> active <?php endif; ?>">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p><?php echo app('translator')->get('Doctors'); ?></p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['doctor-schedule-read', 'doctor-schedule-create', 'doctor-schedule-update',
                    'doctor-schedule-delete'])): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('doctor-schedules.index')); ?>"
                            class="nav-link <?php if($c == 'doctor-schedules'): ?> active <?php endif; ?>">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p><?php echo app('translator')->get('Doctor Schedules'); ?></p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['patient-detail-read', 'patient-detail-create', 'patient-detail-update',
                    'patient-detail-delete'])): ?>
                    <li class="nav-item has-treeview <?php if(
                        $c == 'patient-case-studies' ||
                            $c == 'patient-details' ||
                            $c == 'exam-investigations' ||
                            $c == 'patient-medical-histories' ||
                            $c == 'patient-dental-histories' ||
                            $c == 'patient-drug-histories' ||
                            $c == 'patient-social-histories' ||
                            $c == 'patient-treatment-plans' ||
                            $c == 'test-files'): ?> menu-open <?php endif; ?>">
                        <a href="javascript:void(0)" class="nav-link <?php if(
                            $c == 'patient-case-studies' ||
                                $c == 'patient-details' ||
                                $c == 'exam-investigations' ||
                                $c == 'patient-medical-histories' ||
                                $c == 'patient-dental-histories' ||
                                $c == 'patient-drug-histories' ||
                                $c == 'patient-social-histories' ||
                                $c == 'patient-treatment-plans' ||
                                $c == 'test-files'): ?> active <?php endif; ?>">
                            <i class="nav-icon fas fa-user-injured"></i>
                            <p>
                                <?php echo app('translator')->get('Patients'); ?>
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['patient-detail-read', 'patient-detail-create', 'patient-detail-update',
                                'patient-detail-delete'])): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('patient-details.index')); ?>"
                                        class="nav-link <?php if($c == 'patient-details'): ?> active <?php endif; ?>">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p><?php echo app('translator')->get('View All Patients'); ?></p>
                                    </a>
                                </li>
                            <?php endif; ?>

                            

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['patient-medical-histories-read', 'patient-medical-histories-create',
                                'patient-medical-histories-update', 'patient-medical-histories-delete'])): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('patient-medical-histories.index')); ?>"
                                        class="nav-link <?php if($c == 'patient-medical-histories'): ?> active <?php endif; ?>">
                                        <i class="nav-icon fas fa-book-medical"></i>
                                        <p><?php echo app('translator')->get('Medical History'); ?></p>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['patient-dental-histories-read', 'patient-dental-histories-create',
                                'patient-dental-histories-update', 'patient-dental-histories-delete'])): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('patient-dental-histories.index')); ?>"
                                        class="nav-link <?php if($c == 'patient-dental-histories'): ?> active <?php endif; ?>">
                                        <i class="nav-icon fas fa-tooth"></i>
                                        <p><?php echo app('translator')->get('Dental History'); ?></p>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['patient-drug-histories-read', 'patient-drug-histories-create',
                                'patient-drug-histories-update', 'patient-drug-histories-delete'])): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('patient-drug-histories.index')); ?>"
                                        class="nav-link <?php if($c == 'patient-drug-histories'): ?> active <?php endif; ?>">
                                        <i class="nav-icon fas fa-pills"></i>
                                        <p><?php echo app('translator')->get('Drug History'); ?></p>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['patient-social-histories-read', 'patient-social-histories-create',
                                'patient-social-histories-update', 'patient-social-histories-delete'])): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('patient-social-histories.index')); ?>"
                                        class="nav-link <?php if($c == 'patient-social-histories'): ?> active <?php endif; ?>">
                                        <i class="nav-icon fas fa-user-friends"></i>
                                        <p><?php echo app('translator')->get('Social History'); ?></p>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['exam-investigations-read', 'exam-investigations-create', 'exam-investigations-update',
                                'exam-investigations-delete'])): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('exam-investigations.index')); ?>"
                                        class="nav-link <?php if($c == 'exam-investigations'): ?> active <?php endif; ?>">
                                        <i class="nav-icon fas fa-tooth"></i>
                                        <p><?php echo app('translator')->get('Exam & Diagnosis'); ?></p>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['patient-treatment-plans-read', 'patient-treatment-plans-create',
                                'patient-treatment-plans-update', 'patient-treatment-plans-delete'])): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('patient-treatment-plans.index')); ?>"
                                        class="nav-link <?php if($c == 'patient-treatment-plans'): ?> active <?php endif; ?>">
                                        <i class="nav-icon fas fa-notes-medical"></i>
                                        <p><?php echo app('translator')->get('Treatment Plans'); ?></p>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['patient-appointment-read', 'patient-appointment-create', 'patient-appointment-update',
                    'patient-appointment-delete'])): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('patient-appointments.index')); ?>"
                            class="nav-link <?php if($c == 'patient-appointments'): ?> active <?php endif; ?>">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p><?php echo app('translator')->get('Patient Appointments'); ?></p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['prescription-read', 'prescription-create', 'prescription-update', 'prescription-delete'])): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('prescriptions.index')); ?>"
                            class="nav-link <?php if($c == 'prescriptions'): ?> active <?php endif; ?>">
                            <i class="nav-icon fas fa-file-prescription"></i>
                            <p><?php echo app('translator')->get('Prescription'); ?></p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['task-read', 'task-create', 'task-update', 'task-delete'])): ?>
                    <!-- <li class="nav-item has-treeview <?php if($c == 'tasks'): ?> menu-open <?php endif; ?>">
                                        <a href="javascript:void(0)" class="nav-link <?php if($c == 'tasks'): ?> active <?php endif; ?>">
                                            <i class="nav-icon fas fa-notes-medical"></i>
                                            <p>
                                                <?php echo app('translator')->get('Tasks'); ?>
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="<?php echo e(route('tasks.index')); ?>" class="nav-link <?php if($c == 'tasks' && !request()->routeIs('tasks.assigned')): ?> active <?php endif; ?>">
                                                    <i class="nav-icon fas fa-tasks"></i>
                                                    <p><?php echo app('translator')->get('My Tasks'); ?></p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="<?php echo e(route('tasks.assigned')); ?>" class="nav-link <?php if(request()->routeIs('tasks.assigned')): ?> active <?php endif; ?>">
                                                    <i class="nav-icon fas fa-paper-plane"></i>
                                                    <p><?php echo app('translator')->get('Assigned Tasks'); ?></p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li> -->
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['inventory-read', 'inventory-create', 'inventory-update', 'inventory-delete'])): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('inventories.index')); ?>"
                            class="nav-link <?php echo e($c == 'inventories' ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-box"></i>
                            <p><?php echo app('translator')->get('Inventory'); ?></p>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['insurance-providers-read', 'insurance-providers-create', 'insurance-providers-update', 'insurance-providers-delete'])): ?>
    <li class="nav-item">
                                                <a href="<?php echo e(route('insurance-providers.index')); ?>"
                                                    class="nav-link <?php echo e($c == 'insurance-providers' ? 'active' : ''); ?>">
                                                    <i class="nav-icon fas fa-box"></i>
                                                    <p><?php echo app('translator')->get('Insurance Providers'); ?></p>
                                                </a>
                                            </li>
<?php endif; ?> -->


                


                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['dropdown-read', 'dropdown-create', 'dropdown-update', 'dropdown-delete'])): ?>
                    <li class="nav-item has-treeview <?php if(
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
                            $c == 'dd-findings'): ?> menu-open <?php endif; ?>">
                        <a href="javascript:void(0)" class="nav-link <?php if(
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
                                $c == 'dd-findings'): ?> active <?php endif; ?>">
                            <i class="nav-icon fas fa-list"></i>
                            <p>
                                <?php echo app('translator')->get('Dropdowns Settings'); ?>
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="<?php echo e(route('soft-tissues.index')); ?>"
                                    class="nav-link <?php if($c == 'soft-tissues'): ?> active <?php endif; ?>">
                                    <i class="nav-icon fas fa-venus-double"></i>
                                    <!-- Venus double icon for Soft Tissues -->
                                    <p><?php echo app('translator')->get('Settings Intra Oral (Soft Tissues)'); ?></p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo e(route('extra-orals.index')); ?>"
                                    class="nav-link <?php if($c == 'extra-orals'): ?> active <?php endif; ?>">
                                    <i class="nav-icon fas fa-user-md"></i> <!-- User doctor icon for Extra Orals -->
                                    <p><?php echo app('translator')->get('Settings Extra Orals'); ?></p>
                                </a>
                            </li>






                            <li class="nav-item">
                                <a href="<?php echo e(route('appointment-statuses.index')); ?>"
                                    class="nav-link <?php if($c == 'appointment-statuses'): ?> active <?php endif; ?>">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p><?php echo app('translator')->get('Settings Appointment Status'); ?></p>
                                </a>
                            </li>






                            <li class="nav-item">
                                <a href="<?php echo e(route('categories.index')); ?>"
                                    class="nav-link <?php if($c == 'categories'): ?> active <?php endif; ?>">
                                    <i class="nav-icon fas fa-tags"></i>
                                    <p><?php echo app('translator')->get('Settings Inventory Category'); ?></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('subcategories.index')); ?>"
                                    class="nav-link <?php if($c == 'subcategories'): ?> active <?php endif; ?>">
                                    <i class="nav-icon fas fa-tag"></i>
                                    <p><?php echo app('translator')->get('Settings Inventory Sub Categories'); ?></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('items.index')); ?>"
                                    class="nav-link <?php if($c == 'items'): ?> active <?php endif; ?>">
                                    <i class="nav-icon fas fa-boxes"></i>
                                    <p><?php echo app('translator')->get('Settings Inventory Items'); ?></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('dd-medical-history.index')); ?>"
                                    class="nav-link <?php if($c == 'dd-medical-history'): ?> active <?php endif; ?>">
                                    <i class="nav-icon fas fa-notes-medical"></i>
                                    <p><?php echo app('translator')->get('Settings Medical History'); ?></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('dd-social-history.index')); ?>"
                                    class="nav-link <?php if($c == 'dd-social-history'): ?> active <?php endif; ?> ">
                                    <i class="nav-icon fas fa-user-friends"></i>
                                    <p><?php echo app('translator')->get('Settings Social History'); ?></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('dd-drug-history.index')); ?>"
                                    class="nav-link <?php if($c == 'dd-drug-history'): ?> active <?php endif; ?> ">
                                    <i class="nav-icon fas fa-capsules"></i>
                                    <p><?php echo app('translator')->get('Settings Drug History'); ?></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('dd-dental-history.index')); ?>"
                                    class="nav-link <?php if($c == 'dd-dental-history'): ?> active <?php endif; ?> ">
                                    <i class="nav-icon fas fa-tooth"></i>
                                    <p><?php echo app('translator')->get('Settings Dental History'); ?></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('dd-procedure-categories.index')); ?>"
                                    class="nav-link <?php if($c == 'dd-procedure-categories'): ?> active <?php endif; ?> ">
                                    <i class="nav-icon fas fa-folder-plus"></i>
                                    <p><?php echo app('translator')->get('Settings Procedure Category'); ?></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('dd-procedures.index')); ?>"
                                    class="nav-link <?php if($c == 'dd-procedures'): ?> active <?php endif; ?> ">
                                    <i class="nav-icon fas fa-tools"></i>
                                    <p><?php echo app('translator')->get('Settings Procedures'); ?></p>
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('dd-medicine-types.index')); ?>"
                                    class="nav-link <?php if($c == 'dd-medicine-types'): ?> active <?php endif; ?>">
                                    <i class="nav-icon fas fa-pills"></i>
                                    <p><?php echo app('translator')->get('Settings Prescription Medicine Types'); ?></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('dd-medicine.index')); ?>"
                                    class="nav-link <?php if($c == 'dd-medicine'): ?> active <?php endif; ?> ">
                                    <i class="nav-icon fas fa-prescription-bottle-alt"></i>
                                    <p><?php echo app('translator')->get('Settings Prescription Medicine'); ?></p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo e(route('dd-diagnoses.index')); ?>"
                                    class="nav-link <?php if($c == 'dd-diagnoses'): ?> active <?php endif; ?> ">
                                    <i class="nav-icon fas fa-diagnoses"></i>
                                    <p><?php echo app('translator')->get('Settings Diagnosis'); ?></p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo e(route('dd-findings.index')); ?>"
                                    class="nav-link <?php if($c == 'dd-findings'): ?> active <?php endif; ?> ">
                                    <i class="nav-icon fas fa-microscope"></i>
                                    <p><?php echo app('translator')->get('Settings Findings'); ?></p>
                                </a>
                            </li>

                            


                        </ul>


                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['lab-report-read', 'lab-report-create', 'lab-report-update', 'lab-report-delete',
                    'lab-report-template-read', 'lab-report-template-create', 'lab-report-template-update',
                    'lab-report-template-delete'])): ?>
                    <li class="nav-item has-treeview <?php if($c == 'labs' || $c == 'lab-reports' || $c == 'lab-report-templates'): ?> menu-open <?php endif; ?>">
                        <a href="javascript:void(0)" class="nav-link <?php if($c == 'labs' || $c == 'lab-reports' || $c == 'lab-report-templates'): ?> active <?php endif; ?>">
                            <i class="nav-icon fas fa-vial"></i>
                            <p>
                                <?php echo app('translator')->get('Lab'); ?>
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['labs-read', 'labs-create', 'labs-update', 'labs-delete'])): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('labs.index')); ?>"
                                        class="nav-link <?php if($c == 'labs'): ?> active <?php endif; ?>">
                                        <i class="nav-icon fa fa-medkit"></i>
                                        <p><?php echo app('translator')->get('Labs List'); ?></p>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['lab-report-read', 'lab-report-create', 'lab-report-update', 'lab-report-delete'])): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('dental_lab_orders.index')); ?>"
                                        class="nav-link <?php if($c == 'lab-reports'): ?> active <?php endif; ?>">
                                        <i class="nav-icon fas fa-vial"></i>
                                        <p><?php echo app('translator')->get('Lab Order'); ?></p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['account-header-read', 'account-header-create', 'account-header-update',
                    'account-header-delete', 'payment-read', 'payment-create', 'payment-update', 'payment-delete',
                    'invoice-read', 'invoice-create', 'invoice-update', 'invoice-delete', 'financial-report-read'])): ?>
                    <li class="nav-item has-treeview <?php if($c == 'account-headers' || $c == 'invoices' || $c == 'payments' || $c == 'financial-reports' || $c == 'new-reports'): ?> menu-open <?php endif; ?>">
                        <a href="javascript:void(0)" class="nav-link <?php if($c == 'account-headers' || $c == 'invoices' || $c == 'payments' || $c == 'financial-reports' || $c == 'new-reports'): ?> active <?php endif; ?>">
                            <i class="nav-icon fas fa-hand-holding-usd"></i>
                            <p>
                                <?php echo app('translator')->get('Financial Activities'); ?>
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['account-header-read', 'account-header-create', 'account-header-update',
                                'account-header-delete'])): ?>
                                <!-- <li class="nav-item">
                                                                        <a href="<?php echo e(route('account-headers.index')); ?>"
                                                                            class="nav-link <?php if($c == 'account-headers'): ?> active <?php endif; ?> ">
                                                                            <i class="fas fa-comment-dollar"></i>
                                                                            <p><?php echo app('translator')->get('Account Header'); ?></p>
                                                                        </a>
                                                                    </li> -->
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['invoice-read', 'invoice-create', 'invoice-update', 'invoice-delete'])): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('invoices.index')); ?>"
                                        class="nav-link <?php if($c == 'invoices'): ?> active <?php endif; ?> ">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                        <p><?php echo app('translator')->get('Invoice'); ?></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('invoice-payments.index')); ?>"
                                        class="nav-link <?php if($c == 'invoice-payments'): ?> active <?php endif; ?> ">
                                        <i class="fas fa-money-bill-wave"></i>
                                        <p><?php echo app('translator')->get('Invoice Payments'); ?></p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['payment-read', 'payment-create', 'payment-update', 'payment-delete'])): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('payments.index')); ?>"
                                        class="nav-link <?php if($c == 'payments'): ?> active <?php endif; ?> ">
                                        <i class="fas fa-money-check"></i>
                                        <p><?php echo app('translator')->get('Expense'); ?></p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            
                            
                            <li class="nav-item">
                                <a href="<?php echo e(route('new-reports.index')); ?>"
                                    class="nav-link <?php if($c == 'new-reports'): ?> active <?php endif; ?>">
                                    <i class="fas fa-folder-open"></i>
                                    <p><?php echo app('translator')->get('Report'); ?></p>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                <?php endif; ?>




                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['role-read', 'role-create', 'role-update', 'role-delete', 'user-read', 'user-create',
                    'user-update', 'user-delete', 'smtp-read', 'smtp-create', 'smtp-update', 'smtp-delete', 'company-read',
                    'company-create', 'company-update', 'company-delete', 'currencies-read', 'currencies-create',
                    'currencies-update', 'currencies-delete', 'tax-rate-read', 'tax-rate-create', 'tax-rate-update',
                    'tax-rate-delete'])): ?>
                    <li class="nav-item has-treeview <?php if(
                        $c == 'roles' ||
                            $c == 'users' ||
                            $c == 'apsetting' ||
                            $c == 'smtp-configurations' ||
                            $c == 'general' ||
                            $c == 'currency' ||
                            $c == 'tax'): ?> menu-open <?php endif; ?>">
                        <a href="javascript:void(0)" class="nav-link <?php if(
                            $c == 'roles' ||
                                $c == 'users' ||
                                $c == 'apsetting' ||
                                $c == 'smtp-configurations' ||
                                $c == 'general' ||
                                $c == 'currency' ||
                                $c == 'tax'): ?> active <?php endif; ?>">
                            <i class="nav-icon fa fa-cogs"></i>
                            <p>
                                <?php echo app('translator')->get('Settings'); ?>
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['role-read', 'role-create', 'role-update', 'role-delete'])): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('roles.index')); ?>"
                                        class="nav-link <?php if($c == 'roles'): ?> active <?php endif; ?> ">
                                        <i class="fas fa-cube nav-icon"></i>
                                        <p><?php echo app('translator')->get('Role Management'); ?></p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['user-read', 'user-create', 'user-update', 'user-delete'])): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('users.index')); ?>"
                                        class="nav-link <?php if($c == 'users'): ?> active <?php endif; ?> ">
                                        <i class="fa fa-users nav-icon"></i>
                                        <p><?php echo app('translator')->get('User Management'); ?></p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if($roleName['0'] = 'Super Admin'): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['apsetting-read', 'apsetting-create', 'apsetting-update', 'apsetting-delete'])): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('apsetting')); ?>"
                                            class="nav-link <?php if($c == 'apsetting' && $m == null): ?> active <?php endif; ?> ">
                                            <i class="fa fa-globe nav-icon"></i>
                                            <p><?php echo app('translator')->get('Application Settings'); ?></p>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['company-read', 'company-create', 'company-update', 'company-delete'])): ?>
                                
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</aside>
<?php /**PATH E:\dental\dental-main - 05-Feb-2026\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>