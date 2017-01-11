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
}
