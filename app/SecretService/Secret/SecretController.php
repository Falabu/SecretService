<?php

namespace App\SecretService\Secret;

use App\Http\Controllers\Controller;
use App\SecretService\Secret\Model\Secret;
use App\SecretService\Secret\Request\StoreSecretRequest;
use App\SecretService\Secret\Resource\SecretResource;
use App\SecretService\Secret\Service\ISecretService;
use App\SecretService\SecretResponseFactory\ISecretResponseFactory;
use Symfony\Component\HttpFoundation\Response;

class SecretController extends Controller
{

    public function __construct(
        private readonly ISecretService $secretService,
        private readonly ISecretResponseFactory $response
    ) {
    }

    public function store(StoreSecretRequest $request): Response
    {
        $secret = $request->get('secret');
        $expireAfterViews = $request->get('expireAfterViews');
        $expireAfter = $request->get('expireAfter');

        $secret = $this->secretService->create($secret, $expireAfterViews, $expireAfter);
        $secretResource = SecretResource::make($secret);

        return $this->response->make($secretResource->resolve());
    }

    public function show(Secret $secret): Response
    {
        $secretModel = $this->secretService->retrieve($secret);
        $secretResource = SecretResource::make($secretModel);

        return $this->response->make($secretResource->resolve());
    }
}
