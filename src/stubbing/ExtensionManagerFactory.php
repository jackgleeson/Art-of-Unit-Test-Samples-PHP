<?php

namespace ArtOfUnitTesting\stubbing;

class ExtensionManagerFactory
{
    public static ?IExtensionManager $extensionManager = null;


    public static function setExtensionManager(IExtensionManager $extensionManager) : void
    {
        self::$extensionManager = $extensionManager;
    }

    public static function create() : IExtensionManager
    {
        if (self::$extensionManager === null) {
            self::$extensionManager = new FileExtensionManager();
        }
        return self::$extensionManager;
    }

}