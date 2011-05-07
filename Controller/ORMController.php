<?php
namespace Xnni\UtilBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

class ORMController extends Controller
{
    public function __construct()
    {
    }

    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);

        if (!$this->container->has('doctrine.orm.entity_manager')) {
            throw new InvalidConfigurationException();
        }
        $this->em = $this->container->get('doctrine.orm.entity_manager');
    }
}
