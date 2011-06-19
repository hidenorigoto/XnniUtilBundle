<?php
namespace Xnni\UtilBundle\Command;

if (!class_exists('appDevDebugProjectContainer')) {
    return;
}

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\Output;
use Symfony\Bundle\FrameworkBundle\Command\Command;

class tempContainer extends \appDevDebugProjectContainer
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
        if (!class_exists('appDevDebugProjectContainer')) {
            throw new \InvalidArgumentException('This command can be used only in dev environment.');
        }

        $searchParamName = $input->getArgument('param_name');
        $onlyKey         = $input->getOption('only-key', false);

        $tempContainer = new tempContainer();

        $params = $tempContainer->getDefaultParams();
        if ($onlyKey) {
            $format = '%s';
        } else {
            $format = '    <info>%-28s</info>    %s';
        }
        ksort($params);
        $namespace = '';
        foreach ($params as $paramName=>$param) {
            if (false !== strpos($paramName, $searchParamName)) {
                $parts = explode('.', $paramName);
                if ($namespace != $parts[0]) {
                    $namespace = $parts[0];
                    $output->writeln(sprintf('<comment>%s</comment>', $namespace));
                }
                $output->writeln(sprintf($format, str_replace($namespace.'.', '', $paramName), $param));
            }
        }
    }
}
