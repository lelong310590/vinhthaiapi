@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Error !</strong>
        @foreach ($errors->all() as $e)
            <div>{{$e}}</div>
        @endforeach
    </div>
@endif

{!! \Base\Supports\FlashMessage::renderMessage('create') !!}
{!! \Base\Supports\FlashMessage::renderMessage('delete') !!}
{!! \Base\Supports\FlashMessage::renderMessage('edit') !!}