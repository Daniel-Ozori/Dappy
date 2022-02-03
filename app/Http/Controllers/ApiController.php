<?php

namespace App\Http\Controllers;
use  App\Http\Controllers\ViewsController;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\WalletUser;
use Illuminate\Support\Facades\Redirect;
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
use Sop\CryptoTypes\Asymmetric\EC\ECPublicKey;
use Sop\CryptoTypes\Asymmetric\EC\ECPrivateKey;
use Sop\CryptoEncoding\PEM;
use kornrunner\keccak;

class ApiController extends Controller
{
    #Start of walletCreate ccntrollers

    public function createWallet(){
        $id = auth()->user()->id;
        $user = WalletUser::where('id', $id)->first();
        $user->btc_cred = $this->createBTC();
        $user->ltc_cred = $this->createLTC();
        $user->eth_cred = $this->createETH();
        $user->save();
        return  redirect()->to('/dashboard');
    }
    public function createBTC(){
        // Bip39
        $math = Bitcoin::getMath();
        $network = Bitcoin::getNetwork();
        $random = new Random();
        // Generate random number (Initial Entropy)
        $entropy = $random->bytes(Bip39Mnemonic::MIN_ENTROPY_BYTE_LEN);
        $bip39 = MnemonicFactory::bip39();
        //  By random number
        $mnemonic = $bip39->entropyToMnemonic($entropy);

        $seedGenerator = new Bip39SeedGenerator();
        //  Generate seeds by helping the words, incoming optional plus schismar 'Hello'
        $seed = $seedGenerator->getSeed($mnemonic);
        $hdFactory = new HierarchicalKeyFactory();
        $master = $hdFactory->fromEntropy($seed);

        $hardened = $master->derivePath("49'/0'/0'/0/0");
        $privateKey =  $hardened->getPrivateKey()->toWif();
        $address = new PayToPubKeyHashAddress($hardened->getPublicKey()->getPubKeyHash());
        $address =  $address->getAddress();

        $cred = new stdClass();
        $cred->balance = 0;
        $cred->address = $address;
        $cred->privateKey = $privateKey;

        return $json = json_encode($cred);

    }
    public function createLTC(){
        // Bip39
        $math = Bitcoin::getMath();
        // Set the Leptin network
        $network = NetworkFactory::litecoin();
        $random = new Random();
        //  Generate random number (Initial Entropy)
        $entropy = $random->bytes(Bip39Mnemonic::MIN_ENTROPY_BYTE_LEN);
        $bip39 = MnemonicFactory::bip39();
        //  By random number
        $mnemonic = $bip39->entropyToMnemonic($entropy);
        //$mnemonic = 'security hurdle lift acoustic skate recall hotel elegant amateur hidden escape slow';

        $seedGenerator = new Bip39SeedGenerator();
        //  Generate seeds by helping the words, incoming optional plus schismar 'Hello'
        $seed = $seedGenerator->getSeed($mnemonic);
        $hdFactory = new HierarchicalKeyFactory();
        $master = $hdFactory->fromEntropy($seed);

        $hardened = $master->derivePath("44'/2'/0'/0/0");
        $privateKey =  $hardened->getPrivateKey()->toWif($network);
        $address = new PayToPubKeyHashAddress($hardened->getPublicKey()->getPubKeyHash());
        $address =  $address->getAddress($network);


        $cred = new stdClass();
        $cred->balance = 0;
        $cred->address = $address;
        $cred->privateKey = $privateKey;

        return $json = json_encode($cred);
    }
    public function createETH(){
        // Bip39
        $math = Bitcoin::getMath();
        $network = Bitcoin::getNetwork();
        $random = new Random();
        //  Generate random number (Initial Entropy)
        $entropy = $random->bytes(Bip39Mnemonic::MIN_ENTROPY_BYTE_LEN);
        $bip39 = MnemonicFactory::bip39();
        //  By random number
        $mnemonic = $bip39->entropyToMnemonic($entropy);

        $seedGenerator = new Bip39SeedGenerator();
        //  Generate seeds by helping the words, incoming optional plus schismar 'Hello'
        $seed = $seedGenerator->getSeed($mnemonic);
        $hdFactory = new HierarchicalKeyFactory();
        $master = $hdFactory->fromEntropy($seed);

        $util = new Util();
        //  Set path account
        $hardened = $master->derivePath("44'/60'/0'/0/0");
        $publicKey =  $hardened->getPublicKey()->getHex();
        $privateKey =  $hardened->getPrivateKey()->getHex();//  Can be imported into the private key used by IMTOKEN
        $address = $util->publicKeyToAddress($util->privateKeyToPublicKey($hardened->getPrivateKey()->getHex()));//  Private key imports the same address after IMTOKEN
        $cred = new stdClass();
        $cred->balance = 0;
        $cred->address = $address;
        $cred->privateKey = $privateKey;

        return $json = json_encode($cred);
    }

    #End of walletCreate controllers

    public function getAllWalletData(){
        $id = auth()->user()->id;
        $user = WalletUser::where('id', $id)->first();
        $data = array(
            'btc' => $this->getBTCWalletData($user),
            'ltc' => $this->getLTCWalletData($user),
            'eth' => $this->getBTCWalletData($user),
        );

        return $data;
        
    }

    public function getBTCWalletData($user){

        $creds = json_decode($user->btc_cred,true);
        $data = array(
            'private_key' => $creds['privateKey'],
            'address' => $creds['address'], 
            'qr_code'=> "https://www.bitcoinqrcodemaker.com/api/?style=bitcoin&prefix=off&address=".$creds['address'],
            'coin' => "BTC",
            'balance' => $this->getBalance($creds['address']),
            'balance_usd' => $this->getBalanceUSD('BTC',$creds['balance']),);

        return $data;
    }

    public function getLTCWalletData($user){
        $creds = json_decode($user->ltc_cred,true);
            $data = array(
                'private_key' => $creds['privateKey'],
                'address' => $creds['address'], 
                'qr_code'=> "https://www.bitcoinqrcodemaker.com/api/?style=litecoin&prefix=off&address=".$creds['address'],
                'coin' => "LTC",
                'balance' => $creds['balance'],
                'balance_usd' => $this->getBalanceUSD('LTC',$creds['balance']),);
        return $data;
    }

    public function getETHWalletData($user){
        $creds = json_decode($user->eth_cred,true);
            $data = array(
                'private_key' => $creds['privateKey'],
                'address' => $creds['address'], 
                'qr_code'=> "https://www.bitcoinqrcodemaker.com/api/?style=ethereum&prefix=on&address=".$creds['address'],
                'coin' => "ETH" ,
                'balance' => $creds['balance'],
                'balance_usd' => $this->getBalanceUSD('ETH',$creds['balance']),);
        return $data;
    }


    public function getWalletData($coin){
    	$id = auth()->user()->id;
        $user = WalletUser::where('id', $id)->first();
        switch ($coin) {
            case 'btc':

                return $this->getBTCWalletData($user);
            case 'ltc':
            
                return $this->getLTCWalletData($user);
            case 'eth':
            
                return $this->getETHWalletData($user);
            default:
                return $this->getBTCWalletData($user);
           

        }
    }
    function getBalance($address) {
        return file_get_contents('https://blockchain.info/q/addressbalance/'. $address);
    }

    function getBalanceUSD($coin,$coin_balance){
        return file_get_contents('https://api.coingate.com/v2/rates/merchant/'.$coin.'/USD') * $coin_balance;
    }

}
