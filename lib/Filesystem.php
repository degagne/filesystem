<?php
namespace Filesystem;

class Filesystem
{

    /**
     * Changes mode for files/directories.
     *
     * @param  string $path      path to the file or file
     * @param  int 	  $mode 	 mode
     * @param  bool   $recursive recursive file mode change
     * @return bool
     */
    final public static function chmod($path, $mode, $recursive = false)
    {
        $mode = self::fixFileModeFormat($mode);
        $recursive = ($recursive === false) ? '' : '-R';
        system("chmod {$recursive} {$mode} {$path} 2> /dev/null", $retval);

        if ($retval != 0)
        {
            throw new \RuntimeException(__METHOD__ . ": failed to change or update file permissions for {$path}");
        }
        return true;
    }

    /**
     * Changes group of file.
     *
     * @param  string $file      path to the file
     * @param  int 	  $group 	 file group
     * @param  bool   $recursive recursive file mode change
     * @return bool
     */
    final public static function chgrp($file, $group, $recursive = false)
    {
        $recursive = ($recursive === false) ? '' : '-R';
        system("chgrp {$recursive} {$group} {$file} 2> /dev/null", $retval);

        if ($retval != 0)
        {
            throw new \RuntimeException(__METHOD__ . ": failed to set file '{$file}' to {$group}");
        }
        return true;
    }

    /**
     * Copies file.
     *
     * @param  string $srcfile  path to the source file
     * @param  string $destfile path to the destination file
     * @return bool
     */
    final public static function copy($srcfile, $destfile)
    {
        self::fileExists($srcfile);
        if (@copy($srcfile, $destfile) === false)
        {
            throw new \RuntimeException(__METHOD__ . ": failed to create copy of '{$srcfile}' to '{$destfile}'");
        }
        return true;
    }
    
    /**
     * Removes file.
     *
     * @param  string $file   file name
     * @param  bool   $strict strict error checking
     * @return bool
     */
    final public static function delete($file, $strict = true)
    {
        self::fileExists($file);
        if (@unlink($file) === false)
        {
            if ($strict)
            {
                throw new \RuntimeException(__METHOD__ . ": failed to delete {$file}");
            }
            return false;
        }
        return true;
    }

    /**
     * Removes files.
     *
     * @param  array  $files   file names
     * @param  bool   $strict strict error checking
     * @return bool
     */
    final public static function deleteFiles($files, $strict = true)
    {
        foreach ($files as $file)
        {
            self::delete($file, $strict);
        }
        return true;
    }
    
    /**
     * Returns pathnames matching a pattern (for files only & hidden files).
     *
     * @param  string $directory directory
     * @param  mixed  $pattern   pattern (does not support tilde expansion)
     * @return mixed
     */
    final public static function glob($directory, $pattern = null)
    {
        self::dirExists($directory);

        $pattern = is_array(($pattern)) ? '{' . implode(',', $pattern) . '}' : $pattern;
        if ($pattern === null)
        {
            return array_diff(glob($directory . '/*'), ['.', '..']);
        }
        return glob($directory . '/{,.}*' . $pattern . '*', GLOB_BRACE);
    }

    /**
     * Create new directory.
     *
     * @param  mixed  $directory   path to the directory
     * @param  int    $mode        directory permission mode value (octal)
     * @param  bool   $recursive   create directories as needed
     * @param  bool   $strict      strict error checking
     * @return bool
     */
    final public static function mkdir($directory, $mode = 0777, $recursive = false, $strict = true)
    {
        if (self::dirExists($directory, false))
        {
            return false;
        }

        if (@mkdir($directory, self::fixFileModeFormat($mode), $recursive) === false)
        {
            if ($strict)
            {
                throw new \RuntimeException(__METHOD__ . ": failed to create new directory {$directory}");
            }
            return false;
        }
        return true;
    }
    
