<?php

namespace App\DataFixtures;

use App\Entity\ForumMessage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ForumMessageFixturesDev extends Fixture implements FixtureGroupInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // -------------------------------------------------------------------------------------------------------- Data
        $arrMessages = [
            [
                'user' => $this->getReference('user-1'),
                'trick' => $this->getReference('double-tail'),
                'content' => 'lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'dateCreated' => $this->getReference('double-tail')->getDateCreated()->modify('+5 minutes'),
                'status' => 'published'
            ],
            [
                'user' => $this->getReference('user-2'),
                'trick' => $this->getReference('double-tail'),
                'content' => 'Quisque venenatis neque vehicula aliquet eleifend.',
                'dateCreated' => $this->getReference('double-tail')->getDateCreated()->modify('+8 minutes'),
                'status' => 'published'
            ],
            [
                'user' => $this->getReference('user-1'),
                'trick' => $this->getReference('double-tail'),
                'content' => 'rhoncus aliquet est sed placerat.',
                'dateCreated' => $this->getReference('double-tail')->getDateCreated()->modify('+15 minutes'),
                'status' => 'published'
            ],
            [
                'user' => $this->getReference('user-3'),
                'trick' => $this->getReference('double-tail'),
                'content' => 'Suspendisse eu nisl condimentum nulla sagittis aliquet sit amet ac sem.',
                'dateCreated' => $this->getReference('double-tail')->getDateCreated()->modify('+25 minutes'),
                'status' => 'published'
            ],
            [
                'user' => $this->getReference('user-1'),
                'trick' => $this->getReference('stalefish'),
                'content' => 'Mauris sit amet efficitur nulla, et dignissim ligula.',
                'dateCreated' => $this->getReference('stalefish')->getDateCreated()->modify('+10 minutes'),
                'status' => 'published'
            ],
            [
                'user' => $this->getReference('user-2'),
                'trick' => $this->getReference('stalefish'),
                'content' => 'Ut eget varius tellus. Praesent et leo sem. Nulla fringilla rhoncus elit, ut vehicula justo suscipit sed.',
                'dateCreated' => $this->getReference('stalefish')->getDateCreated()->modify('+25 minutes'),
                'status' => 'published'
            ],

        ];

        // Fixtures
        foreach ($arrMessages as $arrMessage) {
            $message = new ForumMessage();
            $message->setUser($arrMessage['user'])
                ->setTrick($arrMessage['trick'])
                ->setContent($arrMessage['content'])
                ->setDateCreated($arrMessage['dateCreated'])
                ->setStatus($arrMessage['status']);

            $manager->persist($message);
        }

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 50;
    }

    public static function getGroups(): array
    {
        return ['dev'];
    }

}
