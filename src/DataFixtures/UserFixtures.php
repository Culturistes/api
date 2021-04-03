<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $peoples = [
            [
                'username' => 'Remi',
                'role' => ['ROLE_DEV', 'ROLE_REMI']
            ],
            [
                'username' => 'Mael',
                'role' => ['ROLE_DEV']
            ],
            [
                'username' => 'Clara',
                'role' => ['ROLE_DA']
            ],
            [
                'username' => 'Eva',
                'role' => ['ROLE_DA']
            ],
            [
                'username' => 'Laure',
                'role' => ['ROLE_DA']
            ],
            [
                'username' => 'Celine',
                'role' => ['ROLE_DA']
            ],
        ];

        foreach ($peoples as $value){
            $user = new User();
            $user->setUsername($value['username']);
    
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'admin'
            ));
    
            $roles = ['ROLE_ADMIN'];
            foreach ($value['role'] as $role) {
                $roles[] = $role;
            }
            $user->setRoles($roles);
    
            $manager->persist($user);
        }
        
        $manager->flush();
    }
}
