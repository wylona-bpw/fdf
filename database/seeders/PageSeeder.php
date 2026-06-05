<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            ['title' => 'L\'association',              'slug' => 'association',                    'template' => 'association',  'sort_order' => 1],
            ['title' => 'Nos actions',                  'slug' => 'nos-actions',                    'template' => 'actions',      'sort_order' => 2],
            ['title' => 'Faire un don',                 'slug' => 'faire-un-don',                   'template' => 'donate',       'sort_order' => 3],
            ['title' => 'Mentions légales',             'slug' => 'mentions-legales',               'template' => 'default',      'sort_order' => 10],
            ['title' => 'Politique de confidentialité', 'slug' => 'politique-de-confidentialite',    'template' => 'default',      'sort_order' => 11],
        ];

        foreach ($pages as $p) {
            Page::updateOrCreate(['slug' => $p['slug']], array_merge($p, [
                'body'         => '<p>Contenu à rédiger.</p>',
                'is_published' => true,
            ]));
        }
    }
}
