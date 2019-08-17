<?php

namespace App\Controller;
use App\Entity\Auteur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;

class AuteurController extends AbstractController
{

    public function index()
    {
        return $this->render('auteur/index.html.twig', [
            'controller_name' => 'AuteurController',
        ]);
    }

    public function ajoutAuteur(Request $request)
    {
        // On crée un objet Auteur
        $auteur = new Auteur();

        // J'ai raccourci cette partie, car c'est plus rapide à écrire !
        $form = $this->createFormBuilder( $auteur)
            ->add('nom', TextType::class)
            ->add('nationalite', TextType::class)
            ->add('sauvegarder', SubmitType::class)
            ->getForm();

        // Si la requête est en POST
        if ($request->isMethod('POST')) {
            // On fait le lien Requête <-> Formulaire
            // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
            $form->handleRequest($request);

            // On vérifie que les valeurs entrées sont correctes
            // (Nous verrons la validation des objets en détail dans le prochain chapitre)
            if ($form->isValid()) {
                // On enregistre notre objet $advert dans la base de données, par exemple
                $em = $this->getDoctrine()->getManager();
                $em->persist($auteur);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Auteur bien enregistrée.');

                // On redirige vers la page de visualisation de l'auteur nouvellement créée
                return $this->redirectToRoute('Listes_auteurs');
            }
        }

        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render('auteur/form.html.twig', array(
            'form' => $form->createView(),
        ));


    }

    public function listesAuteurs()
    {


        $repository = $this->getDoctrine()->getRepository(Auteur::class);

        $listesAuteurs = $repository->findAll();

        return $this->render('auteur/index.html.twig', ['lesAuteurs' => $listesAuteurs]);
    }
}
