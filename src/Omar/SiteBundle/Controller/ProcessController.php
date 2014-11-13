<?php

namespace Omar\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Omar\SiteBundle\Entity\Process;
use Omar\SiteBundle\Form\ProcessType;

/**
 * Process controller.
 *
 */
class ProcessController extends Controller
{

    /**
     * Lists all Process entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OmarSiteBundle:Process')->findAll();

        return $this->render('OmarSiteBundle:Process:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Process entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Process();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('process_show', array('id' => $entity->getId())));
        }

        return $this->render('OmarSiteBundle:Process:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Process entity.
     *
     * @param Process $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Process $entity)
    {
        $form = $this->createForm(new ProcessType(), $entity, array(
            'action' => $this->generateUrl('process_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Process entity.
     *
     */
    public function newAction()
    {
        $entity = new Process();
        $form   = $this->createCreateForm($entity);

        return $this->render('OmarSiteBundle:Process:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Process entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OmarSiteBundle:Process')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Process entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OmarSiteBundle:Process:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Process entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OmarSiteBundle:Process')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Process entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OmarSiteBundle:Process:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Process entity.
    *
    * @param Process $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Process $entity)
    {
        $form = $this->createForm(new ProcessType(), $entity, array(
            'action' => $this->generateUrl('process_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Process entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OmarSiteBundle:Process')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Process entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('process_edit', array('id' => $id)));
        }

        return $this->render('OmarSiteBundle:Process:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Process entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OmarSiteBundle:Process')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Process entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('process'));
    }

    /**
     * Creates a form to delete a Process entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('process_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
