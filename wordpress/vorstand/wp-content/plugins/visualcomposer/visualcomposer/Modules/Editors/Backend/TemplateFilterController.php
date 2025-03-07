<?php

namespace VisualComposer\Modules\Editors\Backend;

if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

use VisualComposer\Framework\Container;
use VisualComposer\Framework\Illuminate\Support\Module;
use VisualComposer\Helpers\Traits\WpFiltersActions;

class TemplateFilterController extends Container implements Module
{
    protected $templates;

    use WpFiltersActions;

    public function __construct()
    {
        if (version_compare(get_bloginfo('version'), '4.7', '<')) {
            $this->wpAddFilter('page_attributes_dropdown_pages_args', 'registerProjectTemplates');
        } else {
            $this->wpAddFilter('theme_page_templates', 'addNewTemplate');
        }

        $this->wpAddFilter(
            'wp_insert_post_data',
            'registerProjectTemplates'
        );

        $this->wpAddFilter(
            'template_include',
            'viewProjectTemplate'
        );

        $this->templates = [
            'blank-template.php' => __('Blank page', 'vcwb')
        ];
    }

    protected function addNewTemplate($postsTemplates)
    {
        $postsTemplates = array_merge($postsTemplates, $this->templates);

        return $postsTemplates;
    }

    protected function registerProjectTemplates($atts)
    {
        $cacheKey = 'page_templates-' . md5(get_theme_root() . '/' . get_stylesheet());
        $templates = wp_get_theme()->get_page_templates();

        if (empty($templates)) {
            $templates = [];
        }

        wp_cache_delete($cacheKey, 'themes');
        $templates = array_merge($templates, $this->templates);

        wp_cache_add($cacheKey, $templates, 'themes', 1800);

        return $atts;
    }

    protected function viewProjectTemplate($template)
    {
        global $post;

        if (!$post) {
            return $template;
        }

        if (!isset($this->templates[ get_post_meta($post->ID, '_wp_page_template', true) ])) {
            return $template;
        }

        $file = $this->templatePath() . get_post_meta($post->ID, '_wp_page_template', true);

        if (file_exists($file)) {
            return $file;
        } else {
            echo $file;
        }

        return $template;
    }

    protected function templatePath()
    {
        /** @var \VisualComposer\Application $_app */
        $_app = vcapp();

        return $_app->path('visualcomposer/resources/views/editor/templates/');
    }
}
