<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Album;
use App\Models\GalleryItem;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $base = 'gallery/orphelinat-misericorde-divine-2026';

        $album = Album::updateOrCreate(
            ['slug' => 'orphelinat-misericorde-divine-2026'],
            [
                'title'        => 'Distribution alimentaire — Orphelinat La Miséricorde Divine',
                'description'  => "En août 2026, l'équipe du Mouvement des Femmes de Foi s'est rendue à l'orphelinat La Miséricorde Divine, à Yaoundé-Ayéné (Cameroun), pour une distribution de denrées de première nécessité. 50 enfants ont été accompagnés lors de cette mission.",
                'cover_image'  => "{$base}/distribution-17.jpg",
                'event_date'   => '2026-08-03',
                'location'     => 'Yaoundé-Ayéné, Cameroun',
                'is_published' => true,
                'sort_order'   => 1,
            ]
        );

        // Repart les anciens items pour pouvoir reseeder proprement
        $album->items()->delete();

        $sortOrder = 0;

        foreach (range(1, 27) as $i) {
            $n = str_pad((string) $i, 2, '0', STR_PAD_LEFT);
            GalleryItem::create([
                'album_id'   => $album->id,
                'type'       => 'photo',
                'file_path'  => "{$base}/distribution-{$n}.jpg",
                'caption'    => 'Distribution des denrées alimentaires aux enfants',
                'sort_order' => $sortOrder++,
            ]);
        }

        foreach (range(1, 4) as $i) {
            $n = str_pad((string) $i, 2, '0', STR_PAD_LEFT);
            GalleryItem::create([
                'album_id'   => $album->id,
                'type'       => 'photo',
                'file_path'  => "{$base}/equipe-cameroun-{$n}.jpg",
                'caption'    => "L'équipe du Mouvement des Femmes de Foi sur place",
                'sort_order' => $sortOrder++,
            ]);
        }

        GalleryItem::create([
            'album_id'   => $album->id,
            'type'       => 'video',
            'video_url'  => asset("storage/{$base}/reportage.mp4"),
            'caption'    => 'Reportage vidéo de la mission',
            'sort_order' => $sortOrder++,
        ]);
    }
}
