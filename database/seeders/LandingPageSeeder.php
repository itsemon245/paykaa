<?php

namespace Database\Seeders;

use App\Models\LandingPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LandingPage::updateOrCreate(['id' => 1], [
            'hero' => [
                'title' => "Protecting your money is our responsibilty",
                'description' => "We are here to help you protect your money. We will help you to make sure that you are making the right choices and that you are not being scammed.",
                'image_mobile' => 'https://placehold.co/200x420?text=Mobile',
                'image_desktop' => 'https://placehold.co/480x400?text=Desktop',
            ],
            'about' => [
                'title' => 'About us',
                'description' => 'We are a team of developers, designers, and product managers who are passionate about making the world a better place. We believe that everyone deserves access to financial services and we are committed to making that a reality.',
                'image' => 'about.png',
            ],
            'socials' => [
                [
                    'title' => 'twitter',
                    'url' => 'https://twitter.com/paykaa',
                ],
                [
                    'title' => 'facebook',
                    'url' => 'https://www.facebook.com/paykaa',
                ],
                [
                    'title' => 'youtube',
                    'url' => 'https://www.youtube.com/channel/UC0-w6-8-0o-9-4-1-2-3',
                ],
                [
                    'title' => 'instagram',
                    'url' => 'https://instagram.com/paykaa',
                ],
            ],
            'how_it_works' => [
                [
                    'name' => 'Easy to use',
                    'title' => 'You',
                    'description' => "You send request for money to the other party and they can choose to accept or reject the money request.",
                    'image' => ''
                ],
                [
                    'name' => 'Safe & Secure',
                    'title' => 'Website',
                    'description' => "Upon accepting the request, the money will be deducted from the other party and will be safely locked by Paykaa until the request is completed.",
                    'image' => ''
                ],
                [
                    'name' => 'Fast & Reliable',
                    'title' => 'Other Party',
                    'description' => "After the other party accepts the request, you can request for a release. If the other party releases the money then the money will be credited to your account.",
                    'image' => ''
                ],
            ],
        ]);
    }
}
