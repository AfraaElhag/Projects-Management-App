<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Repositories\TaskRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\Gate;
use Auth;

class TaskController extends AppBaseController
{
    /** @var TaskRepository $taskRepository*/
    private $taskRepository;

    public function __construct(TaskRepository $taskRepo)
    {
        $this->taskRepository = $taskRepo;
    }


    public function search(Request $request)
    {
        $q=$request->input('keyword');

        $results=$this->taskRepository->searchQuery(['task'] , $q)->get();
        return response()->json([ 'results' => $results ]);
        
    }
    /**
     * Display a listing of the Task.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            $tasks = $this->taskRepository->allQuery()->get();
            $tasks = $tasks->reverse();

            return view('tasks.index')->with('tasks', $tasks);
        }
        else{
                abort(403);
            } 
    }

    /**
     * Show the form for creating a new Task.
     *
     * @return Response
     */
    public function create()
    {
        if (Gate::allows('isAdmin')) {
            return view('tasks.create');
        }
        else{
                abort(403);
            } 
    }

    /**
     * Store a newly created Task in storage.
     *
     * @param CreateTaskRequest $request
     *
     * @return Response
     */
    public function store(CreateTaskRequest $request)
    {
        if (Gate::allows('isAdmin')) {
            $input = $request->all();
            if(!isset($input['client_viewable']) )
            $input['client_viewable']="0";
            

            $task = $this->taskRepository->create($input);

            Flash::success('Task saved successfully.');

            return redirect(route('tasks.index'));
        }
        else{
                abort(403);
            } 
    }

    /**
     * Display the specified Task.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $task = $this->taskRepository->find($id);

        if (empty($task)) {
            Flash::error('Task not found');

            return redirect(route('tasks.index'));
        }

        return view('tasks.show')->with('task', $task);
    }

    /**
     * Show the form for editing the specified Task.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if (Gate::allows('isAdmin')) {
            $task = $this->taskRepository->find($id);

            if (empty($task)) {
                Flash::error('Task not found');

                return redirect(route('tasks.index'));
            }

            return view('tasks.edit')->with('task', $task);
        }
        else{
                abort(403);
            } 
    }

    /**
     * Update the specified Task in storage.
     *
     * @param int $id
     * @param UpdateTaskRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTaskRequest $request)
    {
        if (Gate::allows('isAdmin')) {
            $task = $this->taskRepository->find($id);
            $input=$request->all();

            if (empty($task)) {
                Flash::error('Task not found');

                return redirect(route('tasks.index'));
            }
            
            if(!isset($input['client_viewable']) )
            $input['client_viewable']="0";
            $task = $this->taskRepository->update($input, $id);

            Flash::success('Task updated successfully.');

            return redirect(route('tasks.index'));
        }
        else{
                abort(403);
            } 
    }

    /**
     * Remove the specified Task from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        if (Gate::allows('isAdmin')) {
            $task = $this->taskRepository->find($id);

            if (empty($task)) {
                Flash::error('Task not found');

                return redirect(route('tasks.index'));
            }

            $this->taskRepository->delete($id);

            Flash::success('Task deleted successfully.');

            return redirect(route('tasks.index'));
        }
        else{
                abort(403);
            } 
    }
}
