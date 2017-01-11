<?php

namespace Phashp\Helpers;

trait Hasher
{
    protected function execute()
    {
        $this->hashedString = $this->string;
        
        /**
         * Make a new cycle until the counter ends
         */
        for ($i = 0; $i <= $this->counter; $i++) {

            /**
             * String to array character by character: "hello" to h,e,l,l,o
             * @var array
             */
            $array = preg_split('//', $this->hashedString, -1, PREG_SPLIT_NO_EMPTY);

            /**
             * Hash every character with every algo
             * @var array
             */
            foreach ($array as $k => $v) {
                foreach ($this->algorithms as $h) {
                    $array[$k] = hash($h, $array[$k]);
                }
            }

            /**
             * Join every hashed character into a string
             * @var string
             */
            $this->hashedString = join("", $array);
        }

        /**
         * At the end, the string is hashed with the outputAlgorithm hash
         * @var string
         */
        $this->hashedString = hash($this->outputAlgorithm, $this->hashedString);

        /**
         * Return it
         */
        return $this->hashedString;
    }
}
