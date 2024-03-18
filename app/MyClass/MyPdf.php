<?php
namespace App\MyClass;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderBody;
use App\Models\OrderPayment;
use App\Models\OrderShipping;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class MyPdf {

    static function Create(string $ViewName,array $data)
    {
        $pdf = Pdf::loadView($ViewName,$data);
        $pdf = (new self)->CounterPage($pdf);
        $pdf->save(storage_path().'/app/public/pdf/order'.$data['header']->id.'.pdf');
        // $pdf->save(public_path().'/storage/pdf/order'.$data['header']->id.'.pdf');

        return $pdf;
    }

    private function CounterPage($pdf)
    {
        $pdf->render();
            // Parameters
        $x          = 505;
        $y          = 820;
        $text       = "Pagina {PAGE_NUM} di {PAGE_COUNT}";     
        $font       = $pdf->getFontMetrics()->get_font('Helvetica', 'normal');   
        $size       = 10;    
        $color      = array(0,0,0);
        $word_space = 0.0;
        $char_space = 0.0;
        $angle      = 0.0;
        $pdf->getCanvas()->page_text(
                $x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle
        );
        return $pdf;
    }

    static function CreatePrinterOrder($id)
    {
        $order = Order::GetOrderHeader($id);
        $myorder = [
            'header' => $order,
            'user' => User::Show($order->user_id),            
            'address' => ($order->address_id != '0') ? Address::Show($order->address_id) : [],
            'body' => OrderBody::GetOrderBody($id),
            'payment' => OrderPayment::Show($id),
            'shipping' => OrderShipping::Show($id),
        ];    
        $pdf = (new self)->Create('pdf.order',$myorder);
        return $pdf->download('order'.$id.'.pdf');
    }
    
}