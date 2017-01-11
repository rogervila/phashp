<?php

namespace Phashp;

use Phashp\Helpers\DefaultAlgorithms;
use Phashp\Helpers\Hasher;

class Phashp
{
    use DefaultAlgorithms, Hasher;

    protected static $instance;
    protected $defaultAlgorithms;
    protected $algorithms;
    protected $outputAlgorithm;
    protected $string;
    protected $counter;
    protected $hashedString;

    public function __construct()
    {
        $this->algorithms = $this->getDefaultAlgorithms();
        $this->counter = 1;
    }

    public static function __callStatic($name, $arguments)
    {
        return self::handle($name, $arguments);
    }

    public function __call($name, $arguments)
    {
        return self::handle($name, $arguments);
    }

    protected static function handle($name, $arguments)
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        $method = 'parse' . ucfirst($name);

        if (method_exists(self::$instance, $method)) {
            $args = isset($arguments[0]) ? $arguments[0] : null;
            return self::$instance->{$method}($args);
        }

        return self::$instance;
    }

    protected function parseAlgos($algorithms)
    {
        if ( ! is_array($algorithms)) {
            throw new \Exception('');
        }

        $this->algorithms = $algorithms;

        return $this;
    }

    protected function parseCycles($integer)
    {
        if ( ! is_int($integer)) {
            throw new \Exception('');
        }

        if ($integer < 1) {
            throw new \Exception('');
        }

        $this->counter = $integer;

        return $this;
    }

    protected function parseOutput($algorithm)
    {
        if ( ! in_array($algorithm, hash_algos())) {
            throw new \Exception('');
        }

        $this->outputAlgorithm = $algorithm;

        return $this;
    }

    protected function parseHash($string)
    {
        if ( ! is_string($string)) {
            throw new \Exception('');
        }

        $this->string = $string;

        return $this->execute();
    }
}
