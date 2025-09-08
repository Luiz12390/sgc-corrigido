<?php

namespace Database\Seeders;

use App\Models\Community;
use Illuminate\Database\Seeder;

class CommunitySeeder extends Seeder
{
    public function run(): void
    {
        Community::create([
            'name' => 'Centro de Inovadores de Tecnologia',
            'description' => 'Uma comunidade para entusiastas de tecnologia, desenvolvedores e inovadores compartilharem ideias e colaborarem em projetos.',
            'cover_image_path' => 'https://images.unsplash.com/photo-1588072432836-e86123924903?w=400',
        ]);
        Community::create([
            'name' => 'Rede de Soluções Sustentáveis',
            'description' => 'Uma rede focada no desenvolvimento de soluções sustentáveis para desafios ambientais e sociais.',
            'cover_image_path' => 'https://images.unsplash.com/photo-1542601904-86986a848528?w=400',
        ]);
        Community::create([
            'name' => 'Coletivo de Mentes Criativas',
            'description' => 'Um espaço para artistas, designers e profissionais criativos exibirem seu trabalho e se conectarem com outros.',
            'cover_image_path' => 'https://images.unsplash.com/photo-1541701494587-cb58502866ab?w=400',
        ]);
        Community::create([
            'name' => 'Fórum de Crescimento Empresarial',
            'description' => 'Um fórum para empreendedores e líderes de negócios discutirem estratégias de crescimento e compartilharem insights.',
            'cover_image_path' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=400',
        ]);
    }
}
