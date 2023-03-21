<?php

namespace App\SecretService\SecretFormRequest;

use App\SecretService\SecretResponseFactory\ISecretResponseFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class SecretFormRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $secretResponse = $this->createSecretResponse();

        $responseData = [
            'message' => 'There are validation errors',
            'errors' => $validator->errors()->messages()
        ];

        $response = $secretResponse->make($responseData, 422);

        throw new ValidationException($validator, $response);
    }

    private function createSecretResponse(): ISecretResponseFactory
    {
        return resolve(ISecretResponseFactory::class);
    }
}
