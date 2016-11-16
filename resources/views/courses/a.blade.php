 <!--         <div class="checkbox"> 
      <td>
   <input type="hidden" name="ide[]" value = "{{ $user->id }}"/>
        <input type="hidden" name="clic[]" />
      <input type="checkbox" onclick="parentBG(this)" {{ $course->hasUser($course->id, $user->id) ? 'checked' : '' }} name="check[]" value="{{ $course->hasUser($course->id, $user->id) ? 1 : 0 }}"/></td>
  </div> -->
         <td>
                   
                     <input type="hidden" name="clic[]" />
                {{ Form::checkbox('check[]',  $course->hasUser($course->id, $user->id) ? 1 : 0,  $course->hasUser($course->id, $user->id) ? 'checked' : '', ['onclick' => "parentBG(this)"]) }}
                </td>




{{-- in welcome --}}

<div class="row">
  <div class="col-md-8 posts">
    @foreach($posts as $post)
    <div class="post">
      <h3>{{ $post->title }}</h3>
      <p>{{ substr($post->body, 0, 300) }}{{ strlen($post->body) > 300 ? "..." : "" }}</p>
      <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary">Read more</a>
    </div>
    <hr>
    @endforeach
  </div>
  <div class="col-md-3 col-md-offset-1 text-center prima">
    <h2>Welcome !</h2>
    Home Page
  </div>
</div>       