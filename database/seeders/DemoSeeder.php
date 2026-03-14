<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::create([
            'name' => 'Demo Organizer',
            'email' => 'demo@example.com',
            'password' => bcrypt('password'),
        ]);

        \App\Models\Event::create([
            'title' => 'Future Tech Expo 2026',
            'description' => 'The largest gathering of AI and robotics enthusiasts in the world. Experience the future of technology first-hand.',
            'location' => 'Silicon Valley Convention Center',
            'start_time' => '2026-06-15 10:00:00',
            'capacity' => 500,
            'available_tickets' => 500,
            'price' => 299,
            'user_id' => $user->id,
        ]);

        \App\Models\Event::create([
            'title' => 'Premium Jazz Night',
            'description' => 'An evening of sophisticated jazz and fine dining in the heart of London. Relax and enjoy the smooth vibes.',
            'location' => 'The Blue Note - London',
            'start_time' => '2026-05-20 19:30:00',
            'capacity' => 80,
            'available_tickets' => 80,
            'price' => 75,
            'user_id' => $user->id,
        ]);

        \App\Models\Event::create([
            'title' => 'Global Marketing Summit',
            'description' => 'Connect with industry leaders and learn the latest trends in global marketing strategies.',
            'location' => 'Dubai Marina - UAE',
            'start_time' => '2026-08-10 09:00:00',
            'capacity' => 1200,
            'available_tickets' => 1200,
            'price' => 150,
            'user_id' => $user->id,
        ]);
    }
}
