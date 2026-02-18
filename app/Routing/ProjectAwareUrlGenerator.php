<?php

namespace App\Routing;

use Illuminate\Routing\UrlGenerator as BaseUrlGenerator;
use Illuminate\Support\Facades\URL;

class ProjectAwareUrlGenerator extends BaseUrlGenerator
{
    /**
     * Generate an absolute URL to the given path.
     *
     * @param  string  $path
     * @param  mixed  $extra
     * @param  bool|null  $secure
     * @return string
     */
    public function to($path, $extra = [], $secure = null)
    {
        // Get current project
        $project = $this->getCurrentProject();

        // If project exists and path is a string (not null or empty)
        if ($project && !empty($path) && is_string($path)) {
            // Skip if path is already a full URL (http://, https://, //)
            if (!str_starts_with($path, 'http://') &&
                !str_starts_with($path, 'https://') &&
                !str_starts_with($path, '//')) {
                // Remove leading slash if present
                $path = ltrim($path, '/');

                // Check if path already starts with project segment
                if (!str_starts_with($path, $project . '/')) {
                    // Prepend project segment
                    $path = $project . '/' . $path;
                }
            }
        }

        // Call parent to() method
        return parent::to($path, $extra, $secure);
    }

    /**
     * Generate the URL to an application asset.
     * Override to automatically include project segment.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    // public function asset($path, $secure = null)
    // {
    //     // Get current project
    //     $project = $this->getCurrentProject();

    //     // If project exists and path is a string (not null or empty)
    //     if ($project && !empty($path) && is_string($path)) {
    //         // Skip if path is already a full URL (http://, https://, //)
    //         if (!str_starts_with($path, 'http://') &&
    //             !str_starts_with($path, 'https://') &&
    //             !str_starts_with($path, '//')) {
    //             // Remove leading slash if present
    //             $path = ltrim($path, '/');

    //             // Check if path already starts with project segment
    //             if (!str_starts_with($path, $project . '/')) {
    //                 // Prepend project segment
    //                 $path = $project . '/' . $path;
    //             }
    //         }
    //     }

    //     // Call parent asset() method with modified path
    //     return parent::asset($path, $secure);
    // }

    /**
     * Get current project from URL defaults
     */
    protected function getCurrentProject()
    {
        try {
            $defaults = URL::getDefaultParameters();
            if (isset($defaults['project']) && !empty($defaults['project'])) {
                return $defaults['project'];
            }
        } catch (\Exception $e) {
            // Continue to fallback
        }

        // Fallback: get from request segment
        $segment = getenv('URL_SEGMENT');
        if ($segment && request()) {
            $project = request()->segment($segment);
            if ($project) {
                return $project;
            }
        }

        return null;
    }
}
