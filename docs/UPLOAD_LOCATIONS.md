# File Upload Locations

This document lists all file upload locations found in the project and their destination paths.

## Public Uploads (Globally Accessible)
These uploads are stored directly in the `public` directory or its subdirectories.

| Controller | Upload Type | Destination Path | Method Used |
| :--- | :--- | :--- | :--- |
| `StudentController.php` | Student Photo | `public/lara/student` | `move()` |
| `StudentController.php` | General Files | `public/uploads` | `move()` |
| `StudentController.php` | File Download | `public/uploads` | (Read location) |
| `UserController.php` | User Photo | `public/lara/user` | `move()` |
| `PatientCaseStudyController.php` | Case Study File | `public/lara/patient-case-studies` | `move()` |
| `LabReportController.php` | Lab Report Photo | `public/lara/lab-reports` | `move()` |
| `GeneralController.php` | Company Logo | `public/lara/companies` | `move()` |
| `FrontEndController.php` | Service Images | `public/lara/front-ends/service` | `move()` |
| `FrontEndController.php` | About Images | `public/lara/front-ends/about` | `move()` |
| `FrontEndController.php` | Home Images | `public/lara/front-ends/home` | `move()` |
| `FrontEndController.php` | General Front-end | `storage/app/front-end` (via `store`) | `store()` |
| `DoctorDetailController.php` | Doctor Photo | `public/lara/doctor` | `move()` |
| `CompanyController.php` | Company Photo | `public/lara/companies` | `move()` |
| `ApplicationSettingController.php` | Logo/Favicon | `public/assets/images/{segment}` | `move()` |

## Storage Uploads (Tenant/Project Specific)
These uploads utilize Laravel's `Storage` facade or `storeAs` method. With the recent changes to `TenantDatabase.php`, if the default disk is `public`, these will be stored under `storage/app/public/{project-slug}/...`.

| Controller | Upload Type | Destination Path (Relative to Disk Root) | Method Used |
| :--- | :--- | :--- | :--- |
| `ExamInvestigationController.php` | Teeth Files | `uploads/{tableName}/{recordId}/teeth_files/{examId}/{toothNum}` | `storeAs()` |
| `ExamInvestigationController.php` | General Files | `uploads/{tableName}/{recordId}/{inputField}` | `storeAs()` |
| `ExamInvestigationController.php` | Profile Picture | `uploads/{tableName}/{recordId}/profile_picture` | (Delete logic) |
| `HomeController.php` | Teeth Files | `uploads/{tableName}/{recordId}/teeth_files/{examId}/{toothNum}` | `storeAs()` |
| `HomeController.php` | General Files | `uploads/{tableName}/{recordId}/{inputField}` | `storeAs()` |
| `StudentController.php` | Patient Files | `uploads/patient/{patientId}/{inputField}` | `storeAs()` |
| `MobileController.php` | (No direct uploads) | (Logic mostly for API responses) | N/A |

**Note:** The `storage/app` directory is usually linked to `public/storage`. With the tenant configuration, paths like `uploads/...` will be prefixed with the project slug (e.g., `project-1/uploads/...`).
