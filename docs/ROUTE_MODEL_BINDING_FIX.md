# Route Model Binding Fix for Multi-Tenant Database

## Problem
When accessing edit pages for newly created records (e.g., `/project-1/labs/9/edit`), Laravel returns "404 Not Found" even though the record exists. Existing records work fine.

## Root Cause
Route model binding (`Lab $lab`) is trying to resolve the model **before** or **without** using the switched database connection. The `TenantDatabase` middleware switches the database, but route model binding might be:
1. Using a cached/stale database connection
2. Resolving before the connection is fully established
3. Not explicitly using the 'mysql' connection that was switched

## Solution Implemented

### 1. Enhanced TenantDatabase Middleware
- Added `Model::clearBootedModels()` to clear cached model connections
- Added `Model::setConnectionResolver()` to force models to use the switched connection
- Added connection test query to ensure database is fully established

### 2. BaseModel Class
- Created `app/Models/BaseModel.php` that extends Laravel's Model
- Includes `UsesTenantConnection` trait
- Overrides `resolveRouteBinding()` to explicitly use 'mysql' connection

### 3. UsesTenantConnection Trait
- Created `app/Traits/UsesTenantConnection.php`
- Can be used by any model that needs tenant-aware route binding
- Forces use of 'mysql' connection for route model binding

### 4. Lab Model Updated
- Changed `Lab` to extend `BaseModel` instead of `Model`
- Now automatically uses correct database for route model binding

## How It Works

1. **Request comes in**: `/project-1/labs/9/edit`
2. **TenantDatabase middleware runs**:
   - Extracts project slug from URL
   - Switches database connection to tenant's database
   - Clears model cache
   - Sets connection resolver
3. **Route model binding happens**:
   - Laravel tries to resolve `Lab $lab` with ID 9
   - `BaseModel::resolveRouteBinding()` is called
   - Explicitly uses `on('mysql')` to query the switched database
   - Returns the model or null (404)

## Files Modified

1. `app/Http/Middleware/TenantDatabase.php` - Enhanced database switching
2. `app/Models/BaseModel.php` - New base model class
3. `app/Models/Lab.php` - Updated to extend BaseModel
4. `app/Traits/UsesTenantConnection.php` - Reusable trait

## For Other Models

To fix route model binding for other models, either:

**Option 1: Extend BaseModel**
```php
class YourModel extends BaseModel
{
    // Your model code
}
```

**Option 2: Use the Trait**
```php
use App\Traits\UsesTenantConnection;

class YourModel extends Model
{
    use UsesTenantConnection;
    // Your model code
}
```

## Testing

1. Create a new lab record
2. Try to access `/project-1/labs/{new_id}/edit`
3. Should now work correctly instead of showing 404

## Why Existing Records Worked

Existing records (like ID 8) might have been:
- Created before the multi-tenant setup
- In a database that was already connected
- Or the connection was cached correctly

New records (like ID 9) are created in the switched database, but route model binding wasn't using the switched connection, causing the 404.
