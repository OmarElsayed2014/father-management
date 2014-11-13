<?php

namespace Omar\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Omar\SiteBundle\Entity\Avatar;
use Omar\SiteBundle\Form\AvatarType;

/**
 * Avatar controller.
 *
 */
class AvatarController extends Controller
{

    /**
     * Lists all Avatar entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OmarSiteBundle:Avatar')->findAll();

        return $this->render('OmarSiteBundle:Avatar:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Avatar entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Avatar();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('avatar_show', array('id' => $entity->getId())));
        }

        return $this->render('OmarSiteBundle:Avatar:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Avatar entity.
     *
     * @param Avatar $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Avatar $entity)
    {
        $form = $this->createForm(new AvatarType(), $entity, array(
            'action' => $this->generateUrl('avatar_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Avatar entity.
     *
     */
    public function newAction()
    {
        $entity = new Avatar();
        $form   = $this->createCreateForm($entity);

        return $this->render('OmarSiteBundle:Avatar:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Avatar entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OmarSiteBundle:Avatar')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Avatar entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OmarSiteBundle:Avatar:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Avatar entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OmarSiteBundle:Avatar')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Avatar entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OmarSiteBundle:Avatar:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Avatar entity.
    *
    * @param Avatar $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Avatar $entity)
    {
        $form = $this->createForm(new AvatarType(), $entity, array(
            'action' => $this->generateUrl('avatar_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Avatar entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OmarSiteBundle:Avatar')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Avatar entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('avatar_edit', array('id' => $id)));
        }

        return $this->render('OmarSiteBundle:Avatar:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Avatar entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OmarSiteBundle:Avatar')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Avatar entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('avatar'));
    }

    /**
     * Creates a form to delete a Avatar entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('avatar_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
