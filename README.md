# Laravel API Task

A RESTful API built with Laravel featuring clean architecture, repository pattern, and comprehensive documentation.

## Features

- RESTful CRUD API for Products
- Repository Pattern Implementation
- Form Request Validation
- API Resource Transformers
- Standardized API Responses
- Swagger/OpenAPI Documentation
- Global Error Handling
- Pagination Support

## Requirements

- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Laravel >= 10.0

## Installation

1. Clone the repository:
```bash
git clone https://github.com/Rom9966/api-task.git
cd api-task
```

2. Install dependencies:
```bash
composer install
```

3. Copy environment file:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Configure your database in `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Run migrations:
```bash
php artisan migrate
```

7. Start the development server:
```bash
php artisan serve
```

## API Documentation

The API documentation is available at `/api/documentation` after starting the server.

### Available Endpoints

#### Products

- `GET /api/products` - List all products (paginated)
- `POST /api/products` - Create a new product
- `GET /api/products/{id}` - Get a specific product
- `PUT /api/products/{id}` - Update a product
- `DELETE /api/products/{id}` - Delete a product

### Response Format

All API responses follow this format:

```json
{
    "success": true,
    "message": "Success message",
    "data": {
        // Response data
    }
}
```

Error responses:
```json
{
    "success": false,
    "message": "Error message",
    "errors": {
        // Validation errors or additional error details
    }
}
```

## Pagination

The `/api/products` endpoint supports pagination with the following query parameters:

- `page`: The page number (default: 1)
- `per_page`: The number of items per page (default: 10)

Example request:
```
GET /api/products?page=2&per_page=20
```

## Project Structure

```
app/
├── Constants/
│   └── ApiResponseCode.php
├── Http/
│   ├── Controllers/
│   │   └── ProductController.php
│   ├── Requests/
│   │   └── ProductRequest.php
│   └── Resources/
│       ├── ProductResource.php
│       └── ProductCollection.php
├── Models/
│   └── Product.php
├── Repositories/
│   ├── Interfaces/
│   │   └── ProductRepositoryInterface.php
│   └── ProductRepository.php
└── Traits/
    └── ApiResponse.php
```

## Testing

Run the test suite:
```bash
php artisan test
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Author

Roman - [romamar565@gmail.com](mailto:romamar565@gmail.com)
