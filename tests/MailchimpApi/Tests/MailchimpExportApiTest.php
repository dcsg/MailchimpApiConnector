<?php

namespace MailchimpApi\Tests;

use MailchimpApi\Exception\MailchimpApiException;
use MailchimpApi\HttpAdapter\CurlHttpAdapter;
use MailchimpApi\MailchimpExportApi;

/**
 * Class MailchimpExportApiTest
 * @package MailchimpApi\Tests
 * @author Daniel Gomes <me@danielcsgomes.com>
 */
class MailchimpExportApiTest extends TestCase
{

    /**
     * @var \MailchimpApi\MailchimpExportApi
     */
    protected $mailchimpExportApi;

    public function setUp()
    {
        $this->mailchimpExportApi = new MailchimpExportApi($this->getMockAdapter($this->never()), 'api_key');
    }

    /**
     * @expectedException \MailchimpApi\Exception\MailchimpApiException
     */
    public function testCallExportApiWithoutApiKey()
    {
        $this->mailchimpExportApi->setApiKey(''); // Test with empty string
        $this->mailchimpExportApi->setApiKey(null); // Test with null string
    }

    public function testCallExportApiWithFakeData()
    {
        $this->mailchimpExportApi->setAdapter($this->getMockAdapter($this->once()), 'api_key');
        $response = $this->mailchimpExportApi->call("list", array(""));
        $this->assertEquals('string', gettype($response));
        $this->assertGreaterThan(0, strlen($response));

    }

    public function testCallExportApiWithRealData()
    {
        if (!isset($_SERVER['MAILCHIMP_API_KEY'])) {
            $this->markTestSkipped('You need to configure the MAILCHIMP_API_KEY value in phpunit.xml');
        }

        if (!isset($_SERVER['MAILCHIMP_LIST_ID'])) {
            $this->markTestSkipped('You need to configure the MAILCHIMP_LIST_ID value in phpunit.xml');
        }

        $this->mailchimpExportApi->setAdapter(new CurlHttpAdapter());
        $this->mailchimpExportApi->setApiKey($_SERVER['MAILCHIMP_API_KEY']);
        $this->mailchimpExportApi->setApiVersion(1.0);

        $params = array(
            "id" => $_SERVER['MAILCHIMP_LIST_ID']
        );
        $response = $this->mailchimpExportApi->call('list', $params);
        $this->assertGreaterThan(0, strlen($response));
        $this->assertNotContains('error', $response);
    }

    public function testCallExportApiWithRealDataAndWithWrongMethod()
    {
        if (!isset($_SERVER['MAILCHIMP_API_KEY'])) {
            $this->markTestSkipped('You need to configure the MAILCHIMP_API_KEY value in phpunit.xml');
        }

        if (!isset($_SERVER['MAILCHIMP_LIST_ID'])) {
            $this->markTestSkipped('You need to configure the MAILCHIMP_LIST_ID value in phpunit.xml');
        }

        $this->mailchimpExportApi->setAdapter(new CurlHttpAdapter());
        $this->mailchimpExportApi->setApiKey($_SERVER['MAILCHIMP_API_KEY']);

        $params = array(
            "id" => $_SERVER['MAILCHIMP_LIST_ID']
        );

        $response = $this->mailchimpExportApi->call('invalid_method', $params);
        $this->assertGreaterThan(0, strlen($response));
        $this->assertContains('Not Found', $response);
    }
}
