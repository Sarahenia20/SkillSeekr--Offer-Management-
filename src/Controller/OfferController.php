<?php

namespace App\Controller;
use App\Entity\Status;
use App\Entity\User;
use App\Entity\Offer;
use App\Form\OfferType;
use App\Repository\OfferRepository;
use Doctrine\Persistence\ManagerRegistry; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class OfferController extends AbstractController
{
    #[Route('/offerList', name: 'app_offer_index', methods: ['GET'])]
    public function index(OfferRepository $offerRepository): Response
    {
        return $this->render('back/offer/index.html.twig', [
            'offers' => $offerRepository->findAll(),
        ]);
    }

    #[Route('/newOffer', name: 'app_offer_new', methods: ['GET', 'POST'])]
    public function new(ManagerRegistry $mr,Request $request, EntityManagerInterface $entityManager): Response
    {

        $offer = new Offer();
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // If "Publish" button is clicked
        if ($request->request->has('publish')) {
            // Get the EntityManager
            $entityManager = $mr->getManager();
            
            // Fetch the status object for "Published" from the database
            $publishedStatus = $entityManager->getRepository(Status::class)->findOneBy(['status' => 'Published']);

            // Update offer status to "Published"
            $offer->setStatus($publishedStatus);
            $this->addFlash('success', 'Offer has been published!');
        }
        
            $entityManager->persist($offer);
            $entityManager->flush();
            $this->addFlash('success', 'Offer created successfully!');
            return $this->redirectToRoute('app_offer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/offer/new.html.twig', [
            'offer' => $offer,
            'form' => $form,
            'page_title' => 'Offer Space',
            'active_page' => 'Add Your Offer',
        ]);
    }

    #[Route('/showOffer{id}', name: 'app_offer_show', methods: ['GET'])]
    public function show(Offer $offer): Response
    {
        return $this->render('offer/show.html.twig', [
            'offer' => $offer,
        ]);
    }

    #[Route('/editOffer{id}', name: 'app_offer_edit', methods: ['GET', 'POST'])]
    public function edit(ManagerRegistry $mr,Request $request, Offer $offer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->isSubmitted() && $form->isValid()) {
                // If "Publish" button is clicked
            if ($request->request->has('publish')) {
                // Get the EntityManager
                $entityManager = $mr->getManager();
    
                // Fetch the status object for "Published" from the database
                $publishedStatus = $entityManager->getRepository(Status::class)->findOneBy(['status' => 'Published']);
    
                // Update offer status to "Published"
                $offer->setStatus($publishedStatus);
            }
            $entityManager->flush();
            $this->addFlash('success', 'Offer has been updated successfully!');

            return $this->redirectToRoute('app_offer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/offer/edit.html.twig', [
            'offer' => $offer,
            'form' => $form,
        ]);
        }
    }
    #[Route('/deleteOffer{id}', name: 'app_offer_delete', methods: ['POST'])]
    public function delete(Request $request, Offer $offer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offer->getId(), $request->request->get('_token'))) {
            $entityManager->remove($offer);
            $entityManager->flush();

            // Flash message for successful deletion
            $this->addFlash('success', 'Offer deleted successfully!');
        } else {
            // Flash message for CSRF token invalidation (optional)
            $this->addFlash('error', 'Invalid CSRF token. Offer could not be deleted.');
        }

        return $this->redirectToRoute('app_offer_index', [], Response::HTTP_SEE_OTHER);
    }

 
}
