# File Upload Project Folder Organization

## Overview
All file uploads are now organized in a unified location: `public/uploads/{project}/` with project-specific subfolders. This keeps all uploads in one place while maintaining separation between projects.

## ✅ Unified Upload Structure

All uploads are stored in: `public/uploads/{project}/{subfolder}/`

### Folder Structure:
```
public/
  uploads/
    {project-1}/
      assets/          # Application settings (logo, favicon)
      student/         # Student photos
      user/            # User photos
      doctor/          # Doctor photos
      companies/       # Company logos
      lab-reports/     # Lab report photos
      patient-case-studies/  # Case study files
      profile/         # Profile photos
      front-ends/      # Front-end images
        service/
        about/
        home/
      files/           # General file uploads
    {project-2}/
      ... (same structure)
```

## Helper Functions

Two helper functions are available in `app/helper.php`:

### `getUploadPath($subfolder = '')`
Returns the relative path for uploads (e.g., `uploads/project-1/student`)

```php
$path = getUploadPath('student'); 
// Returns: "uploads/project-1/student" (if project exists)
// Returns: "uploads/student" (if no project)
```

### `getUploadPublicPath($subfolder = '')`
Returns the full absolute path and creates directory if it doesn't exist

```php
$path = getUploadPublicPath('student'); 
// Returns: "/path/to/public/uploads/project-1/student"
// Creates directory if it doesn't exist
```

## Updated Controllers

All controllers now use the unified upload path:

| Controller | Upload Type | Path | Status |
|------------|-------------|------|--------|
| `ApplicationSettingController` | Logo/Favicon | `uploads/{project}/assets/` | ✅ Updated |
| `StudentController` | Student Photo | `uploads/{project}/student/` | ✅ Updated |
| `StudentController` | General Files | `uploads/{project}/files/` | ✅ Updated |
| `UserController` | User Photo | `uploads/{project}/user/` | ✅ Updated |
| `CompanyController` | Company Logo | `uploads/{project}/companies/` | ✅ Updated |
| `DoctorDetailController` | Doctor Photo | `uploads/{project}/doctor/` | ✅ Updated |
| `FrontEndController` | Service/About/Home Images | `uploads/{project}/front-ends/...` | ✅ Updated |
| `LabReportController` | Lab Report Photo | `uploads/{project}/lab-reports/` | ✅ Updated |
| `PatientCaseStudyController` | Case Study File | `uploads/{project}/patient-case-studies/` | ✅ Updated |
| `ProfileController` | Profile Photo | `uploads/{project}/profile/` | ✅ Updated |
| `GeneralController` | Company Logo | `uploads/{project}/companies/` | ✅ Updated |

## Storage Facade Uploads (Automatic)

Controllers using `Storage::` or `storeAs()` automatically use project folders via `TenantDatabase` middleware:

| Controller | Upload Type | Storage Path |
|------------|-------------|--------------|
| `ExamInvestigationController` | Teeth Files, General Files | `storage/app/public/{project}/uploads/...` |
| `HomeController` | Teeth Files, General Files | `storage/app/public/{project}/uploads/...` |
| `StudentController` | Patient Files (via storeAs) | `storage/app/public/{project}/uploads/patient/...` |

**How it works:** The `TenantDatabase` middleware sets:
```php
Config::set('filesystems.disks.public.root', storage_path('app/public/' . $slug));
```
So all `Storage::` and `storeAs()` calls automatically use the project folder.

## Usage Example

### Before:
```php
$photo->move('lara/student', $imageName);
$data['photo'] = 'lara/student/' . $imageName;
```

### After:
```php
$uploadPath = getUploadPublicPath('student');
$photo->move($uploadPath, $imageName);
$data['photo'] = getUploadPath('student') . '/' . $imageName;
```

## Accessing Uploaded Files in Views

Files stored using the helper functions can be accessed using Laravel's `asset()` helper:

```blade
<img src="{{ asset($student->photo) }}" alt="Student Photo">
<!-- If $student->photo = "uploads/project-1/student/photo.jpg" -->
<!-- Renders as: /uploads/project-1/student/photo.jpg -->
```

## Benefits

1. **Unified Location:** All uploads in one place (`public/uploads/`)
2. **Project Separation:** Each project has its own folder
3. **Easy Management:** Simple to backup, migrate, or delete project data
4. **Consistent Pattern:** All controllers use the same helper functions
5. **Automatic Directory Creation:** Helper functions create directories as needed
