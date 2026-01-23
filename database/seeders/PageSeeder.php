<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::where('email', 'admin@shendamlga.gov.ng')
            ->orWhere('email', 'admin@shendamlga.local')
            ->first();

        if (!$adminUser) {
            $adminUser = User::first();
        }

        if (!$adminUser) {
            $this->command->warn('No admin user found. Please run UserSeeder first.');
            return;
        }

        $pages = [
            [
                'title' => 'About Us',
                'slug' => 'about',
                'content' => '<h2>About Shendam Local Government Area</h2>
                <p>Shendam Local Government Area is one of the seventeen Local Government Areas in Plateau State, Nigeria. We are committed to providing efficient and transparent governance to our citizens.</p>
                <h3>Our Mission</h3>
                <p>To serve the people of Shendam with integrity, transparency, and dedication, fostering sustainable development and improving the quality of life for all residents.</p>
                <h3>Our Vision</h3>
                <p>To be a model local government area known for excellence in governance, community development, and citizen engagement.</p>
                <h3>Our Values</h3>
                <ul>
                    <li>Transparency and Accountability</li>
                    <li>Integrity and Honesty</li>
                    <li>Service Excellence</li>
                    <li>Community Development</li>
                    <li>Citizen Engagement</li>
                </ul>',
                'meta_title' => 'About Shendam Local Government Area',
                'meta_description' => 'Learn about Shendam Local Government Area, our mission, vision, and commitment to serving our community.',
                'status' => 'published',
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact',
                'content' => '<h2>Contact Shendam Local Government Area</h2>
                <p>We are here to serve you. Please feel free to reach out to us through any of the following channels:</p>
                <h3>Office Address</h3>
                <p>Shendam Local Government Secretariat<br>
                Shendam, Plateau State<br>
                Nigeria</p>
                <h3>Email</h3>
                <p>info@shendamlga.gov.ng</p>
                <h3>Office Hours</h3>
                <p>Monday - Friday: 8:00 AM - 4:00 PM<br>
                Saturday: 9:00 AM - 1:00 PM<br>
                Sunday: Closed</p>',
                'meta_title' => 'Contact Shendam Local Government Area',
                'meta_description' => 'Get in touch with Shendam Local Government Area. Find our contact information and office hours.',
                'status' => 'published',
            ],
            [
                'title' => 'Our Leadership',
                'slug' => 'leadership',
                'content' => '<h2>Our Leadership Team</h2>
                <p>The leadership of Shendam Local Government Area is committed to serving the people with dedication and integrity.</p>
                <h3>Executive Chairman</h3>
                <p>Information about the Executive Chairman will be updated here.</p>
                <h3>Management Team</h3>
                <p>Our management team consists of experienced professionals dedicated to efficient service delivery.</p>
                <h3>Council Members</h3>
                <p>Our council members represent various wards and work together for the development of our local government area.</p>',
                'meta_title' => 'Leadership - Shendam Local Government Area',
                'meta_description' => 'Meet the leadership team of Shendam Local Government Area.',
                'status' => 'published',
            ],
            [
                'title' => 'Departments',
                'slug' => 'departments',
                'content' => '<h2>Our Departments</h2>
                <p>Shendam Local Government Area consists of various departments working together to serve our community:</p>
                <h3>Administration</h3>
                <p>Handles general administration and coordination of local government activities.</p>
                <h3>Finance & Budget</h3>
                <p>Manages financial resources, budgeting, and accounting.</p>
                <h3>Health Services</h3>
                <p>Provides healthcare services and public health programs.</p>
                <h3>Education</h3>
                <p>Oversees educational programs and school management.</p>
                <h3>Works & Infrastructure</h3>
                <p>Manages construction and maintenance of public infrastructure.</p>
                <h3>Planning & Development</h3>
                <p>Handles urban planning and development projects.</p>',
                'meta_title' => 'Departments - Shendam Local Government Area',
                'meta_description' => 'Explore the various departments of Shendam Local Government Area.',
                'status' => 'published',
            ],
        ];

        foreach ($pages as $page) {
            Page::firstOrCreate(
                ['slug' => $page['slug']],
                array_merge($page, ['user_id' => $adminUser->id])
            );
        }
    }
}
