@extends('public.shop._layouts.index')
@section('title')
    Privacy Policy
@stop
@section('metatags')
    <link rel="canonical" href="{{URL::route('store.getPrivacy')}}">
    <meta property="og:title" content="Ghoori #PrivacyPolicy" />
    <meta property="og:site_name" content="ghoori.com.bd"/>
    <meta property="og:url" content="{{URL::route('store.getPrivacy')}}" />
    <meta property="og:description" content="We are very conscious about our privacy policy and we would like to be very clear and transparent with how we use our user’s information." />
    <meta property="fb:app_id" content="{{Config::get('facebook.appId')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:image" content="{{asset('img/page_og.jpg')}}" />
    
    <meta property="article:author" content="{{URL::route('home')}}" />
    <meta property="article:publisher" content="{{URL::route('home')}}" />
@stop
@section('privacy')
    <div class="container terms shadow">
        <div class="row term">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 term-point">
                <h2>Acceptance Of Terms</h2>
                <p>We are very conscious about our privacy policy and we would like to be very clear and transparent with how we use our user’s information. This website and any of our services and sites directing you to this Privacy Policy are controlled by Ghoori.</p>
                <p> (Collectively “we” or “us”).</p>
                <h3>Our Privacy Policy explains:</h3>
                <ul>
                    <li>what information we collect and why we collect it.</li>
                    <li>How we use that information.</li>
                    <li>the choices we offer, including how to access and update information.</li>
                </ul>
                <p>If you have any questions about this Privacy Policy, please contact us at: <a href="mailto:info@ghoori.com.bd">info@ghoori.com.bd</a>.</p>

            </div>
        </div>

        <div class="row term">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 term-point">
                <h6>Acceptance Of Terms</h6>
                <p>We collect information to get user’s feedback as well as to provide superior services. Collecting user’s information is also very necessary to improve our business support.</p>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 term-basically">
                <h6>Basically,</h6>
                <p>We collect your information to provide better service.</p>
            </div>
        </div>

        <div class="row term">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 term-point">
                <h6>We collect information in two ways:</h6>
                <p>Information provided through a social network. Some of our services need you to sign up for an account, provide information for a contest or award, or link an account through a social network. We work with social networks including, but not limited to Facebook, Twitter, Google Plus, and LinkedIn. We have access to information you directly provide and information through those social networking services based on your privacy settings on those networks. Beside your accessible information Ghoori will not collect any information from your social network services.</p>

                <p>Information we get from your use of our services. We may collect information about the services that you use and how you use them. We may also have the process to collect information automatically regarding certain technical aspects such as:</p>

                <p>Device information. We may collect device-specific information (such as your hardware model, operating system version, unique device identifiers, and mobile information if you use a mobile device to access the site).</p>

                <p>Log information. When you use our services or view content provided by us, we might automatically collect and store certain information in server logs. This information may include:</p>

                <ul>
                    <li>Details of how you used our service, such as your navigation paths and search queries.</li>
                    <li>Mobile related information if you access our website using your mobile device.</li>
                    <li>Internet protocol address.</li>
                    <li>Device event information such as crashes, system activity, hardware settings, browser type, browser language, the date and time of your request and referral URL.</li>
                    <li>Cookies that may uniquely identify your browser, mobile device, or your account.</li>
                    <li>Browser type, operating system, and other technical information.</li>
                </ul>

            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 term-basically">
                <h6>Basically,</h6>
                <p>We collect information using Facebook Login system. We also collect information though users input.</p>
            </div>
        </div>

        <div class="row term">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 term-point">
                <h6>How we use information we collect</h6>
                <p>We use this information to provide, create, protect and improve our service quality, to develop new services and also develop ways to protect us as well as our users. We also use this information to optimize your search results and ads.</p>
                <p>We also keep your information when you contact us just to give you a better customer service with an advance tracking system. This actually help us to identify your nature of complain and understand your needs as per historical data. We may use your email address to inform you about our services, such as letting you know about upcoming changes or improvements.</p>
                <p>We use aggregated and demographic information to support our advertising needs so we can continue to provide many services for free. Your personally identifiable information is never disclosed to these parties, unless you consent.</p>
                <p>We, or our advertising networks may also use cookie, tag, beacon, or other similar technology to serve you relevant advertisements and alert you to our content, even on other sites and services. This technology can also be used to collect and analyze aggregated information about our users. To know more about information and technology act visit: http://www.moict.gov.bd/ict-policy-acts.html.</p>
                <p>Please note, all comment sections, forums, and other similar areas of Ghoori are public. So any information posted there will be visible for any users of Ghoori. We will ask for your permission before using information for a purpose other than those that are set out in this Privacy Policy.</p>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 term-basically">
                <h6>Basically,</h6>
                <p>We use your information to protect your service quality. We use your information to provide better search result as well. We expect everyone to respect each other privacy</p>
            </div>
        </div>

        <div class="row term">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 term-point">
                <h6>Choice</h6>
                <p>You can always have the choice to opt out our services. If you do not want to get any message or email from our end, you can always discontinue that service. Our automated system will keep you out from the very next communication. However, this opt out service will lock all our communication towards you including different offers and services.</p>
                <p>You may also set your browser to block all cookies, including cookies associated with our services, or to indicate when we are setting a cookie. However, it’s important to remember that many of our services may not function properly if your cookies are disabled.</p>
                <p>You have the right to remove your personal information from our databases. To do this, please delete your Ghoori account. If you have any problems or questions, please let us know by contacting us here <a href="mailto:info@ghoori.com.bd">info@ghoori.com.bd</a> and we will assist you with the process of deleting your account.</p>
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
                <p>You can always able to update or edit your information unless we have to keep that information unchanged due to legal issue.</p>
            </div>
        </div>

        <div class="row term">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 term-point">
                <h6>Information we share</h6>
                <p>According the ICT Law in Bangladesh, we never share personal information with companies, outside organizations and individuals unless one of the following circumstances applies:</p>
                <p>With your permission. We will share personal information with companies, outside organizations or individuals if we have your consent to do so.</p>
                <p>For external processing. We provide personal information to our affiliates or other trusted businesses or persons to process it for us, based on our instructions and in compliance with our Privacy Policy and any other appropriate confidentiality and security measures.</p>
                <p>For legal reasons. We will share personal information with companies, outside organizations or individuals if we have a good-faith belief that access, use, preservation or disclosure of the information is reasonably necessary to meet any applicable law, regulation, legal process or enforceable governmental request, detect, prevent, or otherwise address fraud, security or technical issues or protect against harm to the rights, property or safety of our users or the public as required or permitted by law.</p>
                <p>In case of a sale or asset transfer. If we become involved in a merger, acquisition or other transaction involving the sale of some or all of our assets, user information, including personal information collected from you through your use of our Services, could be included in the transferred assets. Should such an event occur, we would use reasonable means to notify you, either through email and/or a prominent notice on the services…</p>
                <p>In aggregated form for business purposes. We may share aggregated, non-personally identifiable information publicly and with our partners such as business with have a relationship with, advertisers or connected sites. For example, we may share information to show trends about the general use of our services.</p>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 term-basically">
                <h6>Basically,</h6>
                <p>We never share any personal information to any one or any company for any business purpose.</p>
            </div>
        </div>

        <div class="row term">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 term-point">
                <h6>Information security</h6>
                <p>We work hard to protect our users from unauthorized access to or unauthorized alteration, disclosure or destruction of information we hold however not website is entirely secure. You should protect the account information in your possession as well.</p>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 term-basically">
                <h6>Basically,</h6>
                <p>We work hard to protect your information in any situation</p>
            </div>
        </div>

        <div class="row term">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 term-point">
                <h6>Third-Party Sites</h6>
                <p>Our Privacy Policy does not apply to services offered by other companies or individuals, including products or sites that may be displayed to you on this site. We also do not control the privacy policies and your privacy settings on third-party sites, including social networks.</p>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 term-basically">
                <h6>Basically,</h6>
                <p>Ghoori will not be responsible for third party privacy issue. </p>
            </div>
        </div>

    </div>
@stop