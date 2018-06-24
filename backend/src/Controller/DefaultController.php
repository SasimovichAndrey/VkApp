<?php
/**
 * Created by PhpStorm.
 * User: ordiday
 * Date: 20.06.2018
 * Time: 22:38
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\SelectedUser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction()
    {
        return new JsonResponse(null, Response::HTTP_FORBIDDEN);
    }

    /**
     * @Route("/saveUserSelectedFriends")
     * @Method("POST")
     */
    public function saveSelectedUser(Request $request)
    {
        $data =  json_decode($request->getContent());
        $userId = $data->userId;
        $selectedUsers = $data->selectedUsers;

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(SelectedUser::class);
        $existed = $repository->findBy(["UserId" => $userId]);

        foreach($existed as $ex){
            $em->remove($ex);    
        }
        
        foreach($selectedUsers as $selected){
            $newSelected = new SelectedUser();
            $newSelected->SetUserId($userId)
                        ->setSelectedUserId($selected);
            $em->persist($newSelected);
        }
        
        $em->flush();

        return new JsonResponse();
    }

    /**
     * @Route("/getSelectedFriends/{userId}")
     */
    public function getSelectedUsers(Request $req, $userId){

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(SelectedUser::class);

        $existed = $repository->findBy(["UserId" => $userId]);
        
        $jsonObjs = array_map(function ($el){
            return $el->getSelectedUserId();
        }, $existed);

        return new JsonResponse($jsonObjs);
    }

}