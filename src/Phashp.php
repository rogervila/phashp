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

    function __construct()
    {
        $this->algorithms = $this->getDefaultAlgorithms();
        $this->counter = 1;
    }

    public static function __callStatic($name, $arguments)
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        $method = 'parse_' . $name;

        if (method_exists(self::$instance, $method)) {
            $args = isset($arguments[0]) ? $arguments[0] : null;
            return self::$instance->{$method}($args);
        }

        return self::$instance;
    }

    public function __call($name, $arguments)
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        $method = 'parse_' . $name;

        if (method_exists(self::$instance, $method)) {
            $args = isset($arguments[0]) ? $arguments[0] : null;
            return self::$instance->{$method}($args);
        }

        return self::$instance;
    }

    protected function parse_algos($algorithms)
    {
        if ( ! is_array($algorithms)) {
            throw new \Exception('');
        }

        $this->algorithms = $algorithms;

        return $this;
    }

    protected function parse_string($string)
    {
        if ( ! is_string($string)) {
            throw new \Exception('');
        }

        $this->string = $string;

        return $this;
    }

    protected function parse_cycles($integer)
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

    protected function parse_output($algorithm)
    {
        if ( ! in_array($algorithm, hash_algos())) {
            throw new \Exception('');
        }

        $this->outputAlgorithm = $algorithm;

        return $this;
    }

    protected function parse_hash()
    {
        return $this->execute();
    }
}
