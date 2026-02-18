# How Route Model Binding Works in LabController::edit()

## Overview
When you access `/project-1/labs/9/edit`, Laravel automatically finds the `Lab` model with ID `9` and passes it to the `edit()` method. This is called **Route Model Binding**.

## Complete Flow

### Step 1: Request Arrives
```
URL: http://localhost:8000/project-1/labs/9/edit
Route Pattern: {project}/labs/{lab}/edit
Route Parameters: 
  - project = "project-1"
  - lab = "9"
```

### Step 2: TenantDatabase Middleware Runs (BEFORE Route Binding)
```php
// app/Http/Middleware/TenantDatabase.php
1. Extracts "project-1" from URL segment
2. Looks up project configuration
3. Switches database connection:
   - Config::set('database.connections.mysql.database', $databaseName)
   - DB::purge('mysql')
   - DB::reconnect('mysql')
   - Model::setConnectionResolver(DB::getFacadeRoot())
   - Model::clearBootedModels()
```

**Result**: The 'mysql' connection now points to the tenant's database (e.g., `project_1_db`)

### Step 3: Route Model Binding (SubstituteBindings Middleware)
Laravel sees the route parameter `{lab}` and the type-hinted parameter `Lab $lab` in the controller:

```php
// app/Http/Controllers/LabController.php
public function edit(Lab $lab)  // <-- Laravel sees "Lab" type hint
```

Laravel's route binding process:

1. **Detects Model Type Hint**
   - Route parameter: `{lab}` with value `"9"`
   - Controller parameter: `Lab $lab` (type-hinted as `Lab` model)
   - Laravel knows it needs to resolve a `Lab` model

2. **Creates Model Instance**
   ```php
   // Laravel internally does:
   $instance = $container->make(Lab::class);
   // This creates an empty Lab instance
   ```

3. **Calls resolveRouteBinding()**
   ```php
   // Laravel internally does:
   $model = $instance->resolveRouteBinding("9", null);
   ```

### Step 4: Our Custom resolveRouteBinding() Method
```php
// app/Traits/UsesTenantConnection.php
public function resolveRouteBinding($value, $field = null)
{
    // $value = "9" (the route parameter value)
    // $field = null (defaults to primary key 'id')
    
    $field = $field ?? $this->getRouteKeyName(); // Gets 'id'
    
    // CRITICAL: Use static::on('mysql') to force use of switched connection
    $model = static::on('mysql')
        ->where('id', '9')  // Query: WHERE id = 9
        ->first();
    
    if (!$model) {
        return null; // Triggers 404
    }
    
    return $model; // Returns Lab instance with ID 9
}
```

**What happens:**
- `static::on('mysql')` creates a query builder using the **switched** database connection
- The connection was switched by `TenantDatabase` middleware to the tenant's database
- Queries the `labs` table in the **correct tenant database**
- Returns the `Lab` model instance if found, or `null` if not found

### Step 5: Laravel Injects Model into Controller
```php
// Laravel automatically does:
$lab = $resolvedModel; // The Lab instance from resolveRouteBinding()

// Then calls:
$controller->edit($lab);
```

### Step 6: Controller Method Executes
```php
public function edit(Lab $lab)
{
    // $lab is now a fully loaded Lab model instance
    // with all attributes populated from the database
    
    $users = User::whereHas('roles', function ($query) {
        $query->whereIn('name', ['Laboratorist']);
    })->get();

    return view('lab.edit', compact('lab', 'users'));
}
```

## Why This Approach?

### Problem Without Custom resolveRouteBinding()
By default, Laravel's route model binding would do:
```php
// Default Laravel behavior:
Lab::find(9);  // Uses default connection (might be wrong database!)
```

This could query the **wrong database** because:
- The model might use a cached connection
- The connection might not be switched yet
- Multiple tenants might share the same default connection name

### Solution With Custom resolveRouteBinding()
```php
// Our custom behavior:
static::on('mysql')->where('id', 9)->first();  // Explicitly uses switched connection
```

This ensures:
- ✅ Always uses the 'mysql' connection (switched by middleware)
- ✅ Queries the correct tenant database
- ✅ Works for all models extending `BaseModel`

## Key Components

### 1. BaseModel
```php
class BaseModel extends Model
{
    use UsesTenantConnection;
    protected $connection = 'mysql';  // Force use of 'mysql' connection
}
```

### 2. UsesTenantConnection Trait
```php
trait UsesTenantConnection
{
    public function resolveRouteBinding($value, $field = null)
    {
        // Custom logic to use switched connection
        return static::on('mysql')->where($field, $value)->first();
    }
}
```

### 3. Lab Model
```php
class Lab extends BaseModel  // Inherits resolveRouteBinding() from trait
{
    // No special code needed!
}
```

## Visual Flow Diagram

```
Request: /project-1/labs/9/edit
    │
    ├─> TenantDatabase Middleware
    │   └─> Switches 'mysql' connection to tenant database
    │
    ├─> Route Matching
    │   └─> Matches: {project}/labs/{lab}/edit
    │       Parameters: {lab: "9"}
    │
    ├─> SubstituteBindings Middleware
    │   ├─> Detects: Lab $lab (type hint)
    │   ├─> Creates: new Lab() instance
    │   └─> Calls: $instance->resolveRouteBinding("9")
    │
    ├─> UsesTenantConnection::resolveRouteBinding()
    │   ├─> static::on('mysql')  // Uses switched connection
    │   ├─> ->where('id', '9')
    │   └─> ->first()  // Queries tenant database
    │
    └─> LabController::edit($lab)
        └─> $lab is now a loaded Lab model instance
```

## Summary

**The approach used is:**
1. **Implicit Route Model Binding** - Laravel automatically resolves models from route parameters
2. **Custom resolveRouteBinding()** - Override Laravel's default model resolution
3. **Explicit Connection Usage** - Force use of `on('mysql')` to ensure correct database
4. **Trait-Based Solution** - Reusable across all models via `UsesTenantConnection` trait

This ensures that route model binding **always** queries the correct tenant database, regardless of connection caching or timing issues.
