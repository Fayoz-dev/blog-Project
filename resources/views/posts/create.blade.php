<x-layouts.main>

    <x-slot:title>
        Blog Qo'shish
    </x-slot:title>

        <x-page-header>

            Blog Qo'shish
        </x-page-header>

         <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            {{-- <div class="row align-items-end mb-4"> --}}
                <div class="col-lg-6">
                    <h6 class="text-secondary font-weight-semi-bold text-uppercase mb-3">Uz.Hunter</h6>

                </div>

            </div>
            <div class="row">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="contact-form">
                        <div id="success"></div>
                        <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col-sm-6 control-group">
                                    <input type="text" class="form-control p-4" name="title" value="{{ old('title') }}" placeholder="Sarlavha"/>
                                    @error('title')
                                    <p class="help-block text-danger">{{ $message }}</p>
                                    @enderror

                                </div>

                                <div class="control-group mb-4">
                                    <select name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="control-group mb-4">
                                    <label>Tags</label>
                                    <select name="tags[]" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{$tag->id}}" >{{$tag->name}}</option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <div class="control-group mt-2">
                                <input type="file" class="form-control p-4" name="photo"  placeholder="Qisqacha"data-validation-required-message="Please enter a subject" />
                                {{-- @error('photo')
                                    <p class="help-block text-danger">{{ $message }}</p>
                                    @enderror --}}
                            </div>
                            <div class="control-group mt-2">
                                <input type="text" class="form-control p-4" name="short_content" value="{{ old('short_content') }}" placeholder="Qisqacha"data-validation-required-message="Please enter a subject" />
                                @error('short_content')
                                    <p class="help-block text-danger">{{ $message }}</p>
                                    @enderror
                            </div>
                            <div class="control-group mt-2">
                                <textarea class="form-control p-4" rows="6" name="content" value="{{ old('content') }}" placeholder="Content" data-validation-required-message="Please enter your message"></textarea>
                                @error('content')
                                    <p class="help-block text-danger">{{ $message }}</p>
                                    @enderror
                            </div>
                            <div>
                                <button class="btn btn-primary mt-2 btn-block py-3 px-5" type="submit">Saqlash</button>
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
