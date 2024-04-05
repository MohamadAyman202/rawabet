<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use App\Services\FatoorahServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Date;

class PaymentController extends Controller
{

    private $fatoorahService;
    public function __construct(FatoorahServices $fatoorahService)
    {
        $this->fatoorahService = $fatoorahService;
    }
    public function payment(Request $request)
    {
        $pay_subscription = json_decode($request['pay_subscription']);
        $user = json_decode($request['user']);

        $data = [
            'CustomerName'          => $user->name,
            'NotificationOption'    => 'LNK',
            'InvoiceValue'          => $pay_subscription->price,
            'CustomerEmail'         => $user->email,
            'CallBackUrl'           => env('SUCCESS_PAY_URL', route('success_pay')),
            'ErrorUrl'              => env('SUCCESS_PAY_URL', route('success_pay')),
            'Language'              => app()->getLocale(),
            'DisplayCurrencyIso'    => 'EGP',
            'MobileCountryCode'     => '+20',
            'CustomerMobile'        => '1007363331'
        ];


        $status = $this->fatoorahService->sendPayment($data);
        return $this->proccessPayment($status, $user->id, $pay_subscription);
    }

    private function proccessPayment($status, string $user_id, $pay_subscription)
    {
        if ($status) {
            $data = $status['Data'];
            $status_success = Transaction::query()->create([
                'InvoiceId' => $data['InvoiceId'],
                'user_id' => $user_id,
                'subscription_id' => $pay_subscription->id,
                'end_date'  => Date::now()->addDays($pay_subscription->count_day),
                'InvoiceURL' => $data['InvoiceURL']
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
        ]);
        $transaction = Transaction::query()->where('InvoiceId', $status->InvoiceId)->first();

        if ($status) {
            !is_null($status->ErrorCode) && !is_null($status->Error) ? $status_work = 'error' : $status_work = 'working';
            $status->update([
                'end_date' => $transaction->end_date,
                'transaction_id' => $transaction->id,
                'subscription_id'   => $transaction->subscription_id,
                'user_id' => $transaction->user_id,
                'status_work' => $status_work,
            ]);

            if ($transaction) {
                $transaction->update(['status' => '1']);
            }

            return to_route('home');
        };
    }
}
