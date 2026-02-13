<?php

namespace App\DataFixtures;

use App\Entity\Moto;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MotoFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $motos = [

            // ======================
            // PANIGALE
            // ======================
            ['Panigale V2', 2025, 155, 955, 'V-Twin', 'Sportive', 'panigale-v2.webp'],
            ['Panigale V4', 2025, 215, 1103, 'V4', 'Sportive', 'panigale-v4.webp'],
            ['Panigale V4 S', 2025, 215, 1103, 'V4', 'Sportive', 'panigale-v4s.webp'],
            ['Panigale V4 R', 2021, 240, 998, 'V4', 'Sportive', 'panigale-v4r.jpg'],

            // ======================
            // STREETFIGHTER
            // ======================
            ['Streetfighter V2', 2025, 153, 955, 'V-Twin', 'Roadster', 'streetfighter-v2.webp'],
            ['Streetfighter V4', 2025, 208, 1103, 'V4', 'Roadster', 'streetfighter-v4.webp'],
            ['Streetfighter V4 S', 2025, 208, 1103, 'V4', 'Roadster', 'streetfighter-v4s.jpg'],

            // ======================
            // MONSTER
            // ======================
            ['Monster', 2021, 111, 937, 'V-Twin', 'Roadster', 'monster.jpg'],
            ['Monster SP', 2024, 111, 937, 'V-Twin', 'Roadster', 'monster-sp.webp'],

            // ======================
            // MULTISTRADA
            // ======================
            ['Multistrada V2', 2025, 113, 937, 'V-Twin', 'Trail', 'multistrada-v2.jpg'],
            ['Multistrada V4', 2025, 170, 1158, 'V4', 'Trail', 'multistrada-v4.webp'],
            ['Multistrada V4 S', 2025, 170, 1158, 'V4', 'Trail', 'multistrada-v4s.webp'],
            ['Multistrada V4 Rally', 2025, 170, 1158, 'V4', 'Trail', 'multistrada-v4-rally.jpg'],

            // ======================
            // DIAVEL
            // ======================
            ['Diavel V4', 2023, 168, 1158, 'V4', 'Power Cruiser', 'diavel-v4.webp'],
            ['XDiavel V4', 2025, 168, 1158, 'V4', 'Power Cruiser', 'xdiavel-v4.webp'],

            // ======================
            // HYPERMOTARD
            // ======================
            ['Hypermotard 950 SP', 2025, 114, 937, 'V-Twin', 'Supermotard', 'hypermotard-950.webp'],

            // ======================
            // SCRAMBLER
            // ======================
            ['Scrambler Icon', 2025, 73, 803, 'L-Twin', 'Néo-rétro', 'scrambler-icon.png'],
            ['Scrambler Nightshift', 2025, 73, 803, 'L-Twin', 'Néo-rétro', 'scrambler-nightshift.jpg'],
        ];

        foreach ($motos as $data) {
            $moto = new Moto();
            $moto->setName($data[0]);
            $moto->setBrand('Ducati');
            $moto->setYear($data[1]);
            $moto->setPower($data[2]);
            $moto->setDisplacement($data[3]);
            $moto->setEngineType($data[4]);
            $moto->setCategory($data[5]);
            $moto->setImage($data[6]);

            $manager->persist($moto);
        }

        $manager->flush();
    }
}
