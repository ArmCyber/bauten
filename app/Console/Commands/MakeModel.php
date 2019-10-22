<?php
namespace App\Console\Commands;
use Illuminate\Foundation\Console\ModelMakeCommand;
class MakeModel extends ModelMakeCommand
{
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Models';
    }
}
