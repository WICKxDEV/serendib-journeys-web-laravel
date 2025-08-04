<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\Booking;
use App\Models\Blog;
use App\Models\Review;
use App\Models\Guide;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Get roles
        $adminRole = Role::where('slug', 'admin')->first();
        $customerRole = Role::where('slug', 'customer')->first();

        // Create test admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
        ]);
        $admin->roles()->attach($adminRole);

        // Create test customer users
        $customers = [
            [
                'name' => 'John Doe',
                'email' => 'john@test.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@test.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Mike Johnson',
                'email' => 'mike@test.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($customers as $customerData) {
            $customer = User::create($customerData);
            $customer->roles()->attach($customerRole);
        }

        // Guides are now created by GuideSeeder to avoid conflicts

        // Create destinations
        $destinations = [
            [
                'name' => 'Sigiriya',
                'description' => 'Ancient palace and fortress complex',
                'location' => 'Central Province, Sri Lanka',
                'image_url' => 'sigiriya-1.jpg',
                'category' => 'Cultural',
            ],
            [
                'name' => 'Kandy',
                'description' => 'Cultural capital with Temple of the Tooth',
                'location' => 'Central Province, Sri Lanka',
                'image_url' => 'kandy-1.jpg',
                'category' => 'Cultural',
            ],
            [
                'name' => 'Ella',
                'description' => 'Mountain village with scenic views',
                'location' => 'Uva Province, Sri Lanka',
                'image_url' => 'ella-1.jpg',
                'category' => 'Nature',
            ],
            [
                'name' => 'Mirissa',
                'description' => 'Beautiful beach destination',
                'location' => 'Southern Province, Sri Lanka',
                'image_url' => 'mirissa-1.jpg',
                'category' => 'Beach',
            ],
            [
                'name' => 'Yala National Park',
                'description' => 'Wildlife sanctuary with leopards',
                'location' => 'Southern Province, Sri Lanka',
                'image_url' => 'yala-1.jpg',
                'category' => 'Wildlife',
            ],
        ];

        foreach ($destinations as $destData) {
            Destination::create($destData);
        }

        // Create tours
        $tours = [
            [
                'title' => 'Sigiriya Rock Fortress Tour',
                'description' => 'Explore the ancient palace and fortress complex',
                'destination_id' => 1,
                'itinerary' => 'Visit Sigiriya, climb the rock, explore the gardens, and learn about the history.',
                'available_from' => now()->addDays(1),
                'available_to' => now()->addMonths(6),
                'price' => 75.00,
            ],
            [
                'title' => 'Kandy Cultural Experience',
                'description' => 'Visit the Temple of the Tooth and cultural sites',
                'destination_id' => 2,
                'itinerary' => 'Temple of the Tooth, Kandy Lake, cultural show, and city tour.',
                'available_from' => now()->addDays(1),
                'available_to' => now()->addMonths(6),
                'price' => 60.00,
            ],
            [
                'title' => 'Ella Mountain Adventure',
                'description' => 'Hiking and scenic views in the mountains',
                'destination_id' => 3,
                'itinerary' => 'Little Adam\'s Peak, Nine Arches Bridge, Ravana Falls, and tea plantations.',
                'available_from' => now()->addDays(1),
                'available_to' => now()->addMonths(6),
                'price' => 120.00,
            ],
            [
                'title' => 'Mirissa Beach & Whale Watching',
                'description' => 'Relax on the beach and watch whales',
                'destination_id' => 4,
                'itinerary' => 'Whale watching tour, beach relaxation, and seafood lunch.',
                'available_from' => now()->addDays(1),
                'available_to' => now()->addMonths(6),
                'price' => 85.00,
            ],
            [
                'title' => 'Yala Wildlife Safari',
                'description' => 'Safari adventure to see leopards and wildlife',
                'destination_id' => 5,
                'itinerary' => 'Safari in Yala National Park, wildlife spotting, and picnic lunch.',
                'available_from' => now()->addDays(1),
                'available_to' => now()->addMonths(6),
                'price' => 95.00,
            ],
        ];

        foreach ($tours as $tourData) {
            \App\Models\Tour::create($tourData);
        }

        // Create bookings with different statuses
        $bookings = [
            [
                'user_id' => 2, // John Doe
                'tour_id' => 1,
                'guide_id' => 1, // Amal Perera
                'booking_date' => now()->addDays(5),
                'guests' => 2,
                'total_price' => 150.00,
                'status' => 'approved',
                'payment_status' => 'paid',
            ],
            [
                'user_id' => 2, // John Doe
                'tour_id' => 3,
                'guide_id' => 3, // Ravi Silva
                'booking_date' => now()->addDays(10),
                'guests' => 1,
                'total_price' => 120.00,
                'status' => 'pending',
                'payment_status' => 'unpaid',
            ],
            [
                'user_id' => 3, // Jane Smith
                'tour_id' => 2,
                'guide_id' => 1, // Amal Perera
                'booking_date' => now()->addDays(3),
                'guests' => 3,
                'total_price' => 180.00,
                'status' => 'approved',
                'payment_status' => 'paid',
            ],
            [
                'user_id' => 3, // Jane Smith
                'tour_id' => 4,
                'booking_date' => now()->addDays(15),
                'guests' => 2,
                'total_price' => 170.00,
                'status' => 'cancelled',
                'payment_status' => 'refunded',
            ],
            [
                'user_id' => 4, // Mike Johnson
                'tour_id' => 5,
                'guide_id' => 2, // Priya Fernando
                'booking_date' => now()->addDays(7),
                'guests' => 4,
                'total_price' => 380.00,
                'status' => 'approved',
                'payment_status' => 'paid',
            ],
        ];

        foreach ($bookings as $bookingData) {
            Booking::create($bookingData);
        }

        // Create blog posts
        $blogs = [
            [
                'title' => 'Top 10 Must-Visit Destinations in Sri Lanka',
                'content' => 'Sri Lanka is a beautiful island nation with diverse landscapes and rich culture. From ancient temples to pristine beaches, here are the top 10 destinations you must visit...',
                'author_id' => 1, // Admin
                'status' => 'published',
            ],
            [
                'title' => 'A Complete Guide to Sigiriya Rock Fortress',
                'content' => 'Sigiriya, also known as the Lion Rock, is one of Sri Lanka\'s most iconic landmarks. This ancient palace and fortress complex offers breathtaking views and fascinating history...',
                'author_id' => 1, // Admin
                'status' => 'published',
            ],
            [
                'title' => 'Best Time to Visit Sri Lanka for Wildlife',
                'content' => 'Sri Lanka is home to diverse wildlife including elephants, leopards, and various bird species. Learn about the best seasons for wildlife viewing in different national parks...',
                'author_id' => 1, // Admin
                'status' => 'draft',
            ],
        ];

        foreach ($blogs as $blogData) {
            Blog::create($blogData);
        }

        // Create reviews for completed tours
        $reviews = [
            [
                'user_id' => 2, // John Doe
                'tour_id' => 1, // Sigiriya
                'rating' => 5,
                'comment' => 'Amazing experience! The views from the top were breathtaking. Our guide was very knowledgeable about the history.',
            ],
            [
                'user_id' => 3, // Jane Smith
                'tour_id' => 2, // Kandy
                'rating' => 4,
                'comment' => 'Great cultural experience. The Temple of the Tooth was beautiful and the traditional dance show was entertaining.',
            ],
            [
                'user_id' => 4, // Mike Johnson
                'tour_id' => 5, // Yala
                'rating' => 5,
                'comment' => 'Incredible safari experience! We saw leopards, elephants, and many other animals. Highly recommended!',
            ],
        ];

        foreach ($reviews as $reviewData) {
            Review::create($reviewData);
        }

        $this->command->info('Test data seeded successfully!');
        $this->command->info('Admin: admin@test.com / password');
        $this->command->info('Customers: john@test.com, jane@test.com, mike@test.com / password');
    }
}
