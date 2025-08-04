<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Guide;

class GuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create guides
        $guides = [
            [
                'name' => 'Amal Perera',
                'bio' => 'Experienced tour guide with 8 years of experience in cultural and historical tours. Specializes in ancient sites and cultural experiences.',
                'languages' => ['English', 'Sinhala'],
                'phone' => '+94 71 234 5678',
                'email' => 'amal@serendibjourneys.com',
                'location' => 'Colombo, Sri Lanka',
                'experience_years' => 8,
                'specializations' => 'Cultural tours, Historical sites, Temple visits',
                'is_active' => true,
            ],
            [
                'name' => 'Priya Fernando',
                'bio' => 'Wildlife expert and nature guide with extensive knowledge of Sri Lankan wildlife and national parks.',
                'languages' => ['English', 'Sinhala', 'Tamil'],
                'phone' => '+94 72 345 6789',
                'email' => 'priya@serendibjourneys.com',
                'location' => 'Yala, Sri Lanka',
                'experience_years' => 6,
                'specializations' => 'Wildlife safaris, Bird watching, Nature trails',
                'is_active' => true,
            ],
            [
                'name' => 'Ravi Silva',
                'bio' => 'Adventure and hiking specialist with expertise in mountain trails and outdoor activities.',
                'languages' => ['English', 'Sinhala'],
                'phone' => '+94 73 456 7890',
                'email' => 'ravi@serendibjourneys.com',
                'location' => 'Ella, Sri Lanka',
                'experience_years' => 5,
                'specializations' => 'Hiking, Adventure tours, Mountain trails',
                'is_active' => true,
            ],
            [
                'name' => 'Samantha Jayasuriya',
                'bio' => 'Beach and coastal tour specialist with expertise in marine life and water activities.',
                'languages' => ['English', 'Sinhala'],
                'phone' => '+94 74 567 8901',
                'email' => 'samantha@serendibjourneys.com',
                'location' => 'Mirissa, Sri Lanka',
                'experience_years' => 4,
                'specializations' => 'Beach tours, Whale watching, Water sports',
                'is_active' => true,
            ],
            [
                'name' => 'Kumar Rajapaksa',
                'bio' => 'Tea plantation and hill country expert with deep knowledge of Sri Lankan tea culture.',
                'languages' => ['English', 'Sinhala', 'Tamil'],
                'phone' => '+94 75 678 9012',
                'email' => 'kumar@serendibjourneys.com',
                'location' => 'Nuwara Eliya, Sri Lanka',
                'experience_years' => 7,
                'specializations' => 'Tea plantations, Hill country tours, Cultural experiences',
                'is_active' => true,
            ],
        ];

        foreach ($guides as $guideData) {
            Guide::create($guideData);
        }

        $this->command->info('Guides seeded successfully!');
    }
}
