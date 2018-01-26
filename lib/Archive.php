<?php
namespace Filesystem;

use Filesystem\Builder;
use Filesystem\Subprocess;

/**
 * Archive class.
 *
 * @package Filesystem
 */
class Archive
{

    /**
     * Archive filename.
     *
     * @var string
     */
    private $archive;

    /**
     * Files to archive.
     *
     * @var array
     */
    private $files = [];

    /**
     * Archive command.
     *
     * @var string
     */
    public $command = '';

    /**
     * Strict error checking.
     *
     * @var boolean
     */
    public $strict = false;

    /**
     * Constructor.
     *
     * @param  string $archive archive filename
     * @return void
     */
    public function __construct($archive)
    {
        $this->archive = $archive;
    }

    /**
     * Convert object of class to string.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->command;
    }

    /**
     * Add files to archive file.
     *
     * @param  mixed $files files to archive
     * @return object
     */
    final public function add_files($files)
    {
        $this->files = is_array($files) ? $files : [$files];
        return $this;
    }

    /**
     * Returns files to be added to archive file.
     *
     * @return mixed
     */
    final public function get_files()
    {
        return $this->files;
    }

    /**
     * Returns archive file info (zip).
     *
     * @param  array $options supported zip command options.
     * @return string
     */
    final public function zipinfo(array $options = [])
    {
        $this->command = (new Builder())
            ->setPrefix('zipinfo')
            ->setOptions($options)
            ->setArguments([$this->archive]);

        $process = (new Subprocess())->run($this->command);
        $stdout = $process['stdout'];
        $stderr = $process['stderr'];
        $retval = $process['error_code'][0];

        if ($retval != 0)
        {
            throw new \RuntimeException(empty($stderr) ? $stdout : $stderr);
        }
        return $stdout;
    }

    /**
     * Create archive file (zip).
     *
     * @param  array $options supported zip command options
     * @param  bool  $strict  strict error checking
     * @return object
     */
    final public function zip(array $options = [], $strict = false)
    {
        $this->command = (new Builder())
            ->setPrefix('zip')
            ->setOptions($options)
            ->setArguments([$this->archive, $this->get_files()]);
        $this->strict = $strict;
        return $this;
    }

    /**
     * Extract archive file (zip).
     *
     * @param  array $options    supported zip command options
     * @param  array $arguments  supported zip command arguments
     * @param  bool  $strict     strict error checking
     * @return object
     */
    final public function unzip(array $options = [], array $arguments = [], $strict = true)
    {
        $this->command = (new Builder())
            ->setPrefix('unzip')
            ->setOptions($options)
            ->setArguments(array_merge([$this->archive], $arguments));
        $this->strict = $strict;
        return $this;
    }

    /**
     * Create archive file (tar).
     *
     * @param  array $options    supported tar command options
     * @param  array $arguments  supported tar command arguments
     * @param  bool  $strict     strict error checking
     * @return object
     */
    final public function tar(array $options = [], array $arguments = [], $strict = true)
    {
        $this->command = (new Builder())
            ->setPrefix('tar')
            ->setOptions($options)
            ->setArguments(array_merge([$this->archive], $arguments, $this->get_files()));
        $this->strict = $strict;
        return $this;
    }

    /**
     * Compresses archive file (xz).
     *
     * @param  array $options   supported tar command options.
     * @param  bool  $strict    strict error checking
     * @return object
     */
    final public function xz(array $options = [], $strict = true)
    {
        $this->command = (new Builder())
            ->setPrefix('xz')
            ->setOptions($options)
            ->setArguments($this->get_files());
        $this->strict = $strict;
        return $this;
    }

    /**
     * Executes archive command..
     *
     * @return mixed exit status code or false (no files)
     */
    final public function run()
    {
        $process = (new Subprocess())->run($this->command);
        $stdout = $process['stdout'];
        $stderr = $process['stderr'];
        $retval = $process['error_code'][0];

        if (($this->strict === false || $this->strict) && $retval == 0)
        {
            return true;
        }

        if ($this->strict === false && $retval != 0)
        {
            return $retval;
        }

        if ($this->strict && $retval != 0)
        {
            throw new \RuntimeException(empty($stderr) ? $stdout : $stderr);
        }
    }
}
