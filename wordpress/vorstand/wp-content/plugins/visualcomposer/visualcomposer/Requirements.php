<?php
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

/**
 * PHP 5.1! No namespaces must be there!
 */

/**
 * Plugin requirements in driver WordPress.
 * Class VcvCoreRequirements.
 */
class VcvCoreRequirements
{
    /**
     * Perform system check for requirements.
     */
    public function coreChecks()
    {
        $message = '';
        $die = false;

        if (!self::checkVersion(VCV_REQUIRED_PHP_VERSION, PHP_VERSION)) {
            $die = true;
            $message .= '<li>' .
                sprintf(
                    'PHP version %s or greater (recommended 7 or greater)',
                    VCV_REQUIRED_PHP_VERSION
                ) .
                '</li>';
        }

        if (!self::checkVersion(VCV_REQUIRED_BLOG_VERSION, get_bloginfo('version'))) {
            $die = true;
            $message .= '<li>' .
                sprintf(
                    'WordPress version %s or greater',
                    VCV_REQUIRED_BLOG_VERSION
                ) .
                '</li>';
        }

        if (!function_exists('curl_exec') || !function_exists('curl_init')) {
            $die = true;
            $message .= '<li>' .
                'The cURL extension must be loaded' .
                '</li>';
        }
        if (!function_exists('base64_decode')
            || !function_exists('base64_encode')
            || !function_exists('json_decode')
            || !function_exists('json_encode')) {
            $die = true;
            $message .= '<li>' .
                'The base64/json functions must be loaded' .
                '</li>';
        }

        if (glob(VCV_PLUGIN_ASSETS_DIR_PATH . '/*/*.php') === false
            || glob(
                VCV_PLUGIN_ASSETS_DIR_PATH . '/*',
                GLOB_ONLYDIR | GLOB_NOSORT
            ) === false) {
            $die = true;
            $message .= '<li>' .
                'The php.ini open_basedir must allow to check wp-content directory!<br>' .
                'Current value:' . ini_get('open_basedir') . '<br>' .
                'Visual Composer Assets directory:' . VCV_PLUGIN_ASSETS_DIR_PATH . '<br>' .
                'Failed to glob the files in assets directory' .
                '</li>';
        }

        if ($die) {
            wp_die(
                'To run Visual Composer Website Builder your host needs to have:<ul>' . $message . '</ul>' . '<a href="'
                . admin_url('plugins.php') . '">Go back to dashboard</a>'
            );
            $this->deactivate(VCV_PLUGIN_FULL_PATH);
        }

        return true;
    }

    /**
     * @param string $mustHaveVersion
     * @param string $versionToCheck
     *
     * @return bool
     */
    public function checkVersion($mustHaveVersion, $versionToCheck)
    {
        if (version_compare($mustHaveVersion, $versionToCheck, '>')) {
            return false;
        }

        return true;
    }

    public function deactivate($path)
    {
        require_once ABSPATH . '/wp-admin/includes/plugin.php';
        if (!defined('VCV_PHPUNIT') || !VCV_PHPUNIT) {
            deactivate_plugins($path);
        }
    }
}
