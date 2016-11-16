@extends('main')

@section('title', 'Delete Comment ?')

@section('stylesheets')
{!! Html::style('css/parsley.css') !!}
{!! Html::style('css/select2.min.css') !!}
@endsection

@section('content')

<div class="row">
    <div id="comment-form" class="col-md-10 col-md-offset-1 jos">
        <h1>Delete Comment?</h1>
        <hr>
        <p>
            <strong>Name:</strong>{{ $comment->name }}<br/>
            <strong>Email:</strong>{{ $comment->email }}<br/>
            <strong>Comment:</strong>{{ $comment->comment }}<br/>
        </p>
        {!! Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
                    {!! Form::close() !!}   
    </div>
</div>
@endsection

@section('scripts')
{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2.min.js') !!}
<script type="text/javascript">
    $(".select2-multi").select2();

</script>
@endsection
