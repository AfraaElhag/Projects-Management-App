<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Gate;
use Auth;

class UserController extends AppBaseController
{
    /** @var UserRepository $userRepository*/
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }


    public function search(Request $request)
    {
        $q=$request->input('keyword');

        $results=$this->userRepository->searchQuery(['name', 'email' , 'phone'] , $q)->get();
       return response()->json([
        'results' => $results
     ]);
        
    }
    
    

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (Gate::any(['isAdmin','isCustomerService'])) {
            $users = $this->userRepository->paginate(10);

            return view('users.index')
                ->with('users', $users);
        }
        else{
                abort(403);
            }
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        if (Gate::any(['isAdmin','isCustomerService'])) {
            return view('users.create');
        }
        else{
                abort(403);
            }
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        if (Gate::any(['isAdmin','isCustomerService'])) {
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
                
                
            $user = $this->userRepository->create($input);

            Flash::success('User saved successfully.');

            return redirect(route('users.index'));
        }
        else{
                abort(403);
            }
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        
       $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            if(Auth::user()->role=='admin' || Auth::user()->role=='customer service'){
                return redirect(route('users.index'));
                }else{
                    return redirect(route('home'));
                }
        }

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        
        $user = $this->userRepository->find($id);
        $input = $request->all();
        if ($input['password'] != NULL) {
           
            $input['password'] = Hash::make($input['password']);
        }
        else{
            $input['password'] =$user->password;
        }

        

        if (empty($user)) {
            Flash::error('User not found');

            if(Auth::user()->role=='admin' || Auth::user()->role=='customer service'){
                return redirect(route('users.index'));
                }else{
                    return redirect(route('home'));
                }
        }
        
        
        $user = $this->userRepository->update($input, $id);

        Flash::success('User updated successfully.');
      
        if(Auth::user()->role == 'admin' or Auth::user()->role == 'customer service'){
        return redirect(route('users.index'));}
        else{
            return redirect(route('home'));
        }
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        if (Gate::any(['isAdmin','isCustomerService'])) {
            $user = $this->userRepository->find($id);

            if (empty($user)) {
                Flash::error('User not found');

                return redirect(route('users.index'));
            }

            $this->userRepository->delete($id);

            Flash::success('User deleted successfully.');

            return redirect(route('users.index'));
        }
        else{
                abort(403);
            }    
    }
}
