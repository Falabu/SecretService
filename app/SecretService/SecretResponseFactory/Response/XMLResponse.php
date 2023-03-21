<?php

namespace App\SecretService\SecretResponseFactory\Response;

use Spatie\ArrayToXml\ArrayToXml;
use Symfony\Component\HttpFoundation\Response;

class XMLResponse extends Response
{
    protected string $data;

    public function __construct(array $data, int $status = 200, array $headers = [])
    {
        parent::__construct('', $status, $headers);

        $this->setData($data);
    }

    public function setData(array $data): static
    {
        $xmlString = ArrayToXml::convert($data, 'secret-service');

        return $this->setXml($xmlString);
    }

    public function setXml(string $data): static
    {
        $this->data = $data;
        return $this->update();
    }

    protected function update(): static
    {
        if (!$this->headers->has('Content-Type')) {
            $this->headers->set('Content-Type', 'application/xml');
        }

        return $this->setContent($this->data);
    }
}
