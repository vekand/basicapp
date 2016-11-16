@extends('main')

@section('title', 'Output')

@section('stylesheets')
{!! Html::style('css/parsley.css') !!}
{!! Html::style('css/select2.min.css') !!}

@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-offset-1 text-center">
        <h1></h1>
    </div>
  <!--   <div class="col-md-10 col-offset-1 text-center">
      <a href="{{ route('courses.editor', ['id' =>$course] ) }}">Back</a>
  </div> -->

<div class="col-md-10 col-offset-1">
        {!! $content !!}
    </div>
</div>
@endsection

@section('scripts')
{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2.min.js') !!}
<script type="text/javascript">

</script>
@endsection
