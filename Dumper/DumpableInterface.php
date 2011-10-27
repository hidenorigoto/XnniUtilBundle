<?php
namespace Xnni\Bundle\UtilBundle\Dumper;

interface DumpableInterface
{
    const  SPACE = '{space}';
    public function dump($indent = 0);
}
