<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Response codes and messages v1.0.0
	|--------------------------------------------------------------------------
	*/

	1000	=> [
		"Code"		=> 1000,
		"Status"	=> 200,
		"Message"	=> "TRANSACTION SUCCESSFULLY EXECUTE."
	],
	1001	=> [
		"Code"		=> 1001,
		"Status"	=> 200,
		"Message"	=> "RECORD SUCCESSFULLY ADDED."
	],
	1002	=> [
		"Code"		=> 1002,
		"Status"	=> 200,
		"Message"	=> "RECORD SUCCESSFULLY MODIFIED."
	],
	1003	=> [
		"Code"		=> 1003,
		"Status"	=> 200,
		"Message"	=> "RECORD SUCCESSFULLY DELETED."
	],
	1004	=> [
		"Code"		=> 1004,
		"Status"	=> 200,
		"Message"	=> "RECORD SUCCESSFULLY INDEXED."
	],
	1005	=> [
		"Code"		=> 1005,
		"Status"	=> 200,
		"Message"	=> "RECORD SUCCESSFULLY LISTED."
	],
	1006	=> [
		"Code"		=> 1006,
		"Status"	=> 200,
		"Message"	=> "RECORD SUCCESSFULLY SEARCHED."
	],
	1007	=> [
		"Code"		=> 1007,
		"Status"	=> 200,
		"Message"	=> "RECORD SUCCESSFULLY FINDED."
	],
	1008	=> [
		"Code"		=> 1008,
		"Status"	=> 200,
		"Message"	=> "RECORD SUCCESSFULLY CATALOGED."
	],


	2000	=> [
		"Code"		=> 2000,
		"Status"	=> 500,
		"Message"	=> "SERVER ERROR"
	],
	2001	=> [
		"Code"		=> 2001,
		"Status"	=> 404,
		"Message"	=> "ENDPOINT NOT FOUND."
	],
	2002	=> [
		"Code"		=> 2002,
		"Status"	=> 405,
		"Message"	=> "THE HTTP VERB IS NOT SUPPORTED BY THE URL ENDPOINT USED IN THE REQUEST."
	],


	2100	=> [
		"Code"		=> 2100,
		"Status"	=> 422,
		"Message"	=> "ERROR WHILE THE TRANSACTION WAS EXECUTED."
	],
	2101	=> [
		"Code"		=> 2101,
		"Status"	=> 406,
		"Message"	=> "ERROR IN INPUT VARIABLES. THE VARIABLES DO NOT COMPLY WITH THE ESTABLISHED RULES."
	],
	2102	=> [
		"Code"		=> 2102,
		"Status"	=> 406,
		"Message"	=> "ERROR IN INPUT VARIABLES. IDENTIFIER IS NOT A NUMBER."
	],
	2103	=> [
		"Code"		=> 2103,
		"Status"	=> 406,
		"Message"	=> "INVALID ACTION."
	],


	2200	=> [
		"Code"		=> 2200,
		"Status"	=> 406,
		"Message"	=> "ITEM DOESN'T EXIST."
	],
	2201	=> [
		"Code"		=> 2201,
		"Status"	=> 406,
		"Message"	=> "ITEM IS ALREADY REGISTERED."
	],
	2202	=> [
		"Code"		=> 2202,
		"Status"	=> 406,
		"Message"	=> "ITEM DOESN'T ACTIVE."
	],
	2203	=> [
		"Code"		=> 2203,
		"Status"	=> 406,
		"Message"	=> "ITEM DOESN'T PUBLIC."
	],


	2300	=> [
		"Code"		=> 2300,
		"Status"	=> 401,
		"Message"	=> "MISSING REQUEST HEADER TOKEN FOR METHOD."
	],
	2301	=> [
		"Code"		=> 2301,
		"Status"	=> 401,
		"Message"	=> "SESSION DOESN'T EXIST."
	],
	2302	=> [
		"Code"		=> 2302,
		"Status"	=> 401,
		"Message"	=> "SESSION HAS EXPIRED."
	],
	2303	=> [
		"Code"		=> 2303,
		"Status"	=> 401,
		"Message"	=> "SESSION HAS BEEN REVOKED."
	],


	2400	=> [
		"Code"		=> 2400,
		"Status"	=> 403,
		"Message"	=> "USER ACCOUNT DOESN'T EXISTS."
	],
	2401	=> [
		"Code"		=> 2401,
		"Status"	=> 403,
		"Message"	=> "USER ACCOUNT SUSPENDED."
	],
	2402	=> [
		"Code"		=> 2402,
		"Status"	=> 403,
		"Message"	=> "USER ACCOUNT DOESN'T VERIFIED."
	],
	2403	=> [
		"Code"		=> 2403,
		"Status"	=> 403,
		"Message"	=> "WRONG PASSWORD."
	],
	2404	=> [
		"Code"		=> 2404,
		"Status"	=> 403,
		"Message"	=> "WRONG VERIFICATION CODE."
	],


	2500	=> [
		"Code"		=> 2500,
		"Status"	=> 403,
		"Message"	=> "NO PERMISSION FOR THIS CONTENT."
	],
	2501	=> [
		"Code"		=> 2501,
		"Status"	=> 403,
		"Message"	=> "NO PERMISSION TO ADD RECORD."
	],
	2502	=> [
		"Code"		=> 2502,
		"Status"	=> 403,
		"Message"	=> "NO PERMISSION TO MODIFY RECORD."
	],
	2503	=> [
		"Code"		=> 2503,
		"Status"	=> 403,
		"Message"	=> "NO PERMISSION TO DELETE RECORD."
	],
	2504	=> [
		"Code"		=> 2504,
		"Status"	=> 403,
		"Message"	=> "NO PERMISSION TO INDEX RECORD."
	],
	2505	=> [
		"Code"		=> 2505,
		"Status"	=> 403,
		"Message"	=> "NO PERMISSION TO LIST RECORD."
	],
	2506	=> [
		"Code"		=> 2506,
		"Status"	=> 403,
		"Message"	=> "NO PERMISSION TO SEARCH RECORD."
	],
	2507	=> [
		"Code"		=> 2507,
		"Status"	=> 403,
		"Message"	=> "NO PERMISSION TO FIND RECORD."
	],
	2508	=> [
		"Code"		=> 2508,
		"Status"	=> 403,
		"Message"	=> "NO PERMISSION TO CATALOG RECORD."
	]

];