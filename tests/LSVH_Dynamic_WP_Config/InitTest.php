<?php

namespace LSVH_Dynamic_WP_Config;

use PHPUnit\Framework\TestCase;

//use \LSVH_Dynamic_WP_Config\Init as Dynamic_Config;

final class InitTest extends TestCase
{
    public function testCanLoadLibrary(): void
    {
        $this->assertEquals(true, class_exists(Init::class));
    }

    public function testCanWithoutPathReturnString(): void
    {
    	$this->assertEquals(true, is_string(Init::without_path()));	
    }

    public function testCanWithPathReturnString(): void
    {
    	$this->assertEquals(true, is_string(Init::with_path()));	
    }
}