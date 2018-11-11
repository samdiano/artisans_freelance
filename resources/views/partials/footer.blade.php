<!--footer area start-->
<footer class="footer-area">

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <p class="copyright-text ">
                        {!! $basic->copyright !!}
                    </p>
                </div>
                <div class="col-md-3 col-sm-9">
                    <div class="footer-menu">
                        <ul>
                            @foreach($social as $data)
                            <li> <a href="{{url($data->link)}}" style="font-size: 18px">{!! $data->code !!}</a></li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="back-to-top" class="scroll-top back-to-top" data-original-title="" title="" >
        <i class="fa fa-angle-up"></i>
    </div>
</footer>