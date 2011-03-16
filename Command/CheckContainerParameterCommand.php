<?php
namespace Xnni\UtilBundle\Command;

if (!class_exists('appDevProjectContainer')) {
    return;
}

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
            ->setName('container:check-param')
        ;
    }

    /**
     * @see Command
     *
     * @throws \InvalidArgumentException When runs in non-dev environment
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!class_exists('appDevProjectContainer')) {
            throw new \InvalidArgumentException('This command can be used only in dev environment.');
        }

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
