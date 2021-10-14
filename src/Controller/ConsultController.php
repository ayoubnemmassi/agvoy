<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\RegionRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Room;
use App\Entity\Region;
use Symfony\Component\HttpFoundation\Request;
use App\Form\indextype;
use App\Repository\RoomRepository;

class ConsultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $room = new Room();
        $form = $this->createForm( indextype::class, $room);
        $em = $this->getDoctrine()->getManager();
        
        $regionRepository=$em->getRepository(Region::class);
        return $this->render('accueil/index.html.twig', [
            'regions' => $regionRepository->findAll(),
            'controller_name' => 'ConsultController',
            'form' => $form->createView(),
        ]);
    }
      /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render('accueil/about.html.twig', [
            'controller_name' => 'ConsultController',
        ]);
    }  /**
    * @Route("/blog", name="blog")
    */
   public function blog(): Response
   {
       return $this->render('accueil/blog.html.twig', [
           'controller_name' => 'ConsultController',
       ]);
   }  /**
   * @Route("/booking", name="booking")
   */
  public function booking(): Response
  {
      return $this->render('accueil/booking.html.twig', [
          'controller_name' => 'ConsultController',
      ]);
  }  /**
  * @Route("/collection", name="collection")
  */
 public function collection(): Response
 {
     return $this->render('accueil/collection.html.twig', [
         'controller_name' => 'ConsultController',
     ]);
 }
   /**
     * @Route("/elements", name="elements")
     */
    public function elements(): Response
    {
        return $this->render('accueil/elements.html.twig', [
            'controller_name' => 'ConsultController',
        ]);
    }
      /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('accueil/contact.html.twig', [
            'controller_name' => 'ConsultController',
        ]);
    }
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard(): Response
    {
        return $this->render('dashboard/dashboard.html.twig', [
            'controller_name' => 'ConsultController',
        ]);
    }
   /* public function search(Request $request): Response
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
   $data = $request->request->get('id');
        $roomRepo = $this->getDoctrine()->getRepository('App:Room');
        $rooms = $roomRepo->findOneBy(['id' => $data]);

         return $this->render('room/index.html.twig', [
            'rooms' => $rooms,
        ]);
    }*/

    /**
     * @Route("/search",name="searchhandle")
     * @param Request $request
     */
    public function handlesearch(Request $request)
    {
        $data = $request->request->get('name');
        
        $roomRepo = $this->getDoctrine()->getRepository('App:Region');
        $regions = $roomRepo->findBy(['name' => $data]);
        foreach($regions as $region)
        {
            $rooms[] = $region->getRoomsinregions();
        }
         return $this->render('room/index.html.twig', [
            'rooms' => $rooms,
        ]);
    }
}
