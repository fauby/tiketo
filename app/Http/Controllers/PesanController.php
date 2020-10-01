<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\Barang;
use App\Pesanan;
use App\Payment;
use App\PesananDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Omnipay\Omnipay;




class PesanController extends Controller
{
    public function __construct()
    {
        $this->gateway = Omnipay::create('AuthorizeNetApi_Api');
        $this->gateway->setAuthName(env('ANET_API_LOGIN_ID'));
        $this->gateway->setTransactionKey(env('ANET_TRANSACTION_KEY'));
        $this->gateway->setTestMode(true); //comment this line when move to 'live'
    }
    public function index($id)
    {
        $barang = Barang::where('id', $id)->first();

        return view('pesan.index', compact('barang'));
    }
    public function pesan(Request $request ,$id)
    {
        // dd($request);
        $barang = Barang::where('id', $id)->first();
        $tanggal = Carbon::now();

        //validasi apakah melebihi stok
        if($request->jumlah_pesan > $barang->stok)
    	{
    		return redirect('pesan/'.$id);
    	}


        //cek validasi
        $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();

        //simpan ke database pesanan
        if(empty($cek_pesanan))
        {
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->jumlah_harga = 0;
            $pesanan->kode = mt_rand(1, 10);
            $pesanan->save();
        }

        //simpan ke database pesanan_detail
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        $pesanan_detail = new PesananDetail;
        //cek pesanan_detail
        $cek_pesanan_detail = PesananDetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();
        if(empty($cek_pesanan_detail))
        {
            $pesanan_detail->barang_id = $barang->id;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->jumlah = $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $barang->harga*$request->jumlah_pesan;
            $pesanan_detail->save();
        }
        else
        {
            $cek_pesanan_detail = PesananDetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();
            $cek_pesanan_detail->jumlah = $cek_pesanan_detail->jumlah + $request->jumlah_pesan;

            //harga sekarang
            $harga_pesanan_detail_baru = $barang->harga*$request->jumlah_pesan;
            $cek_pesanan_detail->jumlah_harga = $cek_pesanan_detail->jumlah_harga + $harga_pesanan_detail_baru;
            $cek_pesanan_detail->update();
        }


        //jumlah total
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga+$barang->harga*$request->jumlah_pesan;
        $pesanan->update();

        Alert::success('Sukses Masuk Keranjang', 'Success');

        return redirect('home');
    }

    public function check_out()
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        if(!empty($pesanan))
        {
            $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();
        }


        return view('pesan.check_out', compact('pesanan', 'pesanan_details'));
    }

    public function delete($id)
    {
        $pesanan_detail = PesananDetail::where('id', $id)->first();

        $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga-$pesanan_detail->jumlah_harga;
        $pesanan->update();

        $pesanan_detail->delete();

        Alert::error('Pesanan Sukses Dihapus', 'Hapus');
        return redirect('check-out');
    }

    public function konfirmasi()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        if(empty($user->nohp)){
            Alert::error('Identitas Harap Dilengkapi', 'Hapus');
            return redirect('profile');
        }
        if(empty($user->alamat)){
            Alert::error('Identitas Harap Dilengkapi', 'Hapus');
            return redirect('profile');
        }

        return view('pesan.payment', compact('user', 'pesanan'));


        //OLD PAYMENT


        // $pesanan_id = $pesanan->id;
        // $pesanan->status = 1;
        // $pesanan->update();

        // $pesanan_details = PesananDetail::where('pesanan_id', $pesanan_id)->get();
        // foreach ($pesanan_details as $pesanan_detail ) {
        //     $barang = Barang::where('id', $pesanan_detail->barang_id)->first();
        //     $barang->stok = $barang->stok-$pesanan_detail->jumlah;
        //     $barang->update();
        // }


        // Alert::success('Pesanan Sukses Silakan Lanjutkan Proses Pembayaran', 'Success');
        // return redirect('history/'.$pesanan_id );
    }

    public function charge(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        try {
            $creditCard = new \Omnipay\Common\CreditCard([
                'number' => $request->input('cc_number'),
                'expiryMonth' => $request->input('expiry_month'),
                'expiryYear' => $request->input('expiry_year'),
                'cvv' => $request->input('cvv'),
            ]);

            // Generate a unique merchant site transaction ID.
            $transactionId = rand(100000000, 999999999);

            $response = $this->gateway->authorize([
                'amount' => $request->input('amount'),
                'currency' => 'USD',
                'transactionId' => $transactionId,
                'card' => $creditCard,
            ])->send();

            if($response->isSuccessful()) {

                // Captured from the authorization response.
                $transactionReference = $response->getTransactionReference();

                $response = $this->gateway->capture([
                    'amount' => $request->input('amount'),
                    'currency' => 'USD',
                    'transactionReference' => $transactionReference,
                    ])->send();

                $transaction_id = $response->getTransactionReference();
                $amount = $request->input('amount');

                // Insert transaction data into the database
                $isPaymentExist = Payment::where('transaction_id', $transaction_id)->first();

                if(!$isPaymentExist)
                {
                    $payment = new Payment;
                    $payment->transaction_id = $transaction_id;
                    $payment->payer_email = $request->input('email');
                    $payment->amount = $request->input('amount');
                    $payment->currency = 'USD';
                    $payment->payment_status = 'Approved';
                    $payment->user_id = $user->id;
                    $payment->pesanan_id = $pesanan->id;
                    $payment->save();

                    $pesanan_id = $pesanan->id;
                    $pesanan->status = 1;
                    $pesanan->update();

                    $pesanan_details = PesananDetail::where('pesanan_id', $pesanan_id)->get();
                    foreach ($pesanan_details as $pesanan_detail ) {
                        $barang = Barang::where('id', $pesanan_detail->barang_id)->first();
                        $barang->stok = $barang->stok-$pesanan_detail->jumlah;
                        $barang->update();
                    }
                }

                Alert::success('Your transaction id is: '. $transaction_id, 'Success');
                return redirect('history/'.$pesanan_id );
            } else {
                // not successful
                return $response->getMessage();
            }
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }
}
