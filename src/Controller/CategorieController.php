<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie", name="categorie")
     */
    public function index(Request $request)
    {
        $categorie = new Categorie();
        $repository = $this->getDoctrine()->getManager()->getRepository(Categorie::class);
        $listeCategorie = $repository->findAll();
        $form = $this->createFormBuilder($categorie)
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
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController', 'liste'=>$listeCategorie, 'form'=>$form->createView()
        ]);
    }
    
    /**
     * @Route("/categorie_ajout", name="categorie_ajout")
     */
    public function ajout(Request $request)
    {
        $categorie = new Categorie();
        $formBuilder = $this->createFormBuilder($categorie)
                           ->add('libelle', TextType::class)
                           ->add('save',SubmitType::class, array('label'=>'Ajouter'))
                           ->getForm();
        if($request->isMethod('POST')){
            $formBuilder->handleRequest($request);
            if($formBuilder->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($categorie);
                $em->flush();
            }
        }
        return $this->render('categorie/ajout.html.twig', [
            'controller_name' => 'CategorieController','form'=>$formBuilder->createView()
        ]);
    }
    
    /**
     * @Route("/categorie_modifier/{id}", name="categorie_modifier")
     */
    public function modifier(Request $request)
    {
        $categorie = new Categorie();
        $repository = $this->getDoctrine()->getManager()->getRepository(Categorie::class);
        $categorie = $repository->find($request->get('id'));
        $formBuilder = $this->createFormBuilder($categorie)
                       ->add('libelle', TextType::class)
                       ->add('save',SubmitType::class, array('label'=>'Modifier'))
                       ->getForm();
        if($request->isMethod('POST')){
            $formBuilder->handleRequest($request);
            if($formBuilder->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($categorie);
                $em->flush();
            }
        }
        return $this->render('categorie/modifier.html.twig', [
            'controller_name' => 'CategorieController','form'=>$formBuilder->createView()
        ]);
    }
}
