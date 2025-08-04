# API Documentation

This document provides comprehensive API documentation for the Serendib Journeys application, including all endpoints, authentication, and data formats.

## 🔐 Authentication

### Authentication Methods

The API supports two authentication methods:

1. **Session-based Authentication** (Web routes)
2. **Token-based Authentication** (API routes with Sanctum)

### API Token Authentication

To access protected API endpoints, include the Bearer token in the Authorization header:

```
Authorization: Bearer {your-token}
```

## 📋 API Endpoints

### Public Endpoints

#### 1. Tour Management

##### Get All Tours
```
GET /api/tours
```

**Response:**
```json
{
    "data": [
        {
            "id": 1,
            "title": "Colombo City Tour",
            "description": "Explore the vibrant capital city...",
            "price": 150.00,
            "destination": {
                "id": 1,
                "name": "Colombo"
            },
            "available_from": "2024-01-01",
            "available_to": "2024-12-31",
            "average_rating": 4.5,
            "review_count": 12
        }
    ],
    "meta": {
        "current_page": 1,
        "total": 10,
        "per_page": 15
    }
}
```

##### Get Tour Details
```
GET /api/tours/{id}
```

**Response:**
```json
{
    "data": {
        "id": 1,
        "title": "Colombo City Tour",
        "description": "Explore the vibrant capital city...",
        "price": 150.00,
        "itinerary": "Day 1: Visit temples...",
        "destination": {
            "id": 1,
            "name": "Colombo",
            "description": "Capital city of Sri Lanka"
        },
        "reviews": [
            {
                "id": 1,
                "rating": 5,
                "comment": "Excellent tour!",
                "user_name": "John Doe",
                "created_at": "2024-01-15T10:30:00Z"
            }
        ],
        "available_from": "2024-01-01",
        "available_to": "2024-12-31"
    }
}
```

#### 2. Destination Management

##### Get All Destinations
```
GET /api/destinations
```

**Response:**
```json
{
    "data": [
        {
            "id": 1,
            "name": "Colombo",
            "description": "Capital city of Sri Lanka",
            "image": "destinations/colombo.jpg",
            "tour_count": 5
        }
    ]
}
```

#### 3. Blog Management

##### Get All Blog Posts
```
GET /api/blogs
```

**Parameters:**
- `page` (optional): Page number for pagination
- `per_page` (optional): Items per page (default: 10)

**Response:**
```json
{
    "data": [
        {
            "id": 1,
            "title": "Best Places to Visit in Sri Lanka",
            "slug": "best-places-sri-lanka",
            "excerpt": "Discover the most beautiful destinations...",
            "featured_image": "blogs/sri-lanka-travel.jpg",
            "author": {
                "id": 1,
                "name": "Admin User"
            },
            "published_at": "2024-01-15T10:30:00Z",
            "created_at": "2024-01-15T10:30:00Z"
        }
    ],
    "meta": {
        "current_page": 1,
        "total": 25,
        "per_page": 10
    }
}
```

##### Get Blog Post Details
```
GET /api/blogs/{slug}
```

**Response:**
```json
{
    "data": {
        "id": 1,
        "title": "Best Places to Visit in Sri Lanka",
        "slug": "best-places-sri-lanka",
        "content": "Sri Lanka is a beautiful island nation...",
        "excerpt": "Discover the most beautiful destinations...",
        "featured_image": "blogs/sri-lanka-travel.jpg",
        "author": {
            "id": 1,
            "name": "Admin User"
        },
        "meta_title": "Best Places to Visit in Sri Lanka",
        "meta_description": "Discover the most beautiful destinations in Sri Lanka",
        "published_at": "2024-01-15T10:30:00Z"
    }
}
```

### Authenticated Endpoints

#### 1. User Management

