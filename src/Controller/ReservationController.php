<?php

namespace App\Controller;

use App\Entity\Chauffeur;
use App\Entity\Destination;
use App\Entity\Forfait;
use App\Entity\Modele;
use App\Entity\Reservation;
use App\Entity\ReservationChauffeur;
use App\Entity\ReservationForfait;
use App\Entity\Utilisateur;
use App\Entity\Voiture;
use App\Form\ReservationType;
use DateTime;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $repoTuture = $doctrine->getRepository(Voiture::class);
        $lestuture = $repoTuture->findAll();

        $repoModelo = $doctrine->getRepository(Modele::class);
        $lesModele = $repoModelo->findAll();

        return $this->render('reservation/reservation.html.twig', [
            'controller_name' => 'Reservationcontroller',
            "lesTutures" => $lestuture,
            "lesModeles" => $lesModele,
        ]);
    }

    #[Route('/reservation/{id}', name: 'app_louer_voiture')]
    public function reserverLaTutureDeVosReve($id, Request $request, ManagerRegistry $doctrine): Response
    {

        $repoModelo = $doctrine->getRepository(Modele::class);
        $leModele = $repoModelo->findOneBy(array("id" => $id));

        $repoTuture = $doctrine->getRepository(Voiture::class);
        $lestutures = $repoTuture->findAll();

        $lestutureDuModele = [];

        foreach ($lestutures as $uneTuture) {
            if ($uneTuture->getLeModele() == $leModele) {
                array_push($lestutureDuModele, $uneTuture);
            }
        }

        $repoForfait = $doctrine->getRepository(Forfait::class);
        $lesForfaits = $repoForfait->findAll();

        return $this->render('reservation/resererLaTuture.html.twig', [
            'controller_name' => 'Reservationcontroller',
            "lestutureDuModele" => $lestutureDuModele,
            "leModele" => $leModele,
            "lesForfaits" => $lesForfaits,
        ]);
    }

    #[Route('/reservation/add/{destDepId}/{destArrId}/{leChaufId}/{dateRes}/{dateDebRes}/{idVoit}/{idClient}', name: 'app_reservation_ajouter')]
    public function addReservation($destDepId, $destArrId, $leChaufId, $dateRes, $dateDebRes, $idVoit, $idClient, Request $request, ManagerRegistry $doctrine): Response
    {
        try {
            $reservation = new ReservationChauffeur();
            $repoDestination = $doctrine->getRepository(Destination::class);
            $repoChauffeur = $doctrine->getRepository(Chauffeur::class);
            $repoVoiture = $doctrine->getRepository(Voiture::class);
            $repoUtilisateur = $doctrine->getRepository(Utilisateur::class);

            $reservation->setDateDebutReservation(DateTime::createFromFormat('Y-m-d H:i:s', $dateDebRes));
            $reservation->setDatereservation(DateTime::createFromFormat('Y-m-d H:i:s', $dateRes));
            $reservation->setLaVoiture($repoVoiture->find($idVoit));
            $reservation->setLeClient($repoUtilisateur->find($idClient));
            $reservation->setDestinationArriver($repoDestination->find($destArrId));
            $reservation->setDestinationDepart($repoDestination->find($destDepId));
            $reservation->setLeChauffeur($repoChauffeur->find($leChaufId));

            $entityManager = $doctrine->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();

            return new JsonResponse(array(
                'errcode' => 1
            ));
        } catch (\Throwable $th) {
            return new JsonResponse(array(
                'errcode' => 0
            ));
        }
    }
}
