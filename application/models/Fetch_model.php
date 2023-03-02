<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fetch_model extends CI_Model
{
    public function request_hash()
    {
        /* Endpoint */
        $url = 'https://track.colinn.id/api/user/auth';

        /* eCurl */
        $curl = curl_init($url);

        /* Data */
        $data = array(
            'login' => "mike@mike.com",
            'password' => "123456",
        );
        $payload = json_encode($data);
        /* Set JSON data to POST */
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);

        /* Define content type */
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
            'Accept: application/json',
        ));

        /* Return json */
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        /* make request */
        $result = curl_exec($curl);

        /* close curl */
        curl_close($curl);
        // print_r(json_decode($result));
        $this->session->set_userdata('hash', json_decode($result));
        return json_decode($result);
    }
    public function request_tracker()
    {
        $hash = array();
        if ($this->session->userdata('hash')) {
            $hash = $this->session->userdata('hash');
        } else {
            $hash = $this->request_hash();
        }
        if ($hash->success) {
            $url = 'https://track.colinn.id/api/tracker/list';

            /* eCurl */
            $curl = curl_init($url);

            /* Data */
            $data = array(
                'hash' => $hash->hash,
            );
            $payload = json_encode($data);
            /* Set JSON data to POST */
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);

            /* Define content type */
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type:application/json',
                'Accept: application/json',
            ));

            /* Return json */
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            /* make request */
            $result = curl_exec($curl);

            /* close curl */
            curl_close($curl);
            // print_r($result);
            return json_decode($result);
        } else {
            return (object)array('success' => false,);
        }
    }
    public function post_delivery($post_data)
    {
        //TODO
        // return (object)array('success' => false,);
        $items = json_decode($post_data['items']);
        $items_show = "";
        // var_dump($post_data['items']->order_id);
        if ($items->order_id) {
            $items_show .= "Order ID: \n";
            foreach ($items->order_id as $order) {
                $items_show .= "- " . $order . "\n";
            }
        }
        if ($items->sku) {
            $items_show .= "SKU: \n";
            foreach ($items->sku as $sku) {
                $items_show .= "- " . $sku->sku_code . " (" . $sku->quantity . ")\n";
            }
        }
        // var_dump($items_show);
        $json_post = array(
            "tracker_id" => $post_data['tracker_id'],
            "location" => array(
                "lat" => $post_data['lat'],
                "lng" => $post_data['lng'],
                "radius" => 50,
                "address" => $post_data['address']
            ),
            "label" => $post_data['customer'],
            "description" => $items_show,
            "from" => $post_data['from_time'] . '+0700',
            "to" => $post_data['to_time'] . '+0700',
            "max_delay" => 0,
            "min_stay_duration" => 1,
            "external_id" => $post_data['tracking_number']
        );
        $hash = array();
        if ($this->session->userdata('hash')) {
            $hash = $this->session->userdata('hash');
        } else {
            $hash = $this->request_hash();
        }
        if ($hash->success) {
            $url = 'https://track.colinn.id/api/task/create';

            /* eCurl */
            $curl = curl_init($url);

            /* Data */
            $data = array(
                'hash' => $hash->hash,
                'task' => $json_post
            );
            $payload = json_encode($data);
            /* Set JSON data to POST */
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);

            /* Define content type */
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type:application/json',
                'Accept: application/json',
            ));

            /* Return json */
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            /* make request */
            $result = curl_exec($curl);

            /* close curl */
            curl_close($curl);
            // print_r($result);
            return json_decode($result);
        } else {
            return (object)array('success' => false,);
        }
    }
    public function get_link()
    {
        //TODO
        // return (object)array('success' => false,);
        $hash = array();
        if ($this->session->userdata('hash')) {
            $hash = $this->session->userdata('hash');
        } else {
            $hash = $this->request_hash();
        }
        if ($hash->success) {
            return 'https://track.colinn.id/pro/applications/delivery/?key=' . $hash->hash . '&prompt_placeholder=Masukan%20Order%20ID&panel_scale=big&map=roadmap&external_id=';
        } else {
            return 'error';
        }
    }
    public function get_status_by_id($id)
    {
        $hash = array();
        if ($this->session->userdata('hash')) {
            $hash = $this->session->userdata('hash');
        } else {
            $hash = $this->request_hash();
        }
        if ($hash->success) {
            $url = 'https://track.colinn.id/api/task/list';

            /* eCurl */
            $curl = curl_init($url);

            /* Data */
            $data = array(
                'hash' => $hash->hash,
                'external_id' => $id
            );
            $payload = json_encode($data);
            /* Set JSON data to POST */
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);

            /* Define content type */
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type:application/json',
                'Accept: application/json',
            ));

            /* Return json */
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            /* make request */
            $result = curl_exec($curl);

            /* close curl */
            curl_close($curl);
            // print_r($result);
            return json_decode($result);
        } else {
            return 'error';
        }
    }
    public function delete_task($id)
    {
        $fetch_status = $this->get_status_by_id($id);
        $task_id = 0;
        if ($fetch_status != 'error') {
            if ($fetch_status->success) {
                $task_id = $fetch_status->list[0]->id;
            }
        }
        $hash = array();
        if ($this->session->userdata('hash')) {
            $hash = $this->session->userdata('hash');
        } else {
            $hash = $this->request_hash();
        }
        if ($hash->success) {
            $url = 'https://track.colinn.id/api/task/delete';

            /* eCurl */
            $curl = curl_init($url);

            /* Data */
            $data = array(
                'hash' => $hash->hash,
                'task_id' => $task_id
            );
            $payload = json_encode($data);
            /* Set JSON data to POST */
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);

            /* Define content type */
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type:application/json',
                'Accept: application/json',
            ));

            /* Return json */
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            /* make request */
            $result = curl_exec($curl);

            /* close curl */
            curl_close($curl);
            // print_r($result);
            return json_decode($result);
        } else {
            return 'error';
        }
    }
}
