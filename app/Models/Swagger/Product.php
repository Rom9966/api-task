<?php

namespace App\Models\Swagger;

/**
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     title="Product",
 *     description="Product model",
 *     @OA\Property(property="id", type="integer", format="int64", example=1),
 *     @OA\Property(property="name", type="string", example="iPhone 13"),
 *     @OA\Property(property="description", type="string", example="Latest iPhone model with amazing features"),
 *     @OA\Property(property="price", type="number", format="float", example=999.99),
 *     @OA\Property(property="stock", type="integer", example=100),
 *     @OA\Property(property="status", type="boolean", example=true),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */

/**
 * @OA\Schema(
 *     schema="ProductRequest",
 *     type="object",
 *     required={"name", "description", "price", "stock"},
 *     @OA\Property(property="name", type="string", example="iPhone 13"),
 *     @OA\Property(property="description", type="string", example="Latest iPhone model with amazing features"),
 *     @OA\Property(property="price", type="number", format="float", example=999.99),
 *     @OA\Property(property="stock", type="integer", example=100),
 *     @OA\Property(property="status", type="boolean", example=true)
 * )
 */ 