<?php

namespace BigHairEnergy\Preview\Tests;

use BigHairEnergy\Preview\Preview;
use PHPUnit\Framework\TestCase;

class PreviewTest extends TestCase
{
    public function testIgnoreMigrations()
    {
        $this->assertInstanceOf(Preview::class, Preview::ignoreMigrations());
    }
}
