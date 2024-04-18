<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscritpionType;
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
    public function login(ManagerRegistry $doctrine, Request $request, AuthenticationUtils $authenticationUtils)
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(InscritpionType::class, $utilisateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $login = strtolower(mb_substr($utilisateur->getPrenom(), 0, 1) . $utilisateur->getNom());
            $utilisateur->setLogin($login);
            $utilisateur->setSel(substr(md5(rand()), 0, 8));
            $tempPassword = $utilisateur->getMdp() . $utilisateur->getSel();
            $utilisateur->setMdp(password_hash($tempPassword, PASSWORD_BCRYPT));

            $entityManager=$doctrine->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();
            $this->addFlash('success', 'Utilisateur ajouté avec succès');
        }

        return $this->render('login/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
