<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entreprise;
use App\Repository\EntrepriseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EntrepriseController extends AbstractController
{
    /**
     * @Route("/entreprise", name="entreprise")
     */
    public function index(Request $request)
    {
        $entreprise = new Entreprise();
        $repository = $this->getDoctrine()->getManager()->getRepository(Entreprise::class);
        $listeEntreprise = $repository->findAll();
        $form = $this->createFormBuilder($entreprise)
                ->add('save', SubmitType::class, array('attr'=>array('class'=>'btn btn-block btn-outline-danger'),'label'=>'Supprimer'))
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
        return $this->render('entreprise/index.html.twig', [
            'controller_name' => 'EntrepriseController', 'liste'=>$listeEntreprise, 'form'=>$form->createView()
        ]);
    }
    
    /**
     * @Route("/entreprise_ajout", name="entreprise_ajout")
     */
    public function ajout(Request $request)
    {
        $entreprise = new Entreprise();
        $formBuilder = $this->createFormBuilder($entreprise)
                           ->add('nom', TextType::class)
                           ->add('adresse', TextType::class)
                           ->add('save',SubmitType::class, array('label'=>'Ajouter'))
                           ->getForm();
        if($request->isMethod('POST')){
            $formBuilder->handleRequest($request);
            if($formBuilder->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($entreprise);
                $em->flush();
            }
        }
        return $this->render('entreprise/ajout.html.twig', [
            'controller_name' => 'EntrepriseController','form'=>$formBuilder->createView()
        ]);
    }
    
    /**
     * @Route("/entreprise_modifier/{id}", name="entreprise_modifier")
     */
    public function modifier(Request $request)
    {
        $entreprise = new Entreprise();
        $repository = $this->getDoctrine()->getManager()->getRepository(Entreprise::class);
        $entreprise = $repository->find($request->get('id'));
        $formBuilder = $this->createFormBuilder($entreprise)
                       ->add('nom', TextType::class)
                       ->add('adresse', TextType::class)
                       ->add('save',SubmitType::class, array('label'=>'Modifier'))
                       ->getForm();
        if($request->isMethod('POST')){
            $formBuilder->handleRequest($request);
            if($formBuilder->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($entreprise);
                $em->flush();
            }
        }
        return $this->render('entreprise/modifier.html.twig', [
            'controller_name' => 'EntrepriseController','form'=>$formBuilder->createView()
        ]);
    }
    
    /**
     * @Route("/wsEntreprise/{id}", name="wsEntreprise")
     */
    public function wsEntreprise(Request $request){
        $em = $this->getDoctrine()->getManager();  
        $repository = $em->getRepository(Entreprise::class);
        $entreprise = $repository->findBy(['id' => $request->get('id')]);
        return $this->json($entreprise);
    }
}
