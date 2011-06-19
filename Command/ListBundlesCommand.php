<?php
namespace Xnni\UtilBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\Output;
use Symfony\Bundle\FrameworkBundle\Command\Command;

class ListBundlesCommand extends Command
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('bundle:list')
        ;
    }

    /**
     * @see Command
     *
     * @throws \InvalidArgumentException When runs in non-dev environment
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $kernel = $this->container->get('kernel');
        foreach ($kernel->getBundles() as $bundle) {
            $output->writeln($bundle->getName());
        }
    }
}

