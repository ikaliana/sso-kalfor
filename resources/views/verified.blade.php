@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verified</div>

                <div class="card-body">
                    Account sudah terverifikasi. Halaman ini akan pindah secara otomatis dalam <span id="sec-counter">5</span> detik.
                    <br>
                    Klik <a href="/">link ini</a> jika halaman tidak otomatis berpindah.
                </div>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    var counter = 5;
    
    function DoCount() {
        var span = document.getElementById("sec-counter");
        span.innerHTML = --counter;
    }

    // document.addEventListener("DOMContentLoaded", function(event) { 
    //     setTimeout(function() {
    //         var span = document.getElementById("sec-counter");
    //         span.innerHTML = --counter;
    //         if(counter == 0) location.href = "/";
    //     },1000);
    // });


    let timerId = setInterval(() => DoCount(), 1000);
    setTimeout(() => { clearInterval(timerId); location.href = "/kalfor"; }, 5000);
</script>
@endsection
