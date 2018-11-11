@extends('user')
@section('content')

    @include('partials.breadcrumb')



    <!-- Blog Single Section Start -->
    <div class="blog-section blog-section2 section-padding section-background" id="min-height-home">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <aside>
                        @include('partials.profile')
                    </aside>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="blog-single-content">
                                <div class="blog-thumb">
                                    <p> 25 <span>May, 2018</span></p>
                                    <img class="img-responsive" alt="" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Fetured Image">
                                </div>
                                <div class="blog-content">
                                    <h4>IMAGE POST FOR VPS HOSTING</h4>
                                    <ul>
                                        <li>
                                            <span><i class="fa fa-user"></i> By Benjamin</span>
                                        </li>
                                        <li>
                                            <span><i class="fa fa-comments-o"></i> 15 Comments</span>
                                        </li>
                                    </ul>
                                    <div class="blog-text">
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse et justo. Praesent mattis commodo augue. Aliquam ornare hendrerit augue. Cras tellus. In pulvinar lectus a est. Curabitur eget orci. Cras laoreet ligula. Etiam sit amet dolor. Vestibulum Curabitur eget orci. </p>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse et justo. Praesent mattis commodo augue. Aliquam ornare hendrerit augue. Cras tellus. In pulvinar lectus a est. Curabitur eget orci. Cras laoreet ligula. Etiam sit amet dolor. Vestibulum Curabitur eget orci. </p>
                                        <h5>Aliquam ornare hendrerit augue</h5>
                                        <ul class="iconlist dark">
                                            <li><i class="fa fa-check"></i> Sed massa tellus aliquam rhoncus venenatis quis. </li>
                                            <li><i class="fa fa-check"></i> Development dolor sit amet consectetur adipiscing elit Phasellus </li>
                                            <li><i class="fa fa-check"></i> Etiam dictum Nunc enim Sed massa tellus aliquam rhoncus venenatis</li>
                                            <li><i class="fa fa-check"></i> Magna eget scelerisque metus massa in neque sit consectetur </li>
                                        </ul>
                                        <h5>Share this Article</h5>
                                        <ul class="social-icons-2">
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="blog-author">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="blog-list blog-list1">
                                                    <div class="blog-thumb"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Fetured Image" alt="" class="img-responsive"/></div>
                                                    <div class="blog-text">
                                                        <h6>Charlotte</h6>
                                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse et justo. Praesent mattis commodo augue. </p>
                                                        <a class="btn btn-border orange-2 btn-small-2" href="#">Read more</a>
                                                    </div>
                                                </div>
                                                <!--end item-->
                                            </div>
                                        </div>

                                    </div>
                                    <div class="other-blog">
                                        <h4>Related Posts</h4>
                                        <div class="row">
                                            <div class="col-md-4 other-blog-list ">
                                                <div class="image-holder"><a href="#"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Fetured Image" alt="" class="img-responsive"/></a></div>
                                                <h5 ><a href="#">Aliquam ornare</a></h5>
                                                <ul>
                                                    <li>
                                                        <span><i class="fa fa-user"></i> Benjamin</span>
                                                    </li>
                                                    <li>
                                                        <span><i class="fa fa-comments-o"></i>15 Comments</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!--end item-->

                                            <div class="col-md-4 other-blog-list  ">
                                                <div class="image-holder"><a href="#"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Fetured Image" alt="" class="img-responsive"/></a></div>
                                                <h5 ><a href="#">Aliquam ornare</a></h5>
                                                <ul>
                                                    <li>
                                                        <span><i class="fa fa-user"></i> Benjamin</span>
                                                    </li>
                                                    <li>
                                                        <span><i class="fa fa-comments-o"></i>15 Comments</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!--end item-->

                                            <div class="col-md-4 other-blog-list ">
                                                <div class="image-holder"><a href="#"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Fetured Image" alt="" class="img-responsive"/></a></div>
                                                <h5 ><a href="#">Aliquam ornare</a></h5>
                                                <ul>
                                                    <li>
                                                        <span><i class="fa fa-user"></i> Benjamin</span>
                                                    </li>
                                                    <li>
                                                        <span><i class="fa fa-comments-o"></i>15 Comments</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!--end item-->
                                    </div>
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


    <section class="about-section section-padding-2 section-bg-clr1" id="min-height-activity">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
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
                                    <th scope="col">Match</th>
                                    <th scope="col">Question</th>
                                    <th scope="col">Threat</th>
                                    <th scope="col"> Bet Amount</th>
                                    <th scope="col"> Return Amount</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td  data-label="SL">1</td>
                                        <td  data-label="Match">
                                            <a href="#">sdfsdf</a>
                                        </td>
                                        <td  data-label="Question">sadfsa</td>
                                        <td  data-label="Threat">sadfsa</td>
                                        <td  data-label="Bet Amount">asfdsa</td>
                                        <td  data-label="Return Amount">sadf</td>

                                        <td  data-label="Status">
                                                <b class="btn btn-sm btn-warning">Processing</b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Hostonion End -->



    <script>
        (function($){
            $(window).on('resize',function(){
                var bodyHeight = $(window).height();
                $('#min-height-activity').css('min-height',parseInt(bodyHeight) - 450);
                console.log(bodyHeight)
            })
            var bodyHeight = $(window).height();
            $('#min-height-activity').css('min-height',parseInt(bodyHeight) - 450);
            console.log(bodyHeight)


        }(jQuery))
    </script>


@stop