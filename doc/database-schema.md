# Database Schema Documentation

This document provides a comprehensive overview of the Serendib Journeys database schema, including all tables, relationships, and data structures.

## 📊 Database Overview

**Database Name**: `serendib_journeys`  
**Engine**: MySQL 8.0+  
**Character Set**: utf8mb4  
**Collation**: utf8mb4_unicode_ci

## 🗂️ Table Structure

### 1. Users Table

**Purpose**: Stores user account information and authentication data.

```sql
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

**Indexes**:
- `PRIMARY KEY` on `id`
- `UNIQUE KEY` on `email`
- `INDEX` on `email_verified_at`

**Relationships**:
- `hasMany` Bookings
- `hasMany` Reviews
- `belongsToMany` Roles (via `role_user`)

### 2. Roles Table

**Purpose**: Defines user roles and permissions.

```sql
CREATE TABLE roles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    description TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

**Indexes**:
- `PRIMARY KEY` on `id`
- `UNIQUE KEY` on `slug`

**Default Roles**:
- `admin`: Full system access
- `customer`: Can book tours and manage profile
- `tour-guide`: Can view assigned bookings

### 3. Role User Table (Pivot)

**Purpose**: Many-to-many relationship between users and roles.

```sql
CREATE TABLE role_user (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    role_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);
```

**Indexes**:
- `PRIMARY KEY` on `id`
- `FOREIGN KEY` on `user_id`
- `FOREIGN KEY` on `role_id`

### 4. Destinations Table

**Purpose**: Stores geographic destinations for tours.

