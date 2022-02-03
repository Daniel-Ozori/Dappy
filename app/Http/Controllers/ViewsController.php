<?php

namespace App\Http\Controllers;
use  App\Http\Controllers\ApiController;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\WalletUser;
use Redirect;
use View;
use Auth;
use BitWasp\Bitcoin\Address\PayToPubKeyHashAddress;
use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Crypto\Random\Random;
use BitWasp\Bitcoin\Key\Factory\HierarchicalKeyFactory;
use BitWasp\Bitcoin\Mnemonic\Bip39\Bip39Mnemonic;
use BitWasp\Bitcoin\Mnemonic\Bip39\Bip39SeedGenerator;
use BitWasp\Bitcoin\Mnemonic\MnemonicFactory;
use Web3p\EthereumUtil\Util;
use BitWasp\Bitcoin\Network\NetworkFactory;
use Log;
use stdClass;

class ViewsController extends Controller
{
    public function index(){
    	//return index page
    	return view('index');
    }

    //Start of Authhentication controllers
    public function login(){
    	//return signin page
    	return view('auth.login');
    }
    public function loginProcess(Request $request){
        $user = WalletUser::where('email', $request->email)->where('password',$request->password);
        if ($user->exists()) {
            $user = WalletUser::where('email', $request->email)->where('password', $request->password)->first();
            Auth::login($user, true);
            return redirect()->to('/dashboard');
            
            
        }else{
            return Redirect::back()->withErrors(['msg' => 'Incorrect email or password']);
        }
    }
    public function signup(){
    	//return signup page
    	return view('auth.signup');
    }
    public function signupProcess(Request $request){

        if(strstr($request->email , '@') && strlen($request->password) >= 7){
            try {
                $ApiController = new ApiController;
                $WalletUser = new WalletUser;
                $WalletUser->name = $request->name;
                $WalletUser->email = $request->email;
                $WalletUser->password = $request->password;
                $WalletUser->btc_cred = "";
                $WalletUser->ltc_cred = "";
                $WalletUser->eth_cred = "";
                $WalletUser->save();
                Auth::login($WalletUser, true);
                $ApiController->createWallet();
                return redirect()->to('/dashboard');
            } catch (QueryException $e) {
               return Redirect::back()->withErrors(['msg' => 'Email already exists']);
           }
       }else if(!strstr($request->email , '@')){
        return Redirect::back()->withErrors(['msg' => 'Invalid Email Address']);
    }else{
       return Redirect::back()->withErrors(['msg' => 'Password must be atleast 7 characters long']);
    }

}


    //End of Authentication controllers



    //Start of Dashboard controllers
public function DashboardOverview(){
   return view('dashboard.overview');
}
public function DashboardWallet(Request $request, $coin){
    $ApiController = new ApiController;
    return view('dashboard.wallet')->with($ApiController->getWalletData($coin));
}
public function DashboardSettings(){
   return view('dashboard.settings');
}
public function DeleteAccount(){
    WalletUser::find(auth()->user()->id)->delete();
    return redirect()->to('/signup');
}
    //end of Dashboard controllers
}
