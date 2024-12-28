<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course CRUD Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class='bg-dark text-white py-2 text-center'>
        <h2>Course CRUD</h2>
    </div>

    <div class="container">
        <div class="row d-flex justify-content-center mt-4">
            <div class="col-md-10 d-flex">
                <a href="{{ route('courses.index')}}" class="btn btn-secondary px-3"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg my-4">
                    <div class="card-header text-center bg-dark text-white">
                        <h4>Edit Course</h4>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('courses.update', $course->id) }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <div class="mb-4">
                                <label for="name" class="form-label h5 text-secondary">Name<span
                                        class='text-danger'>*</span></label>
                                <input type="text" value="{{ old('name', $course->name) }}" class="@error('name') is-invalid @enderror form-control form-control-lg" id="name" name="name"
                                    placeholder='Course Name'>
                                @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label h5 text-secondary">Description</label>
                                <textarea rows="5" class="form-control form-control-lg" id="description"
                                    name="description" placeholder='Course Description'>{{ old('description', $course->description) }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label h5 text-secondary">Image</label>
                                <input type="file" accept='image/*' class="form-control form-control-lg" id="image"
                                    name="image">
                                @if ($course->image != "")
                                    <img style="width:100%; max-width:200px;" class='my-3' src="{{ asset('uploads/courses/'.$course->image)}}" alt="">
                                @endif
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-lg btn-primary fw-bold" id="create-btn">Update Course</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>