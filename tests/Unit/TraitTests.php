<?php

namespace Nginx\SecureLink\Tests\Unit;

use Nginx\SecureLink\Tests\ModelExample;
use Nginx\SecureLink\Tests\TestCase;

class TraitTests extends TestCase
{
    public function test_should_build_secure_link()
    {
        $link = 'https://yourdomain.com/secure/archive.zip';
        $model = new ModelExample();
        $model->link = $link;
        $secure_link = $model->secure_link;
        $this->assertStringStartsWith($link, $secure_link);
        $this->assertContains('?md5=', $secure_link);
        $this->assertContains('&expires=', $secure_link);
    }
}
