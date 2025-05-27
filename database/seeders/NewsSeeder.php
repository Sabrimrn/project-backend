<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\User; 


class NewsSeeder extends Seeder
{

    public function run(): void
    {
        // Haal een bestaande user op
        $user = User::first();

        $newsItems = [
            [
                'title' => 'New Battle Royale Game Launches',
                'content' => 'A new battle royale game has been announced by top gaming studio. The game features innovative mechanics and stunning graphics that promise to revolutionize the genre.',
                'published_at' => now()->subDays(2),
                'publication_date' => now(),
            ],
            [
                'title' => 'Gaming Championship Results',
                'content' => 'The annual gaming championship concluded with spectacular matches. Over 100 professional players competed for the grand prize of $500,000.',
                'published_at' => now()->subDays(5),
                'publication_date' => now(),
            ],
            [
                'title' => 'Next-Gen Console Updates',
                'content' => 'Major console manufacturers announced significant updates coming to their next-generation gaming systems. New features include enhanced VR support and improved processing power.',
                'published_at' => now()->subDays(7),
                'publication_date' => now(),
            ],
            [
                'title' => 'Indie Game Spotlight',
                'content' => 'This months indie game spotlight features three amazing titles from independent developers. These games showcase creativity and innovation in the gaming industry.',
                'published_at' => now()->subDays(10),
                'publication_date' => now(),
            ],
        ];

        foreach ($newsItems as $item) {
            News::create($item);
        }
    }
}

