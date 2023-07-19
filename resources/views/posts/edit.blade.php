<x-layouts.main>

    <x-slot:title>
        Postni o'zgartirish #{{$post->id}}
    </x-slot:title>
    
        <x-page-header>
            Postni o'zgartirish #{{$post->id}}
        </x-page-header>

         <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            {{-- <div class="row align-items-end mb-4"> --}}
            </div>
            <div class="row">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="contact-form">
                        <div id="success"></div>
                        <form action="{{route('posts.update', ['post' => $post->id])}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-row">
                                <div class="col-sm-6 control-group">
                                    <input type="text" class="form-control p-4" name="title" value="{{ $post->title }}" />
                                    @error('title')
                                    <p class="help-block text-danger">{{ $message }}</p>
                                    @enderror
                                    
                                </div>
                                
                            </div>

                            <div class="control-group mt-2">
                                <input type="file" class="form-control p-4" name="photo"  placeholder="Qisqacha"data-validation-required-message="Please enter a subject" />
                                {{-- @error('photo')
                                    <p class="help-block text-danger">{{ $message }}</p>
                                    @enderror --}}
                            </div>
                            <div class="control-group mt-2">
                                <input type="text" class="form-control p-4" name="short_content" value="{{ $post->short_content }}" data-validation-required-message="Please enter a subject" />
                                @error('short_content')
                                    <p class="help-block text-danger">{{ $message }}</p>
                                    @enderror
                            </div>
                            <div class="control-group mt-2">
                                <textarea class="form-control p-4" rows="6" name="content"  data-validation-required-message="Please enter your message">{{ $post->content }}</textarea>
                                @error('content')
                                    <p class="help-block text-danger">{{ $message }}</p>
                                    @enderror
                            </div>
                            <div>
                                <button class="btn btn-primary mt-2 btn-block py-3 px-5" type="submit">Saqlash</button>
                                <a href="{{route('posts.show', ['post'=>$post -> id])}}" class="btn btn-secondary mt-2">Bekor Qilish</a>
                            </div>
                        </form>
                    </div>
                </div>
{{--                 
            </div> --}}
        </div>
    </div>
    <!-- Contact End -->

</x-layouts.main>