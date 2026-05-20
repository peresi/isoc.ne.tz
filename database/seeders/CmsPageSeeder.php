<?php

namespace Database\Seeders;

use App\Models\CmsPage;
use Illuminate\Database\Seeder;

class CmsPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Home',
                'slug' => 'home',
                'nav_label' => 'Home',
                'route_name' => 'home',
                'content' => 'We believe the Internet changes lives. We work to connect more people, strengthen online trust and safety, and advance an open Internet for everyone in Tanzania.',
                'is_system' => true,
                'is_published' => true,
                'in_navigation' => true,
                'navigation_order' => 1,
            ],
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'nav_label' => 'About Us',
                'route_name' => 'about',
                'content' => 'The Internet Society Tanzania Chapter is part of a global community that works for an open, secure, and trusted Internet for everyone.',
                'is_system' => true,
                'is_published' => true,
                'in_navigation' => true,
                'navigation_order' => 2,
            ],
            [
                'title' => 'Our Work',
                'slug' => 'our-work',
                'nav_label' => 'Our Work',
                'route_name' => 'courses.index',
                'content' => 'Explore our learning programs, digital capacity initiatives, and community-driven Internet development work.',
                'is_system' => true,
                'is_published' => true,
                'in_navigation' => true,
                'navigation_order' => 3,
            ],
            [
                'title' => 'News & Insights',
                'slug' => 'news-insights',
                'nav_label' => 'News & Insights',
                'route_name' => 'news.index',
                'content' => 'Follow announcements, stories, and updates from our chapter and wider Internet development ecosystem.',
                'is_system' => true,
                'is_published' => true,
                'in_navigation' => true,
                'navigation_order' => 4,
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact-us',
                'nav_label' => 'Contact Us',
                'route_name' => 'contact.index',
                'content' => 'Connect with us for partnerships, events, media, and chapter collaboration opportunities.',
                'is_system' => true,
                'is_published' => true,
                'in_navigation' => true,
                'navigation_order' => 5,
            ],

            // Get Involved dropdown pages (custom pages, not shown in the top nav directly)
            [
                'title' => 'Become an organization member',
                'slug' => 'become-an-organization-member',
                'nav_label' => null,
                'route_name' => null,
                'content' => 'Learn how your organization can join Internet Society Tanzania and support an open, secure, and trusted Internet.',
                'is_system' => false,
                'is_published' => true,
                'in_navigation' => false,
                'navigation_order' => 0,
            ],
            [
                'title' => 'Join a fellowship program',
                'slug' => 'join-a-fellowship-program',
                'nav_label' => null,
                'route_name' => null,
                'content' => 'Information about upcoming fellowship opportunities, eligibility, and how to apply.',
                'is_system' => false,
                'is_published' => true,
                'in_navigation' => false,
                'navigation_order' => 0,
            ],
            [
                'title' => 'Attend an event',
                'slug' => 'attend-an-event',
                'nav_label' => null,
                'route_name' => null,
                'content' => 'Discover events, meetups, and chapter activities — and how to participate.',
                'is_system' => false,
                'is_published' => true,
                'in_navigation' => false,
                'navigation_order' => 0,
            ],
        ];

        foreach ($pages as $page) {
            CmsPage::updateOrCreate(['slug' => $page['slug']], $page);
        }
    }
}
