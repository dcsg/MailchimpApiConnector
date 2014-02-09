<?php

namespace MailchimpApiConnector\Tests\HttpAdapter;

use MailchimpApiConnector\HttpAdapter\BuzzHttpAdapter;
use MailchimpApiConnector\Tests\TestCase;

/**
 * @author William Durand <william.durand1@gmail.com>
 */
class BuzzHttpAdapterTest extends TestCase
{
    protected function setUp()
    {
        if (!class_exists('Buzz\Browser')) {
            $this->markTestSkipped('Buzz library has to be installed');
        }
    }

    public function testGetName()
    {
        $buzz = new BuzzHttpAdapter();
        $this->assertEquals('buzz', $buzz->getName());
    }
    
    public function testGetNullContent()
    {
        $buzz = new BuzzHttpAdapter();
        $this->assertNull($buzz->getContent(null));
    }

    public function testGetFalseContent()
    {
        $buzz = new BuzzHttpAdapter();
        $this->assertNull($buzz->getContent(false));
    }

    public function testGetContentWithCustomBrowser()
    {
        $content = 'foobar content';
        $browser = $this->getBrowserMock($content);

        $buzz = new BuzzHttpAdapter($browser);
        $this->assertEquals($content, $buzz->getContent('http://www.example.com'));
    }

    public function testPostNullContent()
    {
        $buzz = new BuzzHttpAdapter(null, false);
        $this->assertNull($buzz->postContent(null));
    }

    public function testPostFalseContent()
    {
        $buzz = new BuzzHttpAdapter();
        $this->assertNull($buzz->postContent(false));
    }

    public function testPostContentWithCustomBrowser()
    {
        $content = 'foobar content';
        $browser = $this->getBrowserMock($content, 'post');

        $buzz = new BuzzHttpAdapter($browser, false);
        $this->assertEquals($content, $buzz->postContent('http://www.example.com'));
    }

    protected function getBrowserMock($content, $method = 'get')
    {
        $mock = $this->getMock('\Buzz\Browser', array($method, 'setVerifyPeer'));
        $mock
            ->expects($this->once())
            ->method($method)
            ->will($this->returnValue($this->getResponseMock($content)));

        return $mock;
    }

    protected function getResponseMock($content, $method = 'getContent')
    {
        $mock = $this->getMock('\Buzz\Message\Response');
        $mock
            ->expects($this->once())
            ->method($method)
            ->will($this->returnValue($content));

        return $mock;
    }
}
