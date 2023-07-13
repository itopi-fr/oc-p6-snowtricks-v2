<?php

namespace App\DataFixtures;

use App\Entity\File;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtureDev extends Fixture implements FixtureGroupInterface, OrderedFixtureInterface
{
    private UserPasswordHasherInterface $userPasswordHasherInterface;

    public function __construct (UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        // ------------------------------------------------------------------------------------------------------- Users
        for ($i = 1; $i <= 3; $i++) {

            // Avatar file
            $userAvatarFile = new File();
            $userAvatarFile->setTitle('Avatar User ' . $i)
                ->setUrl('/public/upload/DataFixtures/avatar/avatar-default-' . $i . '.jpg')
                ->setExt('jpg')
                ->setMime('image/jpeg')
                ->setWeightKB(44)
                ->setType('avatar');

            $manager->persist($userAvatarFile);

            // User
            $user = new User();
            $user->setPseudo('user-' . $i)
                ->setEmail('user' . $i . '@itopi.fr')
                ->setPassword($this->userPasswordHasherInterface->hashPassword($user, 'password'))
                ->setRoles(['ROLE_USER'])
                ->setAvatarFile($userAvatarFile->getId());

            $manager->persist($user);

            $this->addReference($user->getPseudo(), $user);
        }

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 20;
    }

    public static function getGroups(): array
    {
        return ['dev'];
    }
}
