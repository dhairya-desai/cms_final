<x-admin-master>
@section('content')
<h1>Create</h1>
<form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
@csrf
<div class="form-group">
    <label for="title">Title</label>
        <input  type="text"      
                name="title"
                class="form-control"
                id="title"
                placeholder="Enter title">
</div>




<div class="form-group">
     <label for="fie">File</label>
        <input type="file"
               name="post_image"
               class="form-control-file"
               id="post_image">
</div>

<div>
<textarea name="body" 
          id="body" 
          class="form-control"
          cols="30" rows="10"></textarea>
</div>

<div class="form-group">
<label for=""></label>
<input type="text" name="" class="form-control" id="" placeholder="">
</div>


<button type ="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

</x-admin-master>