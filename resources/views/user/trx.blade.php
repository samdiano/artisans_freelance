@extends('user')
@section('content')


    @include('partials.breadcrumb')
    <section class="about-section section-padding-2 section-bg-clr1" id="min-height-trx">
        <div class="container">

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <aside>
                        @include('partials.profile')

                    </aside>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                {{$page_title}}
                            </div>
                        </div>

                        <div class="portlet-body">
                            <table class="table table-striped table-bordered ">
                                <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Transaction ID</th>
                                    <th scope="col" style="width: 25%">Details</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col" >Remaining Balance</th>
                                    <th scope="col">Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($invests) > 0)
                                    @foreach($invests as $k=>$data)
                                        <tr @if($data->type == '+') class="greenbg"
                                            @elseif($data->type == '-') class="redbg" @endif>
                                            <td data-label="SL">{{++$k}}</td>
                                            <td data-label="#TRX">{{$data->trx or 'N/A'}}</td>
                                            <td data-label="Details">{!! $data->title  or 'N/A' !!}</td>
                                            <td data-label="Amount">{!! $data->amount  or 'N/A' !!} {!! $basic->currency !!}</td>
                                            <td data-label="Remeaning Balance">{!! $data->	main_amo  or 'N/A' !!} {!! $basic->currency !!}</td>
                                            <td data-label="Time">{!! date('d M y h:i A',strtotime($data->created_at)) !!} </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">No Data Found !!</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            {!! $invests->links()!!}
                        </div>
                    </div>
                </div>
                <!--end left column-->
            </div>

        </div>
    </section>
    <!-- About Hostonion End -->



    <script>
        (function ($) {
            $(window).on('resize', function () {
                var bodyHeight = $(window).height();
                $('#min-height-trx').css('min-height', parseInt(bodyHeight) - 650);
                console.log(bodyHeight)
            })
            var bodyHeight = $(window).height();
            $('#min-height-trx').css('min-height', parseInt(bodyHeight) - 650);
            console.log(bodyHeight)


        }(jQuery))
    </script>
@stop