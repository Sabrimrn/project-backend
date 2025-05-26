<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\FaqItem;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Gaming Tournament Platform Homepage
     * 
     * @return Response
     */
    public function index(): Response
    {
        // Gaming Platform Statistics
        $stats = [
            'total_players' => User::count(),
            'active_tournaments' => 0, // Will be updated when tournament system is added
            'total_matches' => 0, // Will be updated when match system is added
            'prize_pool_total' => '$50,000', // Placeholder for now
        ];

        // Latest Gaming News (Featured)
        $featuredNews = News::where('is_featured', true)
            ->where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get()
            ->map(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'excerpt' => $article->excerpt,
                    'featured_image' => $article->featured_image,
                    'published_at' => $article->published_at->format('M d, Y'),
                    'read_time' => $this->calculateReadTime($article->content),
                    'category' => $article->category,
                ];
            });

        // Latest Gaming News (Regular)
        $latestNews = News::where('is_published', true)
            ->latest('published_at')
            ->take(6)
            ->get()
            ->map(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'excerpt' => $article->excerpt,
                    'featured_image' => $article->featured_image,
                    'published_at' => $article->published_at->format('M d, Y'),
                    'read_time' => $this->calculateReadTime($article->content),
                    'category' => $article->category,
                ];
            });

        // Top Gaming Categories (Placeholder data for now)
        $gamingCategories = [
            [
                'name' => 'Battle Royale',
                'games' => ['Fortnite', 'PUBG', 'Apex Legends'],
                'active_players' => rand(1000, 5000),
                'tournaments_count' => rand(5, 25),
                'icon' => '🎯',
                'color' => 'from-red-500 to-orange-500'
            ],
            [
                'name' => 'MOBA',
                'games' => ['League of Legends', 'Dota 2', 'Heroes of the Storm'],
                'active_players' => rand(1500, 4000),
                'tournaments_count' => rand(3, 20),
                'icon' => '⚔️',
                'color' => 'from-blue-500 to-purple-500'
            ],
            [
                'name' => 'FPS',
                'games' => ['Counter-Strike 2', 'Valorant', 'Overwatch 2'],
                'active_players' => rand(2000, 6000),
                'tournaments_count' => rand(10, 30),
                'icon' => '🎮',
                'color' => 'from-green-500 to-teal-500'
            ],
        ];

        // Gaming Leaderboard Preview (Top 5)
        $topPlayers = User::whereNotNull('gaming_level')
            ->orderByDesc('gaming_experience_points')
            ->take(5)
            ->get()
            ->map(function ($user, $index) {
                return [
                    'rank' => $index + 1,
                    'name' => $user->name,
                    'level' => $user->gaming_level ?? 1,
                    'experience_points' => $user->gaming_experience_points ?? 0,
                    'favorite_game' => $user->favorite_games[0] ?? 'Not specified',
                    'avatar' => $user->avatar_url ?? "https://ui-avatars.com/api/?name=" . urlencode($user->name) . "&background=3B82F6&color=fff",
                    'badge' => $this->getPlayerBadge($index + 1),
                ];
            });

        // Trending Gaming Topics
        $trendingTopics = [
            ['name' => '#Tournament2024', 'posts' => rand(150, 500)],
            ['name' => '#EsportsLife', 'posts' => rand(100, 300)],
            ['name' => '#GamingTips', 'posts' => rand(200, 400)],
            ['name' => '#NewGameAlert', 'posts' => rand(80, 250)],
            ['name' => '#ProPlayer', 'posts' => rand(120, 350)],
        ];

        // Upcoming Gaming Events (Placeholder)
        $upcomingEvents = [
            [
                'title' => 'Spring Championship 2024',
                'date' => now()->addDays(7)->format('M d, Y'),
                'time' => '19:00 CET',
                'game' => 'League of Legends',
                'prize_pool' => '$10,000',
                'participants' => rand(32, 128),
                'status' => 'Registration Open'
            ],
            [
                'title' => 'FPS Masters Cup',
                'date' => now()->addDays(14)->format('M d, Y'),
                'time' => '20:00 CET',
                'game' => 'Counter-Strike 2',
                'prize_pool' => '$15,000',
                'participants' => rand(16, 64),
                'status' => 'Registration Open'
            ],
            [
                'title' => 'Battle Royale Showdown',
                'date' => now()->addDays(21)->format('M d, Y'),
                'time' => '18:00 CET',
                'game' => 'Fortnite',
                'prize_pool' => '$8,000',
                'participants' => rand(50, 100),
                'status' => 'Coming Soon'
            ]
        ];

        return Inertia::render('Home', [
            'stats' => $stats,
            'featured_news' => $featuredNews,
            'latest_news' => $latestNews,
            'gaming_categories' => $gamingCategories,
            'top_players' => $topPlayers,
            'trending_topics' => $trendingTopics,
            'upcoming_events' => $upcomingEvents,
            'meta' => [
                'title' => 'Gaming Tournament Platform - Compete, Win, Dominate!',
                'description' => 'Join the ultimate gaming tournament platform. Compete in esports tournaments, track your stats, and climb the leaderboards!',
                'keywords' => 'gaming, tournaments, esports, leaderboard, competitive gaming'
            ]
        ]);
    }

    /**
     * Calculate reading time for news articles
     * 
     * @param string $content
     * @return string
     */
    private function calculateReadTime(string $content): string
    {
        $wordCount = str_word_count(strip_tags($content));
        $readingTime = ceil($wordCount / 200); // Average 200 words per minute
        
        return $readingTime === 1 ? '1 min read' : $readingTime . ' min read';
    }

    /**
     * Get player badge based on ranking
     * 
     * @param int $rank
     * @return array
     */
    private function getPlayerBadge(int $rank): array
    {
        return match($rank) {
            1 => ['name' => 'Champion', 'color' => 'text-yellow-500', 'icon' => '👑'],
            2 => ['name' => 'Master', 'color' => 'text-gray-400', 'icon' => '🥈'],
            3 => ['name' => 'Expert', 'color' => 'text-amber-600', 'icon' => '🥉'],
            default => ['name' => 'Pro', 'color' => 'text-blue-500', 'icon' => '⭐']
        };
    }

    /**
     * Gaming Statistics API endpoint
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGamingStats()
    {
        return response()->json([
            'total_players' => User::count(),
            'active_today' => User::whereDate('last_login_at', today())->count(),
            'tournaments_this_month' => 0, // Placeholder
            'matches_played_today' => 0, // Placeholder
        ]);
    }
}
