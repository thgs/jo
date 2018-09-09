
<div class="form-group">
    <label for="name">URL</label>
    {!! Form::text('url', null, [
        'class' => 'form-control',
        'aria-describedby' => 'nameHelp',
        'placeholder' => 'Enter the URL of the feed'
    ]) !!}
    <small id="nameHelp" class="form-text text-muted">Enter the URL of the RSS / Atom feed here.</small>
</div>



<div class="form-group">
    <label for="name">Feed Name</label>
    {!! Form::text('name', null, [
        'class' => 'form-control',
        'aria-describedby' => 'urlHelp',
        'placeholder' => 'Will try to take a guess..'
    ]) !!}
    <small id="urlHelp" class="form-text text-muted">Guess might not work nicely, so you can edit</small>
</div>

<div class="form-group">
    <label for="name">Update Every</label>
    {!! Form::text('update_every', null, [
        'class' => 'form-control',
        'aria-describedby' => 'updateEveryHelp',
        'placeholder' => 'Will too try to take a guess..'
    ]) !!}
    <small id="updateEveryHelp" class="form-text text-muted">Guess might not work nicely, so you can edit (Value is in minutes)</small>
</div>
