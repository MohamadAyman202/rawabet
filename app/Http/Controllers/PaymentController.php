<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use App\Services\FatoorahServices;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{

    private $fatoorahService;
    public function __construct(FatoorahServices $fatoorahService)
    {
        $this->fatoorahService = $fatoorahService;
    }
    public function payment(Request $request)
    {
        try {
            $codePhone = substr($request->phone, 0, 3);
            $phonenumber = substr($request->phone, 3);
            $data = [
                'CustomerName'          => $request->name,
                'NotificationOption'    => 'LNK',
                'InvoiceValue'          => $request->price,
                'CustomerEmail'         => $request->email,
                'CallBackUrl'           => env('SUCCESS_PAY_URL', route('success_pay')),
                'ErrorUrl'              => env('SUCCESS_PAY_URL', route('success_pay')),
                'Language'              => app()->getLocale(),
                'DisplayCurrencyIso'    => 'EGP',
                'MobileCountryCode'     => $codePhone,
                'CustomerMobile'        => $phonenumber
            ];

            $pay_subscription = $request['pay_subscription'];

            $status = $this->fatoorahService->sendPayment($data);
            $response  = new Response();
            $response->cookie('user_id', $request->customer);
            $response->cookie('subscription_id', $request->subscription);
            $response->cookie('name', $request->name);
            $response->cookie('price', $request->price);
            $response->cookie('email', $request->email);
            $response->cookie('phone', $request->phone);
            $response->cookie('pay_subscription', $pay_subscription);

            foreach ($response->headers->getCookies() as $cookie) {
                header('Set-Cookie: ' . $cookie, false);
            }
            return $this->proccessPayment($status, $request->customer, $pay_subscription);
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    private function proccessPayment($status, string $user_id, $pay_subscription)
    {
        if ($status) {
            $data = $status;
            $status_success = Transaction::query()->create([
                'InvoiceId' => $data['Data']['InvoiceId'],
                'InvoiceURL' => $data['Data']['InvoiceURL'],
                'CustomerReference' => $data['Data']['CustomerReference'],
                'UserDefinedField' => $data['Data']['UserDefinedField'],
                'Message' => $data['Message'],
                'ValidationErrors' => $data['ValidationErrors'],
                'IsSuccess' => $data['IsSuccess'],
            ]);

            if ($status_success) return redirect($status_success->InvoiceURL);
        }
        session()->flash('error', 'Please Try Again!');
        return to_route('subscriptions');
    }
    public function payment_callback(Request $request)
    {
        $data = [];
        $data['key'] = $request->paymentId;
        $data['keyType'] = 'paymentId';
        $data_payment = $this->fatoorahService->getPaymentStatus($data);
        return $this->order($data_payment);
    }

    public function order($data)
    {
        $pay_subscription = json_decode($_COOKIE['pay_subscription']);
        $user_id = $_COOKIE['user_id'];
        $all_data = $data;
        $data = $data['Data'];
        $invoiceTransactions = $data['InvoiceTransactions'][0];
        $status = Order::query()->create([
            'IsSuccess' => $all_data['IsSuccess'],
            'InvoiceId'    => $data['InvoiceId'],
            'CustomerName' => $data['CustomerName'],
            'CustomerMobile'   => $data['CustomerMobile'],
            'CustomerEmail' => $data['CustomerEmail'],
            'InvoiceValue' => $data['InvoiceValue'],
            'InvoiceDisplayValue' => $data['InvoiceDisplayValue'],
            'DueDeposit' => $data['DueDeposit'],
            'TransactionDate' => $invoiceTransactions['TransactionDate'],
            'PaymentGateway' => $invoiceTransactions['PaymentGateway'],
            'ReferenceId' => $invoiceTransactions['ReferenceId'],
            'TransactionId' => $invoiceTransactions['TransactionId'],
            'PaymentId' => $invoiceTransactions['PaymentId'],
            'TransactionStatus' => $invoiceTransactions['TransactionStatus'],
            'TransationValue' => $invoiceTransactions['TransationValue'],
            'Country' => $invoiceTransactions['Country'],
            'Currency' => $invoiceTransactions['Currency'],
            'CardNumber' => $invoiceTransactions['CardNumber'],
            'Error' => $invoiceTransactions['Error'],
            'ErrorCode' => $invoiceTransactions['ErrorCode'],
            'end_date' => Date::now()->addDays($pay_subscription->count_day),
            'subscription_id'   => $pay_subscription->id,
            'user_id' => $user_id,
        ]);


        if ($status) {

            !is_null($status->ErrorCode) && !is_null($status->Error) ? $status_work = 'error' : $status_work = 'working';
            $status->update([
                'status_work' => $status_work,
            ]);

            return to_route('home');
        };
    }
}
