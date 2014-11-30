<?php

/**
 * Mock to get a interface for Anax CRequestBasic class
 *
 *
 */
Interface MockCRequestBasic
{
    public function getCurrentUrl();
    public function getServer($key);
}