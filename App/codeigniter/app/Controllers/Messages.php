<?php

namespace App\Controllers;

class Messages extends BaseController
{
    public function index()
    {
        $data = [
            'chats' => [
                ['sender' => 'Hertog jan', 'message' => 'Is deze nog beschikbaar']
            ]
            ];
        return view('messages', $data);
    }
}