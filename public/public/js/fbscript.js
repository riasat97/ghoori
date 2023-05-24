/**
 * Created by arafat on 4/28/15.
 */
$(document).ready(function() {
    var fbLoginButton  =    '.fbLoginButton';
    var loginButton = '.loginButton';
    var loginBeforeSubmitForm = '.loginBeforeSubmitForm';
    var fbConnectButton = '.fbConnectButton';
    var fbLoginBeforeFollowLink = '.fbLoginBeforeFollowLink';

    //@todo implement this
    var showAfterLogin =    '.showAfterLogin';
    var hideAfterLogin =    '.hideAfterLogin';

    var fbForm =            "#fbForm";
    var CSRFtoken =         $(fbForm).find('input[name="_token"]').val();
    var fbAppId =           $(fbForm).find('input[name="fbAppId"]').val();
    var ajaxLoginUrl =      $(fbForm).find('input[name="ajaxLoginUrl"]').val();
    var loginStatusUrl =    $(fbForm).find('input[name="loginStatusUrl"]').val();
    var permissions =       $(fbForm).find('input[name="permissions"]').val();
    var linkToFollowAfterFbLogin = null; // will be used by function
    // var redirectUrl =       '#';
    var redirectUrl =       $(fbForm).find('input[name="redirectUrl"]').val();
    var callBackFunction =  null;

    $.ajaxSetup({ cache: true });//@todo need to know why
    $.getScript('//connect.facebook.net/en_US/sdk.js', function(){
        FB.init({
            appId: fbAppId,
            version: 'v2.3'
        });

        $(loginButton).removeAttr('disabled');

        function redirect(){
            if(window.location.href == redirectUrl||redirectUrl==''){
                location.reload();
            }
            var url      = window.location.href;
            var hostname = getLocation(url).hostname;
            // console.log(redirectUrl);
            var toHostname = getLocation(redirectUrl).hostname;
            if(toHostname.indexOf(hostname) > -1){
                window.location = redirectUrl;
            }
            else location.reload();
        }

        function followLink(){
            var link = linkToFollowAfterFbLogin;
            linkToFollowAfterFbLogin = null;
            window.location = link;
        }

        function connectFB(fbId, userAccessToken, callBack){
            postFbData('settings/ajaxFbConnect',fbId,userAccessToken,callBack);
        }

        function authLoginWithFB(fbId, userAccessToken, callBack){
            postFbData(ajaxLoginUrl,fbId,userAccessToken,callBack);
        }

        function postFbData(submitUrl,fbId, userAccessToken, callBack){
            var loginData = {
                _token          : CSRFtoken,
                fbId            : fbId,
                accessToken     : userAccessToken
            };
            $.ajax({
                type    : "POST",
                url     : submitUrl,
                data    : loginData,
                success : function(response){
                    if(response.status === 'success'){
                        if(callBack) callBack();
                    }else{
                        alert(response.message);//@todo change it with a modal
                    }
                }
            });
        }

        function checkLoginStatus(callBack){
            var tokenData = {
                _token : CSRFtoken
            };
            // console.log(loginStatusUrl);
            $.ajax({
                type    : "GET",
                url     : loginStatusUrl,
                data    : tokenData,
                dataType: 'jsonp',
                success : function(response){
                    if(response.status === 'logged_in'){
                        if(callBack){
                            callBack();
                        }
                    }else{
                        $("#signInModal").modal('show');
                    }
                },
                error : function(){
                    //@todo do it
                    console.log('Error! check @todo');
                }
            });
        }

        $(loginButton).click(function(e){
            e.preventDefault();
            if(e.target.href != undefined || e.target.href != null){
                redirectUrl = e.target.href;
            }
            callBackFunction = redirect;
            checkLoginStatus(redirect);
        });

        $(fbConnectButton).click(function(e){
            e.preventDefault();
            callBackFunction = redirect;
            FB.login(function(response) {
                if (response.authResponse) {
                    var uid = response.authResponse.userID;
                    var accessToken = response.authResponse.accessToken;
                    connectFB(uid, accessToken, callBackFunction);
                    callBackFunction = null;
                }
            }, {scope: permissions, auth_type: 'rerequest', return_scopes: true});
        });

        $(fbLoginButton).click(function(e){
            e.preventDefault();
            $(this).find('i').removeClass('fa-facebook').addClass('fa-spinner fa-spin');
            callBackFunction = redirect;
            FB.login(function(response) {
                if (response.authResponse) {
                    var uid = response.authResponse.userID;
                    var accessToken = response.authResponse.accessToken;
                    authLoginWithFB(uid, accessToken, callBackFunction);
                    callBackFunction = null;
                }
            }, {scope: permissions, auth_type: 'rerequest', return_scopes: true});
        });

        $(fbLoginBeforeFollowLink).click(function(e){
            e.preventDefault();
            $(this).find('i').removeClass('fa-facebook').addClass('fa-spinner fa-spin');
            linkToFollowAfterFbLogin = e.target.href;
            callBackFunction = followLink;
            FB.login(function(response) {
                console.log(response);
                if (response.authResponse) {
                    var uid = response.authResponse.userID;
                    var accessToken = response.authResponse.accessToken;
                    authLoginWithFB(uid, accessToken, callBackFunction);
                    callBackFunction = null;
                }
            }, {scope: permissions, auth_type: 'rerequest', return_scopes: true});
        });

        $(loginBeforeSubmitForm).submit(function(e){
            e.preventDefault();
            callBackFunction = function(){
                console.log(e.target);
                $(e.target).unbind('submit').submit();
            };
            checkLoginStatus(callBackFunction);
        });

    });
    function getLocation(href) {
        var match = href.match(/^(https?\:)\/\/(([^:\/?#]*)(?:\:([0-9]+))?)(\/[^?#]*)?(\?[^#]*|)(#.*|)$/);
        return match && {
            protocol: match[1],
            host: match[2],
            hostname: match[3],
            port: match[4],
            pathname: match[5],
            search: match[6],
            hash: match[7]
        }
    }
});