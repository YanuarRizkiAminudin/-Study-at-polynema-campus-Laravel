@csrf
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Upload Profil</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
        <div class="container">
            <div class="panel panel-primary col-md-8">
                <div class="panel-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{$message}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <img class="mb-3" src="images/{{ Session::get('image') }}" style="width: 250px;">
                    @endif

                    <form action="{{ route('profil.store') }}" method="POST" enctype="multipart/form-data">
                        
                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="mb-3">
                            <label class="form-label" for="image">Image:</label>
                            <input type="file" name="image" id="image"
                                class="form-control @error('image') is-invalid @enderror">

                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>