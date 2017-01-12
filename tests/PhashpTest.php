<?php

namespace Rogervila\Tests;

use Phashp\Phashp;

class PhashpTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function methodsAndProperties()
    {
        $phashp = new Phashp();

        // Check Instance
        $this->assertInstanceOf('Phashp\Phashp', $phashp);

        // Check Properties
        foreach (['instance', 'defaultAlgorithms', 'algorithms', 'outputAlgorithm', 'string', 'counter', 'hashedString'] as $property) {
            $this->assertObjectHasAttribute($property, $phashp);
        }

        // Check methods
        foreach (['execute', 'getDefaultAlgorithms', '__callStatic', '__call', 'parseHash', 'parseAlgos', 'parseCycles', 'parseOutput'] as $method) {
            $this->assertTrue(
                method_exists($phashp, $method),
                'Cart does not have method "' . $method . '"'
            );
        }
    }

    /** @test */
    public function alwaysReturnsTheSameValue()
    {
        $string = uniqid();

        $result1 = Phashp::hash($string);
        $result2 = Phashp::hash($string);

        $this->assertEquals($result1, $result2);
    }

    /** @test */
    public function failsIfInvalidAlgorithmIsPassedAsOutput()
    {
        $this->setExpectedException(get_class(new \Exception));

        // send a random string
        Phashp::output(uniqid())->hash(uniqid());
    }

    /** @test */
    public function failsIfArgumentPassedToAlgosIsNotAnArray()
    {
        $this->setExpectedException(get_class(new \Exception));

        // Send a string instead of an array
        Phashp::algos(uniqid())->hash(uniqid());
    }

    /** @test */
    public function failsIfArgumentPassedToCyclesIsNotAnInteger()
    {
        $this->setExpectedException(get_class(new \Exception));

        // Send a string instead of an array
        Phashp::cycles(uniqid())->hash(uniqid());
    }
}
