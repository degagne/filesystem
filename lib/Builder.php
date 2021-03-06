<?php
namespace Filesystem;

/**
 * Builder class.
 *
 * @package Filesystem
 */
class Builder
{

    /**
     * Command prefix.
     *
     * @var string
     */
    public $prefix;
	
    /**
     * Command options.
     *
     * @var string
     */
    public $options;
	
    /**
     * Command arguments.
     *
     * @var string
     */
    public $arguments;
	
    /**
     * Returns $command as string.
     *
     * @return string $command command line string
     */
    public function __toString()
    {
        $command  = str_pad($this->prefix, strlen($this->prefix) + 1, ' ', STR_PAD_RIGHT);
        $command .= !empty($this->options) ? str_pad($this->options, strlen($this->options) + 1, ' ', STR_PAD_RIGHT) : '';
        $command .= !empty($this->arguments) ? str_pad($this->arguments, strlen($this->arguments) + 1, ' ', STR_PAD_RIGHT) : '';
        return $command;
    }

    /**
     * Set command line prefix.
     *
     * @param  string $prefix command line prefix
     * @return object class object
     */
    final public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * Set command line options
     *
     * @param  array  $opts command line options
     * @return object class object
     */
    final public function setOptions(array $opts)
    {
        $options = [];
        foreach ($opts as $key => $value)
        {
            if (preg_match('/^-.*$/', $key, $matches))
            {
                $options[] = is_bool($value) ? $key : str_pad($key, strlen($key) + 1, ' ', STR_PAD_RIGHT) . $value;
            }
            if (preg_match('/^-.*$/', $value, $matches))
            {
                $options[] = $value;
            }
        }
        $this->options = implode(' ', array_filter($options, 'strlen'));
        return $this;
    }

    /**
     * Set command line arguments
     *
     * @param  array  $args command line arguments
     * @return object class object
     */
    final public function setArguments(array $args)
    {
        $arguments = [];
        foreach ($args as $key => $value)
        {
            if (preg_match('/^-.*$/', $key, $matches))
            {
                $arguments[] = is_bool($value) ? $key : str_pad($key, strlen($key) + 1, ' ', STR_PAD_RIGHT) . $value;
            } else
            {
                $arguments[] = is_array($value) ? implode(' ', $value) : $value;
            }
        }
        $this->arguments = implode(' ', array_filter($arguments, 'strlen'));
        return $this;
    }
}
