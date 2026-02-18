<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesTenantConnection;

/**
 * Base Model for all application models
 * Ensures route model binding works correctly with multi-tenant database switching
 * 
 * Models can either extend this BaseModel or use the UsesTenantConnection trait
 */
class BaseModel extends Model
{
    use UsesTenantConnection;
    
    /**
     * Force all models extending BaseModel to use 'mysql' connection
     * This ensures they use the connection switched by TenantDatabase middleware
     */
    protected $connection = 'mysql';
}
