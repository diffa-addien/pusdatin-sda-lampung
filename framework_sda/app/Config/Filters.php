<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'logger'        => \App\Filters\Logger::class,
        'filterAdmin'   => \App\Filters\FilterAdmin::class,
        'filter_AdmProv'     => \App\Filters\Filter_AdmProv::class,
        'filter_Kontributor' => \App\Filters\Filter_Kontributor::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     */
    public array $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     */
    public array  $filters = [
        'logger' => ['before' => ['*'],'after' => ['Admin', 'Admin/*']],
        'filterAdmin' => ['before' => ['Admin', 'Admin/*']],
        'filter_AdmProv'      => ['before' => ['admin/kelola_akun', 'admin/sda_wilayah/*']],
        'filter_Kontributor'  => ['before' => ['admin/kelola_akun', 'admin/kelola_wilayah', 'admin/kelola_kategori', 'admin/profil_sistem', 'admin/sda_provinsi']]
    ];
}
