<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
   
    /**
     * @Route("/inscrire", name="inscrire")
     */
    public function inscrire(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $utilisateur = new Utilisateur();
        $form = $this->createFormBuilder($utilisateur)
                      ->add('login', TextType::class)
                      ->add('password', PasswordType::class)  
                      ->add('nom', TextType::class)
                      ->add('prenom', TextType::class)
                      ->add('adresse', TextType::class)
                      ->add('telephone', TextType::class)
                      ->add('roles', ChoiceType::class, array('mapped'=> false,'choices' => array('Administrateur' => 'ROLE_ADMIN', 'Utilisateur' => 'ROLE_USER')))
                      ->add('save', SubmitType::class, array('label' => 'S\'inscrire'))
                      ->getForm();
        if ($request->isMethod('POST')){
            $form -> handleRequest($request);
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $utilisateur->setRoles(array($request->request->get('form')['roles']));
                $utilisateur->setPassword($passwordEncoder->encodePassword($utilisateur, $utilisateur->getPassword()));
                $em->persist($utilisateur);
                $em->flush();
                return $this->redirectToRoute('accueil');
            }
        }    
        return $this->render('accueil/inscrire.html.twig', ['form' => $form->createView()]);
    }
}