##### Get User Profile
```
GET /api/user/profile
```

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "email_verified_at": "2024-01-15T10:30:00Z",
        "roles": [
            {
                "id": 2,
                "name": "Customer",
                "slug": "customer"
            }
        ],
        "created_at": "2024-01-15T10:30:00Z"
    }
}
```

##### Update User Profile
```
PUT /api/user/profile
```

**Headers:**
```
Authorization: Bearer {token}
Content-Type: application/json
```

**Request Body:**
```json
{
    "name": "John Doe Updated",
    "email": "john.updated@example.com"
}
```

**Response:**
```json
{
    "data": {
        "id": 1,
        "name": "John Doe Updated",
        "email": "john.updated@example.com",
        "message": "Profile updated successfully"
    }
}
```

#### 2. Booking Management

##### Get User Bookings
```
GET /api/user/bookings
```

**Headers:**
```
Authorization: Bearer {token}
```

**Parameters:**
- `status` (optional): Filter by status (pending, approved, cancelled, completed)
- `page` (optional): Page number for pagination

**Response:**
```json
{
    "data": [
        {
            "id": 1,
            "tour": {
                "id": 1,
                "title": "Colombo City Tour",
                "price": 150.00
            },
            "booking_date": "2024-02-15",
            "guests": 2,
            "total_price": 300.00,
            "status": "approved",
            "payment_status": "paid",
            "created_at": "2024-01-15T10:30:00Z"
        }
    ],
    "meta": {
        "current_page": 1,
        "total": 5,
        "per_page": 15
    }
}
```

##### Get Booking Details
```
GET /api/user/bookings/{id}
```

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
    "data": {
        "id": 1,
        "tour": {
            "id": 1,
            "title": "Colombo City Tour",
            "description": "Explore the vibrant capital city...",
            "price": 150.00,
            "itinerary": "Day 1: Visit temples...",
            "destination": {
                "id": 1,
                "name": "Colombo"
            }
        },
        "booking_date": "2024-02-15",
        "guests": 2,
        "total_price": 300.00,
        "status": "approved",
        "payment_status": "paid",
        "guest_name": "John Doe",
        "guest_email": "john@example.com",
        "guest_phone": "+1234567890",
        "special_requests": "Vegetarian meals preferred",
        "payment": {
            "id": 1,
            "amount": 300.00,
            "payment_method": "stripe",
            "status": "completed",
            "transaction_id": "pi_1234567890"
        },
        "created_at": "2024-01-15T10:30:00Z"
    }
}
```

##### Create Booking
```
POST /api/user/bookings
```

**Headers:**
```
Authorization: Bearer {token}
Content-Type: application/json
```

**Request Body:**
```json
{
    "tour_id": 1,
    "booking_date": "2024-02-15",
    "guests": 2,
    "guest_name": "John Doe",
    "guest_email": "john@example.com",
    "guest_phone": "+1234567890",
    "special_requests": "Vegetarian meals preferred"
}
```

**Response:**
```json
{
    "data": {
        "id": 1,
        "tour": {
            "id": 1,
            "title": "Colombo City Tour",
            "price": 150.00
        },
        "booking_date": "2024-02-15",
        "guests": 2,
        "total_price": 300.00,
        "status": "pending",
        "payment_status": "unpaid",
        "message": "Booking created successfully"
    }
}
```

