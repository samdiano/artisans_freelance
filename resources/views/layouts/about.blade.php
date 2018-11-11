@extends('layout')
@section('content')

  @include('partials.breadcrumb')

    <!--about us page content start-->
    <section class="section-padding about-us-page section-background">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="nicEdit-main">{!! $basic->about !!}</div>
                </div>
            </div>
        </div>
    </section>
@stop