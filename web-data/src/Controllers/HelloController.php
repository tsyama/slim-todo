<?php
namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Controller;

class HelloController extends Controller
{
    public function index(Request $request, Response $response, $args)
    {
        $name = $args['name'];
        $this->logger->addInfo("Hello, {$name}");

        $ticketTable = $this->locator->get('Tickets');
        $ticket = $ticketTable->newEntity(['title' => $name]);
        $ticketTable->save($ticket);

        $data = [
            'name' => $name,
        ];
        return $this->view->render($response, 'hello', $data);
    }
}