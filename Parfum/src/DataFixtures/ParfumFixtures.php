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
            $parfum->setBrand($faker->randomElement($array = array ('Lancôme','Azzaro','Balenciaga','Burberry','Bvlgari','Cacharel', 'Calvin Klein', 'Cartier', 'Cerruti', 'Diesel', 'Dior', 'Dolce & Gabbana', 'Giorgio Armani', 'Guerlain', 'Gucci', 'Hermès', 'Hugo Boss', 'Jean-Paul Gaultier')));
            if($parfum->getBrand() == 'Balenciaga')
            {
                $parfum->setSex('woman');
            }
            $parfum->setSex($faker->randomElement($array = array ('man', 'woman')));

            if($parfum->getBrand() == 'Lancôme' && $parfum->getSex() == 'man')
            {
                $parfum->setName("Hypnôse Homme");
            }else if($parfum->getBrand() == 'Azzaro' && $parfum->getSex() == 'man'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Chrome aqua', 'Azzaro Homme','Wanted','Chrome','Solarissimo')));
            }else if($parfum->getBrand() == 'Azzaro' && $parfum->getSex() == 'woman'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Wanted girl', 'Eau belle')));
            }else if($parfum->getBrand() == 'Balenciaga'){
                $parfum->setName($faker->unique()->randomElement($array = array ('B.Balenciaga', 'Balenciaga Paris','Florabotanica','Rosabotanica')));
            }else if($parfum->getBrand() == 'Burberry' && $parfum->getSex() == 'man'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Mr Burberry', 'Mr Burberry Indigo','Brit Rythm pour homme','London pour homme')));
            }else if($parfum->getBrand() == 'Burberry' && $parfum->getSex() == 'woman'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Burberry her blosson', 'Burberry her','My Burberry blush','Burberry body', 'Burberry pour femme', 'The beat pour femme')));
            }else if($parfum->getBrand() == 'Bvlgari' && $parfum->getSex() == 'man'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Aqua pour homme', 'Bvlgari man','Bvlgari man in black','Bvlgari man extreme')));
            }else if($parfum->getBrand() == 'Bvlgari' && $parfum->getSex() == 'woman'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Omnia', 'Omnia coral','Omnia crystalline','Omnia indian garnet', 'Rose essentielle')));
            }else if($parfum->getBrand() == 'Cacharel' && $parfum->getSex() == 'man'){
                $parfum->setName('Cacharel pour l\'homme');
            }else if($parfum->getBrand() == 'Cacharel' && $parfum->getSex() == 'woman'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Yes i am pink', 'Loulou','Amor amor l\eau flamingo','Anais Anais premier délice')));
            }else if($parfum->getBrand() == 'Calvin Klein' && $parfum->getSex() == 'man'){
                $parfum->setName($faker->randomElement($array = array ('CK one', 'CK one Gold','CK2','Obsessed for men', 'Eternity now for men', 'Reveal men')));
            }else if($parfum->getBrand() == 'Clavin Klein' && $parfum->getSex() == 'woman'){
                $parfum->setName($faker->unique()->randomElement($array = array ('CK women', 'Women','Obsessed for women','Down town')));
            }else if($parfum->getBrand() == 'Cartier' && $parfum->getSex() == 'man'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Pasha ultimate', 'Carat','La panthère','Must de Cartier', 'Baisé volé')));
            }else if($parfum->getBrand() == 'Cartier' && $parfum->getSex() == 'woman'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Carat', 'La panthère','Must de Cartier','Bvlgari man extreme')));
            }else if($parfum->getBrand() == 'Cerruti' && $parfum->getSex() == 'man'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Cerruti 1881 Black', '1881 essentiel','Cerruti image','Cerruti 1881 signature')));
            }else if($parfum->getBrand() == 'Cerruti' && $parfum->getSex() == 'woman'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Cerruti 1881 Bella Notte', 'Cerruti 1881pour femme')));
            }else if($parfum->getBrand() == 'Diesel' && $parfum->getSex() == 'man'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Spirit of the brave', 'Only the brave','Fuel for life','Bad')));
            }else if($parfum->getBrand() == 'Diesel' && $parfum->getSex() == 'woman'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Fuel for life pour elle', 'Loverdose','Loverdose tattoo')));
            }else if($parfum->getBrand() == 'Dior' && $parfum->getSex() == 'man'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Sauvage', 'Dior homme','Fahrenheit','Eau sauvage')));
            }else if($parfum->getBrand() == 'Dior' && $parfum->getSex() == 'woman'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Joy de dior', 'Diorissimo','Miss Dior','J\'adore')));
            }else if($parfum->getBrand() == 'Dolce & Gabbana' && $parfum->getSex() == 'man'){
                $parfum->setName($faker->unique()->randomElement($array = array ('K by Dolce & Gabbana', 'Light blue sun pour homme','The one grey','The one for men')));
            }else if($parfum->getBrand() == 'Dolce & Gabbana' && $parfum->getSex() == 'woman'){
                $parfum->setName($faker->unique()->randomElement($array = array ('The only one two', 'Dolce rosa excelsa','The one essence','Dolce')));
            }else if($parfum->getBrand() == 'Giorgio Armani' && $parfum->getSex() == 'man'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Armani code', 'Stronger with you','Acqua di gio')));
            }else if($parfum->getBrand() == 'Giorgio Armani' && $parfum->getSex() == 'woman'){
                $parfum->setName($faker->randomElement($array = array ('Acqua di gioia', 'In love with you','Light di gioia','Armani code femme')));
            }else if($parfum->getBrand() == 'Guerlain' && $parfum->getSex() == 'man'){
                $parfum->setName($faker->unique()->randomElement($array = array ('L\'homme idéal cool', 'Habit rouge','L\'instant de Guerlain','Héritage')));
            }else if($parfum->getBrand() == 'Guerlain' && $parfum->getSex() == 'woman'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Mon Guerlain', 'La petite robe noire','Insolence','Shalimar')));
            }else if($parfum->getBrand() == 'Gucci' && $parfum->getSex() == 'man'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Gucci pour homme', 'Gucci guilty pour homme')));
            }else if($parfum->getBrand() == 'Gucci' && $parfum->getSex() == 'woman'){
                $parfum->setName($faker->randomElement($array = array ('Mémoire d\'une odeur', 'Gucci guilty intense','Gucci bloom acqua di fiori','Gucci guilty')));
            }else if($parfum->getBrand() == 'Hermès' && $parfum->getSex() == 'man'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Terre d\'Hermès', 'Bel ami','Rocabar','Equipage')));
            }else if($parfum->getBrand() == 'Hermès' && $parfum->getSex() == 'woman'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Twilly d\Hermès', '24 faubourg','Calèche','Rouge d\'Hermès')));
            }else if($parfum->getBrand() == 'Hugo Boss' && $parfum->getSex() == 'man'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Boss bottled infinite', 'Boss botlled night','Boss the scent','Boss bottled united')));
            }else if($parfum->getBrand() == 'Hugo Boss' && $parfum->getSex() == 'woman'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Boss orange', 'Boss nuit pour femme','Hugo woman','Boss femme')));
            }else if($parfum->getBrand() == 'Jean-Paul Gualtier' && $parfum->getSex() == 'man'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Le beau', 'Le male in the navy','Le male','Ultra male')));
            }else if($parfum->getBrand() == 'Jean-Paul Gaultier' && $parfum->getSex() == 'woman'){
                $parfum->setName($faker->unique()->randomElement($array = array ('Ma dame', 'Classique','La belle','Scandal à Paris')));
            }

            $parfum->setPrice($faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 120)); // 48.8932)
            $parfum->setContenance($faker->randomElement($array = array ('50 ml','75 ml', '100 ml')));
            $parfum->setImage($faker->imageUrl($width = 640, $height = 480, 'fashion'));
            $manager->persist($parfum);
        }
        
        $manager->flush();
    }
}
