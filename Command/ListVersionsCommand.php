<?php
namespace Xnni\UtilBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\Output;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand as Command;

class ListVersionsCommand extends Command
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('list-versions')
        ;
    }

    /**
     * @see Command
     *
     * @throws \InvalidArgumentException When runs in non-dev environment
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (class_exists('\Symfony\Component\HttpKernel\Kernel')) {
            $output->writeln('Symfony2:         ' . \Symfony\Component\HttpKernel\Kernel::VERSION);
        }

        if (class_exists('\Doctrine\Common\Version')) {
            $output->writeln('Doctrine2 Common: ' . \Doctrine\Common\Version::VERSION);
        }
        if (class_exists('\Doctrine\ORM\Version')) {
            $output->writeln('Doctrine2 ORM:    ' . \Doctrine\ORM\Version::VERSION);
        }
        if (class_exists('\Doctrine\DBAL\Version')) {
            $output->writeln('Doctrine2 DBAL:   ' . \Doctrine\DBAL\Version::VERSION);
        }
        if (class_exists('\Twig_Environment')) {
            $output->writeln('Twig:             ' . \Twig_Environment::VERSION);
        }
    }
}


