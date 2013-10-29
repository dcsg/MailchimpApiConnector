<?php

namespace MailchimpApiConnector\Tests\HttpAdapter;

use MailchimpApiConnector\HttpAdapter\CurlHttpAdapter;
use MailchimpApiConnector\Tests\TestCase;

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

    public function testGetName()
    {
        $curl = new CurlHttpAdapter();
        $this->assertEquals('curl', $curl->getName());
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

    public function testPostNullContent()
    {
        $curl = new CurlHttpAdapter();
        $this->assertNull($curl->postContent(null));
    }

    public function testPostFalseContent()
    {
        $curl = new CurlHttpAdapter();
        $this->assertNull($curl->postContent(null));
    }
}
