<?php

namespace App\Controller;
use App\Entity\Biblio;
use App\Repository\BiblioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class BiblioController extends AbstractController
{

    public function listesBiblio() :Response
    {


        $listesBiblio = $this->getDoctrine()
            ->getManager()
            ->getRepository(Biblio::class)
            ->biblioEtLivres();

        /*foreach ($listesBiblio as $uneBiblio){

            $listons=$uneBiblio->getListesLivres();
        }*/
        //$listes = $listesBiblio->findAll();




           //$listes_livres= $listesBiblio->getListeslivres();


        return $this->render('biblio/index.html.twig', [

            'lesBiblio' => $listesBiblio,
            //'lesLivres' => $listons


        ]);
    }

    public function listesBiblioEtSesLivres ()
    {

    }

    public function ajoutBiblio (Request $request)
    {
        // On crée un objet Biblio
        $biblio = new Biblio();

        // J'ai raccourci cette partie, car c'est plus rapide à écrire !
        $form = $this->get('form.factory')->createBuilder(FormType::class, $biblio)
            ->add('code',  TextType::class,array(
                'help'=>'identifiant pour chaque biblio'))
            ->add('lieu',  TextType::class )
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
                $em->persist($biblio);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Biblio bien enregistrée.');

                // On redirige vers la page de visualisation de la biblio nouvellement créée
                return $this->redirectToRoute('Listes_biblio');
            }
        }

        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render('biblio/form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
