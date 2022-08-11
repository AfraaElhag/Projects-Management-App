<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Repositories\ClientRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Flash;
use Response;
use Illuminate\Support\Facades\Gate;
use Auth;

class ClientController extends AppBaseController
{
    /** @var ClientRepository $clientRepository*/
    private $clientRepository;

    public function __construct(ClientRepository $clientRepo)
    {
        $this->clientRepository = $clientRepo;
    }

    
    public function search(Request $request)
    {
        $q=$request->input('keyword');

        $results=$this->clientRepository->searchQuery(['name','company_name' , 'email' , 'phone'] , $q)->get();
        return response()->json([ 'results' => $results ]);
        
    }

    /**
     * Display a listing of the Client.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (Gate::any(['isAdmin','isCustomerService'])) {
            $clients = $this->clientRepository->paginate(10);

            return view('clients.index')->with('clients', $clients);
        }
        else{
                abort(403);
            }
    }

    /**
     * Show the form for creating a new Client.
     *
     * @return Response
     */
    public function create()
    {
        if (Gate::any(['isAdmin','isCustomerService'])) {
            return view('clients.create');
        }
        else{
                abort(403);
            }
        
    }

    /**
     * Store a newly created Client in storage.
     *
     * @param CreateClientRequest $request
     *
     * @return Response
     */
    public function store(CreateClientRequest $request)
    {
        if (Gate::any(['isAdmin','isCustomerService'])) {
            $input = $request->all();
            
            $input['password'] = Hash::make($input['password']);

            $client = $this->clientRepository->create($input);

            Flash::success('Client saved successfully.');

            return redirect(route('clients.index'));
        }
        else{
                abort(403);
            }
    }

    /**
     * Display the specified Client.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        if (Gate::any(['isAdmin','isCustomerService'])) {
            $client = $this->clientRepository->findWithTrashed($id);

            if (empty($client)) {
                Flash::error('Client not found');

                return redirect(route('clients.index'));
            }

            return view('clients.show')->with('client', $client);
        }
        else{
                abort(403);
            }
    }

    /**
     * Show the form for editing the specified Client.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if (Gate::any(['isAdmin','isCustomerService','isClient'])) {
            $client = $this->clientRepository->find($id);

            if (empty($client)) {
                Flash::error('Client not found');
                if(Auth::user()->role=='admin' || Auth::user()->role=='customer service'){
                return redirect(route('clients.index'));
                }else{
                    return redirect(route('home'));
                }
            }

            return view('clients.edit')->with('client', $client);
        }
        else{
                abort(403);
            }
    }

    /**
     * Update the specified Client in storage.
     *
     * @param int $id
     * @param UpdateClientRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClientRequest $request)
    {
        if (Gate::any(['isAdmin','isCustomerService','isClient'])) {
            $client = $this->clientRepository->find($id);

            if (empty($client)) {
                Flash::error('Client not found');

                if(Auth::user()->role=='admin' || Auth::user()->role=='customer service'){
                    return redirect(route('clients.index'));
                    }else{
                        return redirect(route('home'));
                    }
            }

            $input = $request->all();
            if ($input['password'] != NULL) {
            
                $input['password'] = Hash::make($input['password']);
            }
            else{
                $input['password'] =$client->password;
            }


            $client = $this->clientRepository->update($input, $id);

            Flash::success('Client updated successfully.');

            if(Auth::user()->role=='admin' || Auth::user()->role=='customer service'){
                return view('clients.show')->with('client', $client);
                }else{
                    return redirect(route('home'));
                }
        }
        else{
                abort(403);
            }
    }

    /**
     * Remove the specified Client from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        if (Gate::any(['isAdmin','isCustomerService'])) {
            $client = $this->clientRepository->find($id);

            if (empty($client)) {
                Flash::error('Client not found');

                return redirect(route('clients.index'));
            }

            $this->clientRepository->delete($id);

            Flash::success('Client deleted successfully.');

            return redirect(route('clients.index'));
        }
        else{
                abort(403);
            }
    }
}
