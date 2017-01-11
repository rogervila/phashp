# Phashp

[![Build Status](https://travis-ci.org/rogervila/phashp.svg?branch=master)](https://travis-ci.org/rogervila/phashp)
[![StyleCI](https://styleci.io/repos/43978114/shield?branch=master)](https://styleci.io/repos/43978114)
[![Code Climate](https://codeclimate.com/github/rogervila/phashp/badges/gpa.svg)](https://codeclimate.com/github/rogervila/phashp)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/cd4c4a22-7b0a-4d41-b1ea-0bf127729075/big.png)](https://insight.sensiolabs.com/projects/cd4c4a22-7b0a-4d41-b1ea-0bf127729075)

Combines different hash algorithms in order to create a stronger hashed string.

[You can find the v1 docs here](https://github.com/rogervila/phashp/tree/1.0).

### Install

First, install [Composer](https://getcomposer.org/)
```sh
$ curl -sS https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
```

Then, require the library on your project
```sh
$ composer require rogervila/phashp
```

### Usage

```php
// Simple usage
Phashp::hash('stringToHash');

// Full options
Phashp::algos(['sha1', 'sha256'])->cycles(2)->output('sha512')->hash('stringToHash');
```

 ### Docs
 
 `algos()` accepts an array of valid hashing algorithms. You can find which ones you can use on your current PHP version with [PHP hash_algos() method](http://php.net/manual/en/function.hash-algos.php).
 
 `cycles()` accepts an integer greater than 0, that will determine the amount of cycles.
 
 **WARNING: a high amount of cycles can make PHP run out of memory**.

`output()` accepts a valid hashing algorithm. The processed string will be returned in that hash algorithm format.

`hash()` **the only mandatory method**. It accepts the string that will be processed. **It must go at the end of the fluent concatenation**.



