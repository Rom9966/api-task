<?php

namespace App\Constants;

/**
 * Class ApiResponseCode
 * 
 * This class contains all HTTP status codes and their corresponding error messages
 * used throughout the application. It helps maintain consistency in API responses.
 */
class ApiResponseCode
{
    /**
     * Success Status Codes
     */
    public const SUCCESS = 200;
    public const CREATED = 201;
    public const ACCEPTED = 202;
    public const NO_CONTENT = 204;

    /**
     * Client Error Status Codes
     */
    public const BAD_REQUEST = 400;
    public const UNAUTHORIZED = 401;
    public const PAYMENT_REQUIRED = 402;
    public const FORBIDDEN = 403;
    public const NOT_FOUND = 404;
    public const METHOD_NOT_ALLOWED = 405;
    public const CONFLICT = 409;
    public const UNPROCESSABLE_ENTITY = 422;
    public const TOO_MANY_REQUESTS = 429;

    /**
     * Server Error Status Codes
     */
    public const INTERNAL_SERVER_ERROR = 500;
    public const NOT_IMPLEMENTED = 501;
    public const BAD_GATEWAY = 502;
    public const SERVICE_UNAVAILABLE = 503;
    public const GATEWAY_TIMEOUT = 504;

    /**
     * Default error messages for each status code
     */
    public const ERROR_MESSAGES = [
        // Client Errors
        self::BAD_REQUEST => 'The request was invalid or cannot be served',
        self::UNAUTHORIZED => 'Authentication is required to access this resource',
        self::PAYMENT_REQUIRED => 'Payment is required to access this resource',
        self::FORBIDDEN => 'You do not have permission to access this resource',
        self::NOT_FOUND => 'The requested resource was not found',
        self::METHOD_NOT_ALLOWED => 'The requested method is not allowed for this resource',
        self::CONFLICT => 'The request conflicts with the current state of the resource',
        self::UNPROCESSABLE_ENTITY => 'The request data was invalid',
        self::TOO_MANY_REQUESTS => 'Too many requests have been made to this resource',

        // Server Errors
        self::INTERNAL_SERVER_ERROR => 'An unexpected error occurred on the server',
        self::NOT_IMPLEMENTED => 'The requested functionality is not implemented',
        self::BAD_GATEWAY => 'The server received an invalid response from the upstream server',
        self::SERVICE_UNAVAILABLE => 'The server is temporarily unable to handle the request',
        self::GATEWAY_TIMEOUT => 'The server did not receive a timely response from the upstream server',
    ];

    /**
     * Get the error message for a given status code
     *
     * @param int $code
     * @return string
     */
    public static function getMessage(int $code): string
    {
        return self::ERROR_MESSAGES[$code] ?? 'An unknown error occurred';
    }
} 