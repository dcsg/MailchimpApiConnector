<?php

namespace MailchimpApi\Tests;

use MailchimpApi\HttpAdapter\HttpAdapterInterface;

/**
 * @author William Durand <william.durand1@gmail.com>
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @param  mixed                $expects
     * @return HttpAdapterInterface
     */
    protected function getMockAdapter($expects = null)
    {
        if (null === $expects) {
            $expects = $this->any();
        }

        $mock = $this->getMock('\MailchimpApi\HttpAdapter\HttpAdapterInterface');
        $mock
            ->expects($expects)
            ->method('getContent')
            ->will($this->returnArgument(0));
        $mock
            ->expects($expects)
            ->method('postContent')
            ->will($this->returnArgument(0));

        return $mock;
    }
}
