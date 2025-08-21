@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Edit Blog</h2>
        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
            </div>
            <div class="mb-3">
                <label for="display_image" class="form-label">Display Image</label>
                <input type="file" name="display_image" class="form-control">
                @if($blog->display_image)
                    <img src="{{ asset('storage/' . $blog->display_image) }}" alt="Image" width="80" class="mt-2">
                @endif
            </div>
            <div class="mb-3">
                <label for="blog_details" class="form-label">Blog Details</label>
                <textarea name="blog_details" id="blogDetails" class="form-control"
                    rows="10">{{ old('blog_details', $blog->blog_details) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="draft" @if($blog->status == 'draft') selected @endif>Draft</option>
                    <option value="published" @if($blog->status == 'published') selected @endif>Published</option>
                </select>
            </div>
            <button type="submit" class="btn btn-update">Update Blog</button>
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