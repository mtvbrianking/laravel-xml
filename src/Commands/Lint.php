<?php

namespace Bmatovu\LaravelXml\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Lint extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xml:lint
                                {input : XML file(s) to parse.}
                                {--o|output= : Save to a given file.}
                                {--s|schema= : WXS schema to validate against.}
                                {--c|command= : Pass raw args to the underlying command}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parsing XML files.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // php artisan xml:lint demo.xml --command="--noout"
        // >>> xmllint demo.xml --format --noout
        // OK

        if (PHP_OS_FAMILY !== 'Linux') {
            $this->error('Only tested on Linux OS');

            return;
        }

        $commands = ['xmllint', $this->argument('input'), '--format', $this->option('command')];

        $this->line('>>> '.implode(' ', $commands));

        $process = new Process($commands);
        $process->run();

        // executes after the command finishes
        if (! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        echo $process->getOutput();

        $this->line('OK');
    }
}
