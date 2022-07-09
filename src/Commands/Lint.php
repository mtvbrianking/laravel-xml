<?php

namespace Bmatovu\LaravelXml\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class Lint extends Command
{
    const XMLLINT_INDENT = '    ';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xml:lint
                                {input : XML file(s) to parse.}
                                {--o|output= : Save to a given file.}
                                {--s|schema= : WXS schema to validate against.}
                                {--i|indent= : Indent space. Default: 4 spaces.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parsing XML files.';

    public function __construct(?string $name = '')
    {
        $this->ignoreValidationErrors();

        parent::__construct($name);
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if (PHP_OS_FAMILY !== 'Linux') {
            $this->error('Only tested on Linux OS');

            return;
        }

        $commands = $this->buildCommands();

        if ($this->option('verbose')) {
            $this->line('>>> '.implode(' ', $commands));
        }

        // dd($commands);

        $process = new Process($commands, null, [
            'XMLLINT_INDENT' => $this->option('indent') ?? self::XMLLINT_INDENT,
        ]);

        $process->run();

        // executes after the command finishes
        if (! $process->isSuccessful()) {
            $this->line($process->getErrorOutput());

            return;
        }

        $this->line($process->getOutput());
    }

    protected function buildCommands()
    {
        $commands = [
            'xmllint',
            $this->argument('input'),
            '--format',
        ];

        if ($output = $this->option('output')) {
            $commands[] = '--output';
            $commands[] = $output;
        }

        if ($schema = $this->option('schema')) {
            $commands[] = '--schema';
            $commands[] = $schema;
        }

        return array_merge($commands, $this->getRawOptions());
    }

    protected function getRawOptions()
    {
        $argv = $_SERVER['argv'];

        if (! \in_array('--', $argv, true)) {
            return [];
        }

        $argv = \array_slice($argv, array_search('--', $argv, true) + 1);

        $raw = [];

        foreach ($argv as $arg) {
            if ('--' === $arg || ! Str::startsWith($arg, '-')) {
                $raw[] = $arg;

                continue;
            }

            $raw = array_merge($raw, explode('=', $arg));
        }

        return $raw;
    }
}
