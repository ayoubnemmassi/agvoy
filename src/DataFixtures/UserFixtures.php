<?php
 
namespace App\DataFixtures;
 
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
 
class UserFixtures extends Fixture
{
    private $encoder;
 
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
 
    public function load(ObjectManager $manager)
    {
       
        $user = new User();
        $user->setEmail('admin.admin@gmail.com');
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setPassword($this->encoder->encodePassword($user,'yugigx1998'));
        $manager->persist($user);
 
        $manager->flush();
    }
}