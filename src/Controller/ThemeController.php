<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Theme;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ThemeController extends AbstractController
{
    /**
     * @Route("/theme", name="theme")
     */
    public function index(Request $request)
    {
        $theme = new Theme();
        $repository = $this->getDoctrine()->getManager()->getRepository(Theme::class);
        $listeTheme = $repository->findAll();
        $form = $this->createFormBuilder($theme)
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
        return $this->render('theme/index.html.twig', [
            'controller_name' => 'ThemeController', 'liste'=>$listeTheme, 'form'=>$form->createView()
        ]);
    }
    
     /**
     * @Route("/theme_ajout", name="theme_ajout")
     */
    public function ajout(Request $request)
    {
        $theme = new Theme();
        $formBuilder = $this->createFormBuilder($theme)
                           ->add('libelle', TextType::class)
                           ->add('save',SubmitType::class, array('label'=>'Ajouter'))
                           ->getForm();
        if($request->isMethod('POST')){
            $formBuilder->handleRequest($request);
            if($formBuilder->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($theme);
                $em->flush();
            }
        }
        return $this->render('theme/ajout.html.twig', [
            'controller_name' => 'ThemeController','form'=>$formBuilder->createView()
        ]);
    }
    
    /**
     * @Route("/theme_modifier/{id}", name="theme_modifier")
     */
    public function modifier(Request $request)
    {
        $theme = new Theme();
        $repository = $this->getDoctrine()->getManager()->getRepository(Theme::class);
        $theme = $repository->find($request->get('id'));
        $formBuilder = $this->createFormBuilder($theme)
                       ->add('libelle', TextType::class)
                       ->add('save',SubmitType::class, array('label'=>'Modifier'))
                       ->getForm();
        if($request->isMethod('POST')){
            $formBuilder->handleRequest($request);
            if($formBuilder->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($theme);
                $em->flush();
            }
        }
        return $this->render('theme/modifier.html.twig', [
            'controller_name' => 'ThemeController','form'=>$formBuilder->createView()
        ]);
    }
}
