<?php

use App\Models\Header;
use App\Repositories\HeaderRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HeaderRepositoryTest extends TestCase
{
    use MakeHeaderTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var HeaderRepository
     */
    protected $headerRepo;

    public function setUp()
    {
        parent::setUp();
        $this->headerRepo = App::make(HeaderRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateHeader()
    {
        $header = $this->fakeHeaderData();
        $createdHeader = $this->headerRepo->create($header);
        $createdHeader = $createdHeader->toArray();
        $this->assertArrayHasKey('id', $createdHeader);
        $this->assertNotNull($createdHeader['id'], 'Created Header must have id specified');
        $this->assertNotNull(Header::find($createdHeader['id']), 'Header with given id must be in DB');
        $this->assertModelData($header, $createdHeader);
    }

    /**
     * @test read
     */
    public function testReadHeader()
    {
        $header = $this->makeHeader();
        $dbHeader = $this->headerRepo->find($header->id);
        $dbHeader = $dbHeader->toArray();
        $this->assertModelData($header->toArray(), $dbHeader);
    }

    /**
     * @test update
     */
    public function testUpdateHeader()
    {
        $header = $this->makeHeader();
        $fakeHeader = $this->fakeHeaderData();
        $updatedHeader = $this->headerRepo->update($fakeHeader, $header->id);
        $this->assertModelData($fakeHeader, $updatedHeader->toArray());
        $dbHeader = $this->headerRepo->find($header->id);
        $this->assertModelData($fakeHeader, $dbHeader->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteHeader()
    {
        $header = $this->makeHeader();
        $resp = $this->headerRepo->delete($header->id);
        $this->assertTrue($resp);
        $this->assertNull(Header::find($header->id), 'Header should not exist in DB');
    }
}
