<?php

namespace Test\Test\Controller\api;
use Test\Test\Model\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class UsersController
{
    public function actionIndex()
    {
        $users = User::getAll(false);

        $response= new JsonResponse($users);
        $response->send();
    }
    public function actionCreate()
    {
        $request = Request::createFromGlobals();
        $data = $request->toArray();

        if (empty($data['name']) || empty($data['surname'])) {
            $errorResponse = new JsonResponse(['message' => 'Ты ввел недостаточно данных!']);
            $errorResponse->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);

            $errorResponse->send();

            return;
        }

        User::create($data);

        $response = new JsonResponse($data);
        $response->setStatusCode(JsonResponse::HTTP_CREATED);

        $response->send();
    }
    public function actionView($userId)
    {
        $users = User::getUser($userId,false);

        $response= new JsonResponse($users);
        $response->send();
        
      
    }
    public function actionDelete(string $userId)
    {
        $users = User::Delete($userId,false);

        $response= new JsonResponse($users);
        $response->send();
        
      
    }
}

