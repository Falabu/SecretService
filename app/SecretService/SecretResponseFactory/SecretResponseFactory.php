<?php

namespace App\SecretService\SecretResponseFactory;

use App\SecretService\SecretResponseFactory\Response\XMLResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecretResponseFactory implements ISecretResponseFactory
{
    public function __construct(private readonly Request $request)
    {
    }

    public function make(array $data, int $status = 200, array $headers = []): Response
    {
        $acceptHeader = $this->request?->headers?->get('Accept');

        return match ($acceptHeader) {
            'application/xml' => $this->createResponse(XMLResponse::class, $data, $status, $headers),
            default => $this->createResponse(JsonResponse::class, $data, $status, $headers)
        };
    }

    private function createResponse(string $class, array $data, int $status = 200, array $headers = []): Response
    {
        return resolve($class, [
            'data' => $data,
            'status' => $status,
            'headers' => $headers,
        ]);
    }
}
