<?php

namespace Tests\Unit;

use App\SecretService\SecretResponseFactory\Response\XMLResponse;
use App\SecretService\SecretResponseFactory\SecretResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tests\TestCase;

class SecretResponseTest extends TestCase
{
    public function testSecretResponseReturnsXMLResponseOnAcceptXMLHeader()
    {
        $request = new Request();
        $request->headers->set('Accept', 'application/xml');

        $secretService = new SecretResponseFactory($request);

        $this->assertInstanceOf(XMLResponse::class, $secretService->make([]));
    }

    public function testSecretResponseReturnsJSONResponseOnNoAcceptHeaderSet()
    {
        $request = new Request();

        $secretService = new SecretResponseFactory($request);

        $this->assertInstanceOf(JsonResponse::class, $secretService->make([]));
    }
}
