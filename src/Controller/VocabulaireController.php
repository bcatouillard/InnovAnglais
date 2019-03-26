<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Vocabulaire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class VocabulaireController extends AbstractController
{
    /**
     * @Route("/vocabulaire", name="vocabulaire")
     */
    public function index(Request $request)
    {
        $vocabulaire = new Vocabulaire();
        $repository = $this->getDoctrine()->getManager()->getRepository(Vocabulaire::class);
        $listeVocabulaire = $repository->findAll();
        $form = $this->createFormBuilder($vocabulaire)
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
        return $this->render('vocabulaire/index.html.twig', [
            'controller_name' => 'VocabulaireController', 'liste'=>$listeVocabulaire, 'form'=>$form->createView()
        ]);
    }
    
    /**
     * @Route("/vocabulaire_ajout", name="vocabulaire_ajout")
     */
    public function ajout(Request $request)
    {
        $vocabulaire = new Vocabulaire();
        $formBuilder = $this->createFormBuilder($vocabulaire)
                           ->add('libelle', TextType::class)
                           ->add('save',SubmitType::class, array('attr'=>array('class'=>'btn btn-outline-primary'),'label'=>'Ajouter'))
                           ->getForm();
        if($request->isMethod('POST')){
            $formBuilder->handleRequest($request);
            if($formBuilder->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($vocabulaire);
                $em->flush();
            }
        }
        return $this->render('vocabulaire/ajout.html.twig', [
            'controller_name' => 'VocabulaireController','form'=>$formBuilder->createView()
        ]);
    }
    
    /**
     * @Route("/vocabulaire_modifier/{id}", name="vocabulaire_modifier")
     */
    public function modifier(Request $request)
    {
        $vocabulaire = new Vocabulaire();
        $repository = $this->getDoctrine()->getManager()->getRepository(Vocabulaire::class);
        $vocabulaire = $repository->find($request->get('id'));
        $formBuilder = $this->createFormBuilder($vocabulaire)
                       ->add('libelle', TextType::class)
                       ->add('save',SubmitType::class, array('label'=>'Modifier'))
                       ->getForm();
        if($request->isMethod('POST')){
            $formBuilder->handleRequest($request);
            if($formBuilder->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($vocabulaire);
                $em->flush();
            }
        }
        return $this->render('vocabulaire/modifier.html.twig', [
            'controller_name' => 'VocabulaireController','form'=>$formBuilder->createView()
        ]);
    }
}
