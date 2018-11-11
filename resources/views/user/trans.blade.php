@extends('user')
@section('content')

    @include('partials.breadcrumb')

    <!-- Blog Single Section Start -->
    <div class="blog-section blog-section2 section-padding section-background" id="min-height-home">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <aside>
                        @include('partials.profile')

                    </aside>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        {{$page_title}}
                                    </div>
                                </div>

                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="">
                                        <thead>
                                        <tr>
                                            <th scope="col">SL</th>
                                            <th scope="col">Trx</th>
                                            <th scope="col">Details</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($invests)>0)
                                        @foreach($invests as $k=>$data)
                                            <tr class="black">
                                                <td  data-label="SL">{{++$k}}</td>
                                                <td  data-label="#Trx">{{$data->trx or 'N/A'}}</td>
                                                <td  data-label="Details">{!! $data->gateway->name  or '-' !!}</td>
                                                <td  data-label="Amount">{{$data->amount  or '-'}} {{$basic->currency }}</td>
                                                <td  data-label="Time">{{$data->created_at  or '-'}} </td>
                                            </tr>
                                        @endforeach
                                            @else

                                        <tr>
                                            <td colspan="5">No results found!!</td>
                                        </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    {!! $invests->links()!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end left column-->

            </div>
        </div>
    </div>

    <!-- Blog Single Section End -->
    <div class="clearfix"></div>
@stop