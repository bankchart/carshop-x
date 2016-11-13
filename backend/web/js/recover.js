/**
 * Created by bankchart on 11/11/2559.
 */
var recover = {
    sendMail : function(email){
        $.ajax({
            url : baseUrl + 'recover-password',
            type : 'post',
            data : { email : email.val() },
            success : function(data){
                if(data=='success'){
                    alert('Check your email please.');
                  //  location.href='/backend';
                }else{
                    alert('Your email not match.');
                  //  location.href='/backend';
                }
            }
        });
    }
};