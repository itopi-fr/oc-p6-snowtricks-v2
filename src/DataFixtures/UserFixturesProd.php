<?php

namespace App\DataFixtures;

use App\Entity\File;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixturesProd extends Fixture implements FixtureGroupInterface, OrderedFixtureInterface
{
    private UserPasswordHasherInterface $userPasswordHasherInterface;

    public function __construct (UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        // -------------------------------------------------------------------------------------------------- User Admin
        // Avatar file
        $adminAvatarFile = new File();
        $adminAvatarFile->setTitle('Avatar Admin')
            ->setUrl('/public/upload/DataFixtures/avatar/avatar-default-1.jpg')
            ->setExt('jpg')
            ->setMime('image/jpeg')
            ->setWeightKB(44)
            ->setType('avatar');

        $manager->persist($adminAvatarFile);

        // User
        $user_admin = new User();



        $user_admin->setPseudo('admin')
            ->setEmail('md@itopi.fr')
            ->setPassword($this->userPasswordHasherInterface->hashPassword($user_admin, "password"))
            ->setRoles(['ROLE_ADMIN'])
            ->setAvatarFile($adminAvatarFile->getId());

        $manager->persist($user_admin);

        $this->addReference("user-admin", $user_admin);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 10;
    }

    public static function getGroups(): array
    {
        return ['dev', 'prod'];
    }
}
