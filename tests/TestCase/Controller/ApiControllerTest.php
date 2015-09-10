<?php
namespace VideoManager\Test\TestCase\Controller;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use VideoManager\Controller\ApiController;

/**
 * VideoManager\Controller\ApiController Test Case
 */
class ApiControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.video_manager.videos'
    ];

    public function setUp()
    {
        parent::setUp();
        $this->Videos = TableRegistry::get('VideoManager.Videos');
    }

    public function tearDown()
    {
        unset($this->Videos);
        parent::tearDown();
    }

    public function testCheckUrl()
    {
        $data = [
          'inputUrl' => 'https://www.youtube.com/watch?v=wj7xwv12M2c&index=131&list=WL'
        ];

        $this->post('/interno/videos/api/checkurl', $data);
        $this->assertResponseOk();
    }

    public function testSetOrder()
    {
        $data = [
            'video' => 1,
            'order' => 5
        ];

        $video = $this->Videos->get(1);
        $this->assertInstanceOf('VideoManager\Model\Entity\Video', $video);
        $this->assertEquals(1, $video->sort_order);

        $this->post('/interno/videos/api/setorder', $data);
        $this->assertResponseOk();

        $video = $this->Videos->get(1);
        $this->assertInstanceOf('VideoManager\Model\Entity\Video', $video);
        $this->assertEquals(5, $video->sort_order);
    }
}
