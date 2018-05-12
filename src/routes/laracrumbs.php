<?php
/**
 * The Laracrumbs uses by the LaracrumbsAdmin package.
 *
 * @package LaracrumbsAdmin
 */
Laracrumbs::register([
    'link' => route('laracrumbs_home'),
    'display_text' => trans('laracrumbs-admin::admin.crumb_home'),
]);
Laracrumbs::register([
    'link' => route('laracrumbs_routes'),
    'display_text' => trans('laracrumbs-admin::admin.crumb_routes'),
]);
Laracrumbs::register([
    'link' => route('laracrumbs_browse'),
    'display_text' => trans('laracrumbs-admin::admin.crumb_browse'),
]);
