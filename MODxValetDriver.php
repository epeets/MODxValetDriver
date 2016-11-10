<?php

/**
 * MODx driver for Laravel Valet by Andy Cowan (@andyw4)
 * based on the Wordpress driver by Adam Wathan
 * I'd appreciate a quick message via twitter if you're using this.
 */

class MODxValetDriver extends BasicValetDriver
{
    /**
     * Determine if the driver serves the request.
     *
     * @param  string  $sitePath
     * @param  string  $siteName
     * @param  string  $uri
     * @return void
     */
    public function serves($sitePath, $siteName, $uri)
    {
        if (file_exists($sitePath.'/config.core.php')) {
          if( strpos(file_get_contents($sitePath.'/config.core.php'),'MODX_CORE_PATH') !== false) {
            return true;
          }
        }
        return false;
    }

    /**
     * Determine if the incoming request is for a static file.
     *
     * @param  string  $sitePath
     * @param  string  $siteName
     * @param  string  $uri
     * @return string|false
     */
    public function isStaticFile($sitePath, $siteName, $uri)
    {
        if (file_exists($staticFilePath = $sitePath.$uri) && !is_dir($sitePath.$uri)) {
            return $staticFilePath;
        }

        return false;
    }

    /**
     * Get the fully resolved path to the application's front controller.
     *
     * @param  string  $sitePath
     * @param  string  $siteName
     * @param  string  $uri
     * @return string
     */
    public function frontControllerPath($sitePath, $siteName, $uri)
    {
        return parent::frontControllerPath(
          $sitePath, $siteName, $uri
        );
    }
}
