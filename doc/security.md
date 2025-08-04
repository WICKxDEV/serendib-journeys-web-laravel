# Security Guide

This document provides comprehensive security guidelines and best practices for the Serendib Journeys application.

## 🛡️ Security Overview

### Security Principles

1. **Defense in Depth**: Multiple layers of security
2. **Least Privilege**: Minimal access required
3. **Fail Securely**: Graceful failure handling
4. **Security by Design**: Built-in security features
5. **Regular Updates**: Keep systems updated

### Security Threats

- **SQL Injection**: Database query manipulation
- **Cross-Site Scripting (XSS)**: Client-side code injection
- **Cross-Site Request Forgery (CSRF)**: Unauthorized actions
- **Authentication Bypass**: Unauthorized access
- **File Upload Vulnerabilities**: Malicious file uploads
- **Payment Security**: Financial data protection

## 🔐 Authentication & Authorization

### User Authentication

#### 1. Password Security

```php
// Strong password validation
$request->validate([
    'password' => [
        'required',
        'string',
        'min:8',
        'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        'confirmed'
    ]
]);
```

#### 2. Multi-Factor Authentication (MFA)

```php
// Implement MFA for sensitive operations
public function enableMFA(User $user)
{
    $user->mfa_enabled = true;
    $user->mfa_secret = Str::random(32);
    $user->save();
}
```

#### 3. Session Security

```php
// Session configuration
'session' => [
    'driver' => 'redis',
    'lifetime' => 120,
    'expire_on_close' => true,
    'secure' => true,
    'http_only' => true,
    'same_site' => 'lax',
],
```

### Role-Based Access Control (RBAC)

#### 1. Role Definitions

```php
// Define roles and permissions
class Role extends Model
{
    const ADMIN = 'admin';
    const CUSTOMER = 'customer';
    const TOUR_GUIDE = 'tour-guide';
    
    protected $fillable = ['name', 'slug', 'description'];
}
```

#### 2. Permission Middleware

```php
// Custom role middleware
class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        if (!$request->user() || !$request->user()->hasRole($role)) {
            abort(403, 'Unauthorized access');
        }
        
        return $next($request);
    }
}
```

#### 3. Route Protection

```php
// Protect routes by role
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('tours', TourController::class);
    Route::resource('bookings', BookingController::class);
});
```

## 🛡️ Input Validation & Sanitization

### Form Validation

#### 1. Request Validation

```php
// Comprehensive validation rules
class BookingRequest extends FormRequest
{
    public function rules()
    {
        return [
            'tour_id' => 'required|exists:tours,id',
            'booking_date' => 'required|date|after:today',
            'guests' => 'required|integer|min:1|max:10',
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'guest_phone' => 'required|string|max:20',
            'special_requests' => 'nullable|string|max:1000',
        ];
    }
}
```

#### 2. XSS Prevention

```php
// Sanitize user input
public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);
    
    // Sanitize HTML content
    $data['content'] = clean($data['content']);
    
    Blog::create($data);
}
```

#### 3. SQL Injection Prevention

```php
// Use Eloquent ORM (prevents SQL injection)
$tours = Tour::where('destination_id', $destinationId)
    ->where('price', '>=', $minPrice)
    ->where('available_from', '<=', now())
    ->get();

// Avoid raw queries
// ❌ Bad: DB::select("SELECT * FROM tours WHERE id = $id");
// ✅ Good: Tour::find($id);
```

## 💳 Payment Security

### Stripe Integration Security

#### 1. Secure Payment Processing

```php
// StripeService with security measures
class StripeService
{
    public function createPaymentIntent(Booking $booking)
    {
        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $booking->total_price * 100,
                'currency' => 'usd',
                'metadata' => [
                    'booking_id' => $booking->id,
                    'user_id' => $booking->user_id,
                ],
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);
            
            return $paymentIntent;
        } catch (ApiErrorException $e) {
            Log::error('Stripe payment intent creation failed: ' . $e->getMessage());
            throw $e;
        }
    }
}
```

#### 2. Webhook Verification

```php
// Verify Stripe webhook signature
public function webhook(Request $request)
{
    $payload = $request->getContent();
    $sigHeader = $request->header('Stripe-Signature');
    
    try {
        $event = Webhook::constructEvent(
            $payload, $sigHeader, config('services.stripe.webhook')
        );
    } catch (UnexpectedValueException $e) {
        Log::error('Invalid payload');
        return response('Invalid payload', 400);
    } catch (SignatureVerificationException $e) {
        Log::error('Invalid signature');
        return response('Invalid signature', 400);
    }
    
    // Process the event
    $this->handleWebhookEvent($event);
}
```

