<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Laravel 11 Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
   <div class="bg-dark py-3">
    <h3 class="text-white text-center">Simple Laravel 11 CRUD</h3>
   </div>
  <div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
          <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
        </div>
     </div>
    <div class="row d-flex justify-content-center">
     <div class="col-md-10">
        <div class="card border-0 shadow-lg my-3">
            <div class="card-header">
                <h3>Create Product</h3>
            </div>
           <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="@error('name') is-invalid @enderror form-control form-control-lg" name="name" value="{{ old('name') }}" placeholder="Enter your name over here">
                    @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="sku" class="form-label">Sku</label>
                    <input type="text" value="{{ old('sku') }}" class="@error('sku') is-invalid @enderror form-control form-control-lg" name="sku" placeholder="Enter your sku over here">
                    @error('sku')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" value="{{ old('price') }}" class="@error('price') is-invalid @enderror form-control form-control-lg" name="price" placeholder="Enter your price over here">
                    @error('price')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="descrption" class="form-label">Desription</label>
                  <textarea name="description" class="@error('description') is-invalid @enderror form-control" cols="30" rows="5">{{ old('description') }}</textarea>
                  @error('description')
                  <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Upload Image</label>
                    <input class="@error('image') is-invalid @enderror form-control" name="image" value="{{ old('image') }}" type="file" id="formFile">
                    @error('image')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-primary col-md-10">Create</button>
            </div>
           </form>
        </div>
     </div>
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>