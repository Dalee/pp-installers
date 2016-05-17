<?php

namespace PP\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class Installer extends LibraryInstaller {
    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package) {
        # TODO: too-much hardcode there, should be cleared up

        $name = $package->getPrettyName();
        if ($name === 'pp/core') {
            return 'libpp';
        }

        $prefix = substr($name, 0, 3);
        if ('pp/' !== $prefix) {
            throw new \InvalidArgumentException(
                'Unable to install plugin. PP plugins '
                .'should always start their package name with '
                .'"pp/"'
            );
        }

        return 'local/plugins/' . substr($name, 3);
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType) {
        return 'pp-plugin' === $packageType;
    }
}
