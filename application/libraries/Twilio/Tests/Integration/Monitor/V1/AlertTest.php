<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Monitor\V1;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class AlertTest extends HolodeckTestCase {
    public function testFetchRequest() {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->monitor->v1->alerts("NOaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://monitor.twilio.com/v1/Alerts/NOaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'
        ));
    }

    public function testFetchResponse() {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "alert_text": "alert_text",
                "api_version": "2010-04-01",
                "date_created": "2015-07-30T20:00:00Z",
                "date_generated": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "error_code": "error_code",
                "log_level": "log_level",
                "more_info": "more_info",
                "request_method": "GET",
                "request_url": "http://www.example.com",
                "request_variables": "request_variables",
                "resource_sid": "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "response_body": "response_body",
                "response_headers": "response_headers",
                "sid": "NOaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "url": "http://www.example.com"
            }
            '
        ));

        $actual = $this->twilio->monitor->v1->alerts("NOaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->fetch();

        $this->assertNotNull($actual);
    }

    public function testDeleteRequest() {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->monitor->v1->alerts("NOaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->delete();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'delete',
            'https://monitor.twilio.com/v1/Alerts/NOaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'
        ));
    }

    public function testDeleteResponse() {
        $this->holodeck->mock(new Response(
            204,
            null
        ));

        $actual = $this->twilio->monitor->v1->alerts("NOaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->delete();

        $this->assertTrue($actual);
    }

    public function testReadRequest() {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->monitor->v1->alerts->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://monitor.twilio.com/v1/Alerts'
        ));
    }

    public function testReadEmptyResponse() {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "alerts": [],
                "meta": {
                    "first_page_url": "https://monitor.twilio.com/v1/Alerts?Page=0&PageSize=50",
                    "key": "alerts",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 0,
                    "previous_page_url": null,
                    "url": "https://monitor.twilio.com/v1/Alerts"
                }
            }
            '
        ));

        $actual = $this->twilio->monitor->v1->alerts->read();

        $this->assertNotNull($actual);
    }

    public function testReadFullResponse() {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "alerts": [
                    {
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "alert_text": "alert_text",
                        "api_version": "2010-04-01",
                        "date_created": "2015-07-30T20:00:00Z",
                        "date_generated": "2015-07-30T20:00:00Z",
                        "date_updated": "2015-07-30T20:00:00Z",
                        "error_code": "error_code",
                        "log_level": "log_level",
                        "more_info": "more_info",
                        "request_method": "GET",
                        "request_url": "http://www.example.com",
                        "resource_sid": "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "sid": "NOaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "url": "http://www.example.com"
                    }
                ],
                "meta": {
                    "first_page_url": "https://monitor.twilio.com/v1/Alerts?Page=0&PageSize=50",
                    "key": "alerts",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 1,
                    "previous_page_url": null,
                    "url": "https://monitor.twilio.com/v1/Alerts"
                }
            }
            '
        ));

        $actual = $this->twilio->monitor->v1->alerts->read();

        $this->assertGreaterThan(0, count($actual));
    }
}