    /**
     * Create new directories.
     *
     * @param  mixed  $directories path to the directories
     * @param  int    $mode        directory permission mode value (octal)
     * @param  bool   $recursive   create directories as needed
     * @param  bool   $strict      strict error checking
     * @return bool
     */
    final public static function mkdirs($directories, $mode = 0777, $recursive = false, $strict = true)
    {
        foreach ($directories as $directory)
        {
            self::mkdir($directory, $mode, $recursive, $strict);
            self::chmod($directory, $mode);
        }
        return true;
    }

    /**
     * Removes a directory.
     *
     * @param  string   $directory  directory to remove
     * @param  bool     $strict     strict error checking
     * @return mixed
     */
    final public static function rmdir($directory, $strict = true)
    {
        self::dirExists($directory);

        // Remove any files, if found in directory
        if (count(($files = self::glob($directory))) > 0)
        {
            self::deleteFiles($files);
        }
        
        if (@rmdir($directory) === false)
        {
            if ($strict)
            {
                throw new \RuntimeException(__METHOD__ . ": failed to delete directory '{$directory}'");
            }
            return false;
        }
        return true;
    }

    /**
     * Removes a directories.
     *
     * @param  array    $directories  directories to remove
     * @param  bool     $strict       strict error checking
     * @return mixed
     */
    final public static function rmdirs($directories, $strict = true)
    {
        foreach ($directories as $directory)
        {
            self::rmdir($directory, $strict);
        }
        return true;
    }

    /**
     * Moves file to different path (rename).
     *
     * @param  string $old_file path to the old file
     * @param  string $new_file path to the new file
     * @return bool
     */
    final public static function rename($old_file, $new_file)
    {
        self::fileExists($old_file);
        if (!@rename($old_file, $new_file))
        {
            throw new \RuntimeException(__METHOD__ . ": failed to move '{$old_file}' to '{$new_file}'");
        }
        return true;
    }
    
    /**
     * Create temporary file.
     *
     * @param  string $template temporary filename template (default=tmp-XXXXXXXXXXXXXX)
     * @param  bool   $resource request file pointer into temporary file
     * @return mixed
     */
    final public static function tmpfile($template = null, $resource = false)
    {
        $template = ($template === null) ? "tmp.XXXXXXXXXXXXXX" : "{$template}.XXXXXXXXXXXXXX";
        $tempfile = shell_exec("mktemp -p /tmp {$template}");
        return ($resource === false) ? rtrim($tempfile) : fopen($tempfile, "w+");
    }

    /**
     * Create temporary directory.
     *
     * @param  string $template temporary directory template (default=tmpXXXXXXXXXXXXXX)
     * @return mixed
     */
    final public static function tmpdir($template = null)
    {
        $template = ($template === null) ? "tmpXXXXXXXXXXXXXX" : "{$template}xxxxxxxxxxxxxx";
        $tempdir = shell_exec("mktemp -p /tmp -d {$template}");
        return rtrim($tempdir);
    }

    /**
     * Fix mode to proper formats.
     *
     * @param  int   $mode file mode
     * @return int
     */
    final private static function fixFileModeFormat($mode)
    {
        if (preg_match('/^[0-9]{3}$/', $mode))
        {
            return (int) str_pad(decoct($mode), 4, '0', STR_PAD_LEFT);
        }
        return $mode;
    }
    
    /**
     * Checks if directory exists;.
     *
     * @param  string $directory directory name
     * @param  bool   $strict    strict error checking
     * @return bool
     */
    final public static function dirExists($directory, $strict = true)
    {
        if (!file_exists($directory))
        {
            if ($strict)
            {
                throw new \RuntimeException(__METHOD__ . ": directory doesn't exist: {$directory}.");
            }
            return false;
        }
        return true;
    }

    /**
     * Checks if file exists;.
     *
     * @param  string $file     file name
     * @param  bool   $strict   strict error checking
     * @return bool
     */
    final public static function fileExists($file, $strict = true)
    {
        if (!file_exists($file))
        {
            if ($strict)
            {
                throw new \RuntimeException(__METHOD__ . ": file doesn't exist: {$file}.");
            }
            return false;
        }
        return true;
    }

}
