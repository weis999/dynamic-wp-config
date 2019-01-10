<?php

namespace LSVH\WordPress\DynamicConfig;

use PHPUnit\Framework\TestCase;

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