# Code Challenge

This app is a commented, tested, and automated solution for a code challenge. 

The solution is src/app.php
 
# Installation

Clone repo.

	composer install
	
	npm install

# Test

	gulp
	
# The Challenge

Write some code that will solve the following:

We want to add up the total time a given object was in a RUNNING state; lets ignore what the object is, or what the states mean, irrelevant to this challenge.   The changes to the objects state are recorded in an array, that would be structured as follows:

```
array(
   array(
      'oldState' => STATE,
      'newState' => STATE,
      'date' => UNIX_TIMESTAMP
   ),
   array(
      'oldState' => STATE,
      'newState' => STATE,
      'date' => UNIX_TIMESTAMP
   )
);
```

There are three possible states.  PAUSED, RUNNING, and COMPLETE.  The array records the unix timestamp (seconds since epoch) of when the object went into the 'newState', leaving 'oldState'.  So we want a total sum of the time it spent in a RUNNING state.   There may be several state changes, or thousands.  They are not necessarily in order.  An object may have never entered into a RUNNING state.  A COMPLETE state can be treated just as PAUSED, i.e. the object is NOT running.  No guarantees that once an object enters into a COMPLETE state, that it won't then go back into RUNNING!  It's the wild west!

To further complicate things, the object may have hard defined 'start' and 'stop' dates (also in seconds since epoch).  We may have state changes outside of these dates, but want to make sure we only include run times within these ranges (if given).  The start/stop dates are optional.  An object might have a hard start, but no stop, or a hard stop, but no start.  Or none.  Or both.  A null will be passed in to indicate the absence of a date.

The method should take the array of states, an optional start, and an optional stop as parameters, returning the number of seconds within RUNNING state.  Use constants for the three states so they can easily be changed to match our tests.

Bonus challenge:  Make your function easily adapt to running the same calculation for the PAUSED or COMPLETE states.

