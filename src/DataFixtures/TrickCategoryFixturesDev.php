<?php

namespace App\DataFixtures;

use App\Entity\File;
use App\Entity\TrickCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TrickCategoryFixturesDev extends Fixture implements FixtureGroupInterface, OrderedFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        // -------------------------------------------------------------------------------------------------------- Data
        $arrCategories = [
            'grabs' => [
                'title' => 'Grabs',
                'description' => 'Les grabs sont des figures au cours desquelles le rider attrape la planche avec la main pendant le saut.',
                'slug' => 'grabs',
                'imgTitle' => 'Featured image category - Grabs',
                'imgName' => 'trick-cat-grabs.jpg',
            ],
            'spins' => [
                'title' => 'Rotations',
                'description' => 'Les rotations sont des figures au cours desquelles le rider effectue une rotation horizontale ou verticale.',
                'slug' => 'rotations',
                'imgTitle' => 'Featured image category - Spins',
                'imgName' => 'trick-cat-spins.jpg',
            ],
            'slides' => [
                'title' => 'Slides',
                'description' => 'Les slides sont des figures au cours desquelles le rider glisse sur une barre de slide.',
                'slug' => 'slides',
                'imgTitle' => 'Featured image category - Slides',
                'imgName' => 'trick-cat-slides.jpg',
            ],
        ];

        // ---------------------------------------------------------------------------------------------------- Fixtures
        foreach ($arrCategories as $key => $value) {
            // File Trick Category Image
            $trickCategoryImage = new File();
            $trickCategoryImage->setTitle($value['imgTitle'])
                ->setUrl('/public/upload/DataFixtures/trick/' . $value['imgName'])
                ->setExt('jpg')
                ->setMime('image/jpeg')
                ->setWeightKB(44)
                ->setType('trick-cat-image');

            $manager->persist($trickCategoryImage);

            // Trick Category
            $trickCategory = new TrickCategory();
            $trickCategory->setTitle($value['title'])
                ->setDescription($value['description'])
                ->setSlug($value['slug'])
                ->setFeatImgFile($trickCategoryImage);

            $manager->persist($trickCategory);

            $this->addReference($key, $trickCategory);
        }

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 30;
    }

    public static function getGroups(): array
    {
        return ['dev'];
    }
}
