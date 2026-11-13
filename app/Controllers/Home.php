<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'ShopEase - Online Store',
            'store_name' => 'ShopEase'
        ];

        return view('landing_page', $data);
    }
}