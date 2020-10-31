<?php
/**
 * User: elnemr
 * Date: 6/25/2020
 */

namespace AElnemr\RestFullResponse;


use AElnemr\RestFullResponse\Helper\EmptyData;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

use Symfony\Component\HttpFoundation\JsonResponse;

trait CoreJsonResponse
{
    /**
     * The request has succeeded.
     *
     * @param array|null $data
     * @param array|null $meta
     * @param string|null $message
     * @param array|null $errors
     * @return JsonResponse
     */
    protected function ok(?array $data = null, ?array $meta = null, ?string $message = null, ?array $errors = null): JsonResponse
    {
        return response()->json($this->body(
            $data,
            $message ?? trans('api.success.success'),
            $meta,
            $errors
        ), 200);
    }

    /**
     * The request has succeeded.
     *
     * @param AnonymousResourceCollection $collection
     * @param string|null $message
     * @return JsonResponse
     */
    protected function okWithPagination(AnonymousResourceCollection $collection, ?string $message = null): JsonResponse
    {
        $collection = json_decode($collection->toResponse(app('request'))->getContent(), true);
        if ($collection) {
            return $this->ok($collection['data'], $collection['meta'], $message);
        }
        return $this->ok(null, null, trans('api.empty_data'));
    }

    /**
     * The request has been fulfilled and resulted in a new resource being created.
     *
     * @param array|null $data
     * @param array|null $meta
     * @param string|null $message
     * @param array|null $errors
     * @return JsonResponse
     */
    protected function created(?array $data = null, ?array $meta = null, ?string $message = null, ?array $errors = null): JsonResponse
    {
        return response()->json($this->body(
            $data,
            $message ?? trans('api.success.created'),
            $meta,
            $errors,
            201
        ), 201);
    }

    /**
     * The request has been accepted for processing, but the processing has not been completed.
     *
     * @param array|null $data
     * @param array|null $meta
     * @param string|null $message
     * @param array|null $errors
     * @return JsonResponse
     */
    protected function accepted(?array $data = null, ?array $meta = null, ?string $message = null, ?array $errors = null): JsonResponse
    {
        return response()->json($this->body(
            $data,
            $message ?? trans('api.success.accepted'),
            $meta,
            $errors,
            202
        ), 202);
    }

    /**
     * The request could not be understood by the server due to malformed syntax.
     * The client SHOULD NOT repeat the request without modifications.
     *
     * @param array|null $errors
     * @param string|null $message
     * @param array|null $data
     * @param array|null $meta
     * @return JsonResponse
     */
    protected function badRequest(?array $errors = null, ?string $message = null, ?array $data = null, ?array $meta = null): JsonResponse
    {
        return response()->json($this->body(
            $data,
            $message ?? trans('api.errors.bad_request'),
            $meta,
            $errors,
            400
        ), 400);
    }

    /**
     * Logical error
     *
     * @param array|null $errors
     * @param string|null $message
     * @param array|null $data
     * @param array|null $meta
     * @return JsonResponse
     */
    protected function conflict(?array $errors = null, ?string $message = null, ?array $data = null, ?array $meta = null): JsonResponse
    {
        return response()->json($this->body(
            $data,
            $message ?? trans('api.errors.conflict'),
            $meta,
            $errors,
            409
        ), 409);
    }

    /**
     * The request requires user authentication.
     *
     * @param array|null $errors
     * @param string|null $message
     * @param mixed $data Response body
     * @param array|null $meta
     * @return JsonResponse
     */
    protected function unauthenticated(?array $errors = null, ?string $message = null, ?array $data = null, ?array $meta = null): JsonResponse
    {
        return response()->json($this->body(
            $data,
            $message ?? trans('api.errors.unauthorized'),
            $meta,
            $errors,
            401
        ), 401);
    }

    /**
     * The original intention was that this code might be used as part of some form of digital cash or micropayment scheme,
     * but that has not happened, and this code is not usually used.
     *
     * @param array|null $errors
     * @param string|null $message
     * @param array|null $data
     * @param array|null $meta
     * @return JsonResponse
     */
    protected function paymentRequired(?array $errors = null, ?string $message = null, ?array $data = null, ?array $meta = null): JsonResponse
    {
        return response()->json($this->body(
            $data,
            $message ?? trans('api.errors.payment_required'),
            $meta,
            $errors,
            402
        ), 402);
    }

    /**
     * The server understood the request, but is refusing to fulfill it.
     * Authorization will not help and the request SHOULD NOT be repeated.
     *
     * @param array|null $errors
     * @param string|null $message
     * @param array|null $data
     * @param array|null $meta
     * @return JsonResponse
     */
    protected function forbidden(?array $errors = null, ?string $message = null, ?array $data = null, ?array $meta = null): JsonResponse
    {
        return response()->json($this->body(
            $data,
            $message ?? trans('api.errors.forbidden'),
            $meta,
            $errors,
            403
        ), 403);
    }

    /**
     * The server has not found anything matching the Request-URI.
     * No indication is given of whether the condition is temporary or permanent.
     *
     * @param array|null $errors
     * @param string|null $message
     * @param mixed $data Response body
     * @param array|null $meta
     * @return JsonResponse
     */
    protected function notFound(?array $errors = null, ?string $message = null, ?array $data = null, ?array $meta = null): JsonResponse
    {
        return response()->json($this->body(
            $data,
            $message ?? trans('api.errors.not_found'),
            $meta,
            $errors,
            404
        ), 404);
    }

    /**
     * The server understands the content type of the request entity,
     * and the syntax of the request entity is correct,
     * but was unable to process the contained instructions.
     *
     * @param array|null $errors
     * @param string|null $message
     * @param array|null $data
     * @param array|null $meta
     * @return JsonResponse
     */
    protected function invalidRequest(?array $errors = null, ?string $message = null, ?array $data = null, ?array $meta = null): JsonResponse
    {
        return response()->json($this->body(
            $data,
            $message ?? trans('api.errors.invalid'),
            $meta,
            $errors,
            422
        ), 422);
    }

    /**
     * Optionally add a parent key to the response body
     *
     * @param array|null $data
     * @param string|null $message
     * @param array|null $meta
     * @param array|null $errors
     * @param int|null $status
     * @return array
     */
    protected function body(?array $data = null,
                            ?string $message = null,
                            ?array $meta = null,
                            ?array $errors = null,
                            ?int $status = 200): array
    {
        return [
            'status' => $status,
            'message' => $message?? EmptyData::string(),
            'response' => [
                'data' => $data?? EmptyData::object(),
                'meta' => $meta?? EmptyData::object(),
            ],
            'errors' => $errors?? EmptyData::object()
        ];
    }
}
