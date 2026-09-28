<?php
/**
 * Plugin Name: Sepehr SEO & GEO
 * Description: داده‌های ساختاریافته (Schema)، دسترسی ربات‌های هوش مصنوعی، فایل llms.txt، عنوان و توضیحات صفحه اصلی و بهینه‌سازی سرعت برای سایت سپهر اسماعیلی. اطلاعات کسب‌وکار فقط در includes/facts.php تعریف می‌شود.
 * Version: 1.0.2
 * Author: Sepehr Esmaeily
 * Requires at least: 6.3
 * Requires PHP: 7.4
 * License: GPLv2 or later
 * Text Domain: sepehr-seo-geo
 *
 * @package sepehr-seo-geo
 */

defined( 'ABSPATH' ) || exit;

define( 'SEPEHR_SEO_GEO_VERSION', '1.0.2' );

require_once __DIR__ . '/includes/facts.php';
require_once __DIR__ . '/includes/meta.php';
require_once __DIR__ . '/includes/schema.php';
require_once __DIR__ . '/includes/ai-access.php';
require_once __DIR__ . '/includes/performance.php';
