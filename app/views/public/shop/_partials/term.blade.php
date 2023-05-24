@extends('public.shop._layouts.index')
@section('title')
    Terms of Service
@stop
@section('metatags')
    <link rel="canonical" href="{{URL::route('store.getTerms')}}">
    <meta property="og:title" content="Ghoori #Terms" />
    <meta property="og:site_name" content="ghoori.com.bd"/>
    <meta property="og:url" content="{{URL::route('store.getTerms')}}" />
    <meta property="og:description" content="The Ghoori web site and service (the “Service”) which is operated by Ghoori, Inc. (“Company”). By using the Service you are agreeing to be bound by these Terms of Use." />
    <meta property="fb:app_id" content="{{Config::get('facebook.appId')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:image" content="{{asset('img/page_og.jpg')}}" />
    
    <meta property="article:author" content="{{URL::route('home')}}" />
    <meta property="article:publisher" content="{{URL::route('home')}}" />
@stop
@section('terms')
    <div class="container terms shadow">
        <div class="row term">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 term-point">
                <h2>Terms and Conditions</h2>
                <p>The Ghoori web site and service (the “Service”) which is operated by Ghoori, Inc. (“Company”). By using the Service you are agreeing to be bound by these Terms of Use.</p>
                <p><i>Please reGhooriad these Terms of Use carefully before registering or using the Service. If you do not accept these Terms of Use, then you may not use the Service. These Terms of Use are subject to change by Ghoori at any time, effective when posted on the Service. Your continued use after such notice will constitute acceptance by you of such changes</i></p>
            </div>
        </div>

        <div class="row term">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 term-point">
                <h6>Use of the Service.</h6>
                <p>You may use this Service only for personal and commercial purposes only and subject to these Terms of Use, all applicable laws, rules and regulations and any agreements or terms with third parties to which you are subject. The Service is for e-commerce industry.</p>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 term-basically">
                <h6>Basically,</h6>
                <p>Ghoori is a professional service for e-commerce industry</p>
            </div>
        </div>

        <div class="row term">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 term-point">
                <h6>Registration</h6>
                <p>You may use the Service without registration, but in that case you will not be able to use many services offered by Ghoori. Your account is for your sole, personal use, you may not authorize others to use your account, and you may not assign or otherwise transfer your account to any other person or entity. You are responsible for the security of your password and will be solely liable for any use or unauthorized use under such password.</p>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 term-basically">
                <h6>Basically,</h6>
                <p>You need to register to get all professional services offered by Ghoori.</p>
            </div>
        </div>

        <div class="row term">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 term-point">
                <h6>Your License to Company.</h6>
                <p>All services of Ghoori may provide you with an opportunity to share and upload, or submit to public forums, contests, sweepstakes, programs or other aspects of the Service, your photos, videos, text and other information (mutually any submission or derivative thereof is referred to as “Content”). You hereby grant Ghoori a perpetual license to use, redact, republish, copy, distribute, perform and distribute your Content and screen name, including any intellectual property contained therein, in any medium now known or hereinafter developed without payment or compensation to you and without seeking any further approval from you as part of the Service or in support of the Service through advertising and marketing. You acknowledge that nothing contained within your Content would require us to seek permission of a third party in order to use the Content as described in these Terms of Use. You also agree to waive any moral rights, or right to any residual payment associated with Content if such Content is published, sold, distributed, or otherwise commercially exploited.</p>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 term-basically">
                <h6>Basically,</h6>
                <p>Ghoori can use, distribute etc for commercial purposes</p>
            </div>
        </div>

        <div class="row term">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 term-point">
                <h6>Acceptable Use Policy.</h6>
                <p>Ghoori expects all of its users to be respectful of other people. If you notice any violation of this Acceptable Use Policy or other unacceptable behavior by any user, you should report such activity to Company at <a href="mailto:info@ghoori.com.bd">info@ghoori.com.bd</a></p>
                <p>You are solely responsible for the Content that you post on the Service or transmit to other users and agree that you will not hold Company responsible or liable for any Content from other users that you access on the Service.</p>
                <p>Categories of prohibited Content below are merely examples and are not intended to be exhaustive. Ghoori will make the sole determination as to whether or not Content is acceptable for the Service. Without limitation, you are that you will not post or transmit to other users anything that contains Content that:</p>
                <ul>
                    <li>is defamatory, abusive, obscene, profane or offensive;</li>
                    <li>Infringes or violates another party’s intellectual property rights (such as music, videos, photos or other materials for which you do not have written authority from the owner of such materials to post on the Service);</li>
                    <li>Violates any party’s right of publicity or right of privacy;</li>
                    <li>Is threatening, harassing or that promotes racism, bigotry, hatred or physical harm of any kind against any group or individual; Promotes or encourages violence;</li>
                    <li>is inaccurate, false or misleading in any way;</li>
                    <li>is illegal or promotes any illegal activities;</li>
                    <li>contains personal information of any party such as phone numbers, addresses, license plate numbers etc;</li>
                    <li>contains software viruses or any other computer code, files or programs designed to interrupt, destroy or limit the functionality of any computer software or hardware or telecommunications equipment; or</li>
                    <li>Contains any advertising, promotional materials, “junk mail,” “spam,” “chain letters,” “pyramid schemes,” or any other form of solicitation.</li>
                </ul>
                <p>You may not use spiders, robots, data mining techniques or other automated devices or programs to catalog, download or otherwise reproduce, store or distribute content available on the Service. Further, you may not use any such automated means to manipulate the Service or attempt to exceed the limited authorization and access granted to you under these Terms of Use. You may not resell use of, or access to, the Service to any third party.</p>

            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 term-basically">
                <h6>Basically,</h6>
                <p>You can always opt out and not choose to provide your information.</p>
            </div>
        </div>

        <div class="row term">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 term-point">
                <h6>Accessing and updating your personal information</h6>
                <p>You can update and access your personal information anytime from your account in our website. If your information is wrong, we strive to give you ways to update it quickly or to delete it unless we have to keep that information for legitimate business or legal purposes. When updating your personal information, we may ask you to verify your identity before we can act on your request.</p>

            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 term-basically">
                <h6>Basically,</h6>
                <p>We expect everyone to respect others. If you find anyone using abusing language or activity please let us know.</p>
            </div>
        </div>

        <div class="row term">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 term-point">
                <h6>Termination of Access.</h6>
                <p>In addition to any right or remedy that may be available to us under these Terms of Use or applicable law, Ghoori may suspend, limit or terminate your account, or all or a portion of your access to the Service, at any time with or without notice and with or without cause. In addition, we may refer any information on illegal activities, including your identity, to the proper authorities.</p>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 term-basically">
                <h6>Basically,</h6>
                <p>Ghoori can terminate your services anytime with showing proper reasons.</p>
            </div>
        </div>

        <div class="row term">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 term-point">
                <h6>Privacy</h6>
                <p>The privacy of your personally identifiable information is very important to us. For more information on what information we collect and how we use such information, please read our privacy policy. Read our Privacy policy to know more.</p>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 term-basically">
                <h6>Basically,</h6>
                <p>We give high priority to your privacy. And never share any information to anyone or any commercial company.</p>
            </div>
        </div>

        <div class="row term">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 term-point">
                <h6>Links</h6>
                <p>This Service may contain links to other web sites not maintained by us. These links may include listings that can provide you with further information, or links that have been included in materials uploaded to the Service by a party other than Ghoori. We encourage you to be aware when you leave our Service and to read the terms and conditions and privacy statements of each and every web site that you visit. We are not responsible for the practices or the content of such other web sites or services. Despite any links that might exist on the Service, we do not endorse and are not affiliated with such third parties.</p>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 term-basically">
                <h6>Basically,</h6>
                <p>Ghoori will not be responsible for any third party privacy issue.</p>
            </div>
        </div>
        <div class="row term">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 term-point">
                <h6>Our Proprietary Rights.</h6>
                <p>Ghoori or its licensors are the exclusive owners of all software, graphics, designs and all copyrights, trademarks and other intellectual property or proprietary rights contained on or used in connection with the Service. Except as set forth herein, you agree not to copy, distribute, modify or make derivative works of any materials without the prior written consent of the owner of such materials. Ghoori reserves all rights not granted under these Terms of Use.</p>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 term-basically">
                <h6>Basically,</h6>
                <p>Ghoori is sole owner of all services, tools etc in <a href="https://ghoori.com.bd">ghoori.com.bd</a></p>
            </div>
        </div>
        <div class="row term">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 term-point">
                <h6>Indemnity</h6>
                <p>You agree to defend, indemnify and hold harmless Company, its officers, directors, employees, business partners and agents, from and against any and all claims, damages, obligations, losses, liabilities, costs or debt, and expenses (including but not limited to attorney’s fees) arising from: (i) any breach by you of any of these Terms of Use, (ii) your Content, (iii) your use of materials or features available on the Service (except to the extent a claim is based upon infringement of a third party right by materials created by Company) or (iv) a violation by you of applicable law or any agreement or terms with a third party to which you are subject.</p>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 term-basically">
                <h6>Basically,</h6>
                <p>Your business has to be legal in terms of Bangladeshi Company and other related laws. Ghoori will not be responsible for any illgal action caused by you</p>
            </div>
        </div>

        <div class="row term">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 term-point">
                <h6>State law- Following IP related laws are prevailing in Bangladesh:</h6>
                <p>The Patents and Designs Act -1911;</p>
                <p>The Trademarks Act – 2009;</p>
                <p>The Copyrights Act – 2000 (Amended in 2005).</p>
                <p>The following IP rights are protected under these laws:</p>
                <p>A patent is an exclusive right granted for an invention, which is a product or a process that provides, in general, a new way of doing something, or offers a new technical solution to a problem.  Under the Patents and Designs Act -1911 patents are granted. Patents provide 16 years protection from the date of filing of the application.</p>
                <p>An industrial design is the ornamental or aesthetic aspect of an article. The design may consist of three-dimensional features, such as the shape or surface of an article, or of two-dimensional features, such as patterns, lines or color. Industrial designs are protected under The Patents and Designs Act -1911. Registration of assign is given for 5 years. It could be renewed twice, each renewal remains valid for 5 years.</p>
                <p>A trademark is a distinctive sign which identifies certain goods or services as those produced or provided by a specific person or enterprise. The trademarks system helps consumers identify and purchase a product or service because its nature and quality, indicated by its unique trademark, meets their needs. A registered trademark provides protection to the owner of the mark by ensuring the exclusive right to use it to identify goods or services, or to authorize another to use it in return for payment. In Bangladesh trademarks and service marks are registered under The Trademarks Act- 2009. Registration provides 7 years protection; it can be renewed every after 10 year on payment of renewal fees</p>
                <p>Copyrights are protected for original intellectual work of literature, art, music, software, etc. under The copyrights Act – 2000 (Amended in 2005). Copyright exist upto 60 years after the death of copyright owner.
                    The Department of Patents, Designs and Trademarks (DPDT) administers all the above mentioned IP rights except copyrights.
                <p>Email: <a href="mailto:info@ghoori.com.bd">info@ghoori.com.bd</a></p>
                <p>It is our policy to terminate relationships regarding content with third parties who repeatedly infringe the copyrights of others.</p>
                <p>Contact Information. Should you have any questions you may contact us at <a href="mailto:info@ghoori.com.bd">info@ghoori.com.bd</a></p>
                <p>Effective Date: These Terms of Use were last updated on May 10, 2015</p>

            </div>
        </div>

    </div>

@stop