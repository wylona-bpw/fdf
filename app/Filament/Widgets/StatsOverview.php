<?php
namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Contact;
use App\Models\NewsletterSubscriber;
use App\Models\Volunteer;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            Stat::make('Articles publiés', Article::published()->count())
                ->icon('heroicon-o-document-text')
                ->color('primary'),

            Stat::make('Bénévoles inscrits', Volunteer::count())
                ->description(Volunteer::pending()->count() . ' en attente')
                ->icon('heroicon-o-heart')
                ->color('success'),

            Stat::make('Messages non lus', Contact::unread()->count())
                ->icon('heroicon-o-envelope')
                ->color('warning'),

            Stat::make('Abonnés newsletter', NewsletterSubscriber::active()->count())
                ->icon('heroicon-o-at-symbol')
                ->color('info'),
        ];
    }
}
