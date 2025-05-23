<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit752f7d2aae16f3c8bcf55fec007ff641
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'VCYC\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'VCYC\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit752f7d2aae16f3c8bcf55fec007ff641::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit752f7d2aae16f3c8bcf55fec007ff641::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit752f7d2aae16f3c8bcf55fec007ff641::$classMap;

        }, null, ClassLoader::class);
    }
}
