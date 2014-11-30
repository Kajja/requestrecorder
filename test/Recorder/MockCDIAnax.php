<?php

/**
 * Mock class for the CDI class in Anax
 *
 *
 */
class MockCDIAnax {
    
    public function __construct($services)
    {
        foreach ($services as $key => $value) {
            $this->$key = $value;
        }

    }

}