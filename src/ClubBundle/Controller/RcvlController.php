<?php

namespace ClubBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ClubBundle\Entity\Rcvl;
use ClubBundle\Form\RcvlType;

/**
 * Rcvl controller.
 *
 */
class RcvlController extends Controller
{
    /**
     * Lists all Rcvl entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rcvls = $em->getRepository('ClubBundle:Rcvl')->findAll();

        return $this->render('ClubBundle:rcvl:index.html.twig', array(
            'rcvls' => $rcvls,
        ));
    }

    /**
     * Creates a new Rcvl entity.
     *
     */
    public function newAction(Request $request)
    {
        $rcvl = new Rcvl();
        $form = $this->createForm('ClubBundle\Form\RcvlType', $rcvl);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rcvl);
            $em->flush();

            return $this->redirectToRoute('rcvl_show', array('id' => $rcvl->getId()));
        }

        return $this->render('ClubBundle:rcvl:new.html.twig', array(
            'rcvl' => $rcvl,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Rcvl entity.
     *
     */
    public function showAction(Rcvl $rcvl)
    {
        $deleteForm = $this->createDeleteForm($rcvl);

        return $this->render('ClubBundle:rcvl:show.html.twig', array(
            'rcvl' => $rcvl,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Rcvl entity.
     *
     */
    public function editAction(Request $request, Rcvl $rcvl)
    {
        $deleteForm = $this->createDeleteForm($rcvl);
        $editForm = $this->createForm('ClubBundle\Form\RcvlType', $rcvl);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rcvl);
            $em->flush();

            return $this->redirectToRoute('rcvl_edit', array('id' => $rcvl->getId()));
        }

        return $this->render('ClubBundle:rcvl:edit.html.twig', array(
            'rcvl' => $rcvl,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Rcvl entity.
     *
     */
    public function deleteAction(Request $request, Rcvl $rcvl)
    {
        $form = $this->createDeleteForm($rcvl);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rcvl);
            $em->flush();
        }

        return $this->redirectToRoute('rcvl_index');
    }

    /**
     * Creates a form to delete a Rcvl entity.
     *
     * @param Rcvl $rcvl The Rcvl entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Rcvl $rcvl)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rcvl_delete', array('id' => $rcvl->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
