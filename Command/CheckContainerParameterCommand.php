<?php
namespace Xnni\UtilBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\Output;
use Symfony\Bundle\FrameworkBundle\Command\Command;

class tempContainer extends \appDevProjectContainer
{
    public function getDefaultParams()
    {
        return $this->getDefaultParameters();
    }
}

class CheckContainerParameterCommand extends Command
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setDefinition(array(
                new InputArgument('param_name', InputArgument::REQUIRED, 'parameter name'),
            ))
            ->addOption('only-key', null, InputOption::VALUE_NONE, 'display only key names if set')
            ->setName('util:container-param')
        ;
    }

    /**
     * @see Command
     *
     * @throws \InvalidArgumentException When namespace doesn't end with Bundle
     * @throws \RuntimeException         When bundle can't be executed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $searchParamName = $input->getArgument('param_name');
        $onlyKey         = $input->getOption('only-key', false);

        $con = new tempContainer();

        $params = $con->getDefaultParams();
        foreach ($params as $paramName=>$param) {
            if (false !== strpos($paramName, $searchParamName)) {
                $output->writeln($paramName);
                if (false === $onlyKey) {
                    $output->writeln($param);
                }
            }
        }
    }
}
