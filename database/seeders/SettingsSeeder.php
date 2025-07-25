<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // General Settings
        Setting::set('site_name', 'Serendib Journeys', 'text', 'general', 'Site Name', 'The name of your website');
        Setting::set('site_description', 'Discover the beauty of Sri Lanka with our curated travel experiences', 'textarea', 'general', 'Site Description', 'Brief description of your website');
        Setting::set('site_logo', '/img/logo.png', 'image', 'general', 'Site Logo', 'Your website logo URL');
        Setting::set('contact_email', 'info@serendibjourneys.com', 'text', 'general', 'Contact Email', 'Primary contact email address');
        Setting::set('contact_phone', '+94 11 234 5678', 'text', 'general', 'Contact Phone', 'Primary contact phone number');
        Setting::set('contact_address', '123 Travel Street, Colombo, Sri Lanka', 'textarea', 'general', 'Contact Address', 'Business address');

        // Homepage Content
        Setting::set('hero_title', 'Discover Sri Lanka', 'text', 'home', 'Hero Title', 'Main headline on homepage');
        Setting::set('hero_subtitle', 'Experience the magic of the pearl of the Indian Ocean', 'textarea', 'home', 'Hero Subtitle', 'Subtitle under main headline');
        Setting::set('hero_image', '/img/bg-hero.jpg', 'image', 'home', 'Hero Background Image', 'Background image for hero section');
        Setting::set('featured_tours_title', 'Featured Tours', 'text', 'home', 'Featured Tours Title', 'Title for featured tours section');
        Setting::set('featured_tours_description', 'Explore our most popular tours and experiences', 'textarea', 'home', 'Featured Tours Description', 'Description for featured tours section');
        Setting::set('about_section_title', 'About Serendib Journeys', 'text', 'home', 'About Section Title', 'Title for about section on homepage');
        Setting::set('about_section_content', 'We are passionate about showcasing the beauty and culture of Sri Lanka through unforgettable travel experiences.', 'textarea', 'home', 'About Section Content', 'Content for about section on homepage');
        Setting::set('testimonials_title', 'What Our Travelers Say', 'text', 'home', 'Testimonials Title', 'Title for testimonials section');
        Setting::set('testimonials_description', 'Read what our satisfied customers have to say about their experiences', 'textarea', 'home', 'Testimonials Description', 'Description for testimonials section');

        // About Page
        Setting::set('about_page_title', 'About Us', 'text', 'about', 'About Page Title', 'Title for the about page');
        Setting::set('about_page_content', 'Serendib Journeys is a premier travel company dedicated to providing exceptional travel experiences in Sri Lanka. Our team of experienced travel professionals is committed to creating memorable journeys that showcase the rich culture, stunning landscapes, and warm hospitality of this beautiful island nation.', 'textarea', 'about', 'About Page Content', 'Main content for the about page');
        Setting::set('about_mission', 'To provide authentic, sustainable, and unforgettable travel experiences that connect visitors with the heart and soul of Sri Lanka.', 'textarea', 'about', 'Our Mission', 'Company mission statement');
        Setting::set('about_vision', 'To become the leading travel company in Sri Lanka, known for exceptional service, authentic experiences, and sustainable tourism practices.', 'textarea', 'about', 'Our Vision', 'Company vision statement');
        Setting::set('about_team_title', 'Meet Our Team', 'text', 'about', 'Team Section Title', 'Title for team section');
        Setting::set('about_team_description', 'Our passionate team of travel experts is here to make your Sri Lankan adventure unforgettable.', 'textarea', 'about', 'Team Section Description', 'Description for team section');

        // Contact Information
        Setting::set('contact_page_title', 'Contact Us', 'text', 'contact', 'Contact Page Title', 'Title for contact page');
        Setting::set('contact_page_description', 'Get in touch with us for any questions about our tours or to book your next adventure.', 'textarea', 'contact', 'Contact Page Description', 'Description for contact page');
        Setting::set('office_hours', 'Monday - Friday: 9:00 AM - 6:00 PM\nSaturday: 9:00 AM - 4:00 PM\nSunday: Closed', 'textarea', 'contact', 'Office Hours', 'Business operating hours');
        Setting::set('emergency_contact', '+94 77 123 4567', 'text', 'contact', 'Emergency Contact', 'Emergency contact number for travelers');

        // Social Media
        Setting::set('facebook_url', 'https://facebook.com/serendibjourneys', 'text', 'social', 'Facebook URL', 'Facebook page URL');
        Setting::set('instagram_url', 'https://instagram.com/serendibjourneys', 'text', 'social', 'Instagram URL', 'Instagram profile URL');
        Setting::set('twitter_url', 'https://twitter.com/serendibjourneys', 'text', 'social', 'Twitter URL', 'Twitter profile URL');
        Setting::set('youtube_url', 'https://youtube.com/serendibjourneys', 'text', 'social', 'YouTube URL', 'YouTube channel URL');
        Setting::set('linkedin_url', 'https://linkedin.com/company/serendibjourneys', 'text', 'social', 'LinkedIn URL', 'LinkedIn company page URL');

        // SEO Settings
        Setting::set('meta_title', 'Serendib Journeys - Discover Sri Lanka', 'text', 'seo', 'Meta Title', 'Default meta title for pages');
        Setting::set('meta_description', 'Discover the beauty of Sri Lanka with Serendib Journeys. Book your next adventure with our curated travel experiences.', 'textarea', 'seo', 'Meta Description', 'Default meta description for pages');
        Setting::set('meta_keywords', 'Sri Lanka, travel, tours, adventure, culture, beaches, wildlife, heritage', 'text', 'seo', 'Meta Keywords', 'Default meta keywords');
        Setting::set('google_analytics', '', 'text', 'seo', 'Google Analytics ID', 'Google Analytics tracking ID');
        Setting::set('facebook_pixel', '', 'text', 'seo', 'Facebook Pixel ID', 'Facebook Pixel tracking ID');
        Setting::set('schema_markup', '', 'textarea', 'seo', 'Schema Markup', 'Additional schema markup for SEO');

        $this->command->info('Default settings seeded successfully!');
    }
}
