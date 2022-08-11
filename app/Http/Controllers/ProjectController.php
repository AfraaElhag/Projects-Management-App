<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use App\Repositories\ClientRepository;
use App\Repositories\ProjectStatusRepository; 
use App\Models\ProjectStatus;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\Gate;
use App\Models\Project;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Redirect;


class ProjectController extends AppBaseController
{
    /** @var ProjectRepository $projectRepository*/
    private $projectRepository;
    private $userRepository;
    private $taskRepository;
    private $ProjectStatusRepository;
    private $clientRepository;

    public function __construct(ProjectRepository $projectRepo,UserRepository $userRepo,TaskRepository $taskRepo,ProjectStatusRepository $ProjectStatusRepo ,ClientRepository $clientRepo)
    {
        $this->projectRepository = $projectRepo;
        $this->userRepository = $userRepo;
        $this->taskRepository = $taskRepo;
        $this->clientRepository = $clientRepo;
        $this->ProjectStatusRepository = $ProjectStatusRepo;
    }


    public function search(Request $request)
    {
        $q=$request->input('keyword');

        $results=$this->projectRepository->searchQuery(['project_name'] , $q)->get();
        return response()->json([ 'results' => $results ]);
        
    }


    /**
     * Display a listing of the Project.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
            if(Auth::user()->role=='admin' || Auth::user()->role=='customer service'){
                $projects = $this->projectRepository->paginate(10);
              
            }                
            elseif(Auth::guard('clientweb')->check()){
                $projects = $this->projectRepository->paginate(10 ,['*'],['client_id'=>Auth::user()->id]);
            }
            else{
               
                $projects = Auth::user()->projects()->paginate(10); 
               
            }


                return view('projects.index')->with('projects', $projects);
      
    }

   

    /**
     * Show the form for creating a new Project.
     *
     * @return Response
     */
    public function create($id)
    {
        
        if (Gate::any(['isAdmin','isCustomerService'])) {
            $designers =User::where('role','project manager')->orWhere( 'role','junior designer')->
            orWhere( 'role','senior designer')->orWhere( 'role','department manager')->get();

            return view('projects.create')->with(['designers'=> $designers,'client_id'=>$id]);

        }
        else{
            abort(403);
        }
    }

    /**
     * Store a newly created Project in storage.
     *
     * @param CreateProjectRequest $request
     *
     * @return Response
     */
    public function store(CreateProjectRequest $request)
    {        
        if (Gate::any(['isAdmin', 'isCustomerService'])) {
            $input = $request->all();

            $tasks = $this->taskRepository->allQuery()->get();
            $client = $this->clientRepository->find($input['client_id']);

            $project = $this->projectRepository->create($input);

            $project->projectStatuses()->saveMany([
                new ProjectStatus(['milestone' => 1,'status' => 0]),
                new ProjectStatus(['milestone' => 2,'status' => 0]),
                new ProjectStatus(['milestone' => 3,'status' => 0]),
                new ProjectStatus(['milestone' => 4,'status' => 0]),
            ]);


           
                $project->users()->attach($request->input('user_id'));
               
            
            
            
            
                $project->tasks()->attach($tasks, ['status' => 'not completed'  ]);
            
            

            Flash::success('Project saved successfully.');

            return view('clients.show')->with('client', $client);
        }
        else{
            abort(403);
        }
    }



