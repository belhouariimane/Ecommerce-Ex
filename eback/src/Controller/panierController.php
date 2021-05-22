<?php
namespace App\Controller;


use App\Entity\Panier;
use App\Entity\Stock;
use App\Entity\Variant;
use DateInterval;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class panierController extends AbstractController
{
    private $em;

    public function __construct(ContainerInterface $container)
    {
        $this->em = $container->get('doctrine')->getManager('default');

    }

    /**
     * @Route(
     *     name="ajout",
     *     path="/ajout",
     *     methods={"POST"}
     * )
     * @param Request $request
     * @return Response
     */
    public function Ajout(Request $request): Response
    {

        $data = json_decode($request->getContent(), true);
        $panier = new Panier();
        // Add 7 days to set deliveryDate
        $d = new \DateTime('now');
        $d->add(new DateInterval('P7D'));
        $panier->setDateCreation();
        $panier->setDateLivraison($d);
        //for every product's variant on shopping cart
        foreach ($data as &$value) {
            // add to BDD
            $variant= $this->em->getRepository(Variant::class)->findOneBy(['id' => $value['variant']['id']]);
            $panier->addVariant($variant);
            $panier->setTaille($value['stock']['taille']);
            $panier->setQuantite($value['qte']);
            $stock = $this->em->getRepository(Stock::class)->findOneBy(['id' => $value['stock']['id']]);
            $stock->setQuantiteDisponible($stock->getQuantiteDisponible() - $value['qte']);
            $this->em->persist($stock);
            $this->em->persist($panier);
        }

        $this->em->flush();
        $response = new Response();
        $response->setStatusCode(Response::HTTP_CREATED);
        return  $response ;
    }
}

