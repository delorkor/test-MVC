<?php

namespace Test\Test\Controller\api;
use Test\Test\Model\Order;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class OrdersController
{
    public function actionOrders(string $userId)
    {
        
        $usersOrder = Order::getUserOrders($userId, false);
        $response= new JsonResponse($usersOrder);
        $response->send();
    }



    public function actionCreate()
    {
        $request = Request::createFromGlobals();
        $data = $request->toArray();
// echo print_r($data);
        if (empty($data['id_user']) || empty($data['product'])) {
            $errorResponse = new JsonResponse(['message' => 'Ты ввел недостаточно данных!']);
            $errorResponse->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);

            $errorResponse->send();

            return;
        }

        Order::create($data);

        $response = new JsonResponse($data);
        $response->setStatusCode(JsonResponse::HTTP_CREATED);

        $response->send();
    }
}