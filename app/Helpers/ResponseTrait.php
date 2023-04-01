<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait ResponseTrait
{
    /**
     * Return response in json.
     */
    public function responseJson($data, $code): JsonResponse
    {
        return response()->json($data, $code);
    }

    private function wrapSuccess($data): array
    {
        return [
            'success' => true,
            'data' => $data
        ];
    }

    private function wrapError($error, $code): array
    {
        return [
            'success' => false,
            'code' => $code,
            'error' => $error
        ];
    }

    /**
     * 200 - ok
     */
    protected function OK($data = []): JsonResponse
    {
        return $this->responseJson($this->wrapSuccess($data), ResponseAlias::HTTP_OK);
    }

    /**
     * 201 - created
     */
    protected function CREATED(array $data = []): JsonResponse
    {
        return $this->responseJson($this->wrapSuccess($data), ResponseAlias::HTTP_CREATED);
    }

    /**
     * 202 - accepted
     */
    protected function ACCEPTED(array $data = []): JsonResponse
    {
        return $this->responseJson($this->wrapSuccess($data), ResponseAlias::HTTP_ACCEPTED);
    }

    /**
     * 204 - no content
     */
    protected function NO_CONTENT(array $data = []): JsonResponse
    {
        return $this->responseJson($this->wrapSuccess($data), ResponseAlias::HTTP_NO_CONTENT);
    }

    /**
     * 401 - unauthorized
     */
    protected function UNAUTHORIZED(string $error = ""): JsonResponse
    {
        if ($error == "") {
            $error = __('http requests.401');
        }
        return $this->responseJson($this->wrapError($error, ResponseAlias::HTTP_UNAUTHORIZED), ResponseAlias::HTTP_UNAUTHORIZED);
    }

    /**
     * 403 - forbidden
     */
    protected function FORBIDDEN(string $error = ""): JsonResponse
    {
        if ($error == "") {
            $error = __('http requests.403');
        }
        return $this->responseJson($this->wrapError($error, ResponseAlias::HTTP_FORBIDDEN), ResponseAlias::HTTP_FORBIDDEN);
    }

    /**
     * 404 - not found
     */
    protected function NOT_FOUND(string $error = ""): JsonResponse
    {
        if ($error == "") {
            $error = __('http requests.404');
        }
        return $this->responseJson($this->wrapError($error, ResponseAlias::HTTP_NOT_FOUND), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * 409 - conflict
     */
    protected function CONFLICT(string $error = ""): JsonResponse
    {
        if ($error == "") {
            $error = __('http requests.409');
        }
        return $this->responseJson($this->wrapError($error, ResponseAlias::HTTP_CONFLICT), ResponseAlias::HTTP_CONFLICT);
    }

    /**
     * 422 - unprocessable
     */
    protected function UNPROCESSABLE(string $error = ""): JsonResponse
    {
        if ($error == "") {
            $error = __('http requests.422');
        }
        return $this->responseJson($this->wrapError($error, ResponseAlias::HTTP_UNPROCESSABLE_ENTITY), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
    }
}
