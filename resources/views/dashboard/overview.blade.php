<?php 
	$Controller = new App\Http\Controllers\ApiController;
	$b =  $Controller->getBalanceUSD('BTC',
							json_decode(auth()->user()->btc_cred,true)['balance']);
	$e =  $Controller->getBalanceUSD('ETH',
							json_decode(auth()->user()->eth_cred,true)['balance']);
	$l =  $Controller->getBalanceUSD('LTC',
							json_decode(auth()->user()->ltc_cred,true)['balance']);

	$sum = $b + $e + $l;
?>
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
	<script src="../../javascript/apexcharts/apexcharts.min.js"></script>
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
					<a href="overview" class="bg-[url(../images/overview_active.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
					<a href="wallet" class="bg-[url(../images/wallet.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
					<a href="settings" class="bg-[url(../images/settings.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
				</div>
				<div class="h-24">

				</div>
			</div>
			
			
		</div>
		<div class=" bg-black lg:hidden p-5 h-18 items-start z-10 fixed top-0 right-0  w-full flex flex-col align-start ">
				
				<div class="grid grid-cols-3 justify-center gap-10">
					<a href="overview" class="bg-[url(../images/overview_active.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
					<a href="wallet" class="bg-[url(../images/wallet.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
					<a href="settings" class="bg-[url(../images/settings.png)]  bg-no-repeat bg-contain bg-center h-5 w-5">
					</a>
				</div>
				
			</div>
		<div class="w-full mt-[45px] lg:mt-0  ">
			<section class="grid justify-center gap-5 grid-main w-full px-5 md:px-10">
				<div class="col-span-8 flex inline-flex h-24 items-center justify-between">
					<div class="font-bold text-2xl">Overview</div>
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
			
			<section class="grid justify-center gap-5 grid-main w-full px-5 md:px-10">
				<div class="col-span-8 md:col-span-3 grid gap-5">
					<div class="text-xl font-bold">Portfolio</div>
					<div class="bg-black text-white rounded-2xl w-full h-44 grid grid-rows-3 p-5">
						<div class="row-span-1">
							<div class="font-bold text-xl">$ <?php  echo($sum); ?>  </div>
							<div class="text-sm">Portfolio balance</div>
						</div>
						<div class="row-span-2" id="chart">

						</div>
					</div>
				</div>
				<div class="col-span-8 md:col-span-5 grid grid-cols-3 gap-5">
					<div class="text-xl col-span-3 font-bold">Your Assets</div>
					<div class="bg-[#E5DEF0] relative flex flex-col hover:shadow-xl  rounded-2xl max-w-32 col-span-3  md:col-span-1 h-44 p-5">
						<a href="wallet/btc" class="w-full h-full absolute"></a>
						<div class="flex flex-col">
							<div class="font-bold text-xl">{{json_decode(auth()->user()->btc_cred,true)['balance'] }}  BTC</div>
							<div class="text-sm">$ <?php echo($b); ?></div>
						</div>
						<div class="mt-auto justify-between flex items-center">
							<div class="bg-white rounded-lg flex justify-center p-2 h-8 w-8">
								<div class="bg-[url(../images/btc.png)]  bg-no-repeat bg-contain bg-center h-full w-full">
								</div>
							</div>
							<div class="text-sm">
								+0.14 %
							</div>
						</div>


					</div>
					<div class="bg-[#D6EDDA] relative hover:shadow-xl  flex flex-col rounded-2xl col-span-3  md:col-span-1  p-5">
						<a href="wallet/ltc" class="w-full h-full absolute"></a>
						<div class="flex flex-col">
							<div class="font-bold text-xl">{{json_decode(auth()->user()->ltc_cred,true)['balance'] }} LTC</div>
							<div class="text-sm">$ <?php echo($l);
							 ?></div>
						</div>
						<div class="mt-auto justify-between flex items-center">
							<div class="bg-white rounded-lg flex justify-center p-2 h-8 w-8">
								<div class="bg-[url(../images/ltc.png)]  bg-no-repeat bg-contain bg-center h-full w-full">
								</div>
							</div>
							<div class="text-sm">
								+10.14 %
							</div>
						</div>
					</div>
					<div class="bg-[#F6F0D8] relative hover:shadow-xl  flex flex-col rounded-2xl col-span-3 md:col-span-1  p-5">
						<a href="wallet/eth" class="w-full h-full absolute"></a>
						<div class="flex flex-col">
							<div class="font-bold text-xl">{{json_decode(auth()->user()->eth_cred,true)['balance'] }}  ETH</div>
							<div class="text-sm">$ <?php echo($e);
							 ?></div>
						</div>
						<div class="mt-auto justify-between flex items-center">
							<div class="bg-white rounded-lg flex justify-center p-2 h-8 w-8">
								<div class="bg-[url(../images/eth.png)]  bg-no-repeat bg-contain bg-center h-full w-full">
								</div>
							</div>
							<div class="text-sm">
								-2.14 %
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="grid justify-center my-10 gap-5 grid-main w-full px-5 md:px-10">
				<div class="col-span-8 text-xl font-bold">
					Market overview
				</div>
				
				<div class="col-span-8 bg-[#FAFCFF] rounded-2xl h-[400px]">
					<!-- TradingView Widget BEGIN -->
					<div class="tradingview-widget-container">
						<div class="tradingview-widget-container__widget" style="font-family: 'Montserrat', sans-serif;"></div>
						<script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-screener.js" async>
							{
								"width": "100%",
								"height": "100%",
								"defaultColumn": "overview",
								"screener_type": "crypto_mkt",
								"displayCurrency": "USD",
								"colorTheme": "light",
								"locale": "en"
							}
						</script>
					</div>
					<!-- TradingView Widget END -->
				</div>
			</section>
			
			
		</div>
	</div>
	<script >
		
		function updateChart(data){
			var options = {
				chart: {
					type: "line",
					height: 60,
					sparkline: {
						enabled: !0
					}
				},
				series: [{
					name:"Requests",
					data: data,
				}],
				stroke: {
					width: 2,
					curve: "smooth"
				},
				markers: {
					size: 0
				}
			};
			chart = new ApexCharts(document.querySelector("#chart"), options);
			chart.render();
		}
		updateChart([20,20,40,60,30,100,20,80,0]);
	</script>
	
	
	
</body>
</html>
