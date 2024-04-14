<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class MainController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('APP_URL') . 'api/v1/',
        ]);
    }

    public function getToken()
    {
        try {
            $responseGetToken = json_decode($this->client->get('token')->getBody(), true);

            $token = $responseGetToken['token'];

            $positions = $this->getPositions();

            return view('register-form', compact('token', 'positions'));

        } catch (RequestException $e) {
            $message = json_decode($e->getResponse()->getBody(), true);
            return $message['message'];

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function register(Request $request)
    {
        try {
            $data = request()->all();

            if (request()->file('photo')) {

                $formData['multipart'][] = [
                    'name' => 'photo',
                    'contents' => file_get_contents(request()->file('photo')->path()),
                    'filename' => request()->file('photo')->getClientOriginalName(),
                ];
            }

            foreach ($data as $key => $value) {
                if ($key != 'photo') {
                    $formData['multipart'][] = [
                        'name' => $key,
                        'contents' => $value
                    ];
                }
            }

            $response = $this->client->post('register',
                [
                    'multipart' => $formData['multipart'],
                    'headers' => [
                        'Authorization' => 'Bearer ' . $data['token'],
                    ]
                ]);

            $response = json_decode($response->getBody(), true);
            $message = $response['message'];

            return view('welcome', compact('message'));

        } catch (RequestException $e) {
            $response = json_decode($e->getResponse()->getBody(), true);
            $fails = $response['fails'];
            return redirect()->back()->withErrors($fails)->withInput();

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function usersList(Request $request)
    {
        try {
            $page = $request->input('page') ?? 1;
            $per_page = $request->input('count') ?? 15;

            if ($request->input('show_more')) {
                $page = 1;
                $per_page = $per_page + 6;
            }

            $users = json_decode($this->client->get('users?page=' . $page . '&count=' . $per_page)->getBody(), true);

            return view('users-list', compact('users'));

        } catch (RequestException $e) {
            $message = json_decode($e->getResponse()->getBody(), true);
            return $message['message'];

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function userById($id)
    {
        try {
            $responseGetUser = json_decode($this->client->get('users/' . $id)->getBody(), true);

            $user = $responseGetUser['user'];

            return view('user-by-id', compact('user'));

        } catch (RequestException $e) {
            $message = json_decode($e->getResponse()->getBody(), true);
            return $message['message'];

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function positionsList()
    {
        try {
            $positions = $this->getPositions();

            return view('positions-list', compact('positions'));

        } catch (RequestException $e) {
            $message = json_decode($e->getResponse()->getBody(), true);
            return $message['message'];

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getPositions()
    {
        $responseGetPositions = json_decode($this->client->get('positions')->getBody(), true);

        $positions = $responseGetPositions['positions'];

        return $positions;
    }
}
