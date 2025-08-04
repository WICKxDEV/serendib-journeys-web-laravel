# System Architecture

This document provides a comprehensive overview of the Serendib Journeys system architecture, including the technical stack, design patterns, and system components.

## 🏗️ High-Level Architecture

```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│   Frontend      │    │   Backend       │    │   External      │
│   (Blade + JS)  │◄──►│   (Laravel)     │◄──►│   Services      │
└─────────────────┘    └─────────────────┘    └─────────────────┘
                              │
                              ▼
                       ┌─────────────────┐
                       │   Database      │
                       │   (MySQL)       │
                       └─────────────────┘
```

## 🛠️ Technology Stack

### Backend Framework
- **Laravel 9.x**: PHP web framework
- **PHP 8.0+**: Server-side language
- **MySQL 8.0+**: Primary database
- **Redis**: Caching and session storage (optional)

### Frontend Technologies
- **Blade Templates**: Server-side templating
- **Tailwind CSS**: Utility-first CSS framework
- **Alpine.js**: Lightweight JavaScript framework
- **Bootstrap**: CSS framework for components
- **Vite**: Build tool and development server

### External Services
- **Stripe**: Payment processing
- **SMTP**: Email delivery
- **File Storage**: Local/cloud storage

## 📁 Directory Structure

```
serendib-journeys-web/
├── app/
│   ├── Console/           # Artisan commands
│   ├── Exceptions/        # Custom exception handlers
│   ├── Helpers/           # Helper functions
│   ├── Http/
│   │   ├── Controllers/   # Application controllers
│   │   ├── Middleware/    # Custom middleware
│   │   └── Requests/      # Form request validation
│   ├── Models/            # Eloquent models
│   ├── Notifications/     # Notification classes
│   ├── Providers/         # Service providers
│   └── Services/          # Business logic services
├── config/                # Configuration files
├── database/
│   ├── factories/         # Model factories
│   ├── migrations/        # Database migrations
│   └── seeders/          # Database seeders
├── public/               # Web server document root
├── resources/
│   ├── js/              # JavaScript files
│   ├── sass/            # SCSS files
│   └── views/           # Blade templates
├── routes/              # Route definitions
├── storage/             # File storage
└── tests/              # Test files
```

## 🎯 Design Patterns

### MVC Architecture
The application follows the Model-View-Controller pattern:

- **Models**: Data layer with Eloquent ORM
- **Views**: Blade templates for presentation
- **Controllers**: Business logic and request handling

### Service Layer Pattern
Business logic is encapsulated in service classes:

```php
// Example: StripeService
class StripeService
{
    public function createPaymentIntent(Booking $booking)
    public function processPayment($paymentIntentId, Booking $booking)
    public function refundPayment($paymentIntentId, $amount = null)
}
```

### Repository Pattern (Implicit)
Data access is abstracted through Eloquent models with relationships:

```php
// Example: Tour model with relationships
class Tour extends Model
{
    public function destination() { /* ... */ }
    public function bookings() { /* ... */ }
    public function reviews() { /* ... */ }
}
```

## 🔐 Security Architecture

### Authentication & Authorization
- **Laravel Sanctum**: API authentication
- **Role-based Access Control**: Custom middleware
- **CSRF Protection**: Built-in Laravel protection
- **Input Validation**: Form request validation

### Payment Security
- **Stripe Integration**: PCI-compliant payment processing
- **Webhook Verification**: Secure payment status updates
- **Transaction Logging**: Comprehensive audit trail

### Data Protection
- **SQL Injection Prevention**: Eloquent ORM
- **XSS Protection**: Blade template escaping
- **File Upload Security**: Validation and sanitization

## 📊 Database Architecture

### Core Entities

```
Users
├── Roles (Many-to-Many)
├── Bookings (One-to-Many)
└── Reviews (One-to-Many)

Tours
├── Destination (Many-to-One)
├── Bookings (One-to-Many)
└── Reviews (One-to-Many)

Bookings
├── User (Many-to-One)
├── Tour (Many-to-One)
├── Payment (One-to-One)
└── Guide (Many-to-One)

Payments
└── Booking (One-to-One)
```

### Database Relationships

