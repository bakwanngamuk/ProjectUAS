<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function showCheckout(Request $request)
    {
        // Ambil data produk dari request atau dari database
        $product = $request->input('product'); // Ini hanya contoh, Anda bisa mengambil data dari database

        return view('checkout', compact('product'));
    }

    public function processPayment(Request $request)
    {
        $paymentMethod = $request->input('payment_method');

        // Logika pemrosesan pembayaran berdasarkan metode pembayaran
        switch ($paymentMethod) {
            case 'cod':
                // Proses Cash on Delivery
                return redirect()->route('payment.success'); // Redirect ke halaman sukses setelah pembayaran berhasil
                break;
            case 'debit':
                $atmNumber = $request->input('atm_number');
                if (!$atmNumber) {
                    return redirect()->back()->with('error', 'Please provide your ATM card number.');
                }
                // Proses Debit dengan nomor ATM
                // Simpan atau proses nomor ATM sesuai kebutuhan Anda
                return redirect()->route('payment.success'); // Redirect ke halaman sukses setelah pembayaran berhasil
                break;
            case 'credit':
                $creditCardNumber = $request->input('credit_card_number');
                if (!$creditCardNumber) {
                    return redirect()->back()->with('error', 'Please provide your credit card number.');
                }
                // Proses Credit dengan nomor kartu kredit
                // Simpan atau proses nomor kartu kredit sesuai kebutuhan Anda
                return redirect()->route('payment.success'); // Redirect ke halaman sukses setelah pembayaran berhasil
                break;
            case 'virtual_account':
                // Proses Virtual Account
                $virtualAccountCode = $this->generateVirtualAccountCode();
                // Simpan atau proses kode virtual account sesuai kebutuhan Anda
                return redirect()->route('payment.success')->with('virtual_account_code', $virtualAccountCode); // Redirect ke halaman sukses setelah pembayaran berhasil
                break;
            default:
                // Metode pembayaran tidak valid
                return redirect()->back()->with('error', 'Invalid payment method.');
        }
    }

    public function paymentSuccess()
    {
        return view('success');
    }

    private function generateVirtualAccountCode()
    {
        // Logika untuk menghasilkan kode virtual account
        // Misalnya, menghasilkan angka acak dengan panjang tertentu
        return 'VA-' . rand(100000, 999999);
    }
}