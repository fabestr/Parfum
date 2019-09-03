<?php

namespace App\DataFixtures;

use Doctrine\Migrations\Version\Factory;
use Faker;
use App\Entity\User;
use App\Entity\Parfum;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ParfumFixtures extends Fixture
{

    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create('fr_FR');

        $admin = new User();
        $admin->setEmail('f.estrabaud@gmail.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->encoder->encodePassword($admin, '123456'));
        $manager->persist($admin);

        for($i = 0; $i<50 ; $i++)
        {
            $parfum = new Parfum();
            $parfum->setBrand($faker->randomElement($array = array ('Lancôme','Azzaro','Balenciaga','Burberry','Bvlgari','Cacharel', 'Calvin Klein', 'Cartier', 'Cerruti', 'Clarins', 'Diesel', 'Dior', 'Dolce & Gabbana', 'Giogio Armani', 'Guerlain', 'Gucci', 'Hermès', 'Hugo Boss')));
            if($parfum->getBrand() == 'Balenciaga')
            {
                $parfum->setSex('woman');
            }
            $parfum->setSex($faker->randomElement($array = array ('man', 'woman')));

            if($parfum->getBrand() == 'Lancôme' && $parfum->getSex() == 'man')
            {
                $parfum->setName("Hypnôse Homme");
            }else if($parfum->getBrand() == 'Azzaro' && $parfum->getSex() == 'man'){
                $parfum->setName($faker->randomElement($array = array ('Chrome aqua', 'Azzaro Homme','Wanted','Chrome','Solarissimo')));
            }else if($parfum->getBrand() == 'Azzaro' && $parfum->getSex() == 'woman'){
                $parfum->setName($faker->randomElement($array = array ('Wanted girl', 'Eau belle')));
            }else if($parfum->getBrand() == 'Balenciaga'){
                $parfum->setName($faker->randomElement($array = array ('B.Balenciaga', 'Balenciaga Paris','Florabotanica','Rosabotanica')));
            }else if($parfum->getBrand() == 'Burberry' && $parfum->getSex() == 'man'){
                $parfum->setName($faker->randomElement($array = array ('Mr Burberry', 'Mr Burberry Indigo','Brit Rythm pour homme','London pour homme')));
            }else if($parfum->getBrand() == 'Burberry' && $parfum->getSex() == 'woman'){
                $parfum->setName($faker->randomElement($array = array ('Burberry her blosson', 'Burberry her','Brit Rythm pour homme','London pour homme')));
            }else if()
            
            $parfum->setPrice($faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 120)); // 48.8932)
            $parfum->setContenance($faker->randomElement($array = array ('50 ml','75 ml', '100 ml')));
            $parfum->setImage($faker->imageUrl($width = 640, $height = 480, 'fashion'));
            $manager->persist($parfum);
        }
        
        $manager->flush();
    }
}
