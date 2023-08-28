<?php

namespace ReactoorInstaller;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Process\Process;

class Installer extends Command
{
    protected static $defaultName = 'new';
    protected static $defaultDescription = 'new application reactoor';
    protected function configure()
    {
        $this->addArgument('folder', InputArgument::OPTIONAL,'Folder Application');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $folder = $input->getArgument('folder');
        if ($folder == ''){
            $process = new Process(['composer', 'create-project', "arshiamohammadei85/reactoor"]);
        }else{
            $process = new Process(['composer', 'create-project', "arshiamohammadei85/reactoor", $folder]);
        }
        $process->start();
        $process->setTimeout(false);
        if ($process->getErrorOutput() == ''){
            echo '';
        }else{
            $output->writeln($process->getErrorOutput());
        }
        $process->wait(function ($type, $buffer) {
            if (Process::ERR === $type) {
                echo $buffer;
            } else {
                echo $buffer;
            }
        });
        $output->writeln('App created successfully.');
        return $process->getOutput();
    }
}