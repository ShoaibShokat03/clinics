<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer Console - Projects</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Link to the design system -->
    <link rel="stylesheet" href="{{ asset('assets/css/dental-design-system.css') }}">
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
                <form action="{{ route('dev.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm text-danger"
                        style="border: 1px solid var(--danger-color);">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
                <button class="btn btn-primary" onclick="openModal('createModal')">
                    <i class="fas fa-plus mr-2"></i> New Project
                </button>
            </div>
        </div>

        <!-- Alerts -->
        @if (session('success'))
            <div class="alert alert-success d-flex justify-content-between align-items-center">
                <span><i class="fas fa-check-circle mr-2"></i> {{ session('success') }}</span>
                <span class="cursor-pointer" onclick="this.parentElement.remove()">&times;</span>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger d-flex justify-content-between align-items-center">
                <span><i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}</span>
                <span class="cursor-pointer" onclick="this.parentElement.remove()">&times;</span>
            </div>
        @endif

        <!-- Grid -->
        <div class="grid-container">
            @forelse($projects as $key => $project)
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="text-primary font-weight-bold" style="font-size: 1.1rem;">
                            <i class="fas fa-project-diagram mr-2"></i> {{ $key }}
                        </span>
                        <span class="badge badge-info">{{ $project['Prefix'] ?? 'No Prefix' }}</span>
                    </div>
                    <div class="card-body">
                        <div class="project-meta-row">
                            <span class="project-meta-label">Database</span>
                            <span class="project-meta-value">{{ $project['DATABASE_NAME'] ?? 'N/A' }}</span>
                        </div>
                        <div class="project-meta-row">
                            <span class="project-meta-label">Host</span>
                            <span class="project-meta-value">{{ $project['HOST'] ?? 'localhost' }}</span>
                        </div>
                        <div class="project-meta-row">
                            <span class="project-meta-label">App Key</span>
                            <span class="project-meta-value" title="{{ $project['APP_KEY'] ?? '' }}">
                                {{ substr($project['APP_KEY'] ?? '', 0, 8) }}...
                            </span>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end gap-2">
                        <a href="{{ route('dashboard', ['project' => $key]) }}" target="_blank"
                            class="btn btn-success btn-sm">
                            <i class="fas fa-external-link-alt mr-2"></i> Visit
                        </a>
                        <button class="btn btn-info btn-sm" data-key="{{ $key }}"
                            data-prefix="{{ $project['Prefix'] ?? '' }}"
                            data-dbname="{{ $project['DATABASE_NAME'] ?? '' }}"
                            data-host="{{ $project['HOST'] ?? 'localhost' }}"
                            data-username="{{ $project['USERNAME'] ?? 'root' }}" onclick="openEditModal(this)">
                            <i class="fas fa-edit mr-2"></i> Edit
                        </button>
                        <button type="button" class="btn btn-danger btn-sm"
                            onclick="openDeleteModal('{{ $key }}', '{{ route('dev.destroy', $key) }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                    <h3>No projects found</h3>
                    <p>Get started by creating a new project environment.</p>
                    <button class="btn btn-primary mt-2" onclick="openModal('createModal')">Create Project</button>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Create Modal -->
    <div id="createModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary"><i class="fas fa-plus-circle mr-2"></i> Create
                        New Project</h5>
                    <span class="close cursor-pointer" onclick="closeModal('createModal')">&times;</span>
                </div>
                <form action="{{ route('dev.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <h6 class="text-uppercase text-muted font-weight-bold"
                                    style="font-size: 0.75rem; letter-spacing: 0.5px;">Project Details</h6>
                                <hr class="mt-1 mb-3">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Segment Name (URL)</label>
                                <div class="input-group">
                                    <span class="input-group-text">/</span>
                                    <input type="text" name="segment_name" id="create_segment_name"
                                        class="form-control" placeholder="project-3" required pattern="[a-zA-Z0-9-]+">
                                </div>
                                <small class="text-muted">URL Identifier</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prefix</label>
                                <input type="text" name="prefix" class="form-control" placeholder="e.g. ABC"
                                    required maxlength="3" style="text-transform: uppercase;">
                                <small class="text-muted">Max 3 Capital Letters</small>
                            </div>

                            <div class="col-12 mt-2 mb-2">
                                <h6 class="text-uppercase text-muted font-weight-bold"
                                    style="font-size: 0.75rem; letter-spacing: 0.5px;">Database Connection</h6>
                                <hr class="mt-1 mb-3">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Database Name</label>
                                <input type="text" name="database_name" class="form-control"
                                    placeholder="e.g. jdent_project3" required pattern="[a-zA-Z0-9_]+">
                                <small class="text-muted">New MySQL database name</small>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">DB Host</label>
                                <input type="text" name="db_host" class="form-control" value="localhost"
                                    required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">DB Username</label>
                                <input type="text" name="db_username" class="form-control" value="root"
                                    required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">DB Password</label>
                                <input type="password" name="db_password" class="form-control"
                                    placeholder="(Optional)">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary text-secondary"
                            style="background: transparent; border: 1px solid var(--border-medium);"
                            onclick="closeModal('createModal')">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4"><i class="fas fa-check mr-2"></i> Create
                            Project</button>
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
                    <h5 class="modal-title font-weight-bold text-primary"><i class="fas fa-edit mr-2"></i> Edit
                        Project</h5>
                    <span class="close cursor-pointer" onclick="closeModal('editModal')">&times;</span>
                </div>
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Segment Name</label>
                                <input type="text" id="edit_segment_name" class="form-control bg-light" disabled>
                                <small class="text-muted">Cannot be changed</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prefix</label>
                                <input type="text" name="prefix" id="edit_prefix" class="form-control" required
                                    maxlength="3" style="text-transform: uppercase;">
                                <small class="text-muted">Max 3 Capital Letters</small>
                            </div>
                        </div>

                        <div class="col-12 mt-2 mb-2">
                            <h6 class="text-uppercase text-muted font-weight-bold"
                                style="font-size: 0.75rem; letter-spacing: 0.5px;">Database Connection</h6>
                            <hr class="mt-1 mb-3">
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Database Name</label>
                            <input type="text" name="database_name" id="edit_database_name" class="form-control"
                                required pattern="[a-zA-Z0-9_]+">
                            <small class="text-muted">A new MySQL database will be created with this name.</small>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">DB Host</label>
                            <input type="text" name="db_host" id="edit_db_host" class="form-control" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">DB Username</label>
                            <input type="text" name="db_username" id="edit_db_username" class="form-control"
                                required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">DB Password</label>
                            <input type="password" name="db_password" id="edit_db_password" class="form-control"
                                placeholder="(Leave unchanged to keep current)">
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary text-secondary"
                            style="background: transparent; border: 1px solid var(--border-medium);"
                            onclick="closeModal('editModal')">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save mr-2"></i> Save
                            Changes</button>
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
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Are you sure you want to delete this project? This action cannot be undone.</p>

                        <div class="alert alert-danger">
                            <div class="checkbox-container">
                                <input type="checkbox" name="drop_database" id="drop_db_confirm" value="1">
                                <label for="drop_db_confirm" class="mb-0 cursor-pointer"><strong>Also permanently
                                        delete the Database?</strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-secondary"
                            style="background: transparent; border: 1px solid var(--border-medium);"
                            onclick="closeModal('deleteModal')">Cancel</button>
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
            form.action = "{{ route('dev.update', ':key') }}".replace(':key', key);

            const editPrefixInput = document.getElementById('edit_prefix');
            editPrefixInput.value = prefix;
            editPrefixInput.dataset.originalValue = prefix;
            document.getElementById('edit_segment_name').value = key;
            document.getElementById('edit_database_name').value = dbname;
            document.getElementById('edit_db_host').value = host;
            document.getElementById('edit_db_username').value = username;
            document.getElementById('edit_db_password').value = ''; // Don't show password, only update if entered

            openModal('editModal');
            // Trigger check on open to ensure no error state
            checkPrefixUnique(document.getElementById('edit_prefix'), true);
        }

        // --- Prefix Uniqueness Check ---
        // Pass PHP array to JS
        const usedPrefixes = @json(collect($projects)->pluck('Prefix')->filter()->map(function ($p) {
                    return (string) $p;
                })->values()->all());

        // Also pass already used segment names (keys of the projects array)
        const usedSegments = @json(array_keys($projects));

        function checkPrefixUnique(inputElement, isEditMode = false) {
            const errorId = inputElement.id + '_error';
            let errorSpan = document.getElementById(errorId);

            // Create error span if not exists
            if (!errorSpan) {
                errorSpan = document.createElement('small');
                errorSpan.id = errorId;
                errorSpan.className = 'text-danger d-block mt-1';
                errorSpan.style.display = 'none';
                inputElement.parentNode.appendChild(errorSpan);
            }

            // Enforce Uppercase and Clean Input (A-Z only, max 3 chars)
            let val = inputElement.value.toUpperCase().replace(/[^A-Z]/g, '');
            if (val.length > 3) val = val.substring(0, 3);

            // Update input value if it changed (handling paste or lowercase typing)
            if (inputElement.value !== val) {
                inputElement.value = val;
            }

            // Validate requirements
            // If edit mode, current prefix is allowed (stored in data attribute)
            let exists = usedPrefixes.includes(val);

            if (isEditMode) {
                const original = inputElement.dataset.originalValue || '';
                if (val === original) {
                    exists = false;
                }
            }

            let errorMessage = '';
            if (exists && val !== '') {
                errorMessage = 'This prefix is already taken.';
            } else if (val.length === 0) {
                // handled by required attribute, but we clear error
            }

            if (errorMessage) {
                inputElement.classList.add('is-invalid');
                errorSpan.textContent = errorMessage;
                errorSpan.style.display = 'block';
                const form = inputElement.closest('form');
                if (form) {
                    const btn = form.querySelector('button[type="submit"]');
                    if (btn) btn.disabled = true;
                }
            } else {
                inputElement.classList.remove('is-invalid');
                errorSpan.style.display = 'none';
                // Re-enable submit button
                const form = inputElement.closest('form');
                if (form) {
                    const btn = form.querySelector('button[type="submit"]');
                    if (btn) btn.disabled = false;
                }
            }
        }

        // --- Segment Name Uniqueness Check (Create Only) ---
        function checkSegmentUnique(inputElement) {
            const errorId = inputElement.id + '_error';
            let errorSpan = document.getElementById(errorId);

            if (!errorSpan) {
                errorSpan = document.createElement('small');
                errorSpan.id = errorId;
                errorSpan.className = 'text-danger d-block mt-1';
                errorSpan.style.display = 'none';

                // Fix: If input is inside an input-group, append the error OUTSIDE/AFTER the group to avoid flexbox layout issues
                const inputGroup = inputElement.closest('.input-group');
                if (inputGroup) {
                    // Check if there's a next sibling (like the help text) and insert before it, or just append to parent
                    if (inputGroup.nextSibling) {
                        inputGroup.parentNode.insertBefore(errorSpan, inputGroup.nextSibling);
                    } else {
                        inputGroup.parentNode.appendChild(errorSpan);
                    }
                } else {
                    inputElement.parentNode.appendChild(errorSpan);
                }
            }

            const val = inputElement.value.trim();
            // Basic pattern check handled by HTML pattern, but checking uniqueness here:
            let exists = usedSegments.includes(val);

            let errorMessage = '';
            if (exists && val !== '') {
                errorMessage = 'This segment name (URL) is already taken.';
            }

            if (errorMessage) {
                inputElement.classList.add('is-invalid');
                errorSpan.textContent = errorMessage;
                errorSpan.style.display = 'block';
                const form = inputElement.closest('form');
                if (form) {
                    const btn = form.querySelector('button[type="submit"]');
                    if (btn) btn.disabled = true;
                }
            } else {
                inputElement.classList.remove('is-invalid');
                errorSpan.style.display = 'none';
                // Check if other inputs are valid? Ideally we shouldn't re-enable if other errors exist.
                // But for simplicity/MVP, valid segment = enable button (unless prefix error re-disables it).
                // A better way is to check validity of the whole form or rely on the other input's event to re-check.
                // Assuming user fixes errors one by one.
                const form = inputElement.closest('form');
                if (form) {
                    // Check if prefix input is invalid?
                    const prefixInput = form.querySelector('input[name="prefix"]');
                    if (prefixInput && prefixInput.classList.contains('is-invalid')) {
                        // Keep disabled if prefix is invalid
                    } else {
                        const btn = form.querySelector('button[type="submit"]');
                        if (btn) btn.disabled = false;
                    }
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const createPrefixInput = document.querySelector(
                'input[name="prefix"]'); // There are two inputs with name="prefix". Be specific.
            const createForm = document.querySelector('#createModal form');
            const editForm = document.querySelector('#editModal form');

            // Specific selectors
            const createInput = createForm.querySelector('input[name="prefix"]');
            const editInput = editForm.querySelector('input[name="prefix"]');

            if (createInput) {
                createInput.addEventListener('input', function() {
                    checkPrefixUnique(this, false);
                });
            }

            if (editInput) {
                editInput.addEventListener('input', function() {
                    checkPrefixUnique(this, true);
                });
            }

            // Segment Name listener (Create form only)
            const createSegmentInput = createForm.querySelector('input[name="segment_name"]');
            if (createSegmentInput) {
                createSegmentInput.addEventListener('input', function() {
                    checkSegmentUnique(this);
                });
            }
        });

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

</html>
