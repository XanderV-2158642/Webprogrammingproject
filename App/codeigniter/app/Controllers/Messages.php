<?php

namespace App\Controllers;
use App\Models\MessageModel;
use App\Models\UserModel;


class Messages extends BaseController
{
    public function index()
    {
        $chats = $this->getChats();

        $chatdata = [];
        foreach($chats as $chat){
            $corr_id = $this->corresponder($chat);
            $usertable = new UserModel();
            $corresponder = $usertable->find($corr_id);
            $lastmessage = $this->getLastMessage($corr_id);

            $chatinfo = [
                'corresponder' => $corresponder['user_name'],
                'corresponder_id' => $corr_id,
                'lastmessage' => $lastmessage['message'],
                'chatwr' => $chat,
                'user_id' => session()->get('user_id')
            ];

            array_push($chatdata, $chatinfo);
        }
        
        
        $data = [
            'chats' => $chatdata
        ];
        return view('/messages/messages', $data);
    }

    public function chat($corresponder_id){
        $user_id = session()->get('user_id');

        $usertable = new UserModel();
        $corresponder = $usertable->find($corresponder_id);

        $db = db_connect();
        $querystring = "SELECT *
                        FROM Messages
                        WHERE (writer_id = " . $user_id . " AND receiver_id = " . $corresponder_id . ") OR (writer_id = " . $corresponder_id . " AND receiver_id = " . $user_id . ")"
                     ." ORDER BY timestamp";

        $query = $db->query($querystring);
        $allresults = $query->getResultArray();

        $this->setRead($allresults);

        $data = [
            'messages' => $allresults,
            'corr_id' => $corresponder_id,
            'corresponder' => $corresponder
        ];

        return view('/messages/chat', $data);
    }


    public function writemessage($receiver_id){
        $usertable = new UserModel();
        $receiver = $usertable->find($receiver_id);

        $data = [
            'receiver' => $receiver
        ];

        if($this->request->getMethod() == 'post'){
            $rules = [
                'message' => 'required|min_length[10]|max_length[600]|alpha_numeric_punct'
            ];
            if ($this->validate($rules)){
                $messagetable = new MessageModel();
                $user_id = session()->get('user_id');
                $message = [
                    'writer_id' => $user_id,
                    'receiver_id' => $receiver_id,
                    'message' => $this->request->getPost('message'),
                    'beenread' => 0
                ];
                $messagetable->insert($message);
                return redirect()->to(base_url('/Messages'));
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('/messages/writemessage', $data);
    }

    private function getChats(){
        $user_id = session()->get('user_id');

        $db = db_connect();
        $querystring = "SELECT *
                        FROM Messages
                        WHERE (writer_id = " . $user_id . " or receiver_id = " . $user_id . 
                      ") ORDER BY timestamp";

        $query = $db->query($querystring);
        $allresults = $query->getResultArray();

        $distinctchats = [];
        $seen = [];
        foreach ($allresults as $chat){
            $pair = [$chat['writer_id'], $chat['receiver_id']];
            sort($pair);
            if (!(in_array($pair, $seen))){
                array_push($distinctchats, $chat);
                array_push($seen, $pair);
            }
        }

        return $distinctchats;
    }

    private function getLastMessage($corresponder_id){
        $user_id = session()->get('user_id');
        
        $db = db_connect();
        $querystring = "SELECT *
                        FROM Messages
                        WHERE (writer_id = " . $user_id . " AND receiver_id = " . $corresponder_id . ") OR (writer_id = " . $corresponder_id . " AND receiver_id = " . $user_id . ")"
                     ." ORDER BY timestamp";

        $query = $db->query($querystring);
        $allresults = $query->getResultArray();

        return end($allresults);
    }

    private function corresponder($chat){
        $user_id = session()->get('user_id');
        if ($chat['writer_id'] == $user_id){
            return $chat['receiver_id'];
        } elseif ($chat['receiver_id'] == $user_id){
            return $chat['writer_id'];
        }
    }

    private function setRead($chats){
        $messagetable = new MessageModel();
        foreach ($chats as $chat){
            $chat['beenread'] = 1;
            $messagetable->update($chat['message_id'], $chat);
        }
    }
}