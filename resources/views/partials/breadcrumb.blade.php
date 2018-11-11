<style type="text/css">
    .breadcrumb-section {
        @php $user = Auth::user() @endphp

        @if(Auth::user())
            @if($user->cover != null )
                 background-image: url({{asset('assets/images/user/'.$user->cover)}});
            @else
                 background-image: url({{asset('assets/images/logo/breadcrumb.jpg')}});
            @endif
        @else
        background-image: url({{asset('assets/images/logo/breadcrumb.jpg')}});
        @endif
    }

</style>
<!-- Breadcrumb Section start -->
<section class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- breadcrumb Section Start -->
                <div class="breadcrumb-content">
                    <h2>{{$page_title}}</h2>
                </div>
                <!-- Breadcrumb section End -->
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
