<?php

namespace Omar\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Omar\SiteBundle\Entity\Dealer;
use Omar\SiteBundle\Form\DealerType;

/**
 * Dealer controller.
 *
 */
class DealerController extends Controller
{

    /**
     * Lists all Dealer entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OmarSiteBundle:Dealer')->findAll();

        return $this->render('OmarSiteBundle:Dealer:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Dealer entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Dealer();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('dealer_show', array('id' => $entity->getId())));
        }

        return $this->render('OmarSiteBundle:Dealer:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Dealer entity.
     *
     * @param Dealer $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Dealer $entity)
    {
        $form = $this->createForm(new DealerType(), $entity, array(
            'action' => $this->generateUrl('dealer_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Dealer entity.
     *
     */
    public function newAction()
    {
        $entity = new Dealer();
        $form   = $this->createCreateForm($entity);

        return $this->render('OmarSiteBundle:Dealer:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Dealer entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OmarSiteBundle:Dealer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dealer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OmarSiteBundle:Dealer:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Dealer entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OmarSiteBundle:Dealer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dealer entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OmarSiteBundle:Dealer:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Dealer entity.
    *
    * @param Dealer $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Dealer $entity)
    {
        $form = $this->createForm(new DealerType(), $entity, array(
            'action' => $this->generateUrl('dealer_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Dealer entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OmarSiteBundle:Dealer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dealer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('dealer_edit', array('id' => $id)));
        }

        return $this->render('OmarSiteBundle:Dealer:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Dealer entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OmarSiteBundle:Dealer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Dealer entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('dealer'));
    }

    /**
     * Creates a form to delete a Dealer entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dealer_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
