
Filesystem
==========

[![Latest Stable Version](https://img.shields.io/packagist/v/degagne/filesystem.svg?style=flat-square)](https://packagist.org/packages/degagne/filesystem) [![License](https://poser.pugx.org/degagne/filesystem/license)](https://packagist.org/packages/degagne/filesystem) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/degagne/filesystem/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/degagne/filesystem/?branch=master) [![Build Status](https://scrutinizer-ci.com/g/degagne/filesystem/badges/build.png?b=master)](https://scrutinizer-ci.com/g/degagne/filesystem/build-status/master) [![Code Intelligence Status](https://scrutinizer-ci.com/g/degagne/filesystem/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

Requirements
============

* PHP >= 5.4

Installation
============

Add filesystem package to your composer.json file.
```
{
    "require": {
        "degagne/filesystem": "~1.0"
    }
}
```

or run
```composer require degagne/filesystem```

Usage
=====
## Filesystem Class

Include the Filesystem class to script.
```php
require_once(__DIR__ . "/vendor/autoload.php");

use Filesystem\Filesystem;
```

### chmod
----------

Changes file mode.

#### Description
```php
bool chmod (string $path, int $mode [, bool $recursive = false])
```

#### Example
```php
<?php

use Filesystem\Filesystem;

Filesystem::chmod('/path/to/file', 0700, true);
```
#### Parameters

**path**
File or path name.

**mode**
File mode.

**recursive**
Recursive.

### chgrp
----------

Changes file group.

#### Description
```php
bool chgrp(string $file, int $group [, bool $recursive = false])
```

#### Example
```php
<?php

use Filesystem\Filesystem;

Filesystem::chgrp('/path/to/file', 100);
```

#### Parameters

**file**
File or path name.

**group**
Group ID.

**recursive**
Recursive.

### copy
----------
Copy file.

#### Description
```php
bool copy(string $srcfile, string $destfile)
```
#### Example
```php
<?php

use Filesystem\Filesystem;

Filesystem::copy('/path/to/source/file', '/path/to/dest/file');
```
#### Parameters

**srcfile**
Source file.

**destfile**
Destination file.

### delete
------
Deletes file.

#### Description
```php
bool delete(string $file [, bool $strict = true])
```

#### Example
```php
<?php

use Filesystem\Filesystem;

Filesystem::delete('/path/to/file');
```

#### Parameters

**file**
Path to file.

**strict**
Engage strict error checking. If true, an exception will be thrown on error.

### deleteFiles
----------
Deletes multiple files.

#### Description
```php
bool deleteFiles(array $files [, bool $strict = true])
```

#### Example
```php
<?php

use Filesystem\Filesystem;

Filesystem::deleteFiles(['/path/to/file1', '/path/to/file2']);
```

#### Parameters
**files**
Path to files.

**strict**
Engage strict error checking. If true, an exception will be thrown on error.

### glob
----------
Returns path names matching a pattern.

#### Description
```php
mixed glob(string $directory [, mixed $pattern = null])
```

#### Examples
```php
<?php

use Filesystem\Filesystem;

$matches = Filesystem::glob('/path/to/directory', '*.php');
```

#### Parameters

**directory**
Path to directory.

**pattern**
Matching pattern.

### mkdir
----------
Make directory.

#### Description
```php
bool mkdir(string $directory [, int $mode = 0777, bool $recursive = false, bool $strict = true])
```

#### Example
```php
<?php

use Filesystem\Filesystem;

Filesystem::mkdir('/path/to/directory', 0600, true);
```

#### Parameters

**directory**
Path to directory.

**mode**
File mode.

**recursive**
Recursive.

**strict**
Engage strict error checking. If true, an exception will be thrown on error.

### mkdirs
----------
Make directories.

#### Description
```php
bool mkdirs(array $directories [, int $mode = 0777, bool $recursive = false, bool $strict = true])
```

#### Example
```php
<?php

use Filesystem\Filesystem;

Filesystem::mkdirs(['/path/to/directory1','/path/to/directory2'], 0600, true);
```

#### Parameters

**directories**
Path to directories.

**mode**
File mode.

**recursive**
Recursive.

**strict**
Engage strict error checking. If true, an exception will be thrown on error.

### rmdir
------
Remove directory.

#### Description
```php
bool rmdir(string $directory [, bool $strict = true])
```

### Example
```php
<?php

use Filesystem\Filesystem;

Filesystem::rmdir('/path/to/directory1');
```

#### Parameters

**directory**
Path to directory.

**strict**
Engage strict error checking. If true, an exception will be thrown on error.

### rmdirs
------
Removed directories.

#### Description
```php
bool rmdir(array $directories [, bool $strict = true])
```

#### Example
```php
<?php

use Filesystem\Filesystem;

Filesystem::rmdirs(['/path/to/directory1', '/path/to/directory2']);
```

#### Parameters

**directories**
Path to directories.

**strict**
Engage strict error checking. If true, an exception will be thrown on error.

### rename
-----
Rename file (move).

#### Description
```php
bool rename(string $old_file, string $new_file)
```

#### Example
```php
<?php

use Filesystem\Filesystem;

Filesystem::rename('/path/to/oldfile', '/path/to/newfile');
```

#### Parameters

**oldfile**
Source file.

**newfile**
Destination file.

### fileWrite
-----
Write content to file.

#### Description
```php
bool fileWrite(string $filename, string $content [, bool $append = false])
```

#### Example
```php
<?php

use Filesystem\Filesystem;

Filesystem::fileWrite('/path/to/file', 'this is the file content', true);
```

#### Parameters

**filename**
Path to file where the content will be written.

**content**
Content being written.

**append**
Append to file, if exists.


### fileContent
-----
Retrieve content from file.

#### Description
```php
string fileContent(string $filename)
```

#### Example
```php
<?php

use Filesystem\Filesystem;

$content = Filesystem::fileContent('/path/to/file');
```

#### Parameters

**filename**
Path to file.

### tmpfile
-----
Create temporary file.

#### Description
```php
mixed tmpfile(string $template = null, bool $resource = false)
```

#### Example
```php
<?php

use Filesystem\Filesystem;

$tmpfile = Filesystem::tmpfile('tmp.XXXXXXXXXXX_XXX');
```

#### Parameters

**template**
temporary filename template (default=tmp-XXXXXXXXXXXXXX)

**resource**
request file pointer into temporary file

### tmpdir
-----
Create temporary directory.

#### Description
```php
string tmpdir(string $template = null)
```

#### Example
```php
<?php

use Filesystem\Filesystem;

$tmpfile = Filesystem::tmpdir('tmpdir.XXXXXXXXXXX_XXX');
```

#### Parameters

**template**
temporary directory template (default=tmpXXXXXXXXXXXXXX)

### dirExists
-------
Checks if directory exists.

#### Description

```php
bool dirExists(string $directory [, bool $strict = true])
```

#### Example
```php
<?php

use Filesystem\Filesystem;

$resp = Filesystem::dirExists('/path/to/directory', false);
```

#### Parameters

**directory**
Path to directory.

**strict**
Engage strict error checking. If true, an exception will be thrown on error.

### fileExists
-------
Checks if file exists.

#### Description

```php
bool fileExists(string file [, bool $strict = true])
```

#### Example
```php
<?php

use Filesystem\Filesystem;

$resp = Filesystem::fileExists('/path/to/file', false);
```

#### Parameters

**file**
Path to file.

**strict**
Engage strict error checking. If true, an exception will be thrown on error.
