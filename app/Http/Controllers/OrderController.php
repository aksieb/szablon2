<?php

namespace App\Http\Controllers;

use App\Contants\Main;
use App\Repositories\CategoryRepository;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{

    public function index(
        OrderRepository $orderRepository
    ) {
        $orders = $orderRepository->getAllPaginated();

        return view('dashboard.orders.index', array(
            'orders'  => $orders
        ));
    }

    public function show(
        $id,
        OrderRepository $orderRepository,
        CategoryRepository $categoryRepository
    ) {
        $order = $orderRepository->find($id);
        $categories = $categoryRepository->getAll(array('id', 'name'));

        return view('dashboard.orders.show', array(
            'order'         => $order,
            'categories'    => $categories,
            'units'         => Main::UNITS
        ));
    }
}
