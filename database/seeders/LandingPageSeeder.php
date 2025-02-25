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
                'address' => 'Dhaka, Bangladesh',
                'email' => 'info@paykaa.com',
                'phone' => '+8801643428395',
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
                'images' => [
                    'test',
                    'test',
                    'test'
                ],
                'lists' => [
                    "First you need to deposit your money in PayKaa account.",
                    "Now you will contract with your partner.",
                    "Finally we will transfer the money to your partner's account with your permission.",
                    "Money transfer system is fully automatic"
                ],
                'transactions' => [
                    "Money transfer, withdraw completely free.",
                    "Only charges apply at the time of deposit.",
                    "Minimum transaction 1 taka.",
                ],
            ],
        ]);
    }
}
