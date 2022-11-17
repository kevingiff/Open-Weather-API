<!DOCTYPE html>
<html>
<head>
	<title>Poll hourly weather data for specified city</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,maximum-scale=1,initial-scale=1">
	<!-- Include Javascript -->
	<script type="text/javascript" src="js/customScript.js"></script>
	<!-- Include jQuery -->
	<script type="text/javascript" src="js/jQuery.js"></script>
	<!-- Include Style Sheet -->
	<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
	<!-- Font icons from Font Awesome Website -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/v4-shims.css">
</head>
<body class="bg-gray-100 overflow-x-hidden" ontouchstart="">
	<!-- Nav -->
	<nav class="relative w-full flex flex-wrap items-center justify-between py-4 bg-gray-100 text-gray-500 hover:text-gray-700 focus:text-gray-700 shadow-md navbar navbar-expand-lg navbar-light">
  	<div class="container-fluid w-full flex flex-wrap items-center justify-between px-6 gap-y-4">
  
  		<div class="collapse navbar-collapse flex-grow items-center" id="navbarSupportedContent">
  
			<!-- Left links -->
			<ul class="navbar-nav flex flex-wrap fley-col list-style-none mr-auto text-lg text-gray-700">
				<li class="nav-item p-2 pr-6">
				  <a class="nav-link hover:text-gray-900 focus:text-gray-900" href="#">Open Weather API</a>
				</li>
				<li class="nav-item p-2 pl-6 border-l-2 font-medium">
				  <a id="currentCity">Porto, PT</a>
				  <a id="latestTemp" class="ml-2"></a>
				</li>
				<li class="nav-item p-2 mx-1">
				  <a id="latestTime" class="text-sm"></a>
				  <a onclick="getWeather()" class="nav-link hover:text-gray-900 focus:text-gray-900 pl-4 cursor-pointer"><i class="fa fa-refresh"></i></a>
				</li>
			</ul>
			<!-- Left links -->

		</div>

		<!-- Right elements -->
		<div class="flex items-center relative">
  
			<div class="dropdown relative">
			    <button onclick="toggleDropdown('dropdown')" class="text-gray-400 bg-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 hover:shadow-lg rounded-md px-4 py-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">info<i class="fa fa-info-circle ml-4"></i></button>
			</div>
  
  		</div>
  		<!-- Dropdown menu -->
		<div id="dropdown" class="hidden absolute w-screen max-w-lg z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 top-0 right-0 mt-16 px-6 pt-4 pb-8 shadow-lg">
			<div onclick="toggleDropdown('dropdown')" class="text-right px-2 pb-2"><i class="fa fa-close"></i></div>
		    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
		      <li>
		        <a class="block py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">API method:</a>
		        <p class="px-4">Data pulled via open Open Weather API: https://openweathermap.org/</p>
		      </li>
		      <li>
		        <a class="block py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Backend:</a>
		        <p class="px-4">Linux cron job scheduled @hourly to pull the api data and store in local MYSQL db</p>
		      </li>
		      <li>
		        <a class="block py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Frontend:</a>
		        <p class="px-4">On every page load, the db is pulled and data is presented, there is a "refresh" button allowing the user to manually call the api any time they want.</p>
		      </li>
		      <li>
		        <a class="block py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Styling:</a>
		        <p class="px-4">via Tailwind: https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css</p>
		      </li>
		      <li>
		        <a class="block py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Future improvements:</a>
		        <p class="px-4">Allow an admin to manipulate the api call (location, temp standard, etc.) via authentication</p>
		        <p class="px-4">Allow renaming columns in db with auth</p>
		        <p class="px-4">Allow resizing of columns</p>
		        <p class="px-4">Allow adjustment of user's crontab</p>
		      </li>
		    </ul>
		</div>
		<!-- Dropdown menu -->

  		<!-- Right elements -->

	</div>
	</nav>
	<!-- Nav -->

	<!-- Results table -->
	<div class="flex flex-col container mx-auto md my-10">
		<div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
			    <table class="shadow-sm bg-white mx-auto">
			      <thead class="border-b">
			        <tr class="font-medium text-gray-700 text-left text-lg">
			          <th scope="col" class="px-6 py-4 cursor-default border-r">Temperature</th>
			          <th scope="col" class="px-6 py-4 cursor-default text-center">Time of data pull</th>
			        </tr>
			      </thead>
			      <tbody>
			        <tr class="border-b bg-gray-100 transition duration-300 ease-in-out hover:bg-gray-200 font-light whitespace-nowrap text-gray-900">
			          <td class="px-6 py-4"></td>
			          <td class="px-6 py-4"></td>
			        </tr>
			        <tr class="border-b border-gray-200 transition duration-300 ease-in-out hover:bg-gray-200 font-light whitespace-nowrap text-gray-900">
			          <td class="px-6 py-4"></td>
			          <td class="px-6 py-4"></td>
			        </tr>
			      </tbody>
			    </table>
		</div>
	</div>
	<!-- Results table -->

</body>
</html>