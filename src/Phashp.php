<?php

namespace Phashp;

use Phashp\Helpers\DefaultAlgorithms;
use Phashp\Helpers\Hasher;

class Phashp
{
    use DefaultAlgorithms, Hasher;

    /**
     * @var Phashp
     */
    protected static $instance;

    /**
     * @var array
     */
    protected $defaultAlgorithms;

    /**
     * @var array
     */
    protected $algorithms;

    /**
     * @var string
     */
    protected $outputAlgorithm;

    /**
     * @var string
     */
    protected $string;

    /**
     * @var int
     */
    protected $counter;

    /**
     * @var string
     */
    protected $hashedString;

    /**
     * Phashp constructor.
     */
    public function __construct()
    {
        $this->algorithms = $this->getDefaultAlgorithms();
        $this->counter = 1;
    }

    /**
     * @param $name
     * @param $arguments
     * @return Phashp
     */
    public static function __callStatic($name, $arguments)
    {
        return self::handle($name, $arguments);
    }

    /**
     * @param $name
     * @param $arguments
     * @return Phashp
     */
    public function __call($name, $arguments)
    {
        return self::handle($name, $arguments);
    }

    /**
     * @param $name
     * @param $arguments
     * @return Phashp
     */
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

    /**
     * @param $algorithms
     * @return $this
     * @throws \Exception
     */
    protected function parseAlgos($algorithms)
    {
        if ( ! is_array($algorithms)) {
            throw new \Exception('');
        }

        $this->algorithms = $algorithms;

        return $this;
    }

    /**
     * @param $integer
     * @return $this
     * @throws \Exception
     */
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

    /**
     * @param $algorithm
     * @return $this
     * @throws \Exception
     */
    protected function parseOutput($algorithm)
    {
        if ( ! in_array($algorithm, hash_algos())) {
            throw new \Exception('');
        }

        $this->outputAlgorithm = $algorithm;

        return $this;
    }

    /**
     * @param $string
     * @return string
     * @throws \Exception
     */
    protected function parseHash($string)
    {
        if ( ! is_string($string)) {
            throw new \Exception('');
        }

        $this->string = $string;

        return $this->execute();
    }
}
