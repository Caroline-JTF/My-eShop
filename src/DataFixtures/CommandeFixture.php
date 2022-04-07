<?php

namespace App\DataFixtures;

use DateTime;
// use Faker\Factory;
use App\Entity\User;
use App\Entity\Produit;
use App\Entity\Commande;
use Faker\Provider\Base;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

/*
 * Les fixtures sont des class servants à injecter des données en BDD grâce à une ligne de commande.
 * C'est un jeu de donnée completement FACTICE
 * Cela vous permet d'avoir des données en BDD sans avoir de CRUD sur vos entités(cad pas de formulaire de création)
 * Cela vous sert au tout début du développement d'un projet, pour avoir des données à manipulées en front et en back.
 */
class CommandeFixture extends Fixture
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        // On assigne l'objet EntityManagerInterface à notre propriété $entityManager
        $this->entityManager = $entityManager;
    }

    /*
     * Cette fonction load() sera exécutée par la ligne de commande php bin/console doctrine:fixtures:load --append
     * Elle ne peut pas prendre d'autres dépendances en injection.
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Base::class;

        $user = $this->entityManager->getRepository(User::class)->find(3);
        $produit = $this->entityManager->getRepository(Produit::class)->find(4);


        for($i=0; $i < 5; ++$i) {
            
            $commande = new Commande();

            $commande->setQuantity($faker::randomDigit());
            $commande->setTotal($faker::randomNumber(3));
            $commande->setState('en cours');
    
            $commande->setUser($user);
            $commande->addProduct($produit);
    
            $commande->setCreatedAt(new DateTime());
            $commande->setUpdatedAt(new DateTime());
    
            $manager->persist($commande);

        }

        $manager->flush();

    }
}
