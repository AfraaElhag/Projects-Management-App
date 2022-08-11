<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ProjectStatus;

class ProjectStatusApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_project_status()
    {
        $projectStatus = ProjectStatus::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/project_statuses', $projectStatus
        );

        $this->assertApiResponse($projectStatus);
    }

    /**
     * @test
     */
    public function test_read_project_status()
    {
        $projectStatus = ProjectStatus::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/project_statuses/'.$projectStatus->id
        );

        $this->assertApiResponse($projectStatus->toArray());
    }

    /**
     * @test
     */
    public function test_update_project_status()
    {
        $projectStatus = ProjectStatus::factory()->create();
        $editedProjectStatus = ProjectStatus::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/project_statuses/'.$projectStatus->id,
            $editedProjectStatus
        );

        $this->assertApiResponse($editedProjectStatus);
    }

    /**
     * @test
     */
    public function test_delete_project_status()
    {
        $projectStatus = ProjectStatus::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/project_statuses/'.$projectStatus->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/project_statuses/'.$projectStatus->id
        );

        $this->response->assertStatus(404);
    }
}
