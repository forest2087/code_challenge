<?php

require dirname(__DIR__) . '/src/app.php';

/**
 * Class appTest
 *
 */
class appTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider mockProvider
     */
    public function testTrue($log, $start, $stop, $expected)
    {

        $app = new Needls;

        // Assert actual and expected unix time to be within 1 second
        $this->assertEquals($expected, $app->getTotal($log, $start, $stop), '', 1);
    }

    /**
     * @return array
     */
    public function mockProvider()
    {
        return array(
            [
                array(
                    array(
                        'date'     => date("U", strtotime("2015-10-15")),
                        'oldState' => null,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    )
                ),
                null,
                null,
                0
            ],
            [
                array(
                    array(
                        'date'     => date("U", strtotime("2015-10-15")),
                        'oldState' => null,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    )
                ),
                date("U", strtotime("next week")),
                null,
                0
            ],
            [
                array(
                    array(
                        'date'     => date("U", strtotime("2015-10-15")),
                        'oldState' => null,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-16")),
                        'oldState' => Settings::CAMPAIGN_STATUS_PAUSED,
                        'newState' => Settings::CAMPAIGN_STATUS_RUNNING
                    )
                ),

                null,
                null,
                time() - date("U", strtotime("2015-10-16"))
            ],

            [
                array(
                    array(
                        'date'     => date("U", strtotime("2015-10-15")),
                        'oldState' => null,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-16")),
                        'oldState' => Settings::CAMPAIGN_STATUS_PAUSED,
                        'newState' => Settings::CAMPAIGN_STATUS_RUNNING
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-17")),
                        'oldState' => Settings::CAMPAIGN_STATUS_RUNNING,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-18")),
                        'oldState' => Settings::CAMPAIGN_STATUS_PAUSED,
                        'newState' => Settings::CAMPAIGN_STATUS_RUNNING
                    ),
                ),
                null,
                null,
                time() - date("U", strtotime("2015-10-18")) + (24 * 60 * 60)
            ],

            [
                array(
                    array(
                        'date'     => date("U", strtotime("2015-10-15")),
                        'oldState' => null,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-16")),
                        'oldState' => Settings::CAMPAIGN_STATUS_PAUSED,
                        'newState' => Settings::CAMPAIGN_STATUS_RUNNING
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-17")),
                        'oldState' => Settings::CAMPAIGN_STATUS_RUNNING,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-18")),
                        'oldState' => Settings::CAMPAIGN_STATUS_PAUSED,
                        'newState' => Settings::CAMPAIGN_STATUS_RUNNING
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-18 12:00:00")),
                        'oldState' => Settings::CAMPAIGN_STATUS_RUNNING,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-19")),
                        'oldState' => Settings::CAMPAIGN_STATUS_PAUSED,
                        'newState' => Settings::CAMPAIGN_STATUS_RUNNING
                    ),
                ),
                null,
                null,
                time() - date("U", strtotime("2015-10-19")) + (24 * 60 * 60 * 1.5)
            ],

            [
                array(
                    array(
                        'date'     => date("U", strtotime("2015-10-15")),
                        'oldState' => null,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-16")),
                        'oldState' => Settings::CAMPAIGN_STATUS_PAUSED,
                        'newState' => Settings::CAMPAIGN_STATUS_RUNNING
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-17")),
                        'oldState' => Settings::CAMPAIGN_STATUS_RUNNING,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-18")),
                        'oldState' => Settings::CAMPAIGN_STATUS_PAUSED,
                        'newState' => Settings::CAMPAIGN_STATUS_RUNNING
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-18 12:00:00")),
                        'oldState' => Settings::CAMPAIGN_STATUS_RUNNING,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-19")),
                        'oldState' => Settings::CAMPAIGN_STATUS_PAUSED,
                        'newState' => Settings::CAMPAIGN_STATUS_RUNNING
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-20")),
                        'oldState' => Settings::CAMPAIGN_STATUS_RUNNING,
                        'newState' => Settings::CAMPAIGN_STATUS_COMPLETE
                    )
                ),
                null,
                null,
                (24 * 60 * 60 * 2.5)
            ],

            [
                array(
                    array(
                        'date'     => date("U", strtotime("2015-10-13")),
                        'oldState' => null,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-14")),
                        'oldState' => Settings::CAMPAIGN_STATUS_PAUSED,
                        'newState' => Settings::CAMPAIGN_STATUS_RUNNING
                    )
                ),

                date("U", strtotime("2015-10-15")),
                null,
                time() - date("U", strtotime("2015-10-15"))
            ],

            [
                array(
                    array(
                        'date'     => date("U", strtotime("2015-10-13")),
                        'oldState' => null,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-16")),
                        'oldState' => Settings::CAMPAIGN_STATUS_PAUSED,
                        'newState' => Settings::CAMPAIGN_STATUS_RUNNING
                    )
                ),
                date("U", strtotime("2015-10-15")),
                null,
                time() - date("U", strtotime("2015-10-16"))
            ],

            [
                array(
                    array(
                        'date'     => date("U", strtotime("2015-10-15")),
                        'oldState' => null,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-16")),
                        'oldState' => Settings::CAMPAIGN_STATUS_PAUSED,
                        'newState' => Settings::CAMPAIGN_STATUS_RUNNING
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-17")),
                        'oldState' => Settings::CAMPAIGN_STATUS_RUNNING,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-18")),
                        'oldState' => Settings::CAMPAIGN_STATUS_PAUSED,
                        'newState' => Settings::CAMPAIGN_STATUS_RUNNING
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-18 12:00:00")),
                        'oldState' => Settings::CAMPAIGN_STATUS_RUNNING,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-19")),
                        'oldState' => Settings::CAMPAIGN_STATUS_PAUSED,
                        'newState' => Settings::CAMPAIGN_STATUS_RUNNING
                    ),
                ),
                date("U", strtotime("2015-10-17")),
                null,
                (time() - date("U", strtotime("2015-10-19"))) + (12 * 60 * 60)
            ],

            [
                array(
                    array(
                        'date'     => date("U", strtotime("2015-10-13")),
                        'oldState' => null,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-14")),
                        'oldState' => Settings::CAMPAIGN_STATUS_PAUSED,
                        'newState' => Settings::CAMPAIGN_STATUS_RUNNING
                    )
                ),

                null,
                date("U", strtotime("2015-10-15")),
                24 * 60 * 60
            ],

            [
                array(
                    array(
                        'date'     => date("U", strtotime("2015-10-13")),
                        'oldState' => null,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-14")),
                        'oldState' => Settings::CAMPAIGN_STATUS_PAUSED,
                        'newState' => Settings::CAMPAIGN_STATUS_RUNNING
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-15")),
                        'oldState' => Settings::CAMPAIGN_STATUS_RUNNING,
                        'newState' => Settings::CAMPAIGN_STATUS_COMPLETE
                    )
                ),

                null,
                date("U", strtotime("2015-10-18")),
                24 * 60 * 60
            ],

            [
                array(
                    array(
                        'date'     => date("U", strtotime("2015-10-15")),
                        'oldState' => null,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-16")),
                        'oldState' => Settings::CAMPAIGN_STATUS_PAUSED,
                        'newState' => Settings::CAMPAIGN_STATUS_RUNNING
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-17")),
                        'oldState' => Settings::CAMPAIGN_STATUS_RUNNING,
                        'newState' => Settings::CAMPAIGN_STATUS_RUNNING
                    )
                ),

                null,
                null,
                time() - date("U", strtotime("2015-10-16"))
            ],

            [
                array(
                    array(
                        'date'     => date("U", strtotime("2015-10-15")),
                        'oldState' => null,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-15")) + 1800,
                        'oldState' => Settings::CAMPAIGN_STATUS_PAUSED,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    )
                ),

                null,
                null,
                0
            ],
            [
                array(
                    array(
                        'date'     => date("U", strtotime("2015-10-13")),
                        'oldState' => Settings::CAMPAIGN_STATUS_RUNNING,
                        'newState' => Settings::CAMPAIGN_STATUS_PAUSED
                    ),
                    array(
                        'date'     => date("U", strtotime("2015-10-16")),
                        'oldState' => Settings::CAMPAIGN_STATUS_PAUSED,
                        'newState' => Settings::CAMPAIGN_STATUS_RUNNING
                    ),
                    array(
                        'date'     => date("U", strtotime("2016-10-17")),
                        'oldState' => Settings::CAMPAIGN_STATUS_RUNNING,
                        'newState' => Settings::CAMPAIGN_STATUS_COMPLETE,
                    ),
                ),
                null,
                date("U", strtotime("2015-10-17")),
                24 * 60 * 60
            ],
        );
    }
}
