<?php

//get State Constants
require 'settings.php';

/**
 * Class Needls
 */
class Needls
{
    /**
     * get total time of a given state, from an arrary of logs
     *
     * @param        $log
     * @param null   $start
     * @param null   $stop
     * @param string $state
     *
     * @return bool|int|null
     */
    public function getTotal($log, $start = null, $stop = null, $state = Settings::CAMPAIGN_STATUS_RUNNING)
    {
        //init vars
        $total = 0;
        $track = false;
        $last  = null;

        //if hard start provided, init tracking, get last track time
        if ($start) {
            $track = true;
            $last  = $start;
        }

        //check log
        if (!is_array($log)) {
            return false;
        }

        foreach ($log as $set) {
            if ($set['oldState'] === $state && $track) {
                //hard stop less than last date
                if ($stop && $set['date'] > $stop) {
                    $track = false;
                    $total += $stop - $last;
                } else {
                    $track = false;
                    $total += $set['date'] - $last;
                }
            }
            if ($set['newState'] === $state) {
                //hard start greater than first time
                if (!$last || $last < $set['date']) {
                    $track = true;
                    $last  = $set['date'];
                }
            }
        }

        //hard stop provided, and state is ongoing
        if ($stop && $track) {
            $total += $stop - $last;
        }

        //hard stop not provided, and state is ongoing
        if (!$stop && $track) {
            if (time() > $last) {
                $total += time() - $last;
            }
        }

        return $total;
    }
}