##### Cancel Booking
```
DELETE /api/user/bookings/{id}
```

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
    "data": {
        "id": 1,
        "status": "cancelled",
        "message": "Booking cancelled successfully"
    }
}
```

#### 3. Payment Management

##### Create Payment Intent
```
POST /api/user/payments/create-intent
```

**Headers:**
```
Authorization: Bearer {token}
Content-Type: application/json
```

**Request Body:**
```json
{
    "booking_id": 1
}
```

**Response:**
```json
{
    "data": {
        "client_secret": "pi_1234567890_secret_abc123",
        "payment_intent_id": "pi_1234567890",
        "amount": 30000,
        "currency": "usd"
    }
}
```

##### Process Payment
```
POST /api/user/payments/process
```

**Headers:**
```
Authorization: Bearer {token}
Content-Type: application/json
```

**Request Body:**
```json
{
    "payment_intent_id": "pi_1234567890",
    "booking_id": 1
}
```

**Response:**
```json
{
    "data": {
        "success": true,
        "message": "Payment processed successfully",
        "booking": {
            "id": 1,
            "status": "approved",
            "payment_status": "paid"
        }
    }
}
```

#### 4. Review Management

##### Get Tour Reviews
```
GET /api/tours/{id}/reviews
```

**Parameters:**
- `page` (optional): Page number for pagination
- `rating` (optional): Filter by rating (1-5)

**Response:**
```json
{
    "data": [
        {
            "id": 1,
            "rating": 5,
            "comment": "Excellent tour experience!",
            "user_name": "John Doe",
            "created_at": "2024-01-15T10:30:00Z"
        }
    ],
    "meta": {
        "current_page": 1,
        "total": 12,
        "per_page": 10,
        "average_rating": 4.5
    }
}
```

##### Create Review
```
POST /api/tours/{id}/reviews
```

**Headers:**
```
Authorization: Bearer {token}
Content-Type: application/json
```

**Request Body:**
```json
{
    "rating": 5,
    "comment": "Excellent tour experience!"
}
```

**Response:**
```json
{
    "data": {
        "id": 1,
        "rating": 5,
        "comment": "Excellent tour experience!",
        "message": "Review submitted successfully"
    }
}
```

### Admin Endpoints

#### 1. Dashboard Statistics

##### Get Dashboard Stats
```
GET /api/admin/dashboard
```

**Headers:**
```
Authorization: Bearer {admin-token}
```

**Response:**
```json
{
    "data": {
        "total_bookings": 150,
        "pending_bookings": 25,
        "approved_bookings": 100,
        "total_revenue": 45000.00,
        "total_users": 75,
        "total_tours": 20,
        "total_blogs": 15,
        "monthly_bookings": [10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65],
        "monthly_revenue": [1500, 2250, 3000, 3750, 4500, 5250, 6000, 6750, 7500, 8250, 9000, 9750],
        "booking_status_distribution": {
            "pending": 25,
            "approved": 100,
            "cancelled": 15,
            "completed": 10
        },
        "recent_bookings": [
            {
                "id": 1,
                "tour_title": "Colombo City Tour",
                "user_name": "John Doe",
                "total_price": 300.00,
                "status": "approved",
                "created_at": "2024-01-15T10:30:00Z"
            }
        ],
        "top_tours": [
            {
                "id": 1,
                "title": "Colombo City Tour",
                "booking_count": 25,
                "total_revenue": 3750.00
            }
        ]
    }
}
```

#### 2. Booking Management (Admin)

##### Get All Bookings
```
GET /api/admin/bookings
```

**Headers:**
```
Authorization: Bearer {admin-token}
```

**Parameters:**
- `status` (optional): Filter by status
- `payment_status` (optional): Filter by payment status
- `date_from` (optional): Filter by date range
- `date_to` (optional): Filter by date range
- `page` (optional): Page number for pagination

**Response:**
```json
{
    "data": [
        {
            "id": 1,
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com"
            },
            "tour": {
                "id": 1,
                "title": "Colombo City Tour",
                "price": 150.00
            },
            "booking_date": "2024-02-15",
            "guests": 2,
            "total_price": 300.00,
            "status": "approved",
            "payment_status": "paid",
            "guest_name": "John Doe",
            "guest_email": "john@example.com",
            "created_at": "2024-01-15T10:30:00Z"
        }
    ],
    "meta": {
        "current_page": 1,
        "total": 150,
        "per_page": 15
    }
}
```

##### Update Booking Status
```
PATCH /api/admin/bookings/{id}/status
```

**Headers:**
```
Authorization: Bearer {admin-token}
Content-Type: application/json
```

**Request Body:**
```json
{
    "status": "approved",
    "guide_id": 5
}
```

**Response:**
```json
{
    "data": {
        "id": 1,
        "status": "approved",
        "guide_id": 5,
        "message": "Booking status updated successfully"
    }
}
```

#### 3. Tour Management (Admin)

##### Create Tour
```
POST /api/admin/tours
```

**Headers:**
```
Authorization: Bearer {admin-token}
Content-Type: application/json
```

**Request Body:**
```json
{
    "destination_id": 1,
    "title": "New Tour Package",
    "description": "Explore beautiful destinations...",
    "price": 200.00,
    "itinerary": "Day 1: Visit temples...",
    "available_from": "2024-01-01",
    "available_to": "2024-12-31"
}
```

**Response:**
```json
{
    "data": {
        "id": 2,
        "title": "New Tour Package",
        "description": "Explore beautiful destinations...",
        "price": 200.00,
        "message": "Tour created successfully"
    }
}
```

##### Update Tour
```
PUT /api/admin/tours/{id}
```

**Headers:**
```
Authorization: Bearer {admin-token}
Content-Type: application/json
```

**Request Body:**
```json
{
    "title": "Updated Tour Package",
    "price": 250.00
}
```

**Response:**
```json
{
    "data": {
        "id": 2,
        "title": "Updated Tour Package",
        "price": 250.00,
        "message": "Tour updated successfully"
    }
}
```

##### Delete Tour
```
DELETE /api/admin/tours/{id}
```

**Headers:**
```
Authorization: Bearer {admin-token}
```

**Response:**
```json
{
    "data": {
        "message": "Tour deleted successfully"
    }
}
```

## 🔄 Webhook Endpoints

### Stripe Webhook

##### Stripe Payment Webhook
```
POST /api/stripe/webhook
```

**Headers:**
```
Stripe-Signature: {stripe-signature}
Content-Type: application/json
```

**Request Body:**
```json
{
    "id": "evt_1234567890",
    "object": "event",
    "type": "payment_intent.succeeded",
    "data": {
        "object": {
            "id": "pi_1234567890",
            "amount": 30000,
            "currency": "usd",
            "metadata": {
                "booking_id": "1"
            }
        }
    }
}
```

**Response:**
```json
{
    "success": true,
    "message": "Webhook processed successfully"
}
```

## 📊 Error Responses

### Standard Error Format

```json
{
    "error": {
        "message": "Error description",
        "code": "ERROR_CODE",
        "details": {
            "field": "Specific field error"
        }
    }
}
```

### Common Error Codes

| Code | Description | HTTP Status |
|------|-------------|-------------|
| `UNAUTHORIZED` | Authentication required | 401 |
| `FORBIDDEN` | Insufficient permissions | 403 |
| `NOT_FOUND` | Resource not found | 404 |
| `VALIDATION_ERROR` | Request validation failed | 422 |
| `PAYMENT_FAILED` | Payment processing failed | 400 |
| `BOOKING_CONFLICT` | Booking date conflict | 409 |

### Example Error Responses

#### Validation Error
```json
{
    "error": {
        "message": "The given data was invalid.",
        "code": "VALIDATION_ERROR",
        "details": {
            "booking_date": ["The booking date must be a date after today."],
            "guests": ["The guests must be at least 1."]
        }
    }
}
```

#### Authentication Error
```json
{
    "error": {
        "message": "Unauthenticated.",
        "code": "UNAUTHORIZED"
    }
}
```

## 🔧 Rate Limiting

### Rate Limits

- **Public endpoints**: 60 requests per minute
- **Authenticated endpoints**: 120 requests per minute
- **Admin endpoints**: 300 requests per minute

### Rate Limit Headers

```
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 45
X-RateLimit-Reset: 1642234567
```

## 📝 Pagination

### Pagination Format

All list endpoints support pagination with the following format:

```json
{
    "data": [...],
    "meta": {
        "current_page": 1,
        "last_page": 5,
        "per_page": 15,
        "total": 75,
        "from": 1,
        "to": 15
    },
    "links": {
        "first": "https://api.example.com/endpoint?page=1",
        "last": "https://api.example.com/endpoint?page=5",
        "prev": null,
        "next": "https://api.example.com/endpoint?page=2"
    }
}
```

## 🔍 Filtering and Sorting

### Common Filter Parameters

- `status`: Filter by status
- `date_from`: Filter by start date
- `date_to`: Filter by end date
- `price_min`: Minimum price filter
- `price_max`: Maximum price filter
- `rating`: Filter by rating

### Sorting Parameters

- `sort_by`: Field to sort by
- `sort_order`: `asc` or `desc`

### Example with Filters

```
GET /api/tours?status=active&price_min=100&price_max=500&sort_by=price&sort_order=asc
```

---

This API documentation provides comprehensive coverage of all endpoints, authentication methods, and data formats for the Serendib Journeys application. 