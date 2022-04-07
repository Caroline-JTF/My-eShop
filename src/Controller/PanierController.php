<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/mon-panier")
 */
class PanierController extends AbstractController
{
    /**
     * @Route ("/voir-mon-panier", name="show_panier", methods={"GET"})
     * @return Response
     */
    public function showPaniere(SessionInterface $session, ProduitRepository $produitRepository): Response
    {
        $panier = $session->get('panier', []);

        return $this->render('panier/show_panier.html.twig');
    }
}

?>