<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit46cc972066c460101a7c05e5832789ad
{
    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'clinela\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'clinela\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PhpRbac' => 
            array (
                0 => __DIR__ . '/..' . '/owasp/phprbac/PhpRbac/src',
            ),
        ),
    );

    public static $classMap = array (
        'AltoRouter' => __DIR__ . '/..' . '/altorouter/altorouter/AltoRouter.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit46cc972066c460101a7c05e5832789ad::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit46cc972066c460101a7c05e5832789ad::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit46cc972066c460101a7c05e5832789ad::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit46cc972066c460101a7c05e5832789ad::$classMap;

        }, null, ClassLoader::class);
    }
}