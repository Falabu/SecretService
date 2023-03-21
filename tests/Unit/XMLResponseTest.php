<?php

namespace Tests\Unit;

use App\SecretService\SecretResponseFactory\Response\XMLResponse;
use Tests\TestCase;

class XMLResponseTest extends TestCase
{
    public function testXMLResponseContentIsTheValidData()
    {
        $data = [
            'message' => 'A kankalin sötétben virágzik!'
        ];

        $expected = '<?xml version="1.0" encoding="UTF-8" ?><secret-service><message>A kankalin sötétben virágzik!</message></secret-service>';

        $xmlResponse = new XMLResponse($data);

        $this->assertXmlStringEqualsXmlString($expected, $xmlResponse->getContent());
    }

    public function testXMLResponseHeaderIsSet()
    {
        $xmlResponse = new XMLResponse([]);

        $responseContentType = $xmlResponse->headers->get('content-type');
        $this->assertEquals('application/xml', $responseContentType);
    }
}
