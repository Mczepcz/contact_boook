<?php

namespace ContactBoxBundle\Controller;

use ContactBoxBundle\Entity\Contact;
use ContactBoxBundle\Entity\Addresse;
use ContactBoxBundle\Entity\Email;
use ContactBoxBundle\Entity\Phone;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ContactController extends Controller
{   
    /**
     * @Route("/new", name="postNew")
     * @Method("POST")
     * @Template("ContactBoxBundle::new.html.twig")
     */
    public function newPostAction(Request $request){
        $contact = new Contact;
        $form = $this->createFormBuilder($contact)->setAction($this->generateUrl("postNew"))->setMethod('POST')->add("name")->add("surname")->add("description")->add("submit","submit")->getForm();
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            
           return $this->redirectToRoute('showContact',["id"=>$contact->getId()]);
        }
        
        return $this->redirectToRoute('new');
    }
    /**
     * @Route("/new", name = "new")
     * @Method("GET")
     * @Template("ContactBoxBundle::new.html.twig")
     */
    public function newAction(){
        $contact = new Contact;
        $form = $this->createFormBuilder($contact)->setAction($this->generateUrl("postNew"))->setMethod('POST')->add("name")->add("surname")->add("description")->add("submit","submit")->getForm();
        
        return ['form'=> $form->createView(),"formName"=>"New contact"];   
    }
    /**
     * 
     * @Route("/{id}/modify", name ="modify")
     * @Template("ContactBoxBundle::new.html.twig")
     */
    public function editAction(Request $request, $id){
        $contact = $this->getDoctrine()->getRepository('ContactBoxBundle:Contact')->find($id);
        if(!$contact){
            
            throw $this->creationNotFoundException('Contact not found');
        }
        $form = $this->createFormBuilder($contact)->setAction($this->generateUrl("modify",["id"=>$id]))->setMethod('POST')->add("name")->add("surname")->add("description")->add("submit","submit")->getForm();
        
        $form->handleRequest($request);
        
        if($form->isValid()){
            $this->getDoctrine()->getManager()->flush();
            
            return $this->redirectToRoute('showContact',["id"=>$id]);
        }
        
        return ['form'=>$form->createView(),"formName"=>"Edit contact"]; 
    }
    /**
     * @Route("/{id}/delete", name="delete")
     * 
     */
    public function deleteAction($id){
        $contact = $this->getDoctrine()->getRepository('ContactBoxBundle:Contact')->find($id);
        if(!$contact){
            
            throw $this->createNotFoundException("Contact not found");
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($contact);
        $em->flush;
        
        return new Response("<html><body><p>Usunięto kontakt<p></body></html>");
    }
    /**
     * @Route("/{id}", name="showContact")
     * @Template("ContactBoxBundle::show.html.twig")
     */
    public function showAction($id){
        $contact = $this->getDoctrine()->getRepository('ContactBoxBundle:Contact')->find($id);
        if(!$contact){
            
            throw $this->createNotFoundException("Contact not found");
        }
        
        return ['contact'=>$contact];
    }
    
    /**
     * @Route("/", name = "showAll")
     * @Template("ContactBoxBundle::showAll.html.twig")
     */
    public function showAllAction(){
        $contacts = $this->getDoctrine()->getRepository('ContactBoxBundle:Contact')->findAll();
        
        return ["contacts"=>$contacts];
    }
    
    /**
     * 
     * @Route("/{id}/addAddres", name="addAddress")
     * @Template("ContactBoxBundle::new.html.twig")
     */
    
    public function addAddressAction(Request $request, $id){
        $address = new Addresse();
        $contact = $this->getDoctrine()->getRepository('ContactBoxBundle:Contact')->find($id);
        if(!$contact){
            throw $this->creationNotFoundException('Contact not found');
        }
        $form = $this->createFormBuilder($address)->setAction($this->generateUrl("addAddress",["id"=>$id]))->setMethod('POST')->add("city")->add("street")->add("houseNo")->add("apartmentNo")->add("submit","submit")->getForm();
        
        $form->handleRequest($request);
        
        if($form->isValid()){
            $address->setContact($contact);
            $contact->addAddress($address);
            $em= $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();
            
            return $this->redirectToRoute('showContact',["id"=>$id]);
        }
        
        return ['form'=>$form->createView(),"formName"=>"New address"]; 
        
    }
    /**
     * 
     * @Route("/{id}/addEmail", name="addEmail")
     * @Template("ContactBoxBundle::new.html.twig")
     */
    public function addEmailAction(Request $request, $id){
        $email = new Email();
        $contact = $this->getDoctrine()->getRepository('ContactBoxBundle:Contact')->find($id);
        if(!$contact){
            throw $this->creationNotFoundException('Contact not found');
        }
        $form = $this->createFormBuilder($email)->setAction($this->generateUrl("addEmail",["id"=>$id]))->setMethod('POST')->add("email")->add("type","choice",array("choices"=>array("Private"=>"Private","Office"=>"Office"),'choices_as_values' => true))->add("submit","submit")->getForm();
        
        $form->handleRequest($request);
        
        if($form->isValid()){
            $email->setContact($contact);
            $contact->addEmail($email);
            $em= $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();
            
            return $this->redirectToRoute('showContact',["id"=>$id]);
        }
        
        return ['form'=>$form->createView(),"formName"=>"New email"]; 
        
    }
    /**
     * 
     * @Route("/{id}/addPhone", name="addPhone")
     * @Template("ContactBoxBundle::new.html.twig")
     */
    public function addPhoneAction(Request $request, $id){
        $phone = new Phone();
        $contact = $this->getDoctrine()->getRepository('ContactBoxBundle:Contact')->find($id);
        if(!$contact){
            throw $this->creationNotFoundException('Contact not found');
        }
        $form = $this->createFormBuilder($phone)->setAction($this->generateUrl("addPhone",["id"=>$id]))->setMethod('POST')->add("phoneNo")->add("type","choice",array("choices"=>array("Home"=>"Home","Office"=>"Office","Mobile"=>"Mobile"),'choices_as_values' => true))->add("submit","submit")->getForm();
        
        $form->handleRequest($request);
        
        if($form->isValid()){
            $phone->setContact($contact);
            $contact->addPhone($phone);
            $em= $this->getDoctrine()->getManager();
            $em->persist($phone);
            $em->flush();
            
            return $this->redirectToRoute('showContact',["id"=>$id]);
        }
        
        return ['form'=>$form->createView(),"formName"=>"New phone"]; 
        
    }
}
