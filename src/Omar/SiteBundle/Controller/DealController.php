<?php

namespace Omar\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Omar\SiteBundle\Entity\Deal;
use Omar\SiteBundle\Form\DealType;

/**
 * Deal controller.
 *
 */
class DealController extends Controller
{

    /**
     * Lists all Deal entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OmarSiteBundle:Deal')->findAll();

        return $this->render('OmarSiteBundle:Deal:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Deal entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Deal();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('deal_show', array('id' => $entity->getId())));
        }

        return $this->render('OmarSiteBundle:Deal:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Deal entity.
     *
     * @param Deal $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Deal $entity)
    {
        $form = $this->createForm(new DealType(), $entity, array(
            'action' => $this->generateUrl('deal_create'),
            'method' => 'POST',
        ));
        
        return $form;
    }

    /**
     * Displays a form to create a new Deal entity.
     *
     */
    public function newAction()
    {
        $entity = new Deal();
        $form   = $this->createCreateForm($entity);

        return $this->render('OmarSiteBundle:Deal:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Deal entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OmarSiteBundle:Deal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Deal entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OmarSiteBundle:Deal:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Deal entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OmarSiteBundle:Deal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Deal entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OmarSiteBundle:Deal:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Deal entity.
    *
    * @param Deal $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Deal $entity)
    {
        $form = $this->createForm(new DealType(), $entity, array(
            'action' => $this->generateUrl('deal_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Deal entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OmarSiteBundle:Deal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Deal entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('deal_edit', array('id' => $id)));
        }

        return $this->render('OmarSiteBundle:Deal:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Deal entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OmarSiteBundle:Deal')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Deal entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('deal'));
    }

    /**
     * Creates a form to delete a Deal entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('deal_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
