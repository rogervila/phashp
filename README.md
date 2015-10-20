# Phashp

Combines different hash algos in order to create a strong hashed string.

### Install

First, install [Composer]
```sh
$ curl -sS https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
```

Then, require phashp on your project
```sh
$ composer require rogervila/phashp
```

### Docs

Call the class
```php
use Rogervila\Phashp;
```
Create the object
```php
$Phashp = new Phashp;
```
Set the hash algos that you want to use (optional)
If algos are not set, it will use the whole accepted algos array
```php
$Phashp->set_algos(['sha512', 'sha256', 'sha224']);
```
Set the output hash. at the end of the magic, the string is hashed in a 'normal' way. **SHA-1 is defined by default**
```php
$Phashp->set_output_algo('sha256');
```
**Hash it!**
```php
$result = $Phashp->hash($string);
echo $result;
```

#### Retrieve data

Get the used algos
```php
$algos = $Phashp->get_algos();
var_dump($algos);
```
Get the output hash algo
```php
$output_algo = $Phashp->get_output_algo();
echo $output_algo;
```

Get the accepted algos
```php
$accepted = $Phashp->get_accepted_algos();
var_dump($accepted);
```

### Version
1.0.0

License
----

MIT

"&copy; [Roger Vilà]"

[Composer]: <http://getcomposer.org/>
[Roger Vilà]: <http://rogervila.es/>