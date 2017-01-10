<?php

namespace Rogervila;

class Phashp
{

    //PROPERTIES

    /**
     * Algorithms compatible with php 5.3, 5.4, 5.5 and 5.6
     * @var array
     */
    private $accepted_algos = array(
        'md2',
        'md4',
        'md5',
        'sha1',
        'sha224',
        'sha256',
        'sha384',
        'sha512',
        'ripemd128',
        'ripemd160',
        'ripemd256',
        'ripemd320',
        'whirlpool',
        'tiger128,3',
        'tiger160,3',
        'tiger192,3',
        'tiger128,4',
        'tiger160,4',
        'tiger192,4',
        'snefru',
        'snefru256',
        'adler32',
        'crc32',
        'crc32b',
        'haval128,3',
        'haval160,3',
        'haval192,3',
        'haval224,3',
        'haval256,3',
        'haval128,4',
        'haval160,4',
        'haval192,4',
        'haval224,4',
        'haval256,4',
        'haval128,5',
        'haval160,5',
        'haval192,5',
        'haval224,5',
        'haval256,5',
    );

    /**
     * The algos that the hasher will use
     * @var array
     */
    private $algos;

    /**
     * String to be hashed
     * @var [string]
     */
    private $string;

    /**
     * How many times the hash will loop.
     * default: 1
     * @var integer
     */
    private $counter = 1;

    /**
     * At the end, a hash string is returned.
     * The default hash for this is a sha1 string
     * @var string
     */
    private $output_algo = 'sha1';


    //METHODS

    function __construct()
    {

        /**
         * By default, the algos are the accepted algos
         */
        $this->algos = $this->accepted_algos;
    }


    // algos

    /**
     * Sets the algos that will be used
     * @param array $array the algos that will be used
     */
    public function set_algos($array)
    {

        if (is_array($array)) {

            /**
             * Check if the algos are accepted
             */
            foreach ($array as $algo) {

                $valid = in_array($algo, $this->accepted_algos);

                if ( ! $valid) {
                    trigger_error("Error: '$algo' is not a valid hash", E_USER_ERROR);
                }
            }

            /**
             * add the algos
             */
            $this->algos = $array;

            //var_dump($this->algos);

        } else {
            trigger_error("Error: the parameter must be an array", E_USER_ERROR);
        }
    }


    /**
     * Returns the current algos
     * @return array of algos
     */
    public function get_algos()
    {
        return $this->algos;
    }


    /**
     * Returns the accepted algos
     * @return accepted algos array
     */
    public function get_accepted_algos()
    {
        return $this->accepted_algos;
    }


    // output hash


    public function set_output_algo($hash)
    {

        if (is_string($hash)) {

            if (in_array($hash, $this->accepted_algos)) {
                $this->output_algo = $hash;
            } else {
                trigger_error("Error: '$hash' is not a valid hash", E_USER_ERROR);
            }

        } else {
            trigger_error("Error: '$hash' must be an string", E_USER_ERROR);
        }
    }

    public function get_output_algo()
    {
        return $this->output_algo;
    }


    /**
     * Hash the string
     * @param  [String] string to be hashed
     * @return [String] 40 character string
     */
    public function hash($string)
    {

        /**
         * Check if it's a string
         */
        if ( ! is_string($string)) {
            trigger_error("Error: '$string' must be an string", E_USER_ERROR);
        }

        /**
         * Final string
         * @var string
         */
        $this->string = $string;

        /**
         * Repeat hash $counter+1 times
         */
        for ($i = 0; $i <= $this->counter; $i++) {

            /**
             * String to array character by character: "hello" to h,e,l,l,o
             * @var array
             */
            $array = preg_split('//', $this->string, -1, PREG_SPLIT_NO_EMPTY);

            /**
             * Hash every character with every algo
             * @var array
             */
            foreach ($array as $k => $v) {
                foreach ($this->algos as $h) {
                    $array[$k] = hash($h, $array[$k]);
                }
            }

            /**
             * Join every hashed character into a string
             * @var string
             */
            $this->string = join("", $array);
        }

        /**
         * At the end, the string is hashed with the $output_algo hash
         * @var string
         */
        $this->string = hash($this->output_algo, $this->string);

        /**
         * Return it
         */
        return $this->string;

    }


}
