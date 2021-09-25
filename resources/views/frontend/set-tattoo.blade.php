@extends('frontend.account_layout')

@push('page_css')
<link href="{{asset('public/front_end')}}/jquery-ui.css" rel="stylesheet" type="text/css" />
<style>
.ui-icon {
    background-image: url('https://creativesyntax.in/tattoo-crm/public/front_end/ui-icons.png') !important;
}
</style>
@endpush

@section('page_content')
<body data-spy="scroll" data-target=".fixed-top">    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-light">
        <div class="container">
            
            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Kora</a> -->

            <!-- Image Logo -->
            <a class="navbar-brand logo-image" href="{{route('f.index')}}">Tattoo Express</a> 

            <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="{{route('f.index')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hi, {{Auth::user()->first_name}}</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item page-scroll" href="article.html">My Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item page-scroll" href="privacy.html">My Images</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item page-scroll" href="terms.html">Change Password</a>
                        </div>
                    </li>
                </ul>
                <span class="nav-item">
                    <a class="btn-solid-sm page-scroll" href="{{route('f.signup')}}">Logout</a>
                </span>
            </div> <!-- end of navbar-collapse -->
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->

    <!-- Header -->
    <header class="ex-header">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 offset-xl-1 text-center">
                    <h1 class="text-center">Please Select Your Tattoos</h1>
                    <div>
                        <button type="button" class="btn-solid-sm" id="downloadBtn" data-name="{{$imgx->hash_id}}" style="display:none;">Done! Want to Download?</button>
                    </div>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of ex-header -->
    <!-- end of header -->
    
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-sm-8" id="drop">
                <img src="{{ asset('public/uploads/files/media_images/' . $imgx->image_org) }}" style="width: 100%;" class="img-thumbnail">
            </div>
            <div class="col-sm-4">
                @if (count($tattoos))
                    <table class="table table-bordered table-sm">
                        @foreach($tattoos as $v)
                            <tr>
                                <td style="width:91px;"><img id="tatto_{{$v->id}}" src="{{ asset('public/uploads/files/media_images/'. $v->image) }}" style="width: 90px;" class="img-thumbnail"></td>
                                <td style="vertical-align: middle;">{{$v->title}}<br/><button type="button" class="applytattoo btn-solid-sm" id="tatbtn_{{$v->id}}">Apply</button></td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>    
        </div>
    </div>
@endsection

@push('page_js')
<script src="{{asset('public/front_end')}}/jquery-ui.js"></script>
<script src="{{asset('public/front_end')}}/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="{{asset('public/front_end')}}/html2canvas.js"></script>
<script type="text/javascript">
  $(function() {    
    $('.draggable').draggable({containment: "#drop", cursor: "move"});
    $('body').on('click', '.applytattoo', function () {
        var tatId = $(this).attr('id').split('_');
        var tatSrc = $('#tatto_' + tatId[1]).attr('src');
        var tatHtml = "<img id='dragtat_" + tatId[1] + "' src='" + tatSrc + "' class='draggable' style='width: 90px; position: absolute; top: 50px; left: 50px;' />";
        $('#drop').append(tatHtml); 
        $('#dragtat_' + tatId[1]).resizable({handles: "all" , autoHide: true, ghost: true}).parent().draggable({containment: "#drop", cursor: "move"});  
        $(this).removeClass('applytattoo').addClass('deletetattoo').text('Remove').css({'border': '1px solid #1e266d', 'background-color': '#1e266d'});
        toastr.success('Tattoo applied on your photo. Please drag the tattoo and set at your position');
        if ($('.draggable').length > 0) {
            $('#downloadBtn').show();
        } else {
            $('#downloadBtn').hide();
        }
    });
    $('body').on('click', '.deletetattoo', function () {
        var tatId = $(this).attr('id').split('_');
        $('#dragtat_' + tatId[1]).remove(); 
        $(this).removeClass('deletetattoo').addClass('applytattoo').text('Apply').removeAttr('style');
        toastr.success('Tattoo has been removed from your photo.');
        if ($('.draggable').length > 0) {
            $('#downloadBtn').show();
        } else {
            $('#downloadBtn').hide();
        }
    });
});
document.getElementById("downloadBtn").addEventListener("click", function() {
    var dwName = $(this).data('name');
    $(this).text('Please Wait...');
    html2canvas(document.querySelector('#drop')).then(function(canvas) {
        saveAs(canvas.toDataURL(),  dwName + '.png');
        toastr.success('Your download request has been done!');
        setTimeout(function() { 
            $("#downloadBtn").text('Download Completed! Want To Download Again?'); 
        }, 3000);
    });
});
function saveAs(uri, filename) {
    var link = document.createElement('a');
    if (typeof link.download === 'string') {
        link.href = uri;
        link.download = filename;
        //Firefox requires the link to be in the body
        document.body.appendChild(link);
        //simulate click
        link.click();
        //remove the link when done
        document.body.removeChild(link);
    } else {
        window.open(uri);
    }
}
</script>
@endpush
