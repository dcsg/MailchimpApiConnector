<?php

namespace MailchimpApi\Tests\HttpAdapter;

use MailchimpApi\HttpAdapter\ZendHttpAdapter;
use MailchimpApi\Tests\TestCase;
use Zend\Http\Client;

/**
 * @author William Durand <william.durand1@gmail.com>
 */
class ZendHttpAdapterTest extends TestCase
{
    protected function setUp()
    {
        if (!class_exists('Zend\Http\Client')) {
            $this->markTestSkipped('Zend library has to be installed');
        }
    }

    public function testGetName()
    {
        $zend = new ZendHttpAdapter();
        $this->assertEquals('zend', $zend->getName());
    }

    public function testGetNullContent()
    {
        $zend = new ZendHttpAdapter();
        $this->assertNull($zend->getContent(null));
    }

    public function testGetFalseContent()
    {
        $zend = new ZendHttpAdapter();
        $this->assertNull($zend->getContent(false));
    }

    public function testGetContentWithCustomAdapter()
    {
        $zend = new ZendHttpAdapter();

        try {
            $content = $zend->getContent('http://www.google.fr');
        } catch (\Exception $e) {
            $this->fail('Exception catched: ' . $e->getMessage());
        }

        $this->assertNotNull($content);
        $this->assertContains('google', $content);
    }

    public function testPostNullContent()
    {
        $zend = new ZendHttpAdapter();
        $this->assertNull($zend->postContent(null));
    }

    public function testPostFalseContent()
    {
        $zend = new ZendHttpAdapter();
        $this->assertNull($zend->postContent(false));
    }

    public function testPostContentWithCustomAdapter()
    {
        $zend = new ZendHttpAdapter();

        try {
            $content = $zend->postContent('http://www.example.com', array(), 'test');
        } catch (\Exception $e) {
            $this->fail('Exception catched: ' . $e->getMessage());
        }

        $this->assertNotNull($content);
        $this->assertContains('Example', $content);
    }
}
