<?php

namespace App\SecretService\SecretFormRequest;

use App\SecretService\SecretResponseFactory\ISecretResponseFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Exceptions\Handler;
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

        /**
         * Laravel makes a Response object, when a ValidationException thrown,
         * But can't handle XMLResponses
         * When response added to the exception laravel response with that
         * @see Handler::convertValidationExceptionToResponse()
         */
        throw new ValidationException($validator, $response);
    }

    private function createSecretResponse(): ISecretResponseFactory
    {
        return resolve(ISecretResponseFactory::class);
    }
}
