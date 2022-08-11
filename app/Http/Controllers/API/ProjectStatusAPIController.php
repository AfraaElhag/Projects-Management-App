<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProjectStatusAPIRequest;
use App\Http\Requests\API\UpdateProjectStatusAPIRequest;
use App\Models\ProjectStatus;
use App\Repositories\ProjectStatusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ProjectStatusResource;
use Response;

/**
 * Class ProjectStatusController
 * @package App\Http\Controllers\API
 */

class ProjectStatusAPIController extends AppBaseController
{
    /** @var  ProjectStatusRepository */
    private $projectStatusRepository;

    public function __construct(ProjectStatusRepository $projectStatusRepo)
    {
        $this->projectStatusRepository = $projectStatusRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/projectStatuses",
     *      summary="Get a listing of the ProjectStatuses.",
     *      tags={"ProjectStatus"},
     *      description="Get all ProjectStatuses",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/ProjectStatus")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $projectStatuses = $this->projectStatusRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ProjectStatusResource::collection($projectStatuses), 'Project Statuses retrieved successfully');
    }

    /**
     * @param CreateProjectStatusAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/projectStatuses",
     *      summary="Store a newly created ProjectStatus in storage",
     *      tags={"ProjectStatus"},
     *      description="Store ProjectStatus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ProjectStatus that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ProjectStatus")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/ProjectStatus"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProjectStatusAPIRequest $request)
    {
        $input = $request->all();

        $projectStatus = $this->projectStatusRepository->create($input);

        return $this->sendResponse(new ProjectStatusResource($projectStatus), 'Project Status saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/projectStatuses/{id}",
     *      summary="Display the specified ProjectStatus",
     *      tags={"ProjectStatus"},
     *      description="Get ProjectStatus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ProjectStatus",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/ProjectStatus"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var ProjectStatus $projectStatus */
        $projectStatus = $this->projectStatusRepository->find($id);

        if (empty($projectStatus)) {
            return $this->sendError('Project Status not found');
        }

        return $this->sendResponse(new ProjectStatusResource($projectStatus), 'Project Status retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateProjectStatusAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/projectStatuses/{id}",
     *      summary="Update the specified ProjectStatus in storage",
     *      tags={"ProjectStatus"},
     *      description="Update ProjectStatus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ProjectStatus",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ProjectStatus that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ProjectStatus")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/ProjectStatus"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProjectStatusAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProjectStatus $projectStatus */
        $projectStatus = $this->projectStatusRepository->find($id);

        if (empty($projectStatus)) {
            return $this->sendError('Project Status not found');
        }

        $projectStatus = $this->projectStatusRepository->update($input, $id);

        return $this->sendResponse(new ProjectStatusResource($projectStatus), 'ProjectStatus updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/projectStatuses/{id}",
     *      summary="Remove the specified ProjectStatus from storage",
     *      tags={"ProjectStatus"},
     *      description="Delete ProjectStatus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ProjectStatus",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var ProjectStatus $projectStatus */
        $projectStatus = $this->projectStatusRepository->find($id);

        if (empty($projectStatus)) {
            return $this->sendError('Project Status not found');
        }

        $projectStatus->delete();

        return $this->sendSuccess('Project Status deleted successfully');
    }
}
