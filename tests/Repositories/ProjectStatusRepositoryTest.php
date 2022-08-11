<?php namespace Tests\Repositories;

use App\Models\ProjectStatus;
use App\Repositories\ProjectStatusRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ProjectStatusRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProjectStatusRepository
     */
    protected $projectStatusRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->projectStatusRepo = \App::make(ProjectStatusRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_project_status()
    {
        $projectStatus = ProjectStatus::factory()->make()->toArray();

        $createdProjectStatus = $this->projectStatusRepo->create($projectStatus);

        $createdProjectStatus = $createdProjectStatus->toArray();
        $this->assertArrayHasKey('id', $createdProjectStatus);
        $this->assertNotNull($createdProjectStatus['id'], 'Created ProjectStatus must have id specified');
        $this->assertNotNull(ProjectStatus::find($createdProjectStatus['id']), 'ProjectStatus with given id must be in DB');
        $this->assertModelData($projectStatus, $createdProjectStatus);
    }

    /**
     * @test read
     */
    public function test_read_project_status()
    {
        $projectStatus = ProjectStatus::factory()->create();

        $dbProjectStatus = $this->projectStatusRepo->find($projectStatus->id);

        $dbProjectStatus = $dbProjectStatus->toArray();
        $this->assertModelData($projectStatus->toArray(), $dbProjectStatus);
    }

    /**
     * @test update
     */
    public function test_update_project_status()
    {
        $projectStatus = ProjectStatus::factory()->create();
        $fakeProjectStatus = ProjectStatus::factory()->make()->toArray();

        $updatedProjectStatus = $this->projectStatusRepo->update($fakeProjectStatus, $projectStatus->id);

        $this->assertModelData($fakeProjectStatus, $updatedProjectStatus->toArray());
        $dbProjectStatus = $this->projectStatusRepo->find($projectStatus->id);
        $this->assertModelData($fakeProjectStatus, $dbProjectStatus->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_project_status()
    {
        $projectStatus = ProjectStatus::factory()->create();

        $resp = $this->projectStatusRepo->delete($projectStatus->id);

        $this->assertTrue($resp);
        $this->assertNull(ProjectStatus::find($projectStatus->id), 'ProjectStatus should not exist in DB');
    }
}