#### 3. Payment Data Protection

```php
// Never store sensitive payment data
class Payment extends Model
{
    protected $fillable = [
        'booking_id',
        'amount',
        'payment_method',
        'transaction_id',
        'status',
        // Never store: card_number, cvv, etc.
    ];
    
    // Encrypt sensitive fields
    protected $casts = [
        'amount' => 'decimal:2',
    ];
}
```

## 📁 File Upload Security

### Secure File Handling

#### 1. File Validation

```php
// Validate file uploads
$request->validate([
    'image' => [
        'required',
        'file',
        'image',
        'mimes:jpeg,png,jpg,gif',
        'max:2048', // 2MB max
        'dimensions:min_width=100,min_height=100',
    ],
]);
```

#### 2. Secure File Storage

```php
// Store files securely
public function storeImage(Request $request)
{
    $file = $request->file('image');
    
    // Generate unique filename
    $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
    
    // Store in secure location
    $path = $file->storeAs('uploads', $filename, 'private');
    
    // Create database record
    Image::create([
        'filename' => $filename,
        'path' => $path,
        'user_id' => auth()->id(),
    ]);
}
```

#### 3. File Access Control

```php
// Control file access
public function downloadImage($filename)
{
    $image = Image::where('filename', $filename)->first();
    
    if (!$image || !auth()->user()->can('download', $image)) {
        abort(404);
    }
    
    return Storage::disk('private')->download($image->path);
}
```

## 🔒 Database Security

### Database Protection

#### 1. Connection Security

```env
# Secure database connection
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=serendib_journeys
DB_USERNAME=serendib_user
DB_PASSWORD=strong_password_here
DB_CHARSET=utf8mb4
DB_COLLATION=utf8mb4_unicode_ci
```

#### 2. Database User Permissions

```sql
-- Create limited database user
CREATE USER 'serendib_user'@'localhost' IDENTIFIED BY 'strong_password';
GRANT SELECT, INSERT, UPDATE, DELETE ON serendib_journeys.* TO 'serendib_user'@'localhost';
REVOKE ALL PRIVILEGES ON *.* FROM 'serendib_user'@'localhost';
FLUSH PRIVILEGES;
```

#### 3. Data Encryption

```php
// Encrypt sensitive data
class User extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'address'
    ];
    
    // Encrypt sensitive fields
    protected $casts = [
        'phone' => 'encrypted',
        'address' => 'encrypted',
    ];
}
```

## 🌐 Web Security Headers

### Security Headers Configuration

#### 1. Nginx Security Headers

```nginx
# Security headers in Nginx
add_header X-Frame-Options "SAMEORIGIN" always;
add_header X-XSS-Protection "1; mode=block" always;
add_header X-Content-Type-Options "nosniff" always;
add_header Referrer-Policy "no-referrer-when-downgrade" always;
add_header Content-Security-Policy "default-src 'self' http: https: data: blob: 'unsafe-inline'" always;
add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;
```

#### 2. Laravel Security Middleware

```php
// Security middleware
class SecurityHeaders
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
        
        return $response;
    }
}
```

## 🔍 Security Monitoring

### Logging and Monitoring

#### 1. Security Event Logging

```php
// Log security events
class SecurityLogger
{
    public static function logLoginAttempt($user, $success, $ip)
    {
        Log::info('Login attempt', [
            'user_id' => $user?->id,
            'email' => $user?->email,
            'success' => $success,
            'ip_address' => $ip,
            'user_agent' => request()->userAgent(),
        ]);
    }
    
    public static function logPaymentAttempt($booking, $success, $error = null)
    {
        Log::info('Payment attempt', [
            'booking_id' => $booking->id,
            'user_id' => $booking->user_id,
            'amount' => $booking->total_price,
            'success' => $success,
            'error' => $error,
        ]);
    }
}
```

#### 2. Failed Login Protection

```php
// Rate limiting for login attempts
Route::post('/login', [LoginController::class, 'login'])
    ->middleware('throttle:5,1'); // 5 attempts per minute
```

#### 3. Suspicious Activity Detection

