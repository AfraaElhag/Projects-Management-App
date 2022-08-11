<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectStatusRequest;
use App\Http\Requests\UpdateProjectStatusRequest;
use App\Repositories\ProjectStatusRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ProjectStatusController extends AppBaseController
{
    /** @var ProjectStatusRepository $projectStatusRepository*/
    private $projectStatusRepository;

    public function __construct(ProjectStatusRepository $projectStatusRepo)
    {
        $this->projectStatusRepository = $projectStatusRepo;
    }

    /**
     * Display a listing of the ProjectStatus.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $projectStatuses = $this->projectStatusRepository->paginate(10);

        return view('project_statuses.index')
            ->with('projectStatuses', $projectStatuses);
    }

    /**
     * Show the form for creating a new ProjectStatus.
     *
     * @return Response
     */
    public function create()
    {
        return view('project_statuses.create');
    }

    /**
     * Store a newly created ProjectStatus in storage.
     *
     * @param CreateProjectStatusRequest $request
     *
     * @return Response
     */
    public function store(CreateProjectStatusRequest $request)
    {
        $input = $request->all();

        $projectStatus = $this->projectStatusRepository->create($input);

        Flash::success('Project Status saved successfully.');

        return redirect(route('projectStatuses.index'));
    }

    /**
     * Display the specified ProjectStatus.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $projectStatus = $this->projectStatusRepository->find($id);

        if (empty($projectStatus)) {
            Flash::error('Project Status not found');

            return redirect(route('projectStatuses.index'));
        }

        return view('project_statuses.show')->with('projectStatus', $projectStatus);
    }

    /**
     * Show the form for editing the specified ProjectStatus.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $projectStatus = $this->projectStatusRepository->find($id);

        if (empty($projectStatus)) {
            Flash::error('Project Status not found');

            return redirect(route('projectStatuses.index'));
        }

        return view('project_statuses.edit')->with('projectStatus', $projectStatus);
    }

    /**
     * Update the specified ProjectStatus in storage.
     *
     * @param int $id
     * @param UpdateProjectStatusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProjectStatusRequest $request)
    {
        $projectStatus = $this->projectStatusRepository->find($id);

        if (empty($projectStatus)) {
            Flash::error('Project Status not found');

            return redirect(route('projectStatuses.index'));
        }

        $projectStatus = $this->projectStatusRepository->update($request->all(), $id);

        Flash::success('Project Status updated successfully.');

        return redirect(route('projectStatuses.index'));
    }

    /**
     * Remove the specified ProjectStatus from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $projectStatus = $this->projectStatusRepository->find($id);

        if (empty($projectStatus)) {
            Flash::error('Project Status not found');

            return redirect(route('projectStatuses.index'));
        }

        $this->projectStatusRepository->delete($id);

        Flash::success('Project Status deleted successfully.');

        return redirect(route('projectStatuses.index'));
    }
}
