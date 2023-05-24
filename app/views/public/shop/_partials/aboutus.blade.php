@extends('public.shop._layouts.index')
@section('title')
    About Us | Ghoori
@stop
@section('staticpagestyles')
    {{HTML::style('css/about_us.css')}}
@stop
@section('metatags')
    <link rel="canonical" href="{{URL::route('about-us')}}">
    <meta property="og:title" content="Ghoori #AboutUs" />
    <meta property="og:site_name" content="ghoori.com.bd"/>
    <meta property="og:url" content="{{URL::route('about-us')}}" />
    <meta property="og:description" content="Our mission is to create the best ecommerce platform for Bangladeshi entreprenuers and help them to start their startup effortlessly." />
    <meta property="fb:app_id" content="{{Config::get('facebook.appId')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:image" content="{{asset('img/about_og.jpg')}}" />
    
    <meta property="article:author" content="{{URL::route('home')}}" />
    <meta property="article:publisher" content="{{URL::route('home')}}" />
@stop
@section('aboutus')
    <div class="pageContainer">
    <div id="slider">
        <div class="slide">
            <!-- <img class="img-responsive" src="https://chorki.com/images/slide.jpg"> -->
            <img class="img-responsive" src="images/Ghoori-New-Head-Image.jpg">
        </div>
    </div>

    <section id="about">
        <div class="container">
            <div class="row">
                <div class="about col-sm-10 col-sm-offset-1">
                    <h2>About Ghoori</h2>
                    <p class="padding">
                        Ghoori is an ecommerce platform, where you can start your business any day and effortlessly. Customers are shopping online, in person, on mobile devices, and with social media. Reach them all with one platform will be a game changer and Ghoori is here to facilitate that. At Ghoori anyone can open an eShop for free. You can share your eShop with others. Also you can visit other eShops and purchase your desired products. Our eShop will give you a complete ecommerce solution. For registration email us at <a href="mailto:info@ghoori.com.bd" style="color:blue">info@ghoori.com.bd</a></p>
                </div>
            </div>
            <div class="row" id="bosses">

                <div class="about_img">
                    <div class="col-sm-3">
                        <div class="thc">
                            <div class="imgc img-position">
                                <img class="img-responsive" src="https://chorki.com/images/chorkibaj/auni.png">
                            </div>
                            <div class="circle_title">
                                <h4>Rizwana Rashid Auni</h4>
                                <p>Co-Founder</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="thc">
                            <div class=" imgc img-position">
                                <img class="img-responsive" src="https://chorki.com/images/chorkibaj/ceo.png">
                            </div>
                            <div class="circle_title">
                                <h4>Zahidul Amin</h4>
                                <p>CEO & Co-Founder</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="thc">
                            <div class=" imgc img-position">
                                <img class="img-responsive" src="images/rashed-moslem.png">
                            </div>
                            <div class="circle_title">
                                <h4>Rashed Moslem</h4>
                                <p>COO & Co-Founder</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="thc">
                            <div class=" imgc img-position">
                                <img class="img-responsive" src="https://chorki.com/images/chorkibaj/nazmus.png">
                            </div>
                            <div class="circle_title">
                                <h4>Nazmus Saquibe</h4>
                                <p>CTO & Co-Founder</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section id="what_do">
                <div class="container-fluid">
                    <div class="row">
                        <div class="about col-sm-10 col-sm-offset-1">
                            <h2>What We Do</h2>
                            <p class="padding">

                                Ghoori is an ecommerce platform. We are a passionate team who are working to create and develop the best possible e-platform for Bangladesh. Our dream is to become the most successful technology company. We are working hard to help entrepreneurs to start and promote their online business. We believe and stand for quality, integrity, empowerment, innovation and Bangladeshi lifestyle. Our mission is to create the best platform for Bangladeshi entrepreneurs. </p>
                        </div>
                    </div>


                    <div id="slider row" style="margin-bottom: 30px;">
                        <div class="slide">
                            <img class="img-responsive" src="images/Ghoori-New-Slider-Image.jpg">
                        </div>
                    </div>

                    <div class="row">

                        <div class="what_do">
                            <div class="col-sm-3">
                                <div class="circle">
                                    <img src="https://chorki.com/images/chorkibaj/salvine.png" class="img-circle img-responsive" alt="Mirza Aliva Salvin">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="what_para">
                                    <h4>Mirza Aliva Salvin</h4>
                                    <p>Mobile Application Engineer</p>
                                    <p>Studied CSE in AUST | Like to code &amp; explore new ideas | Addicted to TV series, movies &amp; anime | Love drawing cartoon .</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="what_do">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="what_para text-right">
                                    <h4>Mohsin Shishir</h4>
                                    <p>Software Engineer</p>
                                    <p>CSE Graduate, AUST | Kind of Introvert, Curious Minded, Good Listener  | Interested in: Games & Sports, Photography, Watching Movies |  Guitarist | Cricketer | Passion: Programming</p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="circle">
                                    <img class="img-responsive" src="https://chorki.com/images/chorkibaj/shishir.png">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="what_do">
                            <div class="col-sm-3">
                                <div class="circle">
                                    <img class="img-responsive" src="https://chorki.com/images/chorkibaj/riasat.png">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="what_para">
                                    <h4>Riasat Raihan Noor</h4>
                                    <p>Software Engineer</p>
                                    <p>Co-Founder, Corrupted Coders | Ex-AUST| Interest in: Sports, Watching Movies, TV series</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="what_do">
                            <div class="col-sm-6 col-sm-offset-3 ">
                                <div class="what_para text-right">
                                    <h4>Imtiaz Shakil Siddique</h4>
                                    <p>Senior Software Engineer</p>
                                    <p>ACM ICPC DHAKA Regional Champion 2013 | Member of <a href="https://www.facebook.com/Attoprotoyee">SUST_ATTOPROTTOYEE</a> | Serious Gamer BF4,COD,DOTA you name it | Weirdest person in the office | Love to code, share ideas</p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="circle">
                                    <img class="img-responsive" src="https://chorki.com/images/chorkibaj/shakil.png">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="what_do">
                            <div class="col-sm-3">
                                <div class="circle">
                                    <img class="img-responsive" src="https://chorki.com/images/chorkibaj/arafat.png">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="what_para">
                                    <h4>Arafat Azam</h4>
                                    <p>Software Engineer</p>
                                    <p>Freelance Writer | Lifelong Learner | Founder of FoonJitsu| Ex-NSU</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="what_do">
                            <div class="col-sm-6 col-sm-offset-3 ">
                                <div class="what_para text-right">
                                    <h4>Tanbin Siyam</h4>
                                    <p>Senior Software Engineer</p>
                                    <p>Co-Founder, NerdCats | Co-Founder, Spiregy | Volunteer & Font Developer, OmicronLab | Ex-KUET </p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="circle">
                                    <img class="img-responsive" src="https://chorki.com/images/chorkibaj/tanbin.png">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="what_do">
                            <div class="col-sm-3">
                                <div class="circle">
                                    <img src="https://chorki.com/images/chorkibaj/anup.png" class="img-circle img-responsive" alt="Anup Rahman">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="what_para">
                                    <h4>Anup Rahman</h4>
                                    <p>UX Engineer</p>
                                    <p>Junior most member A.K.A Kid of the Office | Weird,Interesting & Creative Designer | Studying at East West University, Dept. of CSE | Musician And Composer | Love listening to Songs, Watching Anime, Gaming.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="what_do">
                            <div class="col-sm-6 col-sm-offset-3 ">
                                <div class="what_para text-right">
                                    <h4>Md Tahmidur Rahman</h4>
                                    <p>Spcialist Communication &amp; Brand</p>
                                    <p>Freelance Writer| Interest in: Photography, Sports, Reading books, Watching Movies, TV series| Curious Mind, Loves Food</p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="circle">
                                    <img src="https://chorki.com/images/chorkibaj/tahmid.png" class="img-circle img-responsive" alt="Tahmidur Rahman">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="what_do">
                            <div class="col-sm-3">
                                <div class="circle">
                                    <img src="https://chorki.com/images/chorkibaj/biswajit.png" class="img-circle img-responsive" alt="Anup Rahman">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="what_para">
                                    <h4>Biswajit Pandey</h4>
                                    <p>Software Engineer</p>
                                    <p>National Hackathon Champion - 2014 | Love To Solve, Wanna Be Anonymous | Shooting - COD Is My Favorite Game | Travelling & Bike Riding Is My Hobby.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

                <section id="our_product">
                    <div class="container">
                        <div class="our_product">
                            <div class="row">
                                <div class="product_descrip">
                                    <h2>Our Products</h2>
                                    <p class="padding">We Make Our Own Products</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="product_icon">
                                    <div class="col-sm-2 col-sm-offset-2">
                                        <a href="javascript:">
                                            <img class="img-responsive" src="https://chorki.com/images/pro_icon1.png">
                                        </a> 
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="javascript:">
                                            <img class="img-responsive" src="https://chorki.com/images/pro_icon2.png">
                                        </a>  
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="javascript:">
                                             <img class="img-responsive" src="https://chorki.com/images/pro_icon3.png">
                                        </a>                                       
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="javascript:">
                                            <img class="img-responsive" src="https://chorki.com/images/pro_icon4.png">
                                        </a>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="our_partners">
                    <div class="container">
                        <div class="our_partners">
                            <div class="row">
                                <div class="partners_descrip">
                                    <h2>Our Partners</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="partner_icon">
                                   <div class="col-sm-2 col-sm-offset-2">
                                        <a href="//www.lfotto.com" target="_blank">
                                        <img class="img-responsive" src="{{asset('img/partners/lfotto.jpg')}}">
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                         <a href="//www.muthofun.com" target="_blank">
                                        <img class="img-responsive" src="https://chorki.com/images/partners/muthofon.png">
                                         </a>
                                    </div>
                                    <div class="col-sm-2">
                                         <a href="//www.aamarpay.com" target="_blank">
                                        <img class="img-responsive" src="https://chorki.com/images/partners/amarpay.png">
                                         </a>
                                    </div>
                                    <div class="col-sm-2">
                                         <a href="//www.ecourier.com.bd" target="_blank">
                                        <img class="img-responsive" src="https://chorki.com/images/partners/ecourier.png">
                                      </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="partner_icon">
                                   <div class="col-sm-2 col-sm-offset-2">
                                        <a href="//www.bkash.com" target="_blank">
                                            <img class="img-responsive" src="{{asset('img/partners/bkash.jpg')}}">
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                         
                                    </div>
                                    <div class="col-sm-2">
                                         
                                    </div>
                                    <div class="col-sm-2">
                                         
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="our_culture">
                    <div class="container-fluid">
                        <div class="our_culture">
                            <div class="row">
                                <div class="culture_descrip col-sm-10 col-sm-offset-1">
                                    <h2>Our Culture</h2>
                                    <p class="padding">
                                        At Ghoori we share a common goal and vision for the company. We reflect the culture of Bangladesh and her heritage. We carry an open mind and associates with startups. We want to inspire everyone to share their ideas and views. Ghoori will always maintain a healthy and connecting relationship with the partners and customers. Our office is designed to encourage interactions between Ghoori-wala within and across teams, and to flicker chat about work as well as play. 
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="product_icon">
                                    <div class="col-sm-6">
                                        <div class="box">
                                            <img class="img-responsive" src="{{asset('images/550x300-image-1.jpg')}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="box">
                                            <img class="img-responsive" src="{{asset('images/550x300-image-2.jpg')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="product_icon">
                                    <div class="col-sm-4">
                                        <div class="boxs">
                                            <img class="img-responsive" src="{{asset('images/360x300-1.jpg')}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="boxs">
                                            <img class="img-responsive" src="{{asset('images/360x300-2.jpg')}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="boxs">
                                            <img class="img-responsive" src="{{asset('images/360x300-3.jpg')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="our_mission">
                    <div class="container">
                        <div class="our_mission">
                            <div class="row">
                                <div class="mission_descrip">
                                    <h2>Our Mission</h2>
                                    <p class="padding">
                                        Our mission is to create the best ecommerce platform for Bangladeshi entreprenuers and help them to start their startup effortlessly.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div id="slider">
                    <div class="slide">
                        <img class="img-responsive" src="https://chorki.com/images/slide1.jpg">
                    </div>
                </div>

                <section id="our_vission">
                    <div class="container">
                        <div class="our_vission">
                            <div class="row">
                                <div class="vission_descrip">
                                    <h2>Our Vision</h2>
                                    <p class="padding">
                                        We want to become the most successful ecommerce platform from Bangladesh in the world.
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="logo">
                                    <div class="col-md-6 col-sm-6 col-md-offset-5 col-sm-offset-5 text-center">
                                        <img class="img-responsive" src="img/55_double.png" alt="Ghuri Logo" width="160px" style="margin-bottom:25px; margin-top:-20px; margin-left:20px;">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 text-center">
                                            <p class="text-center">&copy;2015 all rights reserved</p>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
</div>
@stop