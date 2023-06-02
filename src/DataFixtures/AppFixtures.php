<?php

namespace App\DataFixtures;

use App\Entity\Account;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $account1 = new Account();
        $account1->setEmail('test@test.com');
        $account1->setPassword(
            $this->userPasswordHasher->hashPassword(
                $account1,
                '12345678'
            )
        );
        $account1->setName('test1');
        $account1->setLastName('test');
        $account1->setRoles(array('ROLE_ADMIN'));
        $manager->persist($account1);

        $account2 = new Account();
        $account2->setEmail('test2@test.com');
        $account2->setPassword(
            $this->userPasswordHasher->hashPassword(
                $account2,
                '12345678'
            )
        );
        $account2->setName('test2');
        $account2->setLastName('test2');
        $account2->setRoles(array('ROLE_COMPANY'));
        $manager->persist($account2);
        $manager->flush();
    }
}
