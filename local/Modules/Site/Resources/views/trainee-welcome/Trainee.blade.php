@extends('site::layouts.master')
@section('title','Home')  
@section('content')
    <div>      
        <!-- home section -->
        <section id="home">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-md-offset-4">
                        <img src="../assets/site/welcometemplete/images/about-img.png" class="img-responsive wow fadeInUp" alt="About">
                    </div> 
                    <div class="col-md-5 col-md-offset-4">
                        <h1 class="animated fadeInUp" data-animated-delay="0.4s">Trainee Systems</h1>
                    </div>                      
                    <div class="row">
                        <div class="col-md-5 col-md-offset-4">
                        @if(Auth::check())                         
                            <a href="{{ url('site/home')}}" ><button class="btn btn-lg"> Click To Site</button></a>
                        @endif
                        </div>
                    </div>
                </div>
            </div>		
        </section>

        <!-- Detail section -->
        <section id="about">
            <div class="container text-success text-center">
                <div class="row">           
                    <div class=" col-sm-12">
                        <div class="about-thumb">
                            <div class="section-title">
                                <h1 class="wow fadeIn" data-wow-delay="0.2s">I3gateway Digital Agency</h1>
                                <h3 class="wow fadeInUp" data-wow-delay="0.4s">Services</h3>
                            </div>
                            <div class="wow fadeInUp" data-wow-delay="0.6s">
                                <p>We tailor our services to each and every brand ensuring the best possible outcome ever time
                                    In the time of endless digital possibilities, define your uniqueness on our service to enhance your brand and show your personality to the market</p>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- about & feature section -->       
        <section id="feature">
            <div class="container">
                <div class="row">
                
                <svg preserveAspectRatio="none" viewBox="0 0 100 102" height="100" width="100%" version="1.1" xmlns="http://www.w3.org/2000/svg" class="svgcolor-light">
                    <path d="M0 0 L50 100 L100 0 Z"></path>
                </svg>

                <div class="col-md-4 col-sm-6">
                    <div class="media wow fadeInUp" data-wow-delay="0.4s">
                    <div class="media-object media-left">
                        <i class="icon icon-laptop"></i>
                    </div>
                    <div class="media-body">
                        <h2 class="media-heading">Website Development</h2>
                        <p>Responsive everything to fit any devices, desktops, tablet, and phones. However, it is not only adjustable screen resolutions and automatically resizable images but also rather a whole new way of thinking about design</p>
                    </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="media wow fadeInUp" data-wow-delay="0.8s">
                    <div class="media-object media-left">
                        <i class="icon icon-refresh"></i>
                    </div>
                    <div class="media-body">
                        <h2 class="media-heading">Interactive Application</h2>
                        <p>Professional tool via iPad or tablet to present as well as advertise the product and service in more interactive, cleaner, and effective way, marking a impression to customers</p>
                    </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-8">
                    <div class="media wow fadeInUp" data-wow-delay="1.2s">
                    <div class="media-object media-left">
                        <i class="icon icon-chat"></i>
                    </div>
                    <div class="media-body">
                        <h2 class="media-heading">Mobile Application</h2>
                        <p>They are all in our pockets, create the opportunities on building awareness , communication, better connect possibly with providing more value by creating loyalty program</p>
                    </div>
                    </div>
                </div>

                <div class="clearfix text-center col-md-12 col-sm-12">
                    <a href="http://www.i3gateway.com/" target="_blank" class="btn btn-default smoothScroll">Talk to us</a>
                </div>

                </div>
            </div>
        </section>

        <!-- contact section -->
        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-2 col-md-8 col-sm-12">
                        <div class="section-title">
                            <h1 class="wow fadeInUp" data-wow-delay="0.3s">Trainee system</h1>
                            <h3 class="wow fadeInUp" data-wow-delay="0.6s">Welcome internship</h3>
                        </div>
                        <div class="contact-form wow fadeInUp" data-wow-delay="1.0s">
                            <div class="text-center">
                                @if (Auth::guest())
                                    <a class="btn btn-primary btn-lg" href="{{ url('site/login') }}">Login</a>
                                    <a class="btn btn-warning btn-lg" href="{{ url('site/register') }}">Register</a>
                                @endif
                            </div>                           
                        </div>
                    </div>            
                </div>
            </div>
        </section>

        <!-- footer section -->
        <footer>
            <div class="container">
                <div class="row">
                    <svg class="svgcolor-light" preserveAspectRatio="none" viewBox="0 0 100 102" height="100" width="100%" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0 L50 100 L100 0 Z"></path>
                    </svg>
                    <div class="col-md-4 col-sm-6">
                        <h2>develop</h2>
                        <div class="wow fadeInUp" data-wow-delay="0.3s">
                           <p class="copyright-text">Copyright &copy; 2016 I3GATWAY DIGITAL AGENCY <br>
                            Designed by <a rel="nofollow" href="#">***</a></p>
                        </div>
                    </div>                    
                        <div class="col-md-4 col-sm-5">
                            <h2>Contact</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.6s">
                                    120-240 aliquam augue libero,<br>
                                    Convallis in vulputate 10220 <br>
                                    San Francisco, CA, USA
                            </p>
                            <ul class="social-icon">
                                <li><a href="#" class="fa fa-facebook wow bounceIn" data-wow-delay="0.9s"></a></li>
                                <li><a href="#" class="fa fa-twitter wow bounceIn" data-wow-delay="1.2s"></a></li>
                                <li><a href="#" class="fa fa-behance wow bounceIn" data-wow-delay="1.4s"></a></li>
                                <li><a href="#" class="fa fa-dribbble wow bounceIn" data-wow-delay="1.6s"></a></li>
                            </ul>
                        </div>                       
                </div>
            </div>
        </footer>
    </div>
    
    <!-- Back top -->
    <a href="#back-top" class="go-top hvr-icon-bob">
        <i class="glyphicon glyphicon-menu-up hvr-icon"></i>
    </a>
@endsection


