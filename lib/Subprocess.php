<?php
namespace Filesystem;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Subprocess class.
 *
 * @package Filesystem
 */
class Subprocess
{
    /**
     * Stream STDOUT and/or STDERR to file.
     *
     * @var int
     */
    const STREAM_FILE = 1;

    /**
     * Stream STDOUT and/or STDERR to STDOUT.
     *
     * @var int
     */
    const STREAM_STDOUT = 2;

    /**
     * Stream STDOUT and/or STDERR to file and STDOUT.
     *
     * @var int
     */
    const STREAM_BOTH = 3;

    /**
     * Stream STDOUT and/or STDERR to STDOUT (wait for process to finish).
     *
     * @var int
     */
    const STREAM_STDOUT_WAIT = 4;

    /**
     * Stream STDOUT and/or STDERR to STDOUT (interactive mode).
     *
     * @var int
     */
    const STREAM_STDOUT_TTY = 5;

    /**
     * Initiate subprocess.
     *
     * @param  mixed   $cmd           command(s) being executed
     * @param  boolean $stream        whether or not to stream results to console
     * @param  boolean $fail_on_error whether or not to fail on error or pass
     * @param  mixed   $stdoutfile    STDOUT file for output or NULL
     * @param  mixed   $stderrfile    STDERR file for output or NULL
     * @return array   STDOUT, STDERR and RETVAL or just RETVAL if streamed
     */
    final public function run($cmd, $stream = self::STREAM_STDOUT_WAIT, $fail_on_error = false, $stdoutfile = null, $stderrfile = null)
    {
        $process = new Process($cmd);
        $process->setTimeout(10800);
        $process->setIdleTimeout(3600);

        switch ($stream)
        {
            case '1':
                return $this->stream_to_file($process, $stdoutfile, $stderrfile);

            case '2':
                return $this->stream_to_stdout($process);
                
            case '3':
                return $this->stream_to_both($process, $stdoutfile, $stderrfile);
                
            case '4':
                return $this->stream_stdout_wait($process, $fail_on_error);
                
            case '5':
                return $this->stream_stdout_tty($process);
        }
    }

    /**
     * Stream STDOUT and/or STDERR to console.
     *
     * @param  object $process    process object
     * @param  string $stdoutfile STDOUT file for output
     * @param  string $stderrfile STDERR file for output
     * @return array
     */
    final protected function stream_to_file(Process $process, $stdoutfile, $stderrfile)
    {
        if (!isset($stdoutfile))
        {
            throw new \RuntimeException("Missing output file for STDOUT stream.");
        }

        $GLOBALS['stdoutfile'] = $stdoutfile;
        $GLOBALS['stderrfile'] = $stderrfile;

        $process->run(function($type, $buffer)
        {
            if (Process::ERR === $type)
            {
                if ($GLOBALS['stderrfile'] !== null)
                {
                    file_put_contents($GLOBALS['stderrfile'], $buffer, FILE_APPEND | LOCK_EX);
                } else
                {
                    file_put_contents($GLOBALS['stdoutfile'], $buffer, FILE_APPEND | LOCK_EX);
                }
            } else
            {
                file_put_contents($GLOBALS['stdoutfile'], $buffer, FILE_APPEND | LOCK_EX);
            }
        });
        return $this->get_process_info($process);
    }

    /**
     * Stream STDOUT and STDERR to console.
     *
     * @param  object $process process object
     * @return array
     */
    final protected function stream_to_stdout(Process $process)
    {
        $process->run(function($type, $buffer)
        {
            if (Process::ERR === $type)
            {
                fwrite(STDERR, $buffer);
            }

            if (Process::ERR !== $type)
            {
                fwrite(STDOUT, $buffer);
            }
        });
        return $this->get_process_info($process);
    }

    /**
     * Stream STDOUT and STDERR to console.
     *
     * @param  object $process    Process object
     * @param  string $stdoutfile STDOUT file for output
     * @param  string $stderrfile STDERR file for output
     * @return array
     */
    final protected function stream_to_both(Process $process, $stdoutfile, $stderrfile)
    {
        if (!isset($stdoutfile))
        {
            throw new \RuntimeException("Missing output file for STDOUT stream.");
        }

        $GLOBALS['stdoutfile'] = $stdoutfile;
        $GLOBALS['stderrfile'] = $stderrfile;

        $process->run(function($type, $buffer)
        {
            if (Process::ERR === $type)
            {
                if ($GLOBALS['stderrfile'] !== null)
                {
                    file_put_contents($GLOBALS['stderrfile'], $buffer, FILE_APPEND | LOCK_EX);
                }

                if ($GLOBALS['stderrfile'] === null)
                {
                    file_put_contents($GLOBALS['stdoutfile'], $buffer, FILE_APPEND | LOCK_EX);
                }
                fwrite(STDERR, $buffer);
            }

            if (Process::ERR !== $type)
            {
                file_put_contents($GLOBALS['stdoutfile'], $buffer, FILE_APPEND | LOCK_EX);
                fwrite(STDOUT, $buffer);
            }
        });
        return $this->get_process_info($process);
    }

    /**
     * Wait for process to finish and return.
     *
     * @param  object  $process       process object
     * @param  boolean $fail_on_error whether or not to fail on error or pass
     * @return array
     */
    final protected function stream_stdout_wait(Process $process, $fail_on_error)
    {
        $process->run();
        if ($fail_on_error && !$process->isSuccessful())
        {
            throw new ProcessFailedException($process);
        }
        return $this->get_process_info($process);
    }

    /**
     * Stream STDOUT and STDERR to console (interactive mode).
     *
     * @param  object $process process object
     * @return array
     */
    final protected function stream_stdout_tty(Process $process)
    {
        $process->setTty(true);
        $process->start();
        $process->wait();
        return $this->get_process_info($process);
    }

    /**
     * Returns process information.
     *
     * @param  object $process process object
     * @return array
     */
    final protected function get_process_info(Process $process)
    {
        $cmd_executed = $process->getCommandLine();
        $stdout = $process->getOutput();
        $stderr = $process->getErrorOutput();
        $return_value = $process->getExitCode();
        $return_value_text = $process->getExitCodeText();

        return [
            'command'    => $cmd_executed,
            'stdout'     => $stdout,
            'stderr'     => $stderr,
            'error_code' => [$return_value, $return_value_text]
        ];
    }
}
