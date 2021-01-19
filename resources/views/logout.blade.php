@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	Logging out.... please wait!           
        </div>
    </div>
    <form id="logout-auto" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
@endsection

@section('js')
<script type="text/javascript">
	function getUrlParameter(name) {
	    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
	    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
	    var results = regex.exec(location.search);
	    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
	}

	function SubmitForm() {
		var xhr = new XMLHttpRequest();
		xhr.open("POST", "{{ route('logout') }}"); 
		xhr.onload = function(event){ 
		    var url = getUrlParameter('back');
		    location.href = url;
		}; 
		// or onerror, onabort
		var formData = new FormData(document.getElementById("logout-auto")); 
		xhr.send(formData);
	}

	document.addEventListener('DOMContentLoaded', SubmitForm);
</script>
@endsection
