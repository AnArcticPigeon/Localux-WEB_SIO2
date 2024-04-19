<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use function PHPUnit\Framework\isNull;

class LoginController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/login/verify/{email}/{mdp}', name: 'app_login_verify')]
    public function verify($email, $mdp, ManagerRegistry $doctrine)
    {
        $repository = $doctrine->getRepository(Utilisateur::class);
        $utilisateur = $repository->findOneBy(array("email" => $email));
        if ($utilisateur == null) {
            return new JsonResponse(array(
                'errcode' => 1
            ));
        }
        if (password_verify($mdp . $utilisateur->getSel(), $utilisateur->getMdp())) {
            $data = array(
                'id' => $utilisateur->getId(),
                'nom' => $utilisateur->getNom(),
                'prenom' => $utilisateur->getPrenom(),
                'errcode' => 0
            );

            return new JsonResponse($data);
        }
        return new JsonResponse(array(
            'errcode' => 1
        ));
    }

    #[Route('/register', name: 'app_login_register')]
    public function register(ManagerRegistry $doctrine, Request $request, AuthenticationUtils $authenticationUtils)
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(InscriptionType::class, $utilisateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $login = strtolower(mb_substr($utilisateur->getPrenom(), 0, 1) . $utilisateur->getNom());
            $utilisateur->setLogin($login);
            $utilisateur->setMdp(password_hash($utilisateur->getMdp(), PASSWORD_BCRYPT));

            $entityManager=$doctrine->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();
            $this->addFlash('success', 'Utilisateur ajouté avec succès');
        }

        return $this->render('Inscription/inscription.html.twig', [
            'formAddUtilisateur' => $form->createView(),
        ]);
    }

    #[Route('/login', name: 'app_login')]
    public function login2(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('connection/connection.html.twig', [
            'last_username' => $lastUsername,
            'errors' => $error
        ]);
    }


    #[Route('/deconnexion', name: 'app_logout')]
    public function deconnexion(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

}
