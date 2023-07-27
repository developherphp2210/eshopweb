<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{$title}}</title>               
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" />  
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="http://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> 
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>               
        @if ( env('APP_DEBUG') === true)
            @vite(['resources/css/styles.css'])        
        @else 
            <link rel="stylesheet" href="/build/assets/css/styles.css" >    
        @endif    
        <!-- <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" /> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>        
        @if ( env('APP_DEBUG') === true)
        <script src="http://127.0.0.1:5173/resources/js/JsBarcode.all.min.js"></script>         
        @else 
          <script src="/build/assets/js/JsBarcode.all.min.js"></script> 
        @endif  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.0/chart.min.js"></script> 
        @if ( env('APP_DEBUG') === true)       
            <script type="text/javascript" src="http://127.0.0.1:5173/resources/wow_book/wow_book.min.js"></script>
            <link rel="stylesheet" href="http://127.0.0.1:5173/resources/wow_book/wow_book.css" type="text/css" />
            <script type="text/javascript" src="http://127.0.0.1:5173/resources/wow_book/pdf.combined.min.js"></script>            
        @else 
            <script type="text/javascript" src="/build/assets/wow_book/wow_book.min.js"></script>
            <link rel="stylesheet" href="/build/assets/wow_book/wow_book.css" type="text/css" />
            <script type="text/javascript" src="/build/assets/wow_book/pdf.combined.min.js"></script>            
        @endif    
    </head>