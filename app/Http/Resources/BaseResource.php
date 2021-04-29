<?php

/** @noinspection PhpMissingFieldTypeInspection */

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class BaseResource extends JsonResource
{
    public static $wrap = 'record';

    public function with($request): array
    {
        $status = 200;

        if (
            $this->resource instanceof Model &&
            $this->resource->wasRecentlyCreated
        ) {
            $status = 201;
        }

        return [
            'status' => $status
        ];
    }

    /**
     * Customize the response for a request.
     *
     * @param Request|mixed $request
     * @param JsonResponse|mixed $response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $response->setEncodingOptions($response->getEncodingOptions() | JSON_UNESCAPED_UNICODE);
    }
}
