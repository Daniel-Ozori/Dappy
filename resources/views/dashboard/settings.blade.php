<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<link rel="icon"  href="../images/icon.png">
</head>
<body class=" min-w-full min-h-full " style="font-family: 'Montserrat', sans-serif;">
	<div class="flex flex-row">
		<div class="bg-black hidden lg:block w-24 top-0 left-0 bottom-0 h-screen ">
			<div class=" bg-black p-5 w-24 items-center fixed h-full flex flex-col justify-between ">
				<div class="bg-white rounded-lg flex justify-center p-2 h-8 w-8">
					<div class="bg-[url(../images/icon.png)]  bg-no-repeat bg-contain bg-center h-full w-full">
					</div>
				</div>
				<div class="grid grid-rows-3 justify-center gap-10">
					<a href="overview" class="bg-[url(../images/overview.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
					<a href="wallet" class="bg-[url(../images/wallet.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
					<a href="settings" class="bg-[url(../images/settings_active.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
				</div>
				<div class="h-24">

				</div>
			</div>
			
			
		</div>
		<div class=" bg-black lg:hidden p-5 h-18 items-start z-10 fixed top-0 right-0  w-full flex flex-col align-start ">
				
				<div class="grid grid-cols-3 justify-center gap-10">
					<a href="overview" class="bg-[url(../images/overview.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
					<a href="wallet" class="bg-[url(../images/wallet.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
					<a href="settings" class="bg-[url(../images/settings_active.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
				</div>
				
			</div>
		<div class="w-full mt-[45px] lg:mt-0  ">
			<section class="grid justify-center gap-5 grid-main w-full px-5 md:px-10">
				<div class="col-span-8 flex inline-flex h-24 items-center justify-between">
					<div class="font-bold text-2xl">Settings</div>
					<div class="grid grid-flow-col gap-4">
						<div class="bg-gray-200 rounded-full flex justify-center p-2 h-8 w-8">
							<div class="bg-[url(../images/notification.png)]  bg-no-repeat bg-contain bg-center h-full w-full">
							</div>
						</div>
						<div class="relative p-2 flex items-center bg-gray-200 rounded-3xl h-8 w-fit">
							<div class="w-[45px] h-[45px] bottom-0 bg-[url('../images/profile.png')] bg-cover md:absolute bg-black rounded-full">

							</div>
							
							<div class="ml-12 w-20 truncate text-xs hidden md:block font-bold">
								{{ auth()->user()->name }}
							</div>
							
						</div>	
					</div>
					
				</div>
				
				
			</section>
			
			

			<section class="grid justify-center my-10 gap-5 grid-main w-full px-5 md:px-10">
				<div class="col-span-2 text-lg font-bold">
						Account Settings
					</div>
				<div class="col-span-8 p-10 bg-[#FAFCFF] rounded-2xl h-[400px]">
					<form action="/dashboard/settings" method="post" class="flex flex-col w-fit h-full">

						
						@csrf 
						<button class="bg-red-500 mt-s rounded-lg text-white h-10 mt-5 py-2 px-10 flex items-center justify-center" type="submit">Delete account</button>




					</form>
				</div>
			</section>
			
			
		</div>
	</div>
	
	
	
</body>
</html>
