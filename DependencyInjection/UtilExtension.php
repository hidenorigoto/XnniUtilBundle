<?php
namespace Xnni\UtilBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class UtilExtension extends Extension
{
    public function configLoad(array $configs, ContainerBuilder $container)
    {
    }

    /**
     * Returns the base path for the XSD files.
     *
     * @return string The XSD base path
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    public function getNamespace()
    {
        return 'http://innx.co.jp/schema/dic/util';
    }

    public function getAlias()
    {
        return 'util';
    }
}
