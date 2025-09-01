@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Add Blog</h2>
        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            <div class="mb-3">
                <label for="display_image" class="form-label">Display Image</label>
                <input type="file" name="display_image" class="form-control">
            </div>
            <div class="mb-3">
                <label for="blog_details" class="form-label">Blog Details</label>
                <textarea name="blog_details" id="blogDetails" class="form-control"
                    rows="5">{{ old('blog_details') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">
                <span class="material-icons" style="vertical-align:middle;">post_add</span> Add Blog
            </button>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        document.querySelector('form').addEventListener('submit', function (e) {
            const editorData = ClassicEditor.instances.blogDetails.getData();
            if (!editorData.trim()) {
                e.preventDefault();
                alert('Please enter blog details.');
            }
        });
        document.addEventListener("DOMContentLoaded", function () {
            var editorElement = document.querySelector('#blogDetails');
            if (editorElement) {
                ClassicEditor
                    .create(editorElement)
                    .catch(error => {
                        console.error('CKEditor initialization error:', error);
                    });
            }
        });
    </script>
@endsection