<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer Console - Projects</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Link to the design system -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/dental-design-system.css')); ?>">
    <!-- Add FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background-color: var(--bg-gray);
            font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: var(--text-primary);
        }

        .page-wrapper {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .header-section {
            background: var(--bg-white);
            padding: var(--spacing-lg);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            margin-bottom: var(--spacing-xl);
        }

        .page-title {
            margin: 0;
            font-size: 1.75rem;
            color: var(--text-dark);
            font-weight: var(--font-bold);
        }

        .page-subtitle {
            margin: 0;
            color: var(--text-muted);
            font-size: var(--font-md);
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: var(--spacing-lg);
        }

        /* Modal Overrides/Helpers since we aren't using Bootstrap JS for logic, just CSS */
        .modal {
            display: none;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(2px);
        }

        .modal.active {
            display: block;
            /* Bootstrap default is block, but we toggle active manually */
            opacity: 1;
        }

        .modal-dialog {
            /* Bootstrap handles this, but we keep top margin adjustment if needed */
        }

        /* Ensure modal content is scrollable if needed */
        .modal-body {
            max-height: 70vh;
            overflow-y: auto;
        }

        .empty-state {
            grid-column: 1 / -1;
            background: var(--bg-white);
            padding: var(--spacing-xxl);
            border-radius: var(--radius-lg);
            border: 1px dashed var(--border-dark);
            text-align: center;
            color: var(--text-muted);
        }

        .project-meta-row {
            display: flex;
            justify-content: space-between;
            padding: var(--spacing-xs) 0;
            border-bottom: 1px dashed var(--border-light);
            font-size: var(--font-sm);
        }

        .project-meta-row:last-child {
            border-bottom: none;
        }

        .project-meta-label {
            color: var(--text-secondary);
            font-weight: var(--font-medium);
        }

        .project-meta-value {
            color: var(--text-dark);
            font-weight: var(--font-semibold);
            font-family: monospace;
        }

        /* Custom Checkbox wrapper for the delete modal */
        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        /* Button Overrides to keep Dental Design System look on top of Bootstrap */
        .btn-success,
        .btn-info,
        .btn-danger {
            color: #fff !important;
        }

        /* Card Tweaks */
        .card {
            transition: all 0.2s;
            border: 1px solid #e2e8f0;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>

    <div class="page-wrapper">
        <!-- Header -->
        <div class="header-section d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title"><i class="fas fa-code text-primary mr-2"></i> Developer Console</h1>
                <p class="page-subtitle">Manage multi-tenant projects and databases</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <form action="<?php echo e(route('dev.logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-outline-danger btn-sm text-danger" style="border: 1px solid var(--danger-color);">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
                <button class="btn btn-primary" onclick="openModal('createModal')">
                    <i class="fas fa-plus mr-2"></i> New Project
                </button>
            </div>
        </div>

        <!-- Alerts -->
        <?php if(session('success')): ?>
        <div class="alert alert-success d-flex justify-content-between align-items-center">
            <span><i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?></span>
            <span class="cursor-pointer" onclick="this.parentElement.remove()">&times;</span>
        </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
        <div class="alert alert-danger d-flex justify-content-between align-items-center">
            <span><i class="fas fa-exclamation-circle mr-2"></i> <?php echo e(session('error')); ?></span>
            <span class="cursor-pointer" onclick="this.parentElement.remove()">&times;</span>
        </div>
        <?php endif; ?>

        <!-- Grid -->
        <div class="grid-container">
            <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="text-primary font-weight-bold" style="font-size: 1.1rem;">
                        <i class="fas fa-project-diagram mr-2"></i> <?php echo e($key); ?>

                    </span>
                    <span class="badge badge-info"><?php echo e($project['Prefix'] ?? 'No Prefix'); ?></span>
                </div>
                <div class="card-body">
                    <div class="project-meta-row">
                        <span class="project-meta-label">Database</span>
                        <span class="project-meta-value"><?php echo e($project['DATABASE_NAME'] ?? 'N/A'); ?></span>
                    </div>
                    <div class="project-meta-row">
                        <span class="project-meta-label">Host</span>
                        <span class="project-meta-value"><?php echo e($project['HOST'] ?? 'localhost'); ?></span>
                    </div>
                    <div class="project-meta-row">
                        <span class="project-meta-label">App Key</span>
                        <span class="project-meta-value" title="<?php echo e($project['APP_KEY'] ?? ''); ?>">
                            <?php echo e(substr($project['APP_KEY'] ?? '', 0, 8)); ?>...
                        </span>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end gap-2">
                    <a href="<?php echo e(route('dashboard', ['project' => $key])); ?>" target="_blank" class="btn btn-success btn-sm">
                        <i class="fas fa-external-link-alt mr-2"></i> Visit
                    </a>
                    <button class="btn btn-info btn-sm"
                        data-key="<?php echo e($key); ?>"
                        data-prefix="<?php echo e($project['Prefix'] ?? ''); ?>"
                        data-dbname="<?php echo e($project['DATABASE_NAME'] ?? ''); ?>"
                        data-host="<?php echo e($project['HOST'] ?? 'localhost'); ?>"
                        data-username="<?php echo e($project['USERNAME'] ?? 'root'); ?>"
                        onclick="openEditModal(this)">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="openDeleteModal('<?php echo e($key); ?>', '<?php echo e(route('dev.destroy', $key)); ?>')">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty-state">
                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                <h3>No projects found</h3>
                <p>Get started by creating a new project environment.</p>
                <button class="btn btn-primary mt-2" onclick="openModal('createModal')">Create Project</button>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Create Modal -->
    <div id="createModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary"><i class="fas fa-plus-circle mr-2"></i> Create New Project</h5>
                    <span class="close cursor-pointer" onclick="closeModal('createModal')">&times;</span>
                </div>
                <form action="<?php echo e(route('dev.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <h6 class="text-uppercase text-muted font-weight-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Project Details</h6>
                                <hr class="mt-1 mb-3">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Segment Name (URL)</label>
                                <div class="input-group">
                                    <span class="input-group-text">/</span>
                                    <input type="text" name="segment_name" class="form-control" placeholder="project-3" required pattern="[a-zA-Z0-9-]+">
                                </div>
                                <small class="text-muted">URL Identifier</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prefix</label>
                                <input type="text" name="prefix" class="form-control" placeholder="e.g. P-3" required>
                                <small class="text-muted">Invoice/Ref Prefix</small>
                            </div>

                            <div class="col-12 mt-2 mb-2">
                                <h6 class="text-uppercase text-muted font-weight-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Database Connection</h6>
                                <hr class="mt-1 mb-3">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Database Name</label>
                                <input type="text" name="database_name" class="form-control" placeholder="e.g. jdent_project3" required pattern="[a-zA-Z0-9_]+">
                                <small class="text-muted">New MySQL database name</small>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">DB Host</label>
                                <input type="text" name="db_host" class="form-control" value="localhost" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">DB Username</label>
                                <input type="text" name="db_username" class="form-control" value="root" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">DB Password</label>
                                <input type="password" name="db_password" class="form-control" placeholder="(Optional)">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary text-secondary" style="background: transparent; border: 1px solid var(--border-medium);" onclick="closeModal('createModal')">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4"><i class="fas fa-check mr-2"></i> Create Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary"><i class="fas fa-edit mr-2"></i> Edit Project</h5>
                    <span class="close cursor-pointer" onclick="closeModal('editModal')">&times;</span>
                </div>
                <form id="editForm" action="" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Segment Name</label>
                                <input type="text" id="edit_segment_name" class="form-control bg-light" disabled>
                                <small class="text-muted">Cannot be changed</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prefix</label>
                                <input type="text" name="prefix" id="edit_prefix" class="form-control" required>
                                <small class="text-muted">Invoice/Ref Prefix</small>
                            </div>
                        </div>

                        <div class="col-12 mt-2 mb-2">
                            <h6 class="text-uppercase text-muted font-weight-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Database Connection</h6>
                            <hr class="mt-1 mb-3">
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Database Name</label>
                            <input type="text" name="database_name" id="edit_database_name" class="form-control" required pattern="[a-zA-Z0-9_]+">
                            <small class="text-muted">A new MySQL database will be created with this name.</small>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">DB Host</label>
                            <input type="text" name="db_host" id="edit_db_host" class="form-control" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">DB Username</label>
                            <input type="text" name="db_username" id="edit_db_username" class="form-control" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">DB Password</label>
                            <input type="password" name="db_password" id="edit_db_password" class="form-control" placeholder="(Leave unchanged to keep current)">
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary text-secondary" style="background: transparent; border: 1px solid var(--border-medium);" onclick="closeModal('editModal')">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save mr-2"></i> Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Delete Project</h5>
                    <span class="close cursor-pointer" onclick="closeModal('deleteModal')">&times;</span>
                </div>
                <form id="deleteForm" action="" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this project? This action cannot be undone.</p>

                        <div class="alert alert-danger">
                            <div class="checkbox-container">
                                <input type="checkbox" name="drop_database" id="drop_db_confirm" value="1">
                                <label for="drop_db_confirm" class="mb-0 cursor-pointer"><strong>Also permanently delete the Database?</strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-secondary" style="background: transparent; border: 1px solid var(--border-medium);" onclick="closeModal('deleteModal')">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.add('active');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        function openEditModal(button) {
            const key = button.dataset.key;
            const prefix = button.dataset.prefix;
            const dbname = button.dataset.dbname;
            const host = button.dataset.host;
            const username = button.dataset.username;

            const form = document.getElementById('editForm');
            form.action = "<?php echo e(route('dev.update', ':key')); ?>".replace(':key', key);

            document.getElementById('edit_prefix').value = prefix;
            document.getElementById('edit_segment_name').value = key;
            document.getElementById('edit_database_name').value = dbname;
            document.getElementById('edit_db_host').value = host;
            document.getElementById('edit_db_username').value = username;
            document.getElementById('edit_db_password').value = ''; // Don't show password, only update if entered

            openModal('editModal');
        }

        function openDeleteModal(key, actionUrl) {
            const form = document.getElementById('deleteForm');
            form.action = actionUrl;
            // Reset checkbox
            document.getElementById('drop_db_confirm').checked = false;
            openModal('deleteModal');
        }

        // Close modal on click outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        }
    </script>
</body>

</html><?php /**PATH E:\dental\dental-main\resources\views/dev/index.blade.php ENDPATH**/ ?>