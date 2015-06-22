<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BlogUserFixture
 *
 */
class BlogUserFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'blog_user';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'blog_user_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'blog_user_date_created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '', 'precision' => null],
        'blog_user_last_modified' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '', 'precision' => null],
        'blog_user_firstname' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null, 'fixed' => null],
        'blog_user_lastname' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null, 'fixed' => null],
        'blog_user_email' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null, 'fixed' => null],
        'blog_user_password' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null, 'fixed' => null],
        'blog_user_mac_address' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['blog_user_id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'blog_user_id' => 1,
            'blog_user_date_created' => '2015-06-16 15:41:30',
            'blog_user_last_modified' => 1434469290,
            'blog_user_firstname' => 'Lorem ipsum dolor sit amet',
            'blog_user_lastname' => 'Lorem ipsum dolor sit amet',
            'blog_user_email' => 'Lorem ipsum dolor sit amet',
            'blog_user_password' => 'Lorem ipsum dolor sit amet',
            'blog_user_mac_address' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
