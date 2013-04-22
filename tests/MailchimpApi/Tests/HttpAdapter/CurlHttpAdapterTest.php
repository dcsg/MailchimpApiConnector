<?php

namespace MailchimpApi\Tests\HttpAdapter;

use MailchimpApi\HttpAdapter\CurlHttpAdapter;
use MailchimpApi\Tests\TestCase;

/**
 * @author William Durand <william.durand1@gmail.com>
 */
class CurlHttpAdapterTest extends TestCase
{
    protected function setUp()
    {
        if (!function_exists('curl_init')) {
            $this->markTestSkipped('cURL has to be enabled.');
        }
    }

    public function testGetNullContent()
    {
        $curl = new CurlHttpAdapter();
        $this->assertNull($curl->getContent(null));
    }

    public function testGetFalseContent()
    {
        $curl = new CurlHttpAdapter();
        $this->assertNull($curl->getContent(null));
    }
}
