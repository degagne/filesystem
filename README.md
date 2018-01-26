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

```php
require_once(__DIR__ . "/vendor/autoload.php");

use Filesystem\Archive;

// Return zip command with all options and arguments
$archive = new Archive("test.zip");
$zip = $archive
    ->add_files(["testfile1.txt", "testfile2.txt"])
    ->zip(["-j","-9"], true);

print("{$zip}\n");

----- Expected Result(s) -----
zip -j -9 test.zip testfile1.txt testfile2.txt

// Run zip command directly
$zip = $archive
    ->add_files(["testfile1.txt", "testfile2.txt"])
    ->zip(["-j","-9"], true)
    ->run();
```
