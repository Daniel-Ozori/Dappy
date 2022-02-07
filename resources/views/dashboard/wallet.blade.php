<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/main.css">
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<link rel="icon"  href="../../images/icon.png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body class=" min-w-full min-h-full " style="font-family: 'Montserrat', sans-serif;">
	
	<div class="absolute text-green-600" id="copied">copied</div>

	<div class="flex flex-row">
		<div class=" hidden lg:block w-24 top-0 left-0 bottom-0 h-screen ">
			<div class=" shadow-lg p-5 w-24 items-center fixed h-full flex flex-col justify-between ">
				<div class="bg-black rounded-lg flex justify-center p-2 h-8 w-8">
					<div class="bg-[url(../../images/icon.png)]  bg-no-repeat bg-contain bg-center h-full w-full">
					</div>
				</div>
				<div class="grid grid-rows-3 justify-center gap-10">
					<a href="/dashboard/overview" class="bg-[url(../../images/overview.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
					<a href="/dashboard/wallet" class="bg-[url(../../images/wallet_active.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
					<a href="/dashboard/notifications" class="bg-[url(../../images/notification.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
					<a href="/dashboard/trends" class="bg-[url(../../images/trend.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
					<a href="/dashboard/settings" class="bg-[url(../../images/settings.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
				</div>
				<div class="h-24">

				</div>
			</div>
			
			
		</div>
		<div class="bg-white shadow-lg lg:hidden p-5 h-18 items-start z-10 fixed top-0 right-0  w-full flex flex-col align-start ">
				
				<div class="grid grid-cols-5 justify-center gap-10">
					<a href="/dashboard/overview" class="bg-[url(../../images/overview.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
					<a href="/dashboard/wallet" class="bg-[url(../../images/wallet_active.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
					<a href="/dashboard/notifications" class="bg-[url(../../images/notification.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
					<a href="/dashboard/trends" class="bg-[url(../../images/trend.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
					<a href="/dashboard/settings" class="bg-[url(../../images/settings.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
				</div>
				
			</div>
		<div class="w-full mt-[45px] lg:mt-0  ">
			<section class="grid  justify-center gap-5 grid-main w-full px-5 md:px-10">
				<div class="col-span-8 relative flex inline-flex h-24 items-center justify-between">
					<div class="flex items-center">
						<div class="font-bold text-2xl">Wallet</div>
						<div class=" ml-5 items-center cursor-pointer flex justify-between p-2 h-8 w-[70px]">
							

							<select name="coin" class="outline-0" id="coin_select">
								<option value="BTC">Bitcoin</option>
								<option value="LTC">Litecoin</option>
								<option value="ETH"><a href="eth">Ethereum</a></option>
							</select>
							<div class="bg-[url(../../images/dropdown.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
							</div>
						</div>
					</div>
					<div class="grid grid-flow-col gap-4">
						<div class="bg-gray-200 hidden md:block  rounded-full flex justify-center p-2 h-8 w-8">
							<div class="bg-[url(../../images/notification.png)]  bg-no-repeat bg-contain bg-center h-full w-full">
							</div>
						</div>
						<div class="relative p-2 flex items-center bg-gray-200 rounded-3xl h-8 w-fit">
							<div class="w-[45px] bg-center h-[45px] bottom-0 bg-[url('../../images/profile.png')] bg-cover md:absolute bg-black rounded-full">

							</div>
							
							<div class="ml-12 w-20 truncate text-xs hidden md:block">
								{{ auth()->user()->name }}
							</div>
							<div class="w-[15px] h-[15px] bg-center bg-contain bg-[url('../../images/dropdown.png')] ">

							</div>
						</div>	
					</div>

				</div>

			</section>

			<section class="grid justify-center gap-5 grid-main w-full px-5 md:px-10">

				<div class="bg-black text-blue-300 col-span-8 md:col-span-2 flex flex-col  rounded-2xl   h-44 p-5">
					<div class="flex flex-col">
						<div class="font-bold text-xl">{{$balance}} {{$coin}}</div>
						<div class="text-sm">$ {{$balance_usd}}</div>
					</div>
					<div class="mt-auto justify-between flex items-center">
						<div class="bg-white rounded-lg flex justify-center p-2 h-8 w-8">
							<div class="bg-[url(../../images/{{strtolower($coin)}}.png)]  bg-no-repeat bg-contain bg-center h-full w-full">
							</div>
						</div>
						<div class="text-sm">
							+0.14 %
						</div>
					</div>


				</div>
				<div class="col-span-8 md:col-span-5 grid grid-cols-6 gap-4 bg-[#FAFCFF] p-5 rounded-2xl">
					<div class="bg-white col-span-6 md:col-span-2 h-32 md:h-full p-2 bg-[url('{{$qr_code}}')] bg-contain bg-center bg-no-repeat">

					</div>
					<div class="col-span-6 md:col-span-4 h-full ">
						<div class="text-xs">wallet address</div>
						<div id="address" class="bg-white truncate p-2 cursor-pointer w-full lg:w-fit font-bold mt-3 text-xs rounded-lg">{{

						$address }}</div>

						<div class="text-xs mt-3">private key</div>
						<div id="private_key" style="background-color: black;" class="p-2 w-full truncate cursor-pointer  font-bold mt-3 text-xs rounded-lg"  >{{$private_key }}</div>
					</div>
				</div>

				<div class="col-span-8 mt-0 md:mt-10 md:order-1 order-2 md:col-span-5 grid  gap-4 ">
					<div class="  font-bold">
						Transaction history
					</div>
					<div class="w-full flex items-center justify-center bg-[#FAFCFF] rounded-2xl h-[400px]">
						<div class="text-gray-300">No transactions yet</div>
					</div>
				</div>
				<div class="col-span-8 mt-0 md:mt-10  order-1 md:col-span-3 grid  gap-4 ">
					<div class="  font-bold ">Send crypto</div>
					<div class="w-full bg-[#FAFCFF] rounded-2xl h-[400px] p-10">
						<form action="signin.php" method="post" class="flex flex-col w-full h-full">

							<div class="h-12 mt-5  flex rounded-lg">
								<input class="h-full text-sm rounded-lg  outline-0 w-full pl-5" type="text" placeholder="Wallet Address" required="">
							</div>

							<div class="h-12 mt-5  flex rounded-lg">
								<input class="h-full text-sm rounded-lg  outline-0  w-full pl-5" placeholder="Amount in dollars" required="">
							</div>
							<div class="h-12 mt-5  flex rounded-lg">
								<input class="h-full bg-gray-200 text-sm rounded-lg  outline-0  w-full pl-5" placeholder="Fee" disabled="" required="">
							</div>
							<div class="h-10 mt-5 border flex rounded-lg">
								<div class="bg-[url('../../images/password.png')] bg-no-repeat mx-2 bg-contain bg-center h-full w-4"></div>
								<input class="h-full text-sm rounded-lg  outline-0  w-full pl-5" type="password" placeholder="Enter your Password" name="password" required="">
							</div>


							<button class="bg-[#315EFB] mt-s rounded-lg text-white h-10 mt-5 py-2 px-10 flex items-center justify-center" type="submit">Send</button>




						</form>
					</div>
				</div>

			</section>




		</div>


	</div>

	<script>
		var coin = "<?php echo $coin; ?>";
		var select = document.getElementById('coin_select');

		for(var i, j = 0; i = select.options[j]; j++) {
			if(i.value == coin) {
				select.selectedIndex = j;
				break;
			}
		}

		select.onchange = function() {
			window.location.href = this.value.toLowerCase() ;
		};

		$('#address').bind('click', function (event) { 
			copyTextToClipboard($('#address')[0].innerHTML,event);
		
		 });
		$('#private_key').bind('click', function (event) {
			if(!($('#private_key')[0].style.backgroundColor == "black")){
				copyTextToClipboard($('#private_key')[0].innerHTML,event);	
		 	}else{
		 		$('#private_key')[0].style.backgroundColor = "white";
		 	}
		 	
		 });
		function fade(element) {
		    var op = 1;  // initial opacity

		    var timer = setInterval(function () {
		        if (op <= 0.1){
		            clearInterval(timer);
		            element.style.display = 'none';
		        }
		        element.style.opacity = op;
		        element.style.filter = 'alpha(opacity=' + op * 100 + ")";

		        op -= op * 0.1;
		    }, 100);
		}
		function copyTextToClipboard(text,event) {
			if (!navigator.clipboard) {
				fallbackCopyTextToClipboard(text);
				return;
			}
			navigator.clipboard.writeText(text).then(function() {
				$('#copied').css('left',event.pageX);      // <<< use pageX and pageY
		 		$('#copied').css('top',event.pageY);
		 		$('#copied').css('display','inline');     
		 		$("#copied").css("position", "absolute");
		 		fade($("#copied")[0]);
			}, function(err) {
				console.error('Async: Could not copy text: ', err);
			});
		}

	</script>
</body>
</html>