```php
// Detect suspicious activity
class SecurityMonitor
{
    public static function detectSuspiciousActivity($user, $action)
    {
        $recentActions = SecurityLog::where('user_id', $user->id)
            ->where('created_at', '>=', now()->subMinutes(10))
            ->count();
            
        if ($recentActions > 50) {
            // Lock account temporarily
            $user->update(['locked_until' => now()->addMinutes(30)]);
            
            // Send alert
            Mail::to($user->email)->send(new SecurityAlert($user));
        }
    }
}
```

## 🚨 Incident Response

### Security Incident Procedures

#### 1. Data Breach Response

```php
// Data breach notification
class DataBreachHandler
{
    public static function handleDataBreach($affectedUsers, $breachType)
    {
        foreach ($affectedUsers as $user) {
            // Force password reset
            $user->update([
                'password_reset_required' => true,
                'password_reset_token' => Str::random(64),
            ]);
            
            // Send notification
            Mail::to($user->email)->send(new DataBreachNotification($user));
            
            // Log incident
            SecurityIncident::create([
                'user_id' => $user->id,
                'incident_type' => $breachType,
                'description' => 'Data breach detected',
            ]);
        }
    }
}
```

#### 2. Account Lockout

```php
// Account lockout mechanism
class AccountLockout
{
    public static function lockAccount($user, $reason)
    {
        $user->update([
            'locked' => true,
            'locked_at' => now(),
            'lock_reason' => $reason,
        ]);
        
        // Log lockout
        Log::warning('Account locked', [
            'user_id' => $user->id,
            'email' => $user->email,
            'reason' => $reason,
        ]);
    }
}
```

## 🔧 Security Configuration

### Environment Security

#### 1. Production Security Settings

```env
# Production security configuration
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Session security
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax
SESSION_DOMAIN=.yourdomain.com

# Database security
DB_HOST=127.0.0.1
DB_USERNAME=serendib_user
DB_PASSWORD=strong_password_here

# Cache security
CACHE_PREFIX=serendib_
```

#### 2. SSL/TLS Configuration

```nginx
# SSL configuration
ssl_protocols TLSv1.2 TLSv1.3;
ssl_ciphers ECDHE-RSA-AES256-GCM-SHA512:DHE-RSA-AES256-GCM-SHA512:ECDHE-RSA-AES256-GCM-SHA384:DHE-RSA-AES256-GCM-SHA384;
ssl_prefer_server_ciphers off;
ssl_session_cache shared:SSL:10m;
ssl_session_timeout 10m;
```

## 📋 Security Checklist

### Pre-Deployment Security

- [ ] All dependencies updated
- [ ] Security headers configured
- [ ] SSL certificate installed
- [ ] Database user permissions limited
- [ ] File upload validation implemented
- [ ] Payment security measures in place
- [ ] Error reporting disabled in production
- [ ] Logging configured for security events

### Ongoing Security

- [ ] Regular security updates
- [ ] Database backups encrypted
- [ ] Access logs monitored
- [ ] Failed login attempts tracked
- [ ] Payment transactions logged
- [ ] User sessions managed securely
- [ ] File uploads scanned for malware
- [ ] API rate limiting implemented

### Security Testing

- [ ] Penetration testing completed
- [ ] Vulnerability scanning performed
- [ ] Code security review conducted
- [ ] Payment security audit done
- [ ] Data protection compliance verified
- [ ] Incident response plan tested

## 🛠️ Security Tools

### Recommended Security Tools

1. **Laravel Security Packages**:
   - `laravel/sanctum` - API authentication
   - `spatie/laravel-permission` - Role management
   - `barryvdh/laravel-cors` - CORS handling

2. **Security Monitoring**:
   - Laravel Telescope (development)
   - Application logging
   - Server monitoring tools

3. **Vulnerability Scanning**:
   - Composer security check
   - NPM audit
   - OWASP ZAP

## 📞 Security Contacts

### Emergency Contacts

- **Security Team**: security@serendibjourneys.com
- **System Administrator**: admin@serendibjourneys.com
- **Payment Provider**: Stripe Support
- **Hosting Provider**: Your hosting provider support

### Incident Response Contacts

- **Primary Contact**: +94 11 234 5678
- **Backup Contact**: +94 11 234 5679
- **Emergency Hotline**: +94 11 234 5680

---

This security guide provides comprehensive coverage of security measures, best practices, and incident response procedures for the Serendib Journeys application. 