<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MpesaController extends Controller
{ public $formData1 = [];

    public function show(Request $request)
    {
        $this->formData1 = [
            'roomId' => $request->input('roomId'),
            'check_in' => $request->input('check_in'),
            'check_out' => $request->input('check_out'),
            'adults' => $request->input('adults'),
            'child' => $request->input('child'),
            'rooms' => $request->input('rooms'),
            'PricePerNight' => $request->input('PricePerNight'),
        ];
    
        $numberOfNights = $this->calculatePrice($this->formData1);
        $totalPrice = $this->calculateTotalPrice($this->formData1);
    
        $this->formData1['nights'] = $numberOfNights;
        $this->formData1['pricePerNightCalculated'] = $totalPrice;
    
        cache(['form_data1' => $this->formData1], now()->addMinutes(30));
    
        return view('payment.payment', ['formData1' => $this->formData1]);
    }
    
    public function calculatePrice($formData)
    {
        $checkInDate = Carbon::parse($formData['check_in']);
        $checkOutDate = Carbon::parse($formData['check_out']);
    
        return $checkOutDate->diffInDays($checkInDate);
    }
    
    public function calculateTotalPrice($formData)
    {
        $numberOfNights = $this->calculatePrice($formData);
    
        $pricePerNight = isset($formData['PricePerNight']) ? $formData['PricePerNight'] : 200;
    
        $totalPrice = ($numberOfNights * $pricePerNight * $formData['adults']) + (0.5 * $pricePerNight * $formData['child']);
    
        return $totalPrice;
    }
    
private function getAccessToken()
{
    // Replace with your actual consumerKey and consumerSecret
    $consumerKey = "UhoXlFx8vzIZfTr6dtUMzJpXS7uES3Gw";
    $consumerSecret = "8FdgPGYTGFnz2m5M";

    $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    $headers = ['Content-Type:application/json; charset=utf8'];

    $response = Http::withHeaders(['Authorization' => 'Basic ' . base64_encode($consumerKey . ':' . $consumerSecret)])
        ->get($access_token_url);

    // Check if the response is successful and contains JSON data
    if ($response->successful() && $response->json()) {
        $result = $response->json();
        
        // Check if 'access_token' key exists in the response
        if (isset($result['access_token'])) {
            return $result['access_token'];
        } else {
            // Handle the case where 'access_token' key is not present in the response
            // You might want to log or handle this error scenario accordingly
            return null;
        }
    } else {
        // Handle the case where the response was not successful or doesn't contain JSON data
        // You might want to log or handle this error scenario accordingly
        return null;
    }
}

 // PaymentController.php

// PaymentController.php


    public function performStkPush(Request $request)
    {
      

        $access_token = $this->getAccessToken();

        $processRequestUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $callbackUrl = 'https://9a44-105-161-79-85.ngrok-free.app ';
        $passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
        $businessShortCode = '17437';
        $timestamp = now()->format('YmdHis');

        $password = base64_encode($businessShortCode . $passkey . $timestamp);
       
      
        $mpesaNumber = $request->input('mpesa_number');
        // Get values from the request
        $formDataFromCache = Cache::get('form_data1');
        $money =   $formDataFromCache['pricePerNightCalculated'];
        $partyA =  $mpesaNumber;
        $partyB = '254111978124';
        $accountReference = 'Blimley resort';
        $transactionDesc = 'checkout';
        $amount = $money;

        $stkPushHeader = ['Content-Type' => 'application/json', 'Authorization' => 'Bearer ' . $access_token];

        $curlPostData = [
            'BusinessShortCode' => $businessShortCode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'PartyA' => $partyA,
            'PartyB' => $businessShortCode,
            'PhoneNumber' => $partyA,
            'CallBackURL' => $callbackUrl,
            'AccountReference' => $accountReference,
            'TransactionDesc' => $transactionDesc,
        ];

        $response = Http::withHeaders($stkPushHeader)->post($processRequestUrl, $curlPostData);

        $responseData = $response->json();
//dd($responseData);
        $responseData = $response->json();
      
        $checkoutRequestID = $responseData['CheckoutRequestID'];
        $responseCode = $responseData['ResponseCode'];

        if ($responseCode == "0") {
            // Store the $checkoutRequestID in the cache for 60 minutes (adjust as needed)
            Cache::put('checkoutRequestID', $checkoutRequestID, 60);

            return view('payment.success');
        }
    }

    // STK push callback functionality
    // STK push callback functionality
public function handleStkCallback(Request $request)
{
    $stkCallbackResponse = $request->getContent();
    $logFile = "Mpesastkresponse.json";
    file_put_contents($logFile, $stkCallbackResponse, FILE_APPEND);

    $data = json_decode($stkCallbackResponse);

    $merchantRequestID = $data->Body->stkCallback->MerchantRequestID;
    $checkoutRequestID = $data->Body->stkCallback->CheckoutRequestID;
    $resultCode = $data->Body->stkCallback->ResultCode;
    $resultDesc = $data->Body->stkCallback->ResultDesc;
    $amount = $data->Body->stkCallback->CallbackMetadata->Item[0]->Value;
    $transactionId = $data->Body->stkCallback->CallbackMetadata->Item[1]->Value;
    $userPhoneNumber = $data->Body->stkCallback->CallbackMetadata->Item[4]->Value;

    // CHECK IF THE TRANSACTION WAS SUCCESSFUL
    if ($resultCode == 0) {
        // REDIRECT TO SUCCESS PAGE
        return redirect()->route('success', [
            'merchantRequestID' => $merchantRequestID,
            'checkoutRequestID' => $checkoutRequestID,
            'amount' => $amount,
            'transactionId' => $transactionId,
            'userPhoneNumber' => $userPhoneNumber,
        ]);
    }

    return response()->json(['status' => 'payment.success'], 200);
}


    public function queryStkPush(Request $request)
{
  
  

  
    $access_token = $this->getAccessToken();

    // Set API endpoint and credentials
    $queryUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';
    $businessShortCode = '174379';
    $timestamp = now()->format('YmdHis');
    $passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
    $password = base64_encode($businessShortCode . $passkey . $timestamp);
    $checkoutRequestID = Cache::get('checkoutRequestID');

    // Set headers and request payload
    $queryHeader = ['Content-Type' => 'application/json', 'Authorization' => 'Bearer ' . $access_token];
    $curlPostData = [
        'BusinessShortCode' => $businessShortCode,
        'Password' => $password,
        'Timestamp' => $timestamp,
        'CheckoutRequestID' => $checkoutRequestID,
    ];

  
    $response = Http::withHeaders($queryHeader)->post($queryUrl, $curlPostData);
    $responseData = $response->json();

  
    if (isset($responseData['ResultCode'])) {
        $resultCode = $responseData['ResultCode'];

        // Process result codes
        switch ($resultCode) {
            case '1037':
                $message = "1037 Timeout in completing transaction";
                break;

            case '1032':
                $formDataFromCache = Cache::get('form_data1');
                $message = $this->handleTransactionCancelled($formDataFromCache);
                break;

            case '1':
                $message = "1 The balance is insufficient for the transaction";
                break;

            case '0':
                $message = "0 The transaction was successful";
                Cache::put('checkoutRequestID', $checkoutRequestID, 60);
                break;

            default:
                $message = "Unhandled ResultCode: $resultCode";
                break;
        }

        return $message;
    }
}

private function handleTransactionCancelled($formDataFromCache)
{
    try {
      
        $userIdInSession = session('user_id');

   

        // Prepare booking data
        $bookingData = [

            'RoomID' => $formDataFromCache['roomId'] ?? null,
            'UserID' => $userIdInSession,
            'CheckInDate' => $formDataFromCache['check_in'] ?? null,
            'Adult' => $formDataFromCache['adults'] ?? null,
            'Children' => $formDataFromCache['child'] ?? null,
            'CheckOutDate' => $formDataFromCache['check_out'] ?? null,
            'TotalPrice' =>$formDataFromCache['pricePerNightCalculated'],
        ];
       


       // $userEmail = DB::table('users')->where('id', $userIdInSession)->value('email');


       
   
        try {
            DB::table('booking')->insert($bookingData);
        } catch (\Exception $e) {
            \Log::error('Error creating booking: ' . $e->getMessage());
        }
      
        $room = Room::where('RoomId', $formDataFromCache['roomId'])->first();
     
      
       
        if ($room) {
            $room->Status = 'booked';
            $room->save();
           
         
        } else {
            $affectedRows = 0;
            \Log::error('Room not found ');
        }
    } catch (\Exception $e) {
        \Log::error('Exception updating room status: ' . $e->getMessage());
    }

    return view('bookingsuccess');
}

    }