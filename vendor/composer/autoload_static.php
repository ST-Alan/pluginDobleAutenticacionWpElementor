<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4b057d853dd5afa0db9ddacda9bb544c
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Aleximxp\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Aleximxp\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4b057d853dd5afa0db9ddacda9bb544c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4b057d853dd5afa0db9ddacda9bb544c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4b057d853dd5afa0db9ddacda9bb544c::$classMap;

        }, null, ClassLoader::class);
    }
}
