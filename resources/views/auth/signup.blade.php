
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<link rel="icon"  href="images/icon.png">
</head>
<body class=" min-w-full min-h-full bg-[#FAFCFF]  " style="font-family: 'Montserrat', sans-serif;">
	<section class=" h-full flex flex-col items-center justify-center ">
		<div class="my-5 bg-[url('images/icon_lg.png')] bg-no-repeat bg-contain bg-center h-8 w-8">
			
		</div>
		<div class="col-span-4 bg-white rounded-lg h-fit mx-5 max-w-max min-w-fit flex-col items-center flex p-10">
			<div class="text-xl font-bold">Create your account</div>
			<div class="text-sm my-5 text-center text-[#82899B]">Enter your credentials to create an account</div>
			@if($errors->any())
			<div class="text-xs text-red-700">{{$errors->first()}}</div>
			@endif
			<form action="/signup" method="post" class="flex flex-col w-full h-full">
				@csrf 
				<div class="h-10 mt-5 border flex rounded-lg">
					<div class="bg-[url('images/user.png')] bg-no-repeat mx-2 bg-contain bg-center h-full w-4"></div>
					<input class="h-full text-sm rounded-r-lg  outline-0 w-full pl-5" type="text" placeholder="Full name" name="name" required="">
				</div>
				
				<div class="h-10 mt-5 border flex rounded-lg">
					<div class="bg-[url('images/email.png')] bg-no-repeat mx-2 bg-contain bg-center h-full w-4"></div>
					<input class="h-full text-sm rounded-r-lg  outline-0 w-full pl-5" type="text" placeholder="Enter your email" name="email" required="">
				</div>
				

				<div class="h-10 mt-5 border flex rounded-lg">
					<div class="bg-[url('images/password.png')] mx-2 bg-no-repeat bg-contain bg-center h-full w-4"></div>
					<input class="h-full text-sm rounded-r-lg  outline-0  w-full pl-5" type="password" placeholder="Enter your Password" name="password" required="">
				</div>
				
				<div class="flex items-center mt-5">
					<input class="" type="checkbox" name="checkbox" required="">
					<div class="ml-2 text-xs">I certify I am 18 years or older</div>
				</div>
				<button class="bg-[#315EFB] mt-s rounded-lg text-white h-10 mt-5 py-2 px-10 flex items-center justify-center" type="submit">Sign Up</button>

				

				
			</form>
		</div>
		<div class="mt-10 text-sm text-[#82899B]">Already have an account?  <a class="text-[#315EFB]" href="login">Login</a></div>
	</section>
</body>
</html>