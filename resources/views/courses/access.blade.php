@extends('main')

@section('title', 'Access to Course')
@section('stylesheets')
{!! Html::style('css/style2.css') !!}

@endsection
@section('content')
<h1>{{ $course->tipcurs }} <br/><small onclick="checkAll()" style="cursor:pointer;">--- Select All ---  </small><small onclick="uncheckAll()" style="cursor:pointer;">--- Unselect All --- </small>
</h1>
    <hr>
    <form action="{{ route('courses.assign', $course->id) }}" method="post" onsubmit="compl()">
        <table class="table body-table-background table-hover">
            <thead>               
                <th>Last Name</th>
                <th>First Name</th>
                <th>Address</th>
                <th>City</th>
                <th>School</th>
                <th>Teacher</th>
                <th>E-Mail</th>
                <th>Access to this course</th>
            </thead>
            <tbody>
               @foreach($users as $user)
                <input type="hidden" name="ide[]" value = "{{ $user->id }}"/>
               <tr>              
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->adresa }}</td>
                <td>{{ $user->oras }}</td>
                <td>{{ $user->scoala }}</td>
                <td>{{ $user->prof->nick_name }}</td>
                <td>{{ $user->email }} </td>
               
             <div class="checkbox"> 
      <td>
      <input type="checkbox" class="regular-checkbox"  id ="{{ $user->id }}" value ="{{ $user->id }}" onclick="parentBG(this)" {{ $course->hasUser($course->id, $user->id) ? 'checked' : '' }} name="check[]" value="{{ $course->hasUser($course->id, $user->id) ? 1 : 0 }}"/><label for="{{ $user->id }}"></label></td>
  </div>
 
            </tr>
            @endforeach
            {{ csrf_field() }}

        </tbody>

    </table>
    <div class="text-center">
        <button type="submit" class="btn btn-success">Assign Access</button>
    </div>
</form>
<!-- <div class="text-center">
   {{--  {!! $users->links() !!} --}}
</div> -->
<script type="text/javascript">
    function checkAll()
    {
        var checkboxes = document.getElementsByTagName('input'), val = null;    
        for (var i = 0; i < checkboxes.length; i++)
        {

           checkboxes[i].checked = 'checked';
           checkboxes[i].style.background = "lightgreen" ;

       }
   }
   function uncheckAll()
   {
    var checkboxes = document.getElementsByTagName('input'), val = null;    
    for (var i = 0; i < checkboxes.length; i++)
    {

       checkboxes[i].checked = '';
       checkboxes[i].style.background = "white";

   }
}

</script>
<script type="text/javascript">
function parentBG(elm){
    elm.parentNode.style.background = (elm.checked) ? "lightgreen" :"white";
   

}
</script>
<script type="text/javascript">
function compl(){
  var inputs = document.getElementsByTagName('input');
for (i=0; i<inputs.length; i++){
    if (inputs[i].type == 'checked' && inputs[i].checked){
        values = inputs[i].value;
       // var hid = document.getElementsByTagName('hidden');
        //hid[i].value=1;
    }


}
   

}
</script>
@endsection


