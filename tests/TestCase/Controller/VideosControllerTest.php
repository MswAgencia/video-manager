<?php
namespace VideoManager\Test\TestCase\Controller;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use VideoManager\Controller\VideosController;

/**
 * VideoManager\Controller\VideosController Test Case
 */
class VideosControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.video_manager.categories',
        'plugin.video_manager.galleries',
        'plugin.video_manager.videos'
    ];

    public function setUp()
    {
        parent::setUp();
        $this->Videos = TableRegistry::get('VideoManager.Videos');
        $this->Galleries = TableRegistry::get('PhotoGallery.Galleries');
    }

    public function tearDown()
    {
        unset($this->Videos);
        parent::tearDown();
    }
    public function testInitialize()
    {
        $this->markTestIncomplete();
    }

    public function testAdd()
    {
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'username' => 'testinguser',
                    'is_root' => true
                ]
            ]
        ]);

        $data = [
            'name' => 'Some Testing Name',
            'original_url' => 'https://www.youtube.com/watch?v=XozT3zEPmIU',
            'description' => 'Teste',
            'status' => 1,
        ];

        $this->assertTrue($this->Galleries->exists(['id' => 1]));
        $this->post('/interno/galeria-de-fotos/1/videos/novo', $data);
        $this->assertRedirect('/interno/galeria-de-fotos/1/videos');

        $video = $this->Videos->get(2);
        $this->assertInstanceOf('VideoManager\Model\Entity\Video', $video);
        $this->assertEquals($data['name'], $video->name);
        $this->assertEquals($data['original_url'], $video->original_url);
        $this->assertEquals($data['description'], $video->description);
        $this->assertEquals($data['status'], $video->status);
        $this->assertEquals(1, $video->gallery_id);
        $this->assertTextContains('iframe', $video->embedded_url);
    }

    public function testDelete()
    {
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'username' => 'testinguser',
                    'is_root' => true
                ]
            ]
        ]);
        $this->assertTrue($this->Videos->exists(['id' => 1]));
        $this->assertTrue($this->Galleries->exists(['id' => 1]));

        $this->get('/interno/galeria-de-fotos/1/videos/remover/1');
        $this->assertRedirect('/interno/galeria-de-fotos/1/videos');

        $this->assertFalse($this->Videos->exists(['id' => 1]));
    }
}
