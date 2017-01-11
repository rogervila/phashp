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
        for ($x = 0; $x <= $this->counter; $x++) {

            /**
             * String to array character by character: "hello" to h,e,l,l,o
             * @var array
             */
            $charactersArray = preg_split('//', $this->hashedString, -1, PREG_SPLIT_NO_EMPTY);

            /**
             * Hash every character with every algorithm
             * @var array
             */
            for ($y = 0; $y < count($charactersArray); $y++) {
                foreach ($this->algorithms as $algorithm) {
                    $charactersArray[$y] = hash($algorithm, $charactersArray[$y]);
                }
            }

            /**
             * Join every hashed character into a string
             * @var string
             */
            $this->hashedString = join('', $charactersArray);
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
