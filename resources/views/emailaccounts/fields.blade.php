
<div class="form-group">
    <label for="name">Account Name</label>
    {!! Form::text('name', null, [
        'class' => 'form-control',
        'aria-describedby' => 'nameHelp',
        'placeholder' => 'Enter a name for this account'
    ]) !!}
    <small id="nameHelp" class="form-text text-muted">This will be displayed as name on your emails as well.</small>
</div>

<div class="form-group">
    <label for="username">Username</label>
    {!! Form::text('username', null, [
        'class' => 'form-control',
        'placeholder' => 'Enter the username to login to server'
    ]) !!}
</div>

<div class="form-group">
    <label for="password">Password</label>
    {!! Form::password('password', [
        'class' => 'form-control',
    ]) !!}
</div>

<div class="form-group">
    <label for="host">Server</label>
    {!! Form::text('host', null, [
        'class' => 'form-control',
        'aria-describedby' => 'hostHelp',
        'placeholder' => 'Enter a server hostname or IP'
    ]) !!}
    <small id="hostHelp" class="form-text text-muted">Your email server hostname or IP.</small>
</div>


<div class="form-group">
    <label for="port">Port</label>
    {!! Form::text('port', null, [
        'class' => 'form-control',
        'aria-describedby' => 'portHelp',
        'placeholder' => 'Enter port, example : 993'
    ]) !!}
    <small id="portHelp" class="form-text text-muted">Default 143, SSL 993.</small>
</div>


<div class="form-group">
    <label for="encryption">Encryption</label>
    {!! Form::text('encryption', null, [
        'class' => 'form-control',
        'aria-describedby' => 'encryptionHelp',
        'placeholder' => 'Type encryption for this account'
    ]) !!}
    <small id="encryptionHelp" class="form-text text-muted">Possible values: No, TLS, SSL.</small>
</div>

<div class="form-group">
    <label for="protocol">Protocol</label>
    {!! Form::text('protocol', null, [
        'class' => 'form-control',
        'aria-describedby' => 'protocolHelp',
        'placeholder' => 'Enter email protocol for this account'
    ]) !!}
    <small id="protocolHelp" class="form-text text-muted">Choose between IMAP or POP3.</small>
</div>
