<?php

/*
 * This file is part of Trident.
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Trident\Component\HttpKernel\AbstractKernel;

/**
 * Application Kernel
 *
 * Loads all of the application's modules, allows things like module service
 * configuration to happen.
 */
class TridentKernel extends AbstractKernel
{
    const DEBUG_DISABLED = false;
    const DEBUG_ENABLED = true;

    /**
     * {@inheritDoc}
     */
    public function registerModules($environment)
    {
        $modules = [
            new Trident\Module\FrameworkModule\TridentFrameworkModule(),
            new Trident\Module\TemplatingModule\TridentTemplatingModule(),
            new Trident\Module\DoctrineModule\TridentDoctrineModule(),
            new Trident\Module\SecurityModule\TridentSecurityModule(),
        ];

        if (in_array($environment, array('dev'))) {
            // Register development modules here:
            $modules[] = new Trident\Module\DebugModule\TridentDebugModule();
        }

        return $modules;
    }

    /**
     * {@inheritDoc}
     */
    public function registerConfiguration($environment)
    {
        return require __DIR__.'/config/config.php';
    }

    /**
     * Get public asset directory.
     *
     * @return string
     */
    public function getAssetDir()
    {
        return $this->getRootDir().'/../public/assets';
    }
}