```sql
CREATE TABLE destinations (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NULL,
    image VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

**Indexes**:
- `PRIMARY KEY` on `id`
- `INDEX` on `name`

**Relationships**:
- `hasMany` Tours

### 5. Tours Table

**Purpose**: Stores tour package information.

```sql
CREATE TABLE tours (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    destination_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    itinerary TEXT NOT NULL,
    available_from DATE NOT NULL,
    available_to DATE NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (destination_id) REFERENCES destinations(id) ON DELETE CASCADE
);
```

**Indexes**:
- `PRIMARY KEY` on `id`
- `FOREIGN KEY` on `destination_id`
- `INDEX` on `available_from`
- `INDEX` on `available_to`

**Relationships**:
- `belongsTo` Destination
- `hasMany` Bookings
- `hasMany` Reviews

### 6. Bookings Table

**Purpose**: Stores customer tour bookings and reservation details.

```sql
CREATE TABLE bookings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    tour_id BIGINT UNSIGNED NOT NULL,
    guide_id BIGINT UNSIGNED NULL,
    booking_date DATE NOT NULL,
    guests INT NOT NULL DEFAULT 1,
    status VARCHAR(255) NOT NULL DEFAULT 'pending',
    total_price DECIMAL(10,2) NOT NULL,
    payment_status VARCHAR(255) NOT NULL DEFAULT 'unpaid',
    guest_name VARCHAR(255) NULL,
    guest_email VARCHAR(255) NULL,
    guest_phone VARCHAR(255) NULL,
    special_requests TEXT NULL,
    invoice_path VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE,
    FOREIGN KEY (guide_id) REFERENCES users(id) ON DELETE SET NULL
);
```

**Indexes**:
- `PRIMARY KEY` on `id`
- `FOREIGN KEY` on `user_id`
- `FOREIGN KEY` on `tour_id`
- `FOREIGN KEY` on `guide_id`
- `INDEX` on `status`
- `INDEX` on `payment_status`
- `INDEX` on `booking_date`

**Status Values**:
- `pending`: Awaiting admin approval
- `approved`: Confirmed booking
- `cancelled`: Cancelled booking
- `completed`: Tour completed

**Payment Status Values**:
- `unpaid`: Payment not received
- `paid`: Payment completed
- `refunded`: Payment refunded

**Relationships**:
- `belongsTo` User (customer)
- `belongsTo` Tour
- `belongsTo` User (guide)
- `hasOne` Payment

### 7. Payments Table

**Purpose**: Stores payment transaction records.

```sql
CREATE TABLE payments (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    booking_id BIGINT UNSIGNED NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_method VARCHAR(255) NOT NULL,
    transaction_id VARCHAR(255) NOT NULL,
    status VARCHAR(255) NOT NULL,
    stripe_payment_intent_id VARCHAR(255) NULL,
    stripe_charge_id VARCHAR(255) NULL,
    refund_amount DECIMAL(10,2) NULL,
    refund_reason TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE
);
```

**Indexes**:
- `PRIMARY KEY` on `id`
- `FOREIGN KEY` on `booking_id`
- `UNIQUE KEY` on `transaction_id`
- `INDEX` on `status`

**Status Values**:
- `pending`: Payment processing
- `completed`: Payment successful
- `failed`: Payment failed
- `refunded`: Payment refunded

**Relationships**:
- `belongsTo` Booking

### 8. Reviews Table

**Purpose**: Stores customer reviews and ratings for tours.

```sql
CREATE TABLE reviews (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    tour_id BIGINT UNSIGNED NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    comment TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE
);
```

**Indexes**:
- `PRIMARY KEY` on `id`
- `FOREIGN KEY` on `user_id`
- `FOREIGN KEY` on `tour_id`
- `INDEX` on `rating`

**Relationships**:
- `belongsTo` User
- `belongsTo` Tour

### 9. Blogs Table

**Purpose**: Stores blog posts and content management.

```sql
CREATE TABLE blogs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    content TEXT NOT NULL,
    excerpt TEXT NULL,
    featured_image VARCHAR(255) NULL,
    author_id BIGINT UNSIGNED NULL,
    status VARCHAR(255) NOT NULL DEFAULT 'draft',
    published_at TIMESTAMP NULL,
    meta_title VARCHAR(255) NULL,
    meta_description TEXT NULL,
    meta_keywords TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL
);
```

**Indexes**:
- `PRIMARY KEY` on `id`
- `UNIQUE KEY` on `slug`
- `FOREIGN KEY` on `author_id`
- `INDEX` on `status`
- `INDEX` on `published_at`

**Status Values**:
- `draft`: Not published
- `published`: Live on website
- `archived`: Archived content

**Relationships**:
- `belongsTo` User (author)

### 10. Inquiries Table

**Purpose**: Stores customer inquiries and contact form submissions.

```sql
CREATE TABLE inquiries (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    status VARCHAR(255) NOT NULL DEFAULT 'new',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

**Indexes**:
- `PRIMARY KEY` on `id`
- `INDEX` on `status`
- `INDEX` on `created_at`

**Status Values**:
- `new`: Unread inquiry
- `read`: Read by admin
- `replied`: Admin has replied
- `closed`: Inquiry resolved

### 11. Settings Table

**Purpose**: Stores configurable application settings.

```sql
CREATE TABLE settings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    key VARCHAR(255) UNIQUE NOT NULL,
    value TEXT NULL,
    type VARCHAR(255) NOT NULL DEFAULT 'text',
    group VARCHAR(255) NULL,
    description TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

**Indexes**:
- `PRIMARY KEY` on `id`
- `UNIQUE KEY` on `key`
- `INDEX` on `group`

**Common Settings**:
- `site_title`: Website title
- `site_description`: Website description
- `contact_email`: Contact email address
- `contact_phone`: Contact phone number
- `stripe_public_key`: Stripe public key
- `stripe_secret_key`: Stripe secret key

### 12. Password Resets Table

**Purpose**: Stores password reset tokens for user authentication.

```sql
CREATE TABLE password_resets (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL
);
```

**Indexes**:
- `PRIMARY KEY` on `email`
- `INDEX` on `token`

### 13. Failed Jobs Table

**Purpose**: Stores failed queue jobs for debugging.

```sql
CREATE TABLE failed_jobs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid VARCHAR(255) UNIQUE NOT NULL,
    connection TEXT NOT NULL,
    queue TEXT NOT NULL,
    payload LONGTEXT NOT NULL,
    exception LONGTEXT NOT NULL,
    failed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

**Indexes**:
- `PRIMARY KEY` on `id`
- `UNIQUE KEY` on `uuid`

### 14. Personal Access Tokens Table

**Purpose**: Stores API access tokens for user authentication.

```sql
CREATE TABLE personal_access_tokens (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tokenable_type VARCHAR(255) NOT NULL,
    tokenable_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    token VARCHAR(64) UNIQUE NOT NULL,
    abilities TEXT NULL,
    last_used_at TIMESTAMP NULL,
    expires_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    INDEX personal_access_tokens_tokenable_type_tokenable_id_index (tokenable_type, tokenable_id)
);
```

**Indexes**:
- `PRIMARY KEY` on `id`
- `UNIQUE KEY` on `token`
- `INDEX` on `tokenable_type, tokenable_id`

## 🔗 Entity Relationship Diagram

```
Users (1) ──── (N) Bookings (N) ──── (1) Tours
  │                                        │
  │                                        │
  │                                        │
  └── (N) Reviews (N) ────────────────────┘
       │
       │
       └── (N) Tours

Tours (N) ──── (1) Destinations

Bookings (1) ──── (1) Payments

Users (N) ──── (N) Roles (via role_user)

Blogs (N) ──── (1) Users (author)
```

## 📊 Data Types and Constraints

### Common Field Types

| Field Type | Usage | Example |
|------------|-------|---------|
| `BIGINT UNSIGNED` | Primary keys, foreign keys | `id`, `user_id` |
| `VARCHAR(255)` | Short text fields | `name`, `email`, `title` |
| `TEXT` | Long text content | `description`, `content`, `message` |
| `DECIMAL(10,2)` | Monetary values | `price`, `total_price`, `amount` |
| `DATE` | Date only | `booking_date`, `available_from` |
| `TIMESTAMP` | Date and time | `created_at`, `updated_at` |
| `INT` | Integer values | `guests`, `rating` |

### Constraints

- **NOT NULL**: Required fields
- **UNIQUE**: Unique values (emails, slugs)
- **FOREIGN KEY**: Referential integrity
- **CHECK**: Value validation (ratings 1-5)
- **DEFAULT**: Default values

## 🔍 Query Optimization

### Recommended Indexes

```sql
-- Performance indexes for common queries
CREATE INDEX idx_bookings_status_date ON bookings(status, booking_date);
CREATE INDEX idx_tours_availability ON tours(available_from, available_to);
CREATE INDEX idx_payments_status ON payments(status);
CREATE INDEX idx_reviews_tour_rating ON reviews(tour_id, rating);
CREATE INDEX idx_blogs_status_published ON blogs(status, published_at);
```

### Common Queries

```sql
-- Get pending bookings
SELECT * FROM bookings WHERE status = 'pending' ORDER BY created_at DESC;

-- Get tours with availability
SELECT * FROM tours WHERE available_from <= CURDATE() AND available_to >= CURDATE();

-- Get revenue by month
SELECT MONTH(created_at) as month, SUM(total_price) as revenue 
FROM bookings 
WHERE payment_status = 'paid' 
GROUP BY MONTH(created_at);

-- Get average rating by tour
SELECT tour_id, AVG(rating) as avg_rating, COUNT(*) as review_count
FROM reviews 
GROUP BY tour_id;
```

## 🛡️ Data Integrity

### Foreign Key Constraints

All foreign key relationships include:
- `ON DELETE CASCADE`: Delete related records
- `ON DELETE SET NULL`: Set foreign key to NULL
- Proper indexing for performance

### Validation Rules

- Email addresses must be unique
- Phone numbers follow standard format
- Prices must be positive values
- Ratings must be between 1-5
- Dates must be valid and logical

## 📈 Migration Strategy

### Version Control

All database changes are version-controlled through Laravel migrations:
- Each change is a separate migration file
- Migrations are timestamped and ordered
- Rollback capability for each migration

### Data Seeding

Initial data is provided through seeders:
- Default roles and permissions
- Sample destinations and tours
- Test users and bookings

---

This schema provides a robust foundation for the tour booking system with proper relationships, constraints, and optimization for performance and data integrity. 