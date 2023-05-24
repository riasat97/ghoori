<ul>

    <li>
        {{ Form::label('tag', 'Tag Name') }}
        {{ Form::text('tagName') }}
        {{ $errors->first('tagName', '<p class="error">:message</p>') }}
    </li>

    <li>
        {{ Form::submit('Save') }}
    </li>
</ul>