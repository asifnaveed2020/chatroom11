<!-- resources/views/images/index.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Image Upload</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('images.save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                @for($i = 0; $i < 9; $i++)
                    <div class="col-md-4 mb-3">
                        @if(isset($images) && isset(json_decode($images->images, true)[$i]))
                            <div class="position-relative">
                                <img src="{{ Storage::url(json_decode($images->images, true)[$i]) }}" class="img-fluid">
                                <button type="button" data-index="{{$i}}"
                                    class="btn-delete btn btn-danger btn-sm position-absolute"
                                    style="top: 0; right: 0;">X</button>
                                <button type="button" data-index="{{$i}}"
                                    class="btn-add btn btn-danger btn-sm position-absolute"
                                    style="bottom: 0; right: 0;">+</button>
                            </div>
                            <input type="hidden" id="existing_image_{{$i}}"  data-index="{{$i}}"  name="existing_images[{{ $i }}]"
                                value="{{ json_decode($images->images, true)[$i] }}">
                                <input type="file" id="image_{{$i}}"  data-index="{{$i}}" class="images" name="images[{{ $i }}]" class="form-control-file">
                                @else
                            <input type="file" id="image_{{$i}}"  data-index="{{$i}}" class="images" name="images[{{ $i }}]" class="form-control-file">
                        @endif
                    </div>
                    <!-- <form id="delete-form-{{ $i }}" action="{{ route('images.delete', $i) }}" method="POST" style="display: none;">
                            @csrf
                        </form> -->
                @endfor
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <script>
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const index = this.dataset.index; 
                    alert('Ready to delete image at index: ' + index);
                    document.getElementById("existing_image_"+index).value='';
                    
                });
            });
            const images = document.querySelectorAll('.images');
            images.forEach(button => {
                button.addEventListener('change', function () {
                    const index = this.dataset.index;
                    alert('Ready to change image at index: ' + index);
                    document.getElementById("existing_image_"+index).value='';
                    
                });
            });
        </script>
    </div>
</body>

</html>