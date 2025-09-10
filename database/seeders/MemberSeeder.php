<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;
class MemberSeeder extends Seeder {
    public function run(): void {
        $members = [
            [
                'name' => 'David Datu Sarmiento',
                'bio' => 'Backend dev masta. Chill lang tas taranta sa deadline',
                'img_path' => 'images/david/MyPhoto.png',
                'url_route' => 'dxvid',
            ],
            [
                'name' => 'Christine Lopez',
                'bio' => 'IT pindot pindot lang.',
                'img_path' => 'images/christine/tintin.jpeg',
                'url_route' => 'tine',
            ],
            [
                'name' => 'Peter John Habon',
                'bio' => 'Student, aspiring web developer.',
                'img_path' => 'images/peter/peterjohn.jpg',
                'url_route' => 'peterjohn',
            ],
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
}
    
