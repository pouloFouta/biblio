<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Entity\Biblio;
use App\Entity\Livre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Response;


class LivreController extends AbstractController
{


    public function ajoutLivre(Request $request)
    {
        // On crée un objet Livre
        $livre = new Livre();

        // J'ai raccourci cette partie, car c'est plus rapide à écrire !
        $form = $this->get('form.factory')->createBuilder(FormType::class, $livre)
            ->add('titre',  TextType::class)
            ->add('genre',  TextType::class)
            ->add('annee',DateType::class, array( 'years' => range(date('Y'), date('Y')-500),))
            ->add('nbpages',NumberType::class)
            ->add('resume',TextareaType::class)
            ->add('auteur',EntityType::class,['class' => Auteur::class, 'choice_label' => 'nom',])
            ->add('biblio',EntityType::class,['class' => Biblio::class, 'choice_label' => 'code',])
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
                $em->persist($livre);
                $em->flush();



                return $this->redirectToRoute('Listes_Livres');
            }
        }

        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render('livre/form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function listesLivres()

    {


        $repository = $this->getDoctrine()->getRepository(Livre::class);

        $listesLivres = $repository->findAll();

        return $this->render('livre/index.html.twig', ['lesLivres' => $listesLivres]);
    }

    public function listesBiblioEtLivres()
    {


        $repository = $this->getDoctrine()->getRepository(Livre::class);


              $listBib=$repository->afficheLivresParBiblio();
        return $this->render('biblio/index.html.twig', ['lesBib' => $listBib]);
    }






}
