<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;
use App\Traits\ApiResponse;
use App\Constants\ApiResponseCode;
use ReflectionClass;

class Handler extends ExceptionHandler
{
    use ApiResponse;

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Get a human-readable model name from the model class
     *
     * @param string $modelClass
     * @return string
     */
    private function getModelName(string $modelClass): string
    {
        // Get the short class name (e.g., "Product" from "App\Models\Product")
        $shortName = (new ReflectionClass($modelClass))->getShortName();
        
        // Convert camelCase to Title Case with spaces
        $name = preg_replace('/(?<!^)[A-Z]/', ' $0', $shortName);
        
        // Convert to lowercase for consistency
        return strtolower($name);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    { 
        if ($request->expectsJson()) {
            return $this->handleApiException($request, $e);
        }
      
        return parent::render($request, $e);
    }

    /**
     * Handle API exceptions
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $e
     * @return \Illuminate\Http\JsonResponse
     */
    private function handleApiException($request, Throwable $e)
    {
       
        if ($e instanceof ModelNotFoundException) {
            $modelName = $this->getModelName($e->getModel());
            return $this->errorResponse(
                "The requested {$modelName} could not be found",
                ApiResponseCode::NOT_FOUND
            );
        }

        if ($e instanceof ValidationException) {
            return $this->errorResponse(
                'The request data was invalid',
                ApiResponseCode::UNPROCESSABLE_ENTITY,
                $e->errors()
            );
        }

        if ($e instanceof AuthenticationException) {
            return $this->errorResponse(
                'Authentication is required to access this resource',
                ApiResponseCode::UNAUTHORIZED
            );
        }

        if ($e instanceof AuthorizationException) {
            return $this->errorResponse(
                'You do not have permission to access this resource',
                ApiResponseCode::FORBIDDEN
            );
        }

        if ($e instanceof NotFoundHttpException) {
            return $this->errorResponse(
                'The requested resource was not found',
                ApiResponseCode::NOT_FOUND
            );
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse(
                'The requested method is not allowed for this resource',
                ApiResponseCode::METHOD_NOT_ALLOWED
            );
        }

        // Handle any other exceptions
        if (config('app.debug')) {
            return $this->errorResponse(
                $e->getMessage(),
                ApiResponseCode::INTERNAL_SERVER_ERROR,
                [
                    'exception' => get_class($e),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTrace()
                ]
            );
        }

        return $this->errorResponse(
            'An unexpected error occurred on the server',
            ApiResponseCode::INTERNAL_SERVER_ERROR
        );
    }
} 