<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FaqCategory;
use App\Models\FaqItem;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        // Gaming Category
        $gamingCategory = FaqCategory::create(['name' => 'Gaming']);
        
        $gamingFaqs = [
            [
                'question' => 'What platforms do you support?',
                'answer' => 'We support PC, PlayStation, Xbox, and Nintendo Switch platforms.',
            ],
            [
                'question' => 'How do I create a gaming profile?',
                'answer' => 'Simply register an account and go to your profile page to add your gaming information.',
            ],
            [
                'question' => 'Can I link multiple gaming accounts?',
                'answer' => 'Yes, you can link accounts from Steam, Epic Games, Xbox Live, and PlayStation Network.',
            ],
        ];

        foreach ($gamingFaqs as $faq) {
            FaqItem::create(array_merge($faq, ['faq_category_id' => $gamingCategory->id]));
        }

        // Technical Category
        $techCategory = FaqCategory::create(['name' => 'Technical Support']);
        
        $techFaqs = [
            [
                'question' => 'Why is my game lagging?',
                'answer' => 'Game lag can be caused by internet connection, hardware limitations, or server issues. Check your connection and system requirements.',
            ],
            [
                'question' => 'How do I report a bug?',
                'answer' => 'Use our contact form to report bugs. Please include detailed information about the issue and your system specifications.',
            ],
        ];

        foreach ($techFaqs as $faq) {
            FaqItem::create(array_merge($faq, ['faq_category_id' => $techCategory->id]));
        }
    }
}

