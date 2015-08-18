<?php
/**
 * Created by PhpStorm.
 * User: shadan_pc
 * Date: 18-08-2015
 * Time: 15:33
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Response;

class APIController extends Controller{

    protected $status_code = 200;

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->status_code;
    }

    /**
     * @param $status_code
     * @return $this
     */
    public function setStatusCode($status_code)
    {
        $this->status_code = $status_code;

        return $this;
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondNotFound($message = 'Requested resource was not found.')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }


    /**
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }
} 