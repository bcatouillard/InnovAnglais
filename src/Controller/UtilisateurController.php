<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function index(Request $request)
    {
        $utilisateur = new Utilisateur();
        $repository = $this->getDoctrine()->getManager()->getRepository(Utilisateur::class);
        $listeUtilisateurs = $repository->findAll();
        $form = $this->createFormBuilder($utilisateur)
                ->add('save', SubmitType::class, array('attr'=>array('class'=>'btn btn-outline-danger btn-block'),'label'=>'Supprimer'))
                ->getForm(); 
        if ($request->isMethod('POST')){
            $form -> handleRequest($request);
            if($form->isValid()){
                $cocher = $request->request->get('cocher'); 
                foreach($cocher as $i){
                    $u = $repository->find($i);  
                    $this->getDoctrine()->getManager()->remove($u);      
                }
                $this->getDoctrine()->getManager()->flush();
            }           
        }
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController','liste'=>$listeUtilisateurs, 'form'=>$form->createView()
        ]);
    }
    
    /**
     * @Route("/utilisateur_ajout", name="utilisateur_ajout")
     */
    public function ajout(Request $request)
    {
        $utilisateur = new Utilisateur();
        $formBuilder = $this->createFormBuilder($utilisateur)
                           ->add('login', TextType::class)
                           ->add('password', PasswordType::class)  
                           ->add('nom', TextType::class)
                           ->add('prenom', TextType::class)
                           ->add('adresse', TextType::class)
                           ->add('telephone', TextType::class)
                           ->add('roles', ChoiceType::class, array('mapped'=> false,'choices' => array('Administrateur' => 'ROLE_ADMIN', 'Utilisateur' => 'ROLE_USER')))
                           ->add('save',SubmitType::class, array('label'=>'Ajouter'))
                           ->getForm();
        if($request->isMethod('POST')){
            $formBuilder->handleRequest($request);
            if($formBuilder->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($utilisateur);
                $em->flush();
            }
        }
        return $this->render('utilisateur/ajout.html.twig', [
            'controller_name' => 'UtilisateurController','form'=>$formBuilder->createView()
        ]);
    }
    
    /**
     * @Route("/utilisateur_modifier/{id}", name="utilisateur_modifier")
     */
    public function modifier(Request $request)
    {
        $utilisateur = new Utilisateur();
        $repository = $this->getDoctrine()->getManager()->getRepository(Utilisateur::class);
        $utilisateur = $repository->find($request->get('id'));
        $formBuilder = $this->createFormBuilder($utilisateur)
                       ->add('login', TextType::class)
                       ->add('password', PasswordType::class)  
                       ->add('nom', TextType::class)
                       ->add('prenom', TextType::class)
                       ->add('adresse', TextType::class)
                       ->add('telephone', TextType::class)
                       ->add('roles', ChoiceType::class, array('mapped'=> false,'choices' => array('Administrateur' => 'ROLE_ADMIN', 'Utilisateur' => 'ROLE_USER')))
                       ->add('save',SubmitType::class, array('label'=>'Modifier'))
                       ->getForm();
        if($request->isMethod('POST')){
            $formBuilder->handleRequest($request);
            if($formBuilder->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($utilisateur);
                $em->flush();
            }
        }
        return $this->render('utilisateur/modifier.html.twig', [
            'controller_name' => 'UtilisateurController','form'=>$formBuilder->createView()
        ]);
    }
    
    /**
    * @Route("/wsUtilisateur/{id}", name="wsUtilisateur")
    */
    public function wsUtilisateur(Request $request, UtilisateurRepository $repository)
    {
        $utilisateur = $repository->findUser($request->get('id'));
        return $this->json($utilisateur);
    }
}
