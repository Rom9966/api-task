<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Constants\ApiResponseCode;

/**
 * Trait ApiResponse
 * 
 * This trait provides standardized API response methods for consistent
 * response formatting across the application.
 */
trait ApiResponse
{
    /**
     * Success Response
     *
     * @param mixed $data
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    protected function successResponse($data, ?string $message = null, int $code = ApiResponseCode::SUCCESS): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Error Response
     *
     * @param string $message
     * @param int $code
     * @param mixed $errors
     * @return JsonResponse
     */
    protected function errorResponse(string $message, int $code = ApiResponseCode::BAD_REQUEST, $errors = null): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message ?? ApiResponseCode::getMessage($code),
            'errors' => $errors
        ], $code);
    }

    /**
     * Resource Response
     *
     * @param JsonResource $resource
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    protected function resourceResponse(JsonResource $resource, ?string $message = null, int $code = ApiResponseCode::SUCCESS): JsonResponse
    {
        return $this->successResponse($resource, $message, $code);
    }

    /**
     * Collection Response
     *
     * @param ResourceCollection $collection
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    protected function collectionResponse(ResourceCollection $collection, ?string $message = null, int $code = ApiResponseCode::SUCCESS): JsonResponse
    {
        return $this->successResponse($collection, $message, $code);
    }

    /**
     * Paginated Response
     *
     * @param LengthAwarePaginator $paginator
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    protected function paginatedResponse(LengthAwarePaginator $paginator, ?string $message = null, int $code = ApiResponseCode::SUCCESS): JsonResponse
    {
        return $this->successResponse($paginator, $message, $code);
    }

    /**
     * No Content Response
     *
     * @param string|null $message
     * @return JsonResponse
     */
    protected function noContentResponse(?string $message = null): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message
        ], ApiResponseCode::NO_CONTENT);
    }

    /**
     * Not Found Response
     *
     * @param string|null $message
     * @return JsonResponse
     */
    protected function notFoundResponse(?string $message = null): JsonResponse
    {
        return $this->errorResponse(
            $message ?? ApiResponseCode::getMessage(ApiResponseCode::NOT_FOUND),
            ApiResponseCode::NOT_FOUND
        );
    }

    /**
     * Validation Error Response
     *
     * @param mixed $errors
     * @param string|null $message
     * @return JsonResponse
     */
    protected function validationErrorResponse($errors, ?string $message = null): JsonResponse
    {
        return $this->errorResponse(
            $message ?? ApiResponseCode::getMessage(ApiResponseCode::UNPROCESSABLE_ENTITY),
            ApiResponseCode::UNPROCESSABLE_ENTITY,
            $errors
        );
    }

    /**
     * Unauthorized Response
     *
     * @param string|null $message
     * @return JsonResponse
     */
    protected function unauthorizedResponse(?string $message = null): JsonResponse
    {
        return $this->errorResponse(
            $message ?? ApiResponseCode::getMessage(ApiResponseCode::UNAUTHORIZED),
            ApiResponseCode::UNAUTHORIZED
        );
    }

    /**
     * Forbidden Response
     *
     * @param string|null $message
     * @return JsonResponse
     */
    protected function forbiddenResponse(?string $message = null): JsonResponse
    {
        return $this->errorResponse(
            $message ?? ApiResponseCode::getMessage(ApiResponseCode::FORBIDDEN),
            ApiResponseCode::FORBIDDEN
        );
    }

    /**
     * Server Error Response
     *
     * @param string|null $message
     * @param mixed $errors
     * @return JsonResponse
     */
    protected function serverErrorResponse(?string $message = null, $errors = null): JsonResponse
    {
        return $this->errorResponse(
            $message ?? ApiResponseCode::getMessage(ApiResponseCode::INTERNAL_SERVER_ERROR),
            ApiResponseCode::INTERNAL_SERVER_ERROR,
            $errors
        );
    }
} 