<?php

namespace App\DataFixtures;

use App\Entity\File;
use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TrickFixturesDev extends Fixture implements FixtureGroupInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Data : Common snowboard tricks
        $arrTricks = [
            'double-tail' => [
                'title' => 'Double tail grab',
                'description' => 'Le double tail grab est une figure de freestyle consistant à attraper les deux carres de la planche, entre les deux pieds, avec les deux mains.',
                'cat' => 'grabs',
            ],
            'method' => [
                'title' => 'Method',
                'description' => 'La method est une figure de freestyle consistant à attraper la carre frontside de la planche entre les deux pieds avec la main arrière, tout en tendant la jambe avant.',
                'cat' => 'grabs',
            ],
            'reacharound' => [
                'title' => 'Reacharound',
                'description' => 'Le reacharound est une figure de freestyle consistant à attraper la carre frontside de la planche entre les deux pieds avec la main avant, tout en tendant la jambe arrière.',
                'cat' => 'grabs',
                'status' => 'draft',
            ],
            'sadgrab' => [
                'title' => 'Sadgrab',
                'description' => 'Le sadgrab est une figure de freestyle consistant à attraper la carre backside de la planche entre les deux pieds avec la main avant.',
                'cat' => 'grabs',
            ],
            'stalefish' => [
                'title' => 'Stalefish',
                'description' => 'Le stalefish est une figure de freestyle consistant à attraper la carre backside de la planche entre les deux pieds avec la main arrière.',
                'cat' => 'grabs',
            ],
            'stinkbug' => [
                'title' => 'Stinkbug',
                'description' => 'Le stinkbug est une figure de freestyle consistant à attraper la carre frontside de la planche entre les deux pieds avec la main avant, tout en tendant la jambe arrière.',
                'cat' => 'grabs',
                'status' => 'draft',
            ],
            'boardslide' => [
                'title' => 'Boardslide',
                'description' => 'Le boardslide est une figure de freestyle consistant à glisser sur une barre de slide avec la planche perpendiculaire à la barre.',
                'cat' => 'slides',
            ],
            'boardslide-270-out' => [
                'title' => 'Boardslide 270 out',
                'description' => 'Le boardslide 270 out est une figure de freestyle consistant à glisser sur une barre de slide avec la planche perpendiculaire à la barre, puis à effectuer une rotation horizontale de 270° avant de retomber sur la planche.',
                'cat' => 'slides',
            ],
            'nosepress' => [
                'title' => 'Nosepress',
                'description' => 'Le nosepress est une figure de freestyle consistant à glisser sur une barre de slide avec la planche parallèle à la barre, en appuyant sur le nose de la planche.',
                'cat' => 'slides',
            ],
            'nosepress-180-out' => [
                'title' => 'Nosepress 180 out',
                'description' => 'Le nosepress 180 out est une figure de freestyle consistant à glisser sur une barre de slide avec la planche parallèle à la barre, en appuyant sur le nose de la planche, puis à effectuer une rotation horizontale de 180° avant de retomber sur la planche.',
                'cat' => 'slides',
            ],
        ];

        // Fixtures
        foreach ($arrTricks as $slug => $arrTrick) {
            // Trick
            $trick = new Trick();
            $trick->setTitle($arrTrick['title'])
                ->setUser($this->getReference('user-admin'))
                ->setCategory($this->getReference($arrTrick['cat']))
                ->setSlug($slug)
                ->setExcerpt($arrTrick['description'])
                ->setContent($arrTrick['description'])
                ->setDateCreated(new \DateTime() )
                ->setStatus($arrTrick['status'] ?? 'published');

            $manager->persist($trick);
            $this->addReference($slug, $trick);

            // Featured image
            $fileFeatured = new File();
            $fileFeatured->setTitle('Trick featured image : ' . $arrTrick['title'])
                ->setUrl('/public/upload/DataFixtures/trick/' . $arrTrick['cat'] . '/' . $slug . '.jpg')
                ->setExt('jpg')
                ->setMime('image/jpeg')
                ->setWeightKB(400)
                ->setType('trick-image')
                ->setTrick($trick);

            $manager->persist($fileFeatured);
        }

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 40;
    }

    public static function getGroups(): array
    {
        return ['dev'];
    }
}