```sql
-- Users and Roles (Many-to-Many)
users <──> role_user <──> roles

-- Tours and Destinations (Many-to-One)
tours ──> destinations

-- Bookings and Users/Tours (Many-to-One)
bookings ──> users
bookings ──> tours

-- Payments and Bookings (One-to-One)
payments ──> bookings
```

## 🔄 Request Flow

### Public Request Flow
```
1. User Request → Web Server (Apache/Nginx)
2. Web Server → Laravel Router
3. Router → Middleware Stack
4. Middleware → Controller
5. Controller → Service Layer
6. Service → Model (Database)
7. Model → Controller
8. Controller → View (Blade)
9. View → User Response
```

### Authenticated Request Flow
```
1. User Request → Authentication Middleware
2. Authentication → Role Middleware
3. Role Check → Controller
4. Controller → Service Layer
5. Service → Model (Database)
6. Model → Controller
7. Controller → View (Blade)
8. View → User Response
```

## 🎨 Frontend Architecture

### Component Structure
- **Layout Components**: Base templates and navigation
- **Page Components**: Individual page templates
- **Form Components**: Reusable form elements
- **UI Components**: Buttons, cards, modals

### Asset Pipeline
```
SCSS/Sass → Vite → CSS
JavaScript → Vite → Minified JS
Images → Vite → Optimized Assets
```

### Responsive Design
- **Mobile-first**: Tailwind CSS responsive utilities
- **Progressive Enhancement**: Alpine.js for interactivity
- **Accessibility**: ARIA labels and semantic HTML

## 🔧 Configuration Management

### Environment-based Configuration
- **Development**: `.env` file with debug enabled
- **Production**: Environment variables with caching
- **Testing**: Separate test database and configuration

### Service Configuration
```php
// config/services.php
'stripe' => [
    'key' => env('STRIPE_KEY'),
    'secret' => env('STRIPE_SECRET'),
    'webhook' => env('STRIPE_WEBHOOK_SECRET'),
],
```

## 📈 Scalability Considerations

### Horizontal Scaling
- **Load Balancing**: Multiple application servers
- **Database Replication**: Read replicas for queries
- **Caching**: Redis for session and data caching

### Performance Optimization
- **Database Indexing**: Optimized query performance
- **Asset Optimization**: Minified CSS/JS
- **Image Optimization**: Compressed images
- **Query Optimization**: Eager loading relationships

## 🔍 Monitoring & Logging

### Application Monitoring
- **Laravel Logging**: Comprehensive error logging
- **Performance Monitoring**: Query and response time tracking
- **Error Tracking**: Exception handling and reporting

### Business Metrics
- **Booking Analytics**: Revenue and booking trends
- **User Analytics**: User behavior and engagement
- **Payment Analytics**: Transaction success rates

## 🚀 Deployment Architecture

### Development Environment
- **Local Development**: Laravel Sail or local stack
- **Version Control**: Git with feature branches
- **Testing**: PHPUnit for automated testing

### Production Environment
- **Web Server**: Nginx/Apache
- **Application Server**: PHP-FPM
- **Database**: MySQL with replication
- **Caching**: Redis for sessions and cache
- **CDN**: Static asset delivery

## 🔄 Data Flow

### Booking Process Flow
```
1. User selects tour
2. User fills booking form
3. System validates input
4. System creates booking record
5. System redirects to payment
6. Stripe processes payment
7. Webhook updates booking status
8. System sends confirmation email
9. Admin receives notification
```

### Payment Processing Flow
```
1. Create Payment Intent (Stripe)
2. Process Payment (Stripe)
3. Update Booking Status (Database)
4. Create Payment Record (Database)
5. Send Confirmation (Email)
6. Update Inventory (Database)
```

## 🛡️ Error Handling

### Exception Handling
- **Custom Exceptions**: Domain-specific error handling
- **Global Exception Handler**: Centralized error processing
- **User-friendly Messages**: Appropriate error responses

### Logging Strategy
- **Error Logging**: All exceptions and errors
- **Access Logging**: User actions and requests
- **Payment Logging**: All payment-related activities
- **Security Logging**: Authentication and authorization events

---

This architecture provides a solid foundation for a scalable, secure, and maintainable tour booking system. The modular design allows for easy extension and modification as business requirements evolve. 