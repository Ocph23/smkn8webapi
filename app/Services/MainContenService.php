<?php

namespace App\Services;

use App\Models\MainContent;

class MainContenService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getById($id): MainContent
    {
        $data =  MainContent::find($id);
        if ($data) {
            $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === FALSE ? 'http' : 'https';
            $domainLink = $protocol . '://' . $_SERVER['HTTP_HOST'];
            $data->content = str_replace('../../../',$domainLink.'/', $data->content);
            $data->content = html_entity_decode($data->content);
            return $data;
        }
    }
}
