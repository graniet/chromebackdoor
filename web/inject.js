function Logout(){
    console.log('Bot unlogged')
    $.get('class/bot_logout.php');
}
setInterval(Logout,100000);