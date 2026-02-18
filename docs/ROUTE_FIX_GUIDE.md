# Global Route Fix for Project Parameter

## Overview
This document explains the global fix implemented to automatically include the `project` parameter in all route() calls throughout the application.

## How It Works

### 1. Middleware Sets URL Defaults
The `TenantDatabase` middleware (`app/Http/Middleware/TenantDatabase.php`) sets URL defaults:
```php
URL::defaults(['project' => $slug]);
```

This should make Laravel's `route()` helper automatically include the project parameter.

### 2. Helper Functions
Two helper functions are available in `app/helper.php`:

#### `getCurrentProject()`
Returns the current project slug from URL defaults or request segment.

#### `route_with_project($name, $parameters = [], $absolute = true)`
Enhanced route helper that automatically includes project parameter. Use this if `route()` isn't working automatically.

### 3. URL Service Provider
`app/Providers/UrlServiceProvider.php` extends Laravel's URL generator to automatically include project parameter in all `route()` calls.

## Usage

### Automatic (Recommended)
If URL defaults are working correctly, you can use Laravel's standard `route()` helper:
```php
route('dashboard')
route('users.show', $user->id)
route('invoices.index')
```

### Manual (If automatic doesn't work)
Use the enhanced helper:
```php
route_with_project('dashboard')
route_with_project('users.show', $user->id)
```

### For Redirects
Use standard redirect with route:
```php
return redirect()->route('dashboard');
return redirect()->route('users.show', $user->id);
```

## Testing

To verify the fix is working:
1. Check that `URL::defaults()` is set in TenantDatabase middleware
2. Test a route() call: `route('dashboard')` should include project parameter
3. Check generated URLs in browser - they should include the project segment

## Troubleshooting

If routes still don't include project parameter:
1. Verify `URL_SEGMENT` environment variable is set correctly
2. Check that TenantDatabase middleware is running
3. Verify URL defaults are being set: `dd(URL::getDefaultParameters())`
4. Use `route_with_project()` helper as fallback
