<?php
namespace Xnni\Bundle\UtilBundle\Registry;

interface RegistryAwareInterface
{
    public function setRegistry(RegistryInterface $registry);
}
