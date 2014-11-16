<?php

namespace Omar\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OmarSiteBundle:Default:index.html.twig');
    }
    
    /**
     * authenticate memory users that are stored in security.yml
     * 
     * @author Omar ELsayed <omarelsayed1992@gmail.com>
     */
    public function loginAction(Request $request)
    {
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $request->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
            $request->getSession()->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return  $this->render( "OmarSiteBundle:Default:login.html.twig", array(
            'last_username' => $request->getSession()->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }
    
    /**
     * authenticate memory users that are stored in security.yml
     * 
     * @author Omar ELsayed <omarelsayed1992@gmail.com>
     *
    public function loginAction(Request $request)
    {
        
    }*/
}
