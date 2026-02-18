<?php

namespace App\Traits;

/**
 * Trait to ensure models use the correct tenant database connection
 * for route model binding in multi-tenant setups
 *
 * Since TenantDatabase middleware runs BEFORE SubstituteBindings,
 * the database is already switched when route model binding happens.
 * We just need to ensure models use the 'mysql' connection.
 */
trait UsesTenantConnection
{
    /**
     * Resolve route model binding to ensure it uses the correct database connection
     * This is critical for multi-tenant setups where database is switched dynamically
     * by TenantDatabase middleware
     *
     * This method is called by Laravel's route model binding when resolving route parameters
     *
     * NOTE: The database is already switched by TenantDatabase middleware which runs
     * BEFORE SubstituteBindings. We just need to ensure we use the 'mysql' connection.
     */
    public function resolveRouteBinding($value, $field = null)
    {
        // The TenantDatabase middleware has already switched the 'mysql' connection
        // to the correct tenant database BEFORE route model binding happens.
        // We just need to ensure this model instance uses the 'mysql' connection.

        $field = $field ?? $this->getRouteKeyName();

        // Ensure this instance uses the 'mysql' connection (already switched by middleware)
        $this->setConnection('mysql');

        // Use the model's query builder - it will use the switched connection
        // The connection resolver set by TenantDatabase middleware ensures this works
        return $this->newQuery()
            ->where($field, $value)
            ->first();
    }
}