    /**
     * Display the specified Project.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        if (Gate::any(['isAdmin','isDesigner', 'isClient','isCustomerService'])) {
       
                $project = $this->projectRepository->findWithTrashed($id);

                if (empty($project)) {
                    Flash::error('Project not found');
                    return redirect(route('projects.index'));
                }
        
                return view('projects.show')->with('project', $project);
        }
        else
        {  abort(403);  }
    }


    /**
     * Show the form for editing the specified Project.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if (Gate::any(['isAdmin','isCustomerService'])) {
       
            $project = $this->projectRepository->find($id);
            $designers =User::where('role','project manager')->orWhere( 'role','junior designer')->
            orWhere( 'role','senior designer')->orWhere( 'role','department manager')->get();

    
            if (empty($project)) {
                Flash::error('Project not found');

                return redirect(route('projects.index'));
            }

            return view('projects.edit')->with(['project'=>$project,'designers'=> $designers]);
        }
        else{
                abort(403);
            }
        }

    /**
     * Update the specified Project in storage.
     *
     * @param int $id
     * @param UpdateProjectRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProjectRequest $request)
    {
        
        if (Gate::any(['isAdmin','isCustomerService'])) {
            $project = $this->projectRepository->find($id);

            if (empty($project)) {
                Flash::error('Project not found');

                return redirect(route('projects.index'));
            }

            $project = $this->projectRepository->update($request->all(), $id);
            if(! is_null($request->input('user_id'))){
          
                
                $project->users()->attach($request->input('user_id'));
            
        }

            Flash::success('Project updated successfully.');

            return view('projects.show')->with('project', $project);
        }
        else{
                abort(403);
            }
    }

    /**
     * Remove the specified Project from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        if (Gate::any([ 'isAdmin','isCustomerService'])) {
            $project = $this->projectRepository->find($id);

            if (empty($project)) {
                Flash::error('Project not found');

                return redirect(route('projects.index'));
            }

            $this->projectRepository->delete($id);

            Flash::success('Project deleted successfully.');

            return redirect(route('projects.index'));
        }
        else{
                abort(403);
            }
    }

    public function deleteDesigner(User $user , Request $request)
    {
        if (Gate::any([ 'isAdmin','isCustomerService'])) {
            $user->projects()->detach($request->input('project_id'));
            return Redirect::back();
        }
        else{
                abort(403);
            }
    }





   




    public function showTasksTimeline($id)
    {

        if (Gate::any(['isClient'])) {
            $project = $this->projectRepository->find($id);
            if (empty($project)) {
                Flash::error('Project not found');
                return redirect(route('projects.index'));
            }

          
                
                $tasks=$project->tasks->where('client_viewable',true);
                $tasks = $tasks->reverse();
            return view('projects.timeline')->with(['project'=>$project,'tasks'=>$tasks]);
        }
        else{
            abort(403);
        }
    }




//project tasks

    public function showProjectTasks($id,$milestone)
    {

        if (Gate::any(['isAdmin','isDesigner', 'isClient','isCustomerService'])) {
            $project = $this->projectRepository->findWithTrashed($id);
            if (empty($project)) {
                Flash::error('Project not found');
                return redirect(route('projects.index'));
            }

                $tasks=$project->tasks->where('milestone_number',$milestone);
               
            
        
            
            
            
            return view('projecttasks.show')->with(['project'=>$project,'tasks'=>$tasks,'milestone' => $milestone]);
        }
        else{
            abort(403);
        }
    }



    public function editProjectTasks($id ,$task_id)
    {
        $project = $this->projectRepository->find($id);
        $task = $project->tasks()->where('task_id',$task_id)->first();
        $previous_milestone=$task->milestone_number - 1 ;

        $response = Gate::inspect('edit-task', $task);
            if ($response->allowed()) {
                if($task->milestone_number == 1 or $project->projectStatuses()->where('milestone' ,$previous_milestone)->first()->status == 100 ){
                    if (empty($project)) {
                        Flash::error('Project not found');
        
                        return redirect(route('projects.index'));
                    }
    
                     return view('projecttasks.edit')->with(['project'=>$project,'task'=>$task,'milestone' => $task->milestone_number]);
                }
                else{
                    Flash::error('previous not completed');
                    return Redirect::back();
                }

                   
            }
             else {
                Flash::error($response->message());
                return Redirect::back();
                
            }


            
         
       
    }





    public function updateProjectTasks(Request $request,$id , $task_id)
    {
        
        
        
            $project = $this->projectRepository->find($id);
            $milestone=$request->input('milestone');
           
            if($request->input('task_status') == 'not completed')
            {
                $project->tasks()->updateExistingPivot($task_id, ['status' => 'not completed',
                'completed_by' => Auth::user()->name,
                'updated_at' =>now()
                    ]);
                    
               $this->calculateMilestoneAvg($id,$milestone);
                    
            }
            
            if($request->input('task_status') == 'completed')
            {
               $project->tasks()->updateExistingPivot($task_id, ['status' => 'completed',
               'completed_by' => Auth::user()->name,
               'updated_at' =>now()
                ]);

                $this->calculateMilestoneAvg($id,$milestone);
                

            }
            return redirect(route('showprojecttasks',['id'=>$project->id,'milestone'=>$milestone]));
       
               
            
        
    }

    public function calculateMilestoneAvg($id ,$milestone)
    { 
        
 
            $project = $this->projectRepository->find($id);  
           

            $total_tasks_count=$project->tasks()->where('milestone_number',$milestone)->count();  
            $completed_tasks_count=$project->tasks()->where('milestone_number',$milestone)->where('status','completed')->count();
            $milestone_percentage=intval(($completed_tasks_count / $total_tasks_count) * 100);
            
            $project->projectStatuses()->where('milestone' ,$milestone)->update(['status' => $milestone_percentage]);
            
           $this->calculateProjectAvg($id);
        
               
              
    }


    public function calculateProjectAvg ( $id ){
        $project = $this->projectRepository->find($id);
        
        $total=0;
        foreach($project->projectStatuses as $milestone){
               $total+= $milestone->status;
        }
        $avg=intval($total / 4);
        $project->update(['status' => $avg]);
        return redirect(route('projects.show', $id));

    }





     
}